@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Nuova specie</h1>

    <form action="{{ route('admin.species.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.species._form')
    </form>
</div>
@endsection