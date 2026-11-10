# Tugas PBWL - Sistem Informasi Laundry (PHP MVC)

## Cara menjalankan
1. Jalankan Apache dan MySQL di XAMPP.
2. Di phpMyAdmin, jalankan isi `database.sql` (tab SQL atau Import).
3. Salin folder ini ke `c:\xampp\htdocs\tugas-mvc`.
4. Buka Command Prompt di folder tersebut, lalu jalankan:

       composer install

5. Buka `http://localhost/tugas-mvc/public`
6. Login: username `admin`, password `password`

Jika koneksi database berbeda, ubah file `.env`.

## Struktur
    app/Core         Database, Model (abstract), Router, Controller (abstract)
    app/Models       User, Pelanggan, Layanan, Transaksi
    app/Controllers  Auth, Dashboard, Pelanggan, Layanan, Transaksi
    app/Views        layout, login, dashboard, dan halaman CRUD
    public/index.php front controller + tabel route

## Jika login gagal
Buat hash baru lalu update di phpMyAdmin:

    php -r "echo password_hash('admin123', PASSWORD_DEFAULT);"

    UPDATE tb_users SET user_password = '<hash tadi>' WHERE user_name = 'admin';
