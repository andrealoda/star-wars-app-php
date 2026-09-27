@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Nuovo pianeta</h1>

    <form action="{{ route('admin.planets.store') }}" method="POST">
        @include('admin.planets._form')
    </form>
</div>
@endsection