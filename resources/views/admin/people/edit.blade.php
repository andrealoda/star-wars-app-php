@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Modifica personaggi</h1>

    <form action="{{ route('admin.people.update', $person) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.people._form')
    </form>
</div>
@endsection