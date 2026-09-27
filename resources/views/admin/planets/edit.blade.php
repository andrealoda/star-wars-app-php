@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Modifica pianeta</h1>

    <form action="{{ route('admin.planets.update', $planet) }}" method="POST">
        @method('PUT')
        @include('admin.planets._form')
    </form>
</div>
@endsection