Cara instalasi aplikasi LMS Be-Smart

1 . unzip file project ini
2 . buka terminal dan arahkan ke folder project nya
3 . ketikan perintah composer install , dan tunggu beberapa saat hingga proses nya selesai
4 . jika sudah selesai pada terminal yang sama ketikan perintah php artisan config:cache
5 . selanjutnya ketikan perintah php artisan key:generate
6 . buat database di phpmyadmin lalu ubah option DB_DATABASE pada .env file dengan nama database yang baru saja dibuat
7 . buka kembali terminal yang sebelumnya dan ketikan perintah php artisan migrate setelah selesai ketikan perintah 
    php artisan db:seed
8 . jalankan project ini dengan cara ketikan perintah php artisan serve pada terminal .
9 . pada browser ketikan url 127.0.0.1:8000

Info Login : 
username : admin1234
password : secret