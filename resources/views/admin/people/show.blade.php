@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h1>{{ $person->nome }}</h1>

        <img src="{{ $person->immagine ? asset('storage/' . $person->immagine) : asset('img/placeholder-personaggio.png') }}"
            class="img-thumbnail my-3" style="max-height: 300px;" alt="{{ $person->nome }}">



        <ul class="list-group mb-3">
            <li class="list-group-item"><strong>Altezza: </strong>{{ $person->altezza ?? '-' }}</li>
            <li class="list-group-item"><strong>Peso: </strong>{{ $person->peso ?? '-' }}</li>
            <li class="list-group-item"><strong>Colore di capelli: </strong>{{ $person->colore_capelli ?? '-' }}</li>
            <li class="list-group-item"><strong>Colore degli occhi: </strong>{{ $person->colore_occhi ?? '-' }}</li>
            <li class="list-group-item"><strong>Anno di nascita: </strong>{{ $person->anno_nascita ?? '-' }}</li>
            <li class="list-group-item"><strong>Genere: </strong>{{ $person->genere ?? '-' }}</li>

            {{-- aggiunta del pianeta, se presente --}}
            <li class="list-group-item"><strong>Pianeta: </strong>
                @if ($person->planet)
                    <a href="{{ route('admin.planets.show', $person->planet) }}">{{ $person->planet->nome }}</a>
                @else
                    -
                @endif
            </li>

            {{-- aggiunta della specie, se presente --}}
            <li class="list-group-item"><strong>Specie: </strong>
                @if ($person->species)
                    <a href="{{ route('admin.species.show', $person->species) }}">{{ $person->species->nome }}</a>
                @else
                    -
                @endif
            </li>
        </ul>

        <a href="{{ route('admin.people.index') }}" class="btn btn-secondary">Torna alla lista</a>
        <a href="{{ route('admin.people.edit', $person) }}" class="btn btn-warning">Modifica</a>

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
                        Sei sicuro di voler eliminare <strong>{{ $person->nome }}</strong>? L'operazione è irreversibile.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <form action="{{ route('admin.people.destroy', $person) }}" method="POST">
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
