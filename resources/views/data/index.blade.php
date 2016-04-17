@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data
                </div>

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">
                            <p>
                                {{ Session::get('msg') }}
                            </p>
                        </div>
                    @endif


                    @if (Auth::check())
                    <span class="pull-right">
                        <a href="{{ route('data.create') }}" class="btn btn-success">Add New Data</a>
                    </span>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Created At</th>
                                @if (Auth::check())
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr>
                                <th scope="row"><a href="{{ route('data.show', [$item]) }}">{{ $item->id }}</a></th>
                                <td><a href="{{ route('data.show', [$item]) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                @if (Auth::check())
                                <td>
                                    <a href="{{ route('data.edit', [$item->id]) }}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('data.destroy', [$item->id]) }}" style="display:inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                                @endif
                                <td></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ 4 + Auth::check() }}" align="center">No Data to display.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $data->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
