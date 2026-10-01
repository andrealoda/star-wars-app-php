@csrf

<div class="mb-3">
    <label for="titolo" class="form-label">Titolo</label>
    <input type="text" name="titolo" id="titolo"
        class="form-control @if ($errors->has('titolo')) is-invalid @endif"
        value="{{ old('titolo', $film->titolo) }}">
    @if ($errors->has('titolo'))
        <div class="invalid-feedback">{{ $errors->first('titolo') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="episodio" class="form-label">Episodio</label>
    <input type="number" name="episodio" id="episodio"
        class="form-control @if ($errors->has('episodio')) is-invalid @endif"
        value="{{ old('episodio', $film->episodio) }}">
    @if ($errors->has('episodio'))
        <div class="invalid-feedback">{{ $errors->first('episodio') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="data_uscita" class="form-label">Data di uscita</label>
    <input type="date" name="data_uscita" id="data_uscita"
        class="form-control @if ($errors->has('data_uscita')) is-invalid @endif"
        value="{{ old('data_uscita', $film->data_uscita) }}">
    @if ($errors->has('data_uscita'))
        <div class="invalid-feedback">{{ $errors->first('data_uscita') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="regista" class="form-label">Regista</label>
    <input type="text" name="regista" id="regista"
        class="form-control @if ($errors->has('regista')) is-invalid @endif"
        value="{{ old('regista', $film->regista) }}">
    @if ($errors->has('regista'))
        <div class="invalid-feedback">{{ $errors->first('regista') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="sinossi" class="form-label">Sinossi</label>
    <textarea name="sinossi" id="sinossi" rows="5"
        class="form-control @if ($errors->has('sinossi')) is-invalid @endif">{{ old('sinossi', $film->sinossi) }}</textarea>
    @if ($errors->has('sinossi'))
        <div class="invalid-feedback">{{ $errors->first('sinossi') }}</div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Personaggi collegati</label>
    <div class="border rounded p-2" style="max-height: 250px; overflow-y: auto;">
        @foreach ($people as $person)
            <div class="form-check">
                <input type="checkbox" name="people_ids[]" id="person_{{ $person->id }}" value="{{ $person->id }}"
                    class="form-check-input" @checked(collect(old('people_ids', $film->people->pluck('id')))->contains($person->id))>
                    {{-- Il metodo pluck() è progettato per estrarre i valori da una singola chiave in una collezione.
                    (old('people_ids', $film->people->pluck('id')) dichiara che se il form è tornato indietro per un errore di validazione, riusa quello che l'utente aveva spuntato. --}}
                <label class="form-check-label" for="person_{{ $person->id }}">{{ $person->nome }}</label>
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

    @if ($film->immagine)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $film->immagine) }}" alt="{{ $film->nome }}"
                style="max-height: 150px;">
        </div>
    @endif
</div>


<button type="submit" class="btn btn-primary">Salva</button>
<a href="{{ route('admin.films.index') }}" class="btn btn-secondary">Annulla</a>
