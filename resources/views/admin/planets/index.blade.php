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
    </div>
@endsection