@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-5" style="width: 22rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $data->name }} info</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $data->email  }}</li>
                    <li class="list-group-item">{{ $data->phone }}</li>
                    <li class="list-group-item">{{ $data->address  }}</li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('contacts.all') }}" class="btn btn-primary">Go Homepage</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection