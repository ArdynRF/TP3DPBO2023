<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Studio.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

$film = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$film->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $film->getfilmById($id);
        $row = $film->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['judul'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['gambar'] . '" class="img-thumbnail" alt="' . $row['film_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Judul Film</td>
                                    <td>:</td>
                                    <td>' . $row['judul'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tahun Rilis</td>
                                    <td>:</td>
                                    <td>' . $row['tahun_rilis'] . '</td>
                                </tr>
                                <tr>
                                    <td>Durasi Film</td>
                                    <td>:</td>
                                    <td>' . $row['durasi'] . '</td>
                                </tr>
                                <tr>
                                    <td>Studio Film</td>
                                    <td>:</td>
                                    <td>' . $row['nama_studio'] . '</td>
                                </tr>
                                <tr>
                                    <td>Genre Film</td>
                                    <td>:</td>
                                    <td>' . $row['nama_genre'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="form.php?id=' . $row['film_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['film_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($film->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$film->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_FILM', $data);
$detail->write();
