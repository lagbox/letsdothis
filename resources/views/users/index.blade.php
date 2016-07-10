@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users
                </div>

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">
                            <p>
                                {{ Session::get('msg') }}
                            </p>
                        </div>
                    @endif


                    @can ('create', new \App\User)
                        <span class="pull-right">
                            <a href="{{ route('users.create') }}" class="btn btn-success">Add New User</a>
                        </span>
                    @endcan

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            @can ('edit', $user)
                                                <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can ('delete', $user)
                                                <form method="POST" action="{{ route('users.destroy', [$user->id]) }}" style="display:inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <input type="submit" value="Delete" class="btn btn-danger">
                                                </form>
                                            @endcan
                                        </td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" align="center">No Data to display.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $users->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
