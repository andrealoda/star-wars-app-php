@csrf

<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" name="nome" id="nome"
        class="form-control @if ($errors->has('nome')) is-invalid @endif" value="{{ old('nome', $person->nome) }}">
    @if ($errors->has('nome'))
        <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="altezza" class="form-label">Altezza (cm)</label>
    <input type="number" name="altezza" id="altezza"
        class="form-control @if ($errors->has('altezza')) is-invalid @endif"
        value="{{ old('altezza', $person->altezza) }}">
    @if ($errors->has('altezza'))
        <div class="invalid-feedback">{{ $errors->first('altezza') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="peso" class="form-label">Peso (kg)</label>
    <input type="number" name="peso" id="peso"
        class="form-control @if ($errors->has('peso')) is-invalid @endif"
        value="{{ old('peso', $person->peso) }}">
    @if ($errors->has('peso'))
        <div class="invalid-feedback">{{ $errors->first('peso') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="colore_capelli" class="form-label">Colore capelli</label>
    <input type="text" name="colore_capelli" id="colore_capelli"
        class="form-control @if ($errors->has('colore_capelli')) is-invalid @endif"
        value="{{ old('colore_capelli', $person->colore_capelli) }}">
    @if ($errors->has('colore_capelli'))
        <div class="invalid-feedback">{{ $errors->first('colore_capelli') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="colore_occhi" class="form-label">Colore occhi</label>
    <input type="text" name="colore_occhi" id="colore_occhi"
        class="form-control @if ($errors->has('colore_occhi')) is-invalid @endif"
        value="{{ old('colore_occhi', $person->colore_occhi) }}">
    @if ($errors->has('colore_occhi'))
        <div class="invalid-feedback">{{ $errors->first('colore_occhi') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="anno_nascita" class="form-label">Anno di nascita</label>
    <input type="text" name="anno_nascita" id="anno_nascita"
        class="form-control @if ($errors->has('anno_nascita')) is-invalid @endif"
        value="{{ old('anno_nascita', $person->anno_nascita) }}">
    @if ($errors->has('anno_nascita'))
        <div class="invalid-feedback">{{ $errors->first('anno_nascita') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="genere" class="form-label">Genere</label>
    <input type="text" name="genere" id="genere"
        class="form-control @if ($errors->has('genere')) is-invalid @endif"
        value="{{ old('genere', $person->genere) }}">
    @if ($errors->has('genere'))
        <div class="invalid-feedback">{{ $errors->first('genere') }}</div>
    @endif
</div>

{{-- sezione del form per collegare Pianeta d'origine e Specie di appartenenza di un Personaggio --}}

<div class="mb-3">
    <label for="planet_id" class="form-label">Pianeta di origine</label>
    <select name="planet_id" id="planet_id" class="form-select @if ($errors->has('planet_id')) is-invalid @endif">
        <option value="">-- Nessuno --</option>
        @foreach ($planets as $planet)
            <option value="{{ $planet->id }}" @selected(old('planet_id', $person->planet_id) == $planet->id)>{{ $planet->nome }}</option>
        @endforeach
    </select>
    @if ($errors->has('planet_id'))
        <div class="invalid-feedback">{{ $errors->first('planet_id') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="people_id" class="form-label">Specie</label>
    <select name="species_id" for="species_id" class="form-select @if ($errors->has('species_id')) is-invalid @endif">
        <option value="">-- Nessuna --</option>
        @foreach ($species as $specie)
            <option value="{{ $specie->id }}" @selected(old('species_id', $person->species_id) == $specie->id)>{{ $specie->nome }}</option>
        @endforeach
    </select>
    @if ($errors->has('species_id'))
        <div class="invalid-feedback">{{ $errors->first('species_id') }}</div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Film</label>
    <div class="border rounded p-2" style="max-height: 250px; overflow-y: auto;">
        @foreach ($films as $film)
            <div class="form-check">
                <input type="checkbox" name="film_ids[]" id="film_{{ $film->id }}" value="{{ $film->id }}"
                    class="form-check-input" @checked(collect(old('film_ids', $person->films->pluck('id')))->contains($film->id))>
                <label class="form-check-label" for="film_{{ $film->id }}">{{ $film->titolo }}</label>
            </div>
        @endforeach
    </div>
</div>

<div class="mb-3">
    <label for="immagine" class="form-label">Immagine</label>
    <input type="file" name="immagine" id="immagine"
        class="form-control @if ($errors->has('immagine')) is-invalid @endif">
    @if ($errors->has('immagine'))
        <div class="invalid-feedback">{{ $errors->first('immagine') }}</div>
    @endif

    @if ($person->immagine)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $person->immagine) }}" alt="{{ $person->nome }}"
                style="max-height: 150px;">
        </div>
    @endif
</div>

<button type="submit" class="btn btn-primary">Salva</button>
<a href="{{ route('admin.people.index') }}" class="btn btn-secondary">Annulla</a>
