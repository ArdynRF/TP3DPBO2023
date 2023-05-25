<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Studio.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

// buat instance Film
$listFilm = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listFilm->open();
// tampilkan data Film
$listFilm->getFilmJoin();

// cari Film
if (isset($_POST['btn-cari'])) {
    // methode mencari data Film
    $listFilm->searchFilm($_POST['cari']);
} else {
    // method menampilkan data Film
    $listFilm->getFilmJoin();
}

$data = null;

// ambil data Film
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listFilm->getResult()) {
    $Genre = isset($row['nama_genre']) ? $row['nama_genre'] : '';
    $Studio = isset($row['nama_studio']) ? $row['nama_studio'] : '';
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 Film-thumbnail">
        <a href="detail.php?id=' . $row['film_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['gambar'] . '" class="card-img-top" alt="' . $row['gambar'] . '">
            </div>
            <div class="card-body">
                <p class="card-text Film-nama my-10">' . $row['judul'] . '</p>
                <p class="card-text divisi-nama">' . $Studio . '</p>
                <p class="card-text jabatan-nama my-0">' . $Genre . '</p>
            </div>
        </a>
    </div>    
    </div>';
}



// tutup koneksi
$listFilm->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_FILM', $data);
$home->write();
