@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Modifica film</h1>

    <form action="{{ route('admin.films.update', $film) }}" method="POST">
        @method('PUT')
        @include('admin.films._form')
    </form>
</div>
@endsection