@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Film</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Episodio</th>
                    <th>Titolo</th>
                    <th>Data di uscita</th>
                    <th>Regista</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        <td>{{ $film->episodio ?? '-' }}</td>
                        <td>{{ $film->titolo }}</td>
                        <td>{{ $film->data_uscita ?? '-' }}</td>
                        <td>{{ $film->regista ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.films.show', $film) }}" class="btn btn-sm btn-primary">Dettagli</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Torna alla dashboard</a>
        <a href="{{ route('admin.films.create') }}" class="btn btn-primary mt-3">Nuovo film</a>
    </div>
@endsection
