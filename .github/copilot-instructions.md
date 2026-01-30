# GitHub Copilot Instructions — Desa Kunyayan

## Goal
Help the agent get productive immediately: understand the app shape, local dev & debug steps, common conventions, and important files to inspect before changing code.

## Quick summary (first 30s) ✅
- Laravel 10 app using Breeze-auth, Spatie Roles/Permissions, Tailwind + Vite for frontend.
- Admin area under `app/Http/Controllers/Admin/*` and routes protected with `['auth','role:admin']` (see `routes/web.php`).
- Key models: `App\Models\Berita`, `Kades`, `Statistic`. Images: `storage/app/public/...` served via `php artisan storage:link`.

## Essential local workflows (copy/paste) 🔧
- Install dependencies:
  - `composer install`
  - `npm install`
- Setup env and key:
  - `cp .env.example .env` && `php artisan key:generate`
- DB (quick dev): use SQLite
  - update `.env`: `DB_CONNECTION=sqlite` and `DB_DATABASE=database/database.sqlite`
  - create file: `touch database/database.sqlite`
  - enable CLI PHP extensions if needed: `extension=pdo_sqlite`, `extension=sqlite3` in PHP `php.ini`
  - migrate: `php artisan migrate --force`
  - seed: `php artisan db:seed --class=KadesSeeder` and `php artisan db:seed --class=RoleAssignmentSeeder`
  - verify: `php artisan tinker --execute "echo \App\Models\Berita::latest()->count();"`
- If using MySQL (Laragon): start `mysqld.exe`, update `.env`, run `php artisan config:clear`
- Link storage for uploads: `php artisan storage:link`
- Run frontend dev: `npm run dev` (vite) — or `npm run build` for production
- Tests: `php artisan test` or `vendor/bin/phpunit`

## Project-specific conventions & gotchas ⚠️
- Admin routes live under `/admin/*` and use resource controllers (see `Admin\BeritaController`). Respect the `role:admin` middleware and Spatie permission seeders (`RoleAssignmentSeeder`).
- Images: controllers store files using disk `public` (e.g., `storage/app/public/berita`) but seeders reference `uploads/kades/*` (public path `public/storage/uploads/kades`). Run `storage:link` after migrations.
- Models typically use `protected $guarded = []` (mass-assignable all) — be mindful when adding fields or validation.
- Use `@vite(...)` and `Vite::asset(...)` in Blade templates; assets live in `resources/{css,js,images}`.
- Validation and file removal: controllers validate uploads and delete previous files via `Storage::disk('public')->delete(...)` when replacing images.

## Where to look first (ordered) 🔎
1. `ADMIN_PANEL_SETUP.md` — working feature summary and UI expectations (colors, forms).
2. `DB_NOTES.md` — local DB troubleshooting and SQLite fallback steps.
3. `routes/web.php` — route protection and resource routing.
4. `app/Http/Controllers/Admin/*` — admin logic (Berita, Statistic, Kades).
5. `resources/views/` — Blade templates, Vite usage, and asset expectations.
6. `database/migrations/` & `database/seeders/` — DB shape and example data (notably `RoleAssignmentSeeder` & `KadesSeeder`).

## Safety & testing guidance for changes 🧪
- For database changes: add migration + update relevant seeders and factories.
- Add feature tests for controllers and basic integration tests for admin routes. Use `php artisan test --filter NameOfTest` to iterate quickly.
- When touching file upload logic, add a test that uploads and verifies `Storage::disk('public')` contents (use `Storage::fake('public')`).

## Examples to copy in PRs
- Seed admin user (from `RoleAssignmentSeeder`): email `admin@gmail.com` / password `kunyayan2025` (used for local testing only; rotate for production).
- Incrementing berita views is done in `HomeController::berita($id)` — prefer keeping that pattern instead of global database triggers.

> Note: Do not add or expose production credentials. Use local seeders and `.env` files only.

---
If anything here is unclear or missing, tell me which parts you want expanded (DB setup, auth, asset build, or tests) and I will iterate. ✨
