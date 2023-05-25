# TP3DPBO2023
Saya Ardyn Rezky Fahreza NIM 2103551 mengerjakan TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Deskripsi Tugas
Buatlah program menggunakan bahasa pemrograman PHP dengan spesifikasi sebagai berikut:
* Program bebas, kecuali program Ormawa
* Menggunakan minimal 3 buah tabel
* Terdapat proses Create, Read, Update, dan Delete data
* Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas)
* Menggunakan template/skin form tambah data dan ubah data yang sama
* 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
* Menggunakan template/skin tabel yang sama untuk menampilkan tabel

## Desaign Program
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/d2822b0e-2fb2-4a5d-b457-889a004374f5)

Pada program ini terdapat 3 tabel yaitu:
1. Tabel Film yang berisi 7 atribut dengan atribut `film_id` sebagai primary keynya. Tabel ini memiliki relasi many to one dengan tabel Director dimana foreign keynya ada pada atribut`studio_id` dan juga berelasi many to one dengan tabel Genre dimana foreign keynya ada pada atribut `genre_id`.
2. Tabel Studio berisi 2 atribut dengan atribut `studio_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Film
3. Tabel Genre berisi 2 atribut dengan atribut `genre_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Film.

## Penjelasan alur
1. Saat pengguna mengakses website maka halaman yg pertama muncul adalah Home yg berisi list film, di halaman ini dapat mencari film yang diinginkan dengan kolom Searching yg disediakan.
2. Untuk mengakses detail dari film, klik film yg diinginkan lalu halaman detail akan muncul, di halaman detail pengguna dapat menghapus film atau mengubah data film.
3. ketika pengguna ingin mengubah data film maka akan diarahkan ke halaman form untuk mengubah data film.
4. Selanjutnya, jika pengguna ingin menambahkan film, dapat mengakses navbar Tambah Film dan akan muncul form untuk menambah film.
5. lalu ada halaman daftar studio yg menampilkan tabel berisi studio studio yg tersedia, di halaman ini juga ada form yg digunakan untuk mengubah dan menambah daftar studio.
6. lalu ada halaman daftar genre yg menampilkan tabel berisi genre genre yg tersedia, di halaman ini juga ada form yg digunakan untuk mengubah dan menambah daftar studio.

## Dokumentasi
Halaman Home
![image](https://github.com/ArdynRF/TP3DPBO2023/blob/main/assets/documentation/home.png)

Halaman Detail
![image](https://github.com/ArdynRF/TP3DPBO2023/blob/main/assets/documentation/detail.png)

Halaman Add Film
![image](https://github.com/ArdynRF/TP3DPBO2023/blob/main/assets/documentation/tambah.png)

Halaman Edit Film
![image](https://github.com/ArdynRF/TP3DPBO2023/blob/main/assets/documentation/edit.png)

Halaman Daftar Studio
![image](https://github.com/ArdynRF/TP3DPBO2023/blob/main/assets/documentation/studio.png)

Halaman Genres
![image](https://github.com/ArdynRF/TP3DPBO2023/blob/main/assets/documentation/genre.png)

Dokumentasi Video

https://github.com/ArdynRF/TP3DPBO2023/blob/main/assets/documentation/2023-05-25%2021-02-58.mkv


