<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Studio.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

$studio = new Studio($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$studio->open();
$studio->getStudio();

if (!isset($_GET['id'])) {
    $id = 0;
    if ($id == 0) {
        # code...
        if (isset($_POST['submit'])) {
            if ($studio->addStudio($_POST) > 0) {
                echo "<script>
                    alert('Data berhasil ditambah!');
                    document.location.href = 'studio.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal ditambah!');
                    document.location.href = 'studio.php';
                </script>";
            }
        }
    }
    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Studio';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Studio</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Studio';

while ($div = $studio->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_studio'] . '</td>
    <td style="font-size: 22px;">
        <a href="Studio.php?id=' . $div['studio_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="Studio.php?hapus=' . $div['studio_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($studio->updateStudio($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'studio.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'studio.php';
            </script>";
            }
        }

        $studio->getStudioById($id);
        $row = $studio->getResult();

        $dataUpdatee = $row['studio_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($studio->deleteStudio($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'studio.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'studio.php';
            </script>";
        }
    }
}

$studio->close();

$view->replace('DATA_VAL_UPDATE', $dataUpdatee);
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
