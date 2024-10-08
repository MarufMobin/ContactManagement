@extends('layouts.app')
@section('title', 'Contact All Info')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <h2 class="pt-5 text-center">Contact All information List are here</h2>
            <div class="my-4 d-flex justify-content-between">
                <div>
                    <a class="btn btn-primary btn-lg" href="{{ route('contacts.create') }}">Create New Record</a>
                    <a class="btn btn-primary btn-lg" href="{{ route('contacts.all', ['sort' => 'name', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Name</a>
                    <a class="btn btn-primary btn-lg" href="{{ route('contacts.all', ['sort' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Date Created</a>
                </div>
                <div>
                    <form action="{{ route('contacts.all') }}" method="GET">
                        <div class="d-flex">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email" class="form-control">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col" colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if( count($contracts) > 0 )
                    @foreach ( $contracts as $item )
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->address }}</td>
                        <td>
                            <a href="{{route('contacts.edit', $item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('contacts.delete',$item->id ) }}" method="POST">
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                        <td>
                            <a href="{{route('contacts.show', $item->id)}}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p>OOPS Nothing founded !</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection