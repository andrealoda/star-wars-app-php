@csrf

<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" name="nome" id="nome" class="form-control @if ($errors->has('nome')) is-invalid @endif" value="{{ old('nome', $planet->nome) }}">
    @if ($errors->has('nome'))
        <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="clima" class="form-label">Clima</label>
    <input type="text" name="clima" id="clima" class="form-control @if ($errors->has('clima')) is-invalid @endif" value="{{ old('clima', $planet->clima) }}">
    @if ($errors->has('clima'))
        <div class="invalid-feedback">{{ $errors->first('clima') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="terreno" class="form-label">Terreno</label>
    <input type="text" name="terreno" id="terreno" class="form-control @if ($errors->has('terreno')) is-invalid @endif" value="{{ old('terreno', $planet->terreno) }}">
    @if ($errors->has('terreno'))
        <div class="invalid-feedback">{{ $errors->first('terreno') }}</div>
    @endif
</div>

<div class="mb-3">
    <label for="popolazione" class="form-label">Popolazione</label>
    <input type="number" name="popolazione" id="popolazione" class="form-control @if ($errors->has('popolazione')) is-invalid @endif" value="{{ old('popolazione', $planet->popolazione) }}">
    @if ($errors->has('popolazione'))
        <div class="invalid-feedback">{{ $errors->first('popolazione') }}</div>
    @endif
</div>

<button type="submit" class="btn btn-primary">Salva</button>
<a href="{{ route('admin.planets.index') }}" class="btn btn-secondary">Annulla</a>