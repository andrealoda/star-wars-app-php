<footer class="bg-white border-top mt-auto">
    <div class="container py-4">
        <div class="row gy-4">

            {{-- Colonna 1: la società (inventata) --}}
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <img src="{{ asset('img/logo-back.svg') }}" alt="" height="32">
                    <h2 class="h6 mb-0">Orbita Digital Archives Pvt. Ltd.</h2>
                </div>
                <p class="small text-body-secondary mb-2">
                    Archiviamo la galassia dal 2026.<br>
                    Software per la catalogazione di mondi, specie ed equipaggi.
                </p>
                <p class="small text-body-secondary mb-0">
                    <i class="bi bi-geo-alt me-1"></i>Bengaluru, Karnataka, India<br>
                    <i class="bi bi-envelope me-1"></i>info@example.com
                </p>
            </div>

            {{-- Colonna 2: link alle sezioni e al sito pubblico --}}
            <div class="col-md-6">
                <h2 class="h6 mb-3">Navigazione</h2>
                <ul class="list-unstyled small mb-0">
                    @auth
                        <li class="mb-2">
                            <a class="link-secondary text-decoration-none" href="{{ route('admin.films.index') }}">
                                <i class="bi bi-film me-2"></i>Film
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="link-secondary text-decoration-none" href="{{ route('admin.people.index') }}">
                                <i class="bi bi-person-lines-fill me-2"></i>Personaggi
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="link-secondary text-decoration-none" href="{{ route('admin.species.index') }}">
                                <i class="bi bi-bug-fill me-2"></i>Specie
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="link-secondary text-decoration-none" href="{{ route('admin.planets.index') }}">
                                <i class="bi bi-globe-europe-africa me-2"></i>Pianeti
                            </a>
                        </li>
                    @endauth
                    <li>
                        <a class="link-secondary text-decoration-none" href="{{ config('app.frontend_url') }}">
                            <i class="bi bi-globe2 me-2"></i>Sito pubblico
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</footer>
