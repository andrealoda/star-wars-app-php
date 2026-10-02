@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>{{ $film->titolo }}</h1>

        <img src="{{ $film->immagine ? asset('storage/' . $film->immagine) : asset('img/placeholder-film.png') }}"
            class="img-thumbnail my-3" style="max-height: 300px;" alt="{{ $film->nome }}">

        <ul class="list-group mb-3">
            <li class="list-group-item"><strong>Episodio: </strong>{{ $film->episodio ?? '-' }}</li>
            <li class="list-group-item"><strong>Data di uscita: </strong>{{ $film->data_uscita ?? '-' }}</li>
            <li class="list-group-item"><strong>Regista: </strong>{{ $film->regista ?? '-' }}</li>
            <li class="list-group-item"><strong>Sinossi: </strong><br>{{ $film->sinossi ?? '-' }}</li>
        </ul>

        <h2 class="h5 mt-4">Personaggi</h2>
        @if ($film->people->isEmpty())
            <p class="text-secondary">Nessun personaggio collegato.</p>
        @else
            <ul class="list-group mb-3">
                @foreach ($film->people as $person)
                    <li class="list-group-item">
                        <a href="{{ route('admin.people.show', $person) }}">{{ $person->nome }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('admin.films.index') }}" class="btn btn-secondary">Torna alla lista</a>
        <a href="{{ route('admin.films.edit', $film) }}" class="btn btn-warning">Modifica</a>

        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Elimina
        </button>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Conferma eliminazione</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare <strong>{{ $film->titolo }}</strong>? L'operazione è irreversibile.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <form action="{{ route('admin.films.destroy', $film) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina definitivamente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
