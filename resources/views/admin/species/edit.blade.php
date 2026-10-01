@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Modifica specie</h1>

    <form action="{{ route('admin.species.update', $specie) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.species._form')
    </form>
</div>
@endsection