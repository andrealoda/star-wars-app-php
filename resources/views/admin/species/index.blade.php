@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Specie</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Lingua</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($species as $specie)
                <tr>
                    <td>{{ $specie->nome }}</td>
                    <td>{{ $specie->lingua ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.species.show', $specie) }}" class="btn btn-sm btn-primary">Dettagli</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.species.create') }}" class="btn btn-primary mt-3">Nuova specie</a>
</div>
@endsection