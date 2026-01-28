# Admin Panel Quick Start Guide - Desa Kunyayan

## Accessing the Admin Panel

### 1. Login
- Go to: http://localhost:8000/login
- Enter your admin credentials
- Click "Sign in"

### 2. View Admin Dashboard
After login, click on "Dashboard" link or go to: `/admin/home`

You will see:
- Total Berita (News) count
- Total Views across all berita
- Navigation sidebar on the left with blue background

---

## Managing Berita (News)

### View All Berita
1. From admin dashboard, click "Kelola Berita" in the sidebar
2. Or directly go to: `/admin/berita`
3. You'll see a table with all published berita

Table shows:
- **Judul** - Title of the news
- **Penulis** - Author name
- **Tanggal** - Publication date
- **Dibaca** - View count
- **Aksi** - Action buttons (Edit/Delete)

### Create New Berita

1. Click the **"+ Tambah Berita"** button at the top
2. Fill in the form:
   - **Judul Berita** - Enter the news title (required)
   - **Isi Berita** - Enter the full content (required)
   - **Penulis** - Author name (automatically filled with your name)
   - **Foto Berita** - Upload an image (optional, jpg/png/gif, max 2MB)

3. Click **"Simpan Berita"** to save

### Edit Existing Berita

1. From the berita list, click the **"Edit"** button on the berita you want to modify
2. Update any fields (title, content, author, or image)
3. Click **"Update Berita"** to save changes

### Delete Berita

1. From the berita list, click the **"Hapus"** button
2. Confirm the deletion when prompted
3. The berita will be permanently removed

---

## Managing Infografis (Statistics)

### Update Infografis

1. From admin dashboard, click **"Edit Infografis"** in the sidebar
2. Or go directly to: `/admin/stats/edit`

You'll see a form divided into two sections:

#### Section 1: General Population Data
- **Total Populasi** - Total population of the village
- **Total Kepala Keluarga** - Total number of families
- **Total Laki-laki** - Total males
- **Total Perempuan** - Total females

#### Section 2: Religion-Based Statistics
- **Islam** - Number of Muslims
- **Kristiani** - Number of Christians
- **Katolik** - Number of Catholics
- **Hindu** - Number of Hindus
- **Buddha** - Number of Buddhists
- **Konghucu** - Number of Confucians

3. Update all the numbers with current data
4. Click **"Update Infografis"** to save

A success message will appear confirming the update.

---

## Important Notes

### Images
- Supported formats: JPG, JPEG, PNG, GIF
- Maximum file size: 2MB
- Images are stored on the server
- Old images are deleted when you upload a new one

### Author Field
- When creating a berita, the author field is automatically filled with your username
- You can change it to someone else if needed
- This field is required

### Views Count
- The number of views is automatically incremented each time someone opens a berita
- Views are tracked in the database
- You cannot manually edit this field

### Dates
- Berita creation/update dates are automatically recorded
- Displayed in Indonesian format (e.g., "27 Januari 2026")

---

## Public Website Pages

### View Your Published Content

#### Berita Page
- URL: `/berita`
- Shows all published berita in a grid layout
- Displays title, excerpt, author, views, and date
- Click on any card to read the full berita

#### Public Detail Page
- Shows full berita content
- Displays author and publication date
- Shows the uploaded image
- Has a "Back to Berita" link

#### Profil (Profile) Page
- URL: `/profil`
- Shows village information
- May display statistics from infografis

#### Infografis Page
- URL: `/infografis`
- Displays population statistics
- Shows religion-based breakdown
- Uses data from the admin infografis form

---

## Logout

To logout from the admin panel:
1. Click the **"Logout"** button in the admin sidebar
2. You will be redirected to the login page

---

## Troubleshooting

### Problem: Can't access admin panel
**Solution:** 
- Make sure you're logged in (check login page)
- Verify you have admin role
- Try accessing directly: `/admin/home`

### Problem: Image not uploading
**Solution:**
- Check file size (must be less than 2MB)
- Check file format (JPG, PNG, or GIF only)
- Check server storage has free space

### Problem: Changes not saving
**Solution:**
- Check all required fields are filled (red asterisks *)
- Look for error messages
- Try again or contact administrator

### Problem: Can't find berita after creating it
**Solution:**
- Refresh the page
- Check berita list for the newly created item
- Search for it by title

---

## Tips for Best Results

### For Berita (News)
- Use clear, descriptive titles
- Write engaging content
- Use high-quality images
- Keep titles under 255 characters
- Use professional language

### For Infografis (Statistics)
- Update statistics regularly
- Keep numbers accurate
- Update when village census changes
- All fields should add up correctly:
  - Total Males + Total Females = Total Population
  - Sum of religions should roughly equal Total Population

### General Tips
- Always preview before publishing
- Keep file sizes reasonable for faster loading
- Use proper spelling and grammar
- Organize berita chronologically (newest first shown in public)

---

## System Requirements

- **Browser:** Modern browser (Chrome, Firefox, Safari, Edge)
- **Connection:** Internet connection required
- **Screen:** Desktop or large tablet recommended (min 768px width)
- **JavaScript:** Must be enabled

---

## Support & Help

If you encounter any issues or have questions:
1. Check the troubleshooting section above
2. Review the full documentation: `ADMIN_PANEL_SETUP.md`
3. Contact your system administrator
4. Check browser console (F12) for error messages

---

**Last Updated:** January 2026
**Version:** 1.0
**Status:** Production Ready
