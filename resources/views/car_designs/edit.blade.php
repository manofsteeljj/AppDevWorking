@extends('layout')

@section('content')
<h1>Edit Car Design</h1>

<form action="{{ route('car_designs.update', $carDesign->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Name:</label>
    <input type="text" name="name" value="{{ $carDesign->name }}" required>
    <label>Model:</label>
    <input type="text" name="model" value="{{ $carDesign->model }}">
    <label>Description:</label>
    <textarea name="description">{{ $carDesign->description }}</textarea>
    <button type="submit">Update</button>
</form>
@endsection
