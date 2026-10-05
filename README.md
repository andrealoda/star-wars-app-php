# Holocron: Backoffice e API (Laravel)

Backoffice e API REST di **Holocron**, un archivio a tema Star Wars. Questo repository contiene la parte Laravel del progetto: il pannello di amministrazione protetto da login e le API che alimentano il sito pubblico.

Il sito pubblico, realizzato in React, si trova in un repository separato: [star-wars-app-react](https://github.com/andrealoda/star-wars-app-react).

Progetto didattico realizzato per il corso Boolean. Star Wars è un marchio di Lucasfilm Ltd.: questo progetto non è affiliato né approvato da Lucasfilm o Disney.

## Cosa fa

- **Backoffice** in Blade e Bootstrap, accessibile solo dopo il login (Laravel Breeze). Permette di creare, leggere, modificare ed eliminare film, personaggi, specie e pianeti.
- **Upload delle immagini** per ogni entità. Quando si sostituisce o si elimina un record, il vecchio file viene rimosso dal disco.
- **API REST** in sola lettura, usate dal frontend React.

## Database

| Tabella | Contenuto principale | Relazioni |
| --- | --- | --- |
| `planets` | nome, clima, terreno, popolazione, immagine | un pianeta ha molti personaggi (1-N) |
| `species` | nome, lingua, immagine | una specie ha molti personaggi (1-N) |
| `people` | nome, altezza, peso, capelli, occhi, anno di nascita, genere, immagine | appartiene a un pianeta e a una specie (opzionali) |
| `films` | titolo, episodio, data di uscita, regista, sinossi, immagine | molti-a-molti con i personaggi tramite `film_person` (N-N) |

Se un pianeta o una specie viene eliminato, i personaggi collegati restano e perdono solo il riferimento (`nullOnDelete`). Se si elimina un film o un personaggio, le righe corrispondenti nella tabella pivot vengono eliminate (`cascadeOnDelete`).

## Requisiti

- PHP 8.2 o superiore
- Composer
- Node.js e npm
- MySQL

## Installazione

```bash
git clone https://github.com/andrealoda/star-wars-app-php.git
cd star-wars-app-php

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Crea un database vuoto chiamato `star_wars_app` e imposta nel file `.env` le credenziali di MySQL (`DB_USERNAME`, `DB_PASSWORD` e, se serve, `DB_PORT`). Poi:

```bash
php artisan migrate --seed
php artisan storage:link
```

`migrate --seed` crea le tabelle e le popola con i dati contenuti in `database/seeders/data/` (file JSON con struttura SWAPI, la Star Wars API). `storage:link` rende raggiungibili dal browser le immagini caricate.

## Avvio

In due terminali:

```bash
php artisan serve    # backoffice e API su http://localhost:8000
npm run dev          # compila SCSS e JavaScript con Vite
```

Il login è su `http://localhost:8000/login`. Il seeder crea un utente per lo sviluppo in locale:

- email: `test@example.com`
- password: `password`

Questo utente serve solo in locale: va cambiato o eliminato prima di qualsiasi uso diverso.

## Immagini

Le immagini caricate dal backoffice vengono salvate in `storage/app/public/` (cartelle `films`, `people`, `planets`, `species`) e **non sono nel repository**, perché i materiali ufficiali di Star Wars sono protetti da copyright. Un record senza immagine mostra un segnaposto: i file `public/img/placeholder-*.png` nel backoffice e quelli nel progetto React.

## Variabili d'ambiente specifiche

| Variabile | A cosa serve |
| --- | --- |
| `FRONTEND_URL` | indirizzo del sito React, usato dai link "Sito pubblico" di header e footer (letto in `config/app.php`) |
| `FILESYSTEM_DISK=public` | disco predefinito per gli upload |

Gli indirizzi del frontend ammessi dalle chiamate AJAX sono elencati in `config/cors.php`: di default `http://localhost:5173` e `http://localhost:5174`.

## API

Tutti gli endpoint rispondono in JSON con la forma `{ "success": true, "results": ... }` e sono di sola lettura. Un ID inesistente restituisce un errore 404.

| Metodo | Endpoint | Restituisce |
| --- | --- | --- |
| GET | `/api/films` | tutti i film, ciascuno con i suoi personaggi |
| GET | `/api/films/{id}` | un film con i suoi personaggi |
| GET | `/api/people` | tutti i personaggi, con pianeta e specie |
| GET | `/api/people/{id}` | un personaggio con pianeta e specie |
| GET | `/api/species` | tutte le specie, ciascuna con i suoi personaggi |
| GET | `/api/species/{id}` | una specie con i suoi personaggi |
| GET | `/api/planets` | tutti i pianeti, ciascuno con i suoi abitanti |
| GET | `/api/planets/{id}` | un pianeta con i suoi abitanti |

Il campo `immagine` contiene il percorso relativo del file (per esempio `people/1.jpg`): l'indirizzo completo si ottiene aggiungendo `/storage/` davanti.

## Rotte del backoffice

Tutte richiedono il login.

| Rotta | Descrizione |
| --- | --- |
| `/` | dashboard |
| `/admin/films` | gestione film (CRUD) |
| `/admin/people` | gestione personaggi (CRUD) |
| `/admin/species` | gestione specie (CRUD) |
| `/admin/planets` | gestione pianeti (CRUD) |
| `/profile` | profilo dell'utente |

## Struttura del codice

- `app/Http/Controllers/Admin/`: controller del backoffice (resource controller con upload delle immagini)
- `app/Http/Controllers/Api/`: controller delle API
- `app/Models/`: modelli Eloquent e relazioni
- `database/migrations/` e `database/seeders/`: schema e dati iniziali
- `resources/views/layouts/app.blade.php`: layout comune, che include `partials/header` e `partials/footer`
- `resources/views/admin/`: viste CRUD, con un `_form` condiviso tra creazione e modifica
- `resources/scss/app.scss`: tema Bootstrap personalizzato (palette chiara del backoffice)
