<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // just to see if the current user can do this action
        $this->authorize(new User);

        return view('users.edit', [
            'user' => new User,
            'action' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRequest $request)
    {
        // just to see if the current user can do this action
        $this->authorize(new User);

        $data = $request->all();

        // hash the password
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('users.index')
            ->withMsg('User was created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // can the current user edit this user
        $this->authorize($user);

        return view('users.edit', [
            'user' => $user,
            'action' => 'Update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UserRequest $request, User $user)
    {
        // can the current user update this user
        $this->authorize($user);

        $data = $request->all();

        // if there was no password passed, remove that field
        // if there was, lets hash it
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->withMsg('User was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        // can the current user delete this user
        $this->authorize('delete', $user);

        // if they deleted themselves ... log them out?
        if ($user->id == $request->user()->id) {
            auth()->logout();
        }

        $user->delete();

        return redirect()->route('users.index')
            ->withMsg('User was deleted.');
    }
}
