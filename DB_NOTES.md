Local DB troubleshooting (2026-01-30)

- Problem: Laravel was throwing `SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it` when querying `beritas`.
- Cause: No MySQL server listening on 127.0.0.1:3306 (no running service) and for quick local testing SQLite was chosen.

Actions taken:
1. Switched local DB to SQLite in `.env`:

```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

2. Created the file `database/database.sqlite`.

3. Enabled `pdo_sqlite` and `sqlite3` in the CLI PHP `php.ini` (Laragon environment):

- Uncommented `extension=pdo_sqlite` and `extension=sqlite3`

4. Cleared Laravel config/cache:

```
php artisan config:clear
php artisan cache:clear
```

5. Ran migrations to create tables:

```
php artisan migrate --force
```

6. Verified Eloquent query works:

```
php artisan tinker --execute "echo \App\Models\Berita::latest()->count();"
```

Notes / Next steps:
- If you prefer to use MySQL locally, start your MySQL service or run a Docker container and update `.env` back to MySQL values.
- To revert to MySQL update `.env` and run `php artisan config:clear`.
- For publishing the site, use an *absolute* SQLite path in `.env` (example for Windows):

```
DB_CONNECTION=sqlite
DB_DATABASE=C:\\Path\\To\\your_project\\database\\database.sqlite
```

  This avoids "database file does not exist" errors when the webserver's working directory differs from the project root. Alternatively, use a production DB (MySQL/Postgres) and set connection details in `.env`.

---

Additional steps performed (2026-01-30):

- Found Laragon MySQL at `D:\laragon\bin\mysql\mysql-8.0.30-winx64` and `mysqld.exe`.
- Started `mysqld.exe` directly using Laragon `my.ini` so MySQL listens on port 3306.
- Created database `desa_kunyayan` and verified with `mysql -u root -e "SHOW DATABASES;"`.
- Reverted `.env` to MySQL settings and ran `php artisan config:clear`.
- Verified the original query works against MySQL:

```
php artisan tinker --execute "echo \App\Models\Berita::latest()->count();"
# output: 1
```

If you want I can instead configure MySQL to run as a Windows service, or keep using Laragon's manual start method. Please tell me which you prefer.

---

Additional (2026-01-30):

- Uploaded placeholder `resources/images/peta_final.png` (replace with the high-resolution map when preferred).
- Added placeholder head-of-village photos into `public/storage/uploads/kades/` and created `database/seeders/KadesSeeder.php` to add sample entries.
- Ran `php artisan db:seed --class=KadesSeeder` to add 4 sample `Kades` entries.

