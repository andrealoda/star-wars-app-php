@csrf

<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" name="nome" id="nome" class="form-control @if ($errors->has('nome')) is-invalid @endif" value="{{ old('nome', $specie->nome) }}">
    @if ($errors->has('nome'))
        <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="lingua" class="form-label">Lingua</label>
    <input type="text" name="lingua" id="lingua" class="form-control @if ($errors->has('lingua')) is-invalid @endif" value="{{ old('lingua', $specie->lingua) }}">
    @if ($errors->has('lingua'))
        <div class="invalid-feedback">{{ $errors->first('lingua') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="immagine" class="form-label">Immagine</label>
    <input type="file" name="immagine" id="immagine"
        class="form-control @if ($errors->has('immagine')) is-invalid @endif">
    @if ($errors->has('immagine'))
        <div class="invalid-feedback">{{ $errors->first('immagine') }}</div>
    @endif

    @if ($specie->immagine)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $specie->immagine) }}" alt="{{ $specie->nome }}"
                style="max-height: 150px;">
        </div>
    @endif
</div>

<button type="submit" class="btn btn-primary">Salva</button>
<a href="{{ route('admin.species.index') }}" class="btn btn-secondary">Annulla</a>