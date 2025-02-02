@extends('layout')

@section('content')
<h1>Car Designs</h1>
<a href="{{ route('car_designs.create') }}">Create New Car Design</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Model</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    @foreach($carDesigns as $carDesign)
    <tr>
        <td>{{ $carDesign->id }}</td>
        <td>{{ $carDesign->name }}</td>
        <td>{{ $carDesign->model }}</td>
        <td>{{ $carDesign->description }}</td>
        <td>
            <a href="{{ route('car_designs.show', $carDesign->id) }}">View</a>
            <a href="{{ route('car_designs.edit', $carDesign->id) }}">Edit</a>
            <form action="{{ route('car_designs.destroy', $carDesign->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
