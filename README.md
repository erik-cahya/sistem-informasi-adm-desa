# Aplikasi Sistem Informasi Administrasi Desa
Aplikasi sistem informasi pengelolahan desa sederhana.
<br>
<kbd>
![screencapture-127-0-0-1-8000-home-2022-10-30-07_23_32](https://user-images.githubusercontent.com/63504249/198857316-36df2330-92e9-4ae3-91c6-6f9df3ebd89f.png)
</kbd>

## Fitur
- Dashboard
- Kelolah data Penduduk dan keluarga
- Kelolah data Mutasi (lahir, masuk, keluar, wafat)
- Kelolah data surat
- Profile dan akun pengguna
- Lupa password
## Instalasi

1. clone github project

```console
git clone https://github.com/ferddev21/sistem-informasi-adm-desa
```

2. buka direktori project

```console
cd sistem-informasi-adm-desa
```

3. jalankan update composer

```console
composer update
```

4. ubah file name `.env.example` ke `.env` 

5. sesuaikan configurasi `.env` anda
```console
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem-informasi-adm-desa
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=youremail@gmail.com
MAIL_PASSWORD=yourpasswordApp
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=youremail@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

```


6. jalankan keygen baru

```console
php artisan key:generate
```

7. jalankan migrate database table dan seeder

```console
php artisan migrate
```

```console
php artisan db:seed
```

8. run laravel serve

```console
php artisan serve
```

9. buka di url `http://127.0.0.1:8000`

10. akun default 
```console
Username : admin
Password : admin123
```

Enjoy



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT) and Premium Bootstrap admin template from [NiceAdmin](https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/).
