# LV3-LV4-NWEB
# Laravel Projekt — LV3 & LV4
Projekt razvijen za kolegij Napredno web programiranje, FERIT, Osijek, u sklopu laboratorijskih vježbi 3 i 4. Aplikacija PHP framework Laravel
Implementirana je autentifikacija, upravljanje korisničkim projektima te uloge voditelja i članova tima.

# Funkcionalnosti

Registracija, prijava i odjava korisnika 
Upravljanje korisničkim profilom 
Kreiranje, uređivanje i brisanje projekata 
Dodavanje članova na projekt iz baze registriranih korisnika
Uloge korisnika:
Voditelj: puni pristup projektu (uređivanje svih polja, brisanje)
Član: može uređivati samo obavljene poslove
Prikaz projekata na kojima je korisnik voditelj i onih na kojima je član

# Tehnologije i alati
PHP 8+
Laravel 12
Laravel Breeze (Blade starter kit)
Tailwind CSS (putem Vite)
SQLite (za lokalni razvoj)
Git & GitHub

# Pokretanje projekta lokalno
git clone https://github.com/Ena1313/LV3-LV4-NWEB.git
cd LV3-LV4-NWEB
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
Aplikacija će sada biti dostupna na: http://127.0.0.1:8000
