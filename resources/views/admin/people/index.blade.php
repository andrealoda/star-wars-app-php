@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">
            Personaggi
        </h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Altezza</th>
                    <th>Peso</th>
                    <th>Colore di capelli</th>
                    <th>Colore degli occhi</th>
                    <th>Anno di nascita</th>
                    <th>Genere</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($people as $person)
                    <tr>
                        <td>
                            <img src="{{ $person->immagine ? asset('storage/' . $person->immagine) : asset('img/placeholder-personaggio-thumb.png') }}"
                                class="img-thumbnail" style="max-height: 50px;" alt="{{ $person->nome }}">
                        </td>
                        <td>{{ $person->nome }}</td>
                        <td>{{ $person->altezza ?? '-' }}</td>
                        <td>{{ $person->peso ?? '-' }}</td>
                        <td>{{ $person->colore_capelli ?? '-' }}</td>
                        <td>{{ $person->colore_occhi ?? '-' }}</td>
                        <td>{{ $person->anno_nascita ?? '-' }}</td>
                        <td>{{ $person->genere ?? '-' }}</td>

                        <td>
                            <a href="{{ route('admin.people.show', $person) }}" class="btn btn-sm btn-primary">Dettagli</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Torna alla dashboard</a>
        <a href="{{ route('admin.people.create') }}" class="btn btn-primary mt-3">Nuovo personaggio</a>
    </div>
@endsection
