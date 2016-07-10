@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $action }} User</div>

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

                    {{ Form::model($user, [
                        'route' => $user->exists ? ['users.update', $user] : 'users.store',
                        'class' => 'form',
                        'role' => 'form',
                        'method' => $user->exists ? 'PUT' : 'POST'
                    ]) }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        {{ Form::text('name', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Name'
                        ]) }}
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email</label>
                        {{ Form::text('email', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Email'
                        ]) }}
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Password
                        @if ($user->exists)
                            <small>Leave this and the following field blank to not set a new password</small>
                        @endif
                        </label>
                        {{ Form::password('password', [
                            'class' => 'form-control',
                            'placeholder' => 'Password'
                        ]) }}
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password_confirmation">Password Confirm</label>
                        {{ Form::password('password_confirmation', [
                            'class' => 'form-control',
                            'placeholder' => 'Password Confirmation'
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
