@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Nuovo personaggio</h1>

    <form action="{{ route('admin.people.store') }}" method="POST">
        @include('admin.people._form')
    </form>
</div>
@endsection