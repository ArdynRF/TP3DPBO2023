<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Studio.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

// Mendapatkan data Studio dari database
$studio = new Studio($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$studio->open();
$studioData = $studio->getStudio();

// Mendapatkan data Genre dari database
$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();
$genreData = $genre->getGenre();
$form1 = '';
$form2 = '';

$tmp_image = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$tmp_image->open();

while ($row = $studio->getResult()) {
    $form1 .= "<option value=" . $row['studio_id'] . ">" . $row['nama_studio'] . "</option>";
}

while ($row = $genre->getResult()) {
    $form2 .=  "<option value=" . $row['genre_id'] . ">" . $row['nama_genre'] . "</option>";
}
$genre->close();
$studio->close();

$film = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$film->open();
$film->getFilm();

if (!isset($_GET['id'])) {
    $id = 0;
    if ($id == 0) {
        # code...
        if (isset($_POST['submit'])) {
            if ($film->addData($_POST, $_FILES) > 0) {
                echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'index.php';
                </script>";
            }
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$viewform = new Template('templates/skinform.html');
$film->close();
$film->open();
$film->getFilmJoin();

$studio->open();
$studioData = $studio->getStudio();

$genre->open();
$genreData = $genre->getGenre();

$form3 = '';
$form4 = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id > 0) {
        $tmp_image->getFilm();
        $tmp_image->getFilmById($id);
        $temp_fix = $tmp_image->getResult();
        $tmp = $temp_fix['gambar'];
        if (isset($_POST['submit'])) {
            if ($film->updateData($id, $_POST, $_FILES, $tmp) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
            </script>";
            }
        }

        $film->getFilmById($id);
        $row = $film->getResult();

        $judulUpdate = $row['judul'];
        $tahuUpdate = $row['tahun_rilis'];
        $durasiUpdate = $row['durasi'];
        $StudioUpdate = $row['studio_id'];
        $GenreUpdate = $row['genre_id'];

        while ($row = $studio->getResult()) {
            if ($row['studio_id'] == $StudioUpdate) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $form3 .= "<option value=" . $row['studio_id'] . " " . $select . ">" . $row['nama_studio'] . "</option>";
        }

        while ($row = $genre->getResult()) {
            if ($row['genre_id'] == $GenreUpdate) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $form4 .= "<option value=" . $row['genre_id'] . " " .  $select . ">" . $row['nama_genre'] . "</option>";
        }


        $btn = 'Simpan';
        $title = 'Ubah';

        $viewform->replace('DATA_FORM1', $form3);
        $viewform->replace('DATA_FORM2', $form4);
        $viewform->replace('DATA_NAMA', $judulUpdate);
        $viewform->replace('DATA_TAHUN', $tahuUpdate);
        $viewform->replace('DATA_DURASI', $durasiUpdate);
    }
}

// var_dump($row['genre_id']);
// die;

$genre->close();
$studio->close();

$viewform->replace('DATA_TITLE', $title);
$viewform->replace('DATA_BUTTON', $btn);
$viewform->replace('DATA_FORM1', $form1);
$viewform->replace('DATA_FORM2', $form2);
$viewform->write();
