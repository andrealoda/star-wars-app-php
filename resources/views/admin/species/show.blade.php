@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>{{ $specie->nome }}</h1>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Lingua: </strong>{{ $specie->lingua ?? '-' }}</li>
    </ul>

    <a href="{{ route('admin.species.index') }}" class="btn btn-secondary">Torna alla lista</a>
    <a href="{{ route('admin.species.edit', $specie) }}" class="btn btn-warning">Modifica</a>

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
                    Sei sicuro di voler eliminare <strong>{{ $specie->nome }}</strong>? L'operazione è irreversibile.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('admin.species.destroy', $specie) }}" method="POST">
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