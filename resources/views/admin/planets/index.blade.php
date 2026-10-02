@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">
            Pianeti
        </h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Clima</th>
                    <th>Terreno</th>
                    <th>Popolazione</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($planets as $planet)
                    <tr>
                        <td>
                            <img src="{{ $planet->immagine ? asset('storage/' . $planet->immagine) : asset('img/placeholder-pianeta-thumb.png') }}"
                                class="img-thumbnail" style="max-height: 50px;"" alt="{{ $planet->nome }}">
                        </td>
                        <td>{{ $planet->nome }}</td>
                        <td>{{ $planet->clima ?? '-' }}</td>
                        <td>{{ $planet->terreno ?? '-' }}</td>
                        <td>{{ $planet->popolazione ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.planets.show', $planet) }}" class="btn btn-sm btn-primary">Dettagli</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Torna alla dashboard</a>
        <a href="{{ route('admin.planets.create') }}" class="btn btn-primary mt-3">Nuovo pianeta</a>
    </div>
@endsection
