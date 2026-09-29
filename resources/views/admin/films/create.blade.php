@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Nuovo film</h1>

    <form action="{{ route('admin.films.store') }}" method="POST">
        @include('admin.films._form')
    </form>
</div>
@endsection