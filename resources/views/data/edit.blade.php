@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $action }} Data</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::model($data, [
                        'route' => $data->exists ? ['data.update', $data] : 'data.store',
                        'class' => 'form',
                        'role' => 'form',
                        'method' => $data->exists ? 'PUT' : 'POST'
                    ]) }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        {{ Form::text('name', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Name'
                        ]) }}
                    </div>
                    <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                        <label for="value">Value</label>
                        {{ Form::textarea('value', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Value'
                        ]) }}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
