@extends('layouts.app')
@section('title', 'Contact Form')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="p-5">
                <h2 class="text-center">Update Contact Form</h2>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('contacts.update',$data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group pt-4">
                        <label for="name">
                            Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" name="name" value="{{$data->name}}">

                    </div>
                    <div class="form-group pt-4">
                        <label for="email">
                            Email <span class="text-danger">*</span>
                        </label>

                        <input type="email" class="form-control" name="email" value="{{$data->email}}">

                    </div>
                    <div class="form-group pt-4">
                        <label for="phone">
                            Phone <span class="text-danger">*</span>
                        </label>

                        <input type="number" class="form-control" name="phone" value="{{$data->phone}}">

                    </div>
                    <div class="form-group pt-4">
                        <label for="address">
                            Address <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" name="address" value="{{$data->address}}">

                    </div>
                    <div class="form-group pt-4">
                        <input type="hidden" value="{{$data->id}}">
                        <input type="submit" class="btn btn-primary" value="Update Contact">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection