# Admin Panel Setup - Desa Kunyayan

## Overview
The admin panel has been successfully created for managing berita (news) and infografis (statistics) without displaying admin links in the public navbar. All admin features are accessed through a sidebar within the admin panel itself.

## Features Implemented

### 1. **Public Berita Listing Page** (`/berita`)
- Clean grid layout displaying all published berita
- Shows title, excerpt, author, views count, and published date
- Link to read full berita details
- Responsive design with blue color scheme (#40BFE1)

### 2. **Admin Panel Dashboard** (`/admin/home`)
- Sidebar navigation with blue background (#40BFE1)
- Dashboard cards showing:
  - Total berita count
  - Total views across all berita
- Quick access links to manage berita and infografis

### 3. **Berita Management**
#### List View (`/admin/berita`)
- Table showing all berita with:
  - Title (truncated)
  - Author name
  - Creation date
  - View count
  - Edit and Delete buttons
- "Add New Berita" button at the top
- Success message on creation/update/deletion

#### Create View (`/admin/berita/create`)
- Form fields:
  - Judul Berita (Title) - required
  - Isi Berita (Content) - required, textarea
  - Penulis (Author) - required, auto-filled with logged-in user name
  - Foto Berita (Image) - optional, accepts jpg/png/gif, max 2MB
- Image preview before upload
- Save and Cancel buttons

#### Edit View (`/admin/berita/edit/{id}`)
- Same form as create, but pre-filled with existing berita data
- Shows current image with option to replace
- Update and Cancel buttons

### 4. **Infografis Management** (`/admin/stats/edit`)
- Form to update population statistics:
  - Total Populasi (Total Population)
  - Total Kepala Keluarga (Total Families)
  - Total Laki-laki (Total Males)
  - Total Perempuan (Total Females)
  
- Religion-based statistics:
  - Islam
  - Kristiani (Christian)
  - Katolik (Catholic)
  - Hindu
  - Buddha
  - Konghucu (Confucius)

## Database Schema

### Berita Table
```
- id (PK)
- title (string)
- content (text)
- author (string)
- image_url (string, nullable)
- views (integer, default: 0)
- created_at (timestamp)
- updated_at (timestamp)
```

### Statistic Table
```
- id (PK)
- total_population (integer)
- total_families (integer)
- total_males (integer)
- total_females (integer)
- islam (integer)
- christian (integer)
- catholic (integer)
- hindu (integer)
- buddha (integer)
- konghucu (integer)
- created_at (timestamp)
- updated_at (timestamp)
```

## Controllers Updated

### 1. **HomeController** (`app/Http/Controllers/HomeController.php`)
- `berita_index()` - Display all berita with pagination (12 per page)
- `berita($id)` - Display single berita and increment views

### 2. **Admin\BeritaController** (`app/Http/Controllers/Admin/BeritaController.php`)
- `index()` - List all berita (10 per page)
- `create()` - Show create form
- `store()` - Save new berita with image upload
- `edit($id)` - Show edit form
- `update($id)` - Update existing berita
- `destroy($id)` - Delete berita and associated image

### 3. **Admin\StatisticController** (`app/Http/Controllers/Admin/StatisticController.php`)
- `home()` - Dashboard with berita stats
- `edit()` - Show infografis edit form
- `update()` - Save infografis changes

## Views Created/Updated

### New Views
1. `resources/views/berita_index.blade.php` - Public berita listing
2. `resources/views/admin/dashboard.blade.php` - Admin dashboard

### Updated Views
1. `resources/views/admin/berita/index.blade.php` - Redesigned with blue theme
2. `resources/views/admin/berita/create.blade.php` - New form design with sidebar
3. `resources/views/admin/berita/edit.blade.php` - Edit form with sidebar
4. `resources/views/admin/stats/edit.blade.php` - Infografis edit with sidebar and grid layout
5. `resources/views/detail_berita.blade.php` - Updated to use new berita fields

## Routes Configuration

The following routes are protected with `['auth', 'role:admin']` middleware:

```php
// Admin Routes (require authentication & admin role)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', [StatisticController::class, 'home'])->name('admin.home');
    Route::get('/admin/stats/edit', [StatisticController::class, 'edit'])->name('admin.stats.edit');
    Route::post('/admin/stats/update', [StatisticController::class, 'update'])->name('admin.stats.update');
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('berita', BeritaController::class);
    });
});

// Public Routes
Route::get('/berita', [HomeController::class, 'berita_index'])->name('berita.index');
Route::get('/berita/{id}', [HomeController::class, 'berita'])->name('berita.show');
```

## Styling

### Color Scheme
- Primary Blue: `#40BFE1`
- Secondary: `#999` (buttons)
- Danger: `#e74c3c` (delete buttons)
- Background: `#f5f5f5`

### Layout
- Admin sidebar: Fixed width (250px), full-height
- Admin content: Responsive, left-margin adjusted for sidebar
- Forms: Clean, organized with proper spacing
- Tables: Hover effects, clear action buttons

## Security Features

1. **Authentication Required** - All admin routes require user login
2. **Role-Based Access Control** - Admin role required via Spatie Laravel Permission
3. **CSRF Protection** - All forms protected with @csrf
4. **Authorization** - BeritaController handles file uploads securely
5. **Validation** - All inputs validated server-side

## File Upload Handling

- Files stored in: `storage/app/public/berita/`
- Symlink required: `php artisan storage:link`
- Accessible via: `asset('storage/berita/filename')`
- Old files deleted when image is replaced

## Testing the Admin Panel

1. **Login as Admin**
   - Navigate to `/login`
   - Use admin credentials
   - After login, access admin panel via `/admin/home`

2. **Create Berita**
   - Click "Tambah Berita" button
   - Fill in title, content, author
   - Optionally upload image
   - Click "Simpan Berita"

3. **Edit Berita**
   - Go to berita list
   - Click "Edit" button on desired berita
   - Update fields and click "Update Berita"

4. **Delete Berita**
   - Go to berita list
   - Click "Hapus" button
   - Confirm deletion

5. **Update Infografis**
   - Go to "Edit Infografis" from admin sidebar
   - Update all statistics fields
   - Click "Update Infografis"

## Implementation Notes

- Admin links are **NOT** displayed in public navbar
- Admin access is completely hidden from regular users
- Only authenticated admin users can access `/admin/*` routes
- Berita views are incremented each time someone opens the detail page
- Database migrations include permission setup for admin role

## Future Enhancements

1. Add search/filter functionality to berita list
2. Bulk delete operations
3. Berita categories/tags
4. Comment moderation
5. Activity logging
6. Export statistics to PDF/Excel

## Troubleshooting

**Issue: Images not showing**
- Ensure `php artisan storage:link` was run
- Check image file exists in `storage/app/public/berita/`
- Verify filesystem disk is set to 'public' in config

**Issue: Admin routes returning 403**
- Verify user has 'admin' role assigned
- Check database for roles assignment
- Confirm Spatie Permission is properly installed

**Issue: Form validation failing**
- Check all required fields are filled
- Image must be: jpg, jpeg, png, gif (max 2MB)
- Verify file upload permissions

---
Last Updated: January 2026
