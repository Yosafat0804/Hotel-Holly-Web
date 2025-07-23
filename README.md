
# Hotel Holly Web

Aplikasi web hotel yang komprehensif ini, yang dikembangkan menggunakan framework Laravel, menawarkan perjalanan yang lancar dari reservasi hingga penyelesaian pembayaran. Dengan antarmuka yang intuitif dan fitur-fitur yang tangguh, pengguna dapat dengan mudah menelusuri kamar yang tersedia, membuat reservasi untuk tanggal yang diinginkan, mengelola pemesanan, dan menyelesaikan pembayaran yang aman, semuanya dalam satu platform. Dibangun dengan fokus pada pengalaman pengguna dan efisiensi, aplikasi ini menyederhanakan seluruh proses pemesanan hotel baik untuk tamu maupun administrator, meningkatkan pengalaman keseluruhan untuk semua pemangku kepentingan yang terlibat.


## Fitur

- **Pencarian Ketersediaan Kamar (Room Availability Search)**: Pengguna dapat mencari kamar yang tersedia berdasarkan tanggal check-in dan check-out, jumlah tamu, serta preferensi kamar seperti tipe dan fasilitas
- **Deskripsi Kamar (Room Descriptions)**: Setiap tipe kamar akan ditampilkan lengkap dengan informasi seperti:
                                            •	Foto kamar
                                            •	Fasilitas (AC, TV, Wi-Fi, dsb)
                                            •	Harga per malam
                                            •	Kapasitas Kasur
                                            •	Kamar Tersedia
- **Pemesanan Kamar (Room Reservation)**: Pengguna dapat memesan kamar secara langsung melalui website dengan mengisi formulir data tamu, memilih tipe kamar, serta menentukan tanggal menginap ( Check-in & Check-out )
- **Konfirmasi Reservasi (Reservation Confirmation)**: Setelah pemesanan berhasil, pengguna akan menerima konfirmasi melalui tampilan di web dan email yang berisi:
1.	ID reservasi
2.	Rincian kamar
3.	Tanggal menginap
4.	Total biaya
- **Pembatalan dan Perubahan Reservasi (Cancellation & Modification)**: Pengguna dapat membatalkan atau mengubah data pemesanannya sesuai dengan ketentuan hotel, misalnya sebelum H-1 tanggal check-in
- **Opsi Pembayaran (Payment Options)**: Menyediakan beberapa metode pembayaran, seperti:
                                          1.	Transfer bank
                                          2.	Kartu kredit/debit
                                          3.	Pembayaran di tempat (cash on arrival)
- **Integrasi Kalender (Calendar Integration)**: Pengguna dapat menambahkan jadwal menginap ke kalender digital mereka (Google Calendar atau lainnya) agar tidak lupa tanggal reservasi

## Screenshoots


## Tech Stack

**Framework:** Laravel, Bootstrap

**Database:** MySQL or sqlite


## Run Locally

Clone the project


```bash
  git clone https://github.com/Yosafat0804/Hotel-Holly-Web.git
  cd Hotel-Holly-Web
```

Go to the project directory

Install Packages

```bash
  composer install
```
Copy .env.example to .env

```bash
  cp .env.example .env
```
Generate AppKey

```bash
  php artisan key:generate
```

Create a new database your-database-name
Open .env on your code editor and set the .env database config

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=root
DB_PASSWORD=
```

Migrate project to generate table

```bash
  php artisan migrate
```
After creating a table, we'll seeding database, run seed command

```bash
  php artisan db:seed
```
Run project

```bash
  php artisan serve
```

open your project locally : http://127.0.0.1:8000 (port and host adjust)


## Authors

- [@Yosafat0804](https://www.github.com/Yosafat0804)


