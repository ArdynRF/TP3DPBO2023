<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Studio.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();
$genre->getGenre();

if (!isset($_GET['id'])) {
    $id = 0;
    if ($id == 0) {
        if (isset($_POST['submit'])) {
            if ($genre->addGenre($_POST) > 0) {
                echo "<script>
                    alert('Data berhasil ditambah!');
                    document.location.href = 'genre.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal ditambah!');
                    document.location.href = 'genre.php';
                </script>";
            }
        }
    }
    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Genre';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Genre</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Genre';

while ($jab = $genre->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $jab['nama_genre'] . '</td>
    <td style="font-size: 22px;">
        <a href="Genre.php?id=' . $jab['genre_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="Genre.php?hapus=' . $jab['genre_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($genre->updateGenre($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'genre.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'genre.php';
            </script>";
            }
        }

        $genre->getGenreById($id);
        $row = $genre->getResult();

        $dataUpdate = $row['nama_genre'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($genre->deleteGenre($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'genre.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'genre.php';
            </script>";
        }
    }
}

$genre->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
