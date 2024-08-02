@extends('layouts.app')
@section('title', 'Contact Form')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="p-5">
                <h2 class="text-center">Fill Up the Contact Form</h2>
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <div class="form-group pt-4">
                        <label for="name">
                            Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group pt-4">
                        <label for="email">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group pt-4">
                        <label for="phone">
                            Phone <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="phone">
                    </div>
                    <div class="form-group pt-4">
                        <label for="address">
                            Address <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group pt-4">
                        <input type="submit" class="btn btn-primary" value="Add New Contact" name="address">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection