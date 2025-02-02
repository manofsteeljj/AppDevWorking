@extends('layout')

@section('content')
<h1>Create Car Design</h1>

<form action="{{ route('car_designs.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Model:</label>
    <input type="text" name="model">
    <label>Description:</label>
    <textarea name="description"></textarea>
    <button type="submit">Create</button>
</form>
@endsection
