<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;
use App\Http\Requests\DataRequest;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $data = Data::paginate(20);

        return view('data.index', compact('data'));
    }

    public function create()
    {
        $data = new Data;

        $action = 'Create';

        return view('data.edit', compact('action', 'data'));
    }

    public function store(DataRequest $request)
    {
        //$this->validate($request, $this->rules);

        $data = $request->only(['name', 'value']);

        $data['user_id'] = $request->user()->id;

        Data::create($data);

        return redirect()->route('data.index')->with('msg', 'Data was created.');
    }

    public function show(Data $data)
    {
        return view('data.show', compact('data'));
    }

    public function edit(Data $data)
    {
        $this->authorize($data);

        $action = 'Update';

        return view('data.edit', compact('data', 'action'));
    }

    public function update(DataRequest $request, Data $data)
    {
        $this->authorize($data);

        //$this->validate($request, $this->rules);

        $data->update($request->only(['name', 'value']));

        return redirect()->route('data.index')->with('msg', 'Data was updated.');
    }

    public function destroy(Data $data)
    {
        $this->authorize('delete', $data);

        $data->delete();

        return redirect()->route('data.index')->with('msg', 'Data was deleted.');
    }
}
