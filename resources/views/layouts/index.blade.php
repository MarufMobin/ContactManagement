@extends('layouts.app')
@section('title', 'Contact All Info')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <h2 class="pt-5 text-center">Contact All information List are here</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col" colspan="2" class="text-center">Action</th>
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