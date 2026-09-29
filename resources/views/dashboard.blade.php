@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>

                </div>
                <div class="row g-4 mt-4">

                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column align-items-center text-center">
                                <i class="bi bi-film" style="font-size: 4rem;"></i>
                                <h5 class="card-title mt-3">Film</h5>
                                <a href="{{ route('admin.films.index') }}" class="btn btn-sm btn-primary mt-auto">Vai alla
                                    lista dei film</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column align-items-center text-center">
                                <i class="bi bi-people-fill" style="font-size: 4rem;"></i>
                                <h5 class="card-title mt-3">Personaggi</h5>
                                <a href="{{ route('admin.people.index') }}" class="btn btn-sm btn-primary mt-auto">Vai alla
                                    lista dei personaggi</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column align-items-center text-center">
                                <i class="bi bi-globe-americas" style="font-size: 4rem;"></i>
                                <h5 class="card-title mt-3">Pianeti</h5>
                                <a href="{{ route('admin.planets.index') }}" class="btn btn-sm btn-primary mt-auto">Vai alla
                                    lista dei pianeti</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column align-items-center text-center">
                                <i class="bi bi-stars" style="font-size: 4rem;"></i>
                                <h5 class="card-title mt-3">Specie</h5>
                                <a href="{{ route('admin.species.index') }}" class="btn btn-sm btn-primary mt-auto">Vai alla
                                    lista delle specie</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
