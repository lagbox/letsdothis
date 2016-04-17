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
                    <div>
                        <strong>Name:</strong>
                        <p>
                            {{ $data->name }}
                        </p>
                    </div>
                    <div>
                        <strong>Value:</strong>
                        <p>
                            {{ $data->value }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
