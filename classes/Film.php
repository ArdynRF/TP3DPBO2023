<?php
class Film extends DB
{

    function getFilmJoin()
    {
        $query = "SELECT * FROM Film JOIN Studio ON Film.studio_id=Studio.studio_id JOIN Genre ON Film.genre_id=Genre.genre_id ORDER BY Film.film_id";

        return $this->execute($query);
    }

    function getFilm()
    {
        $query = "SELECT * FROM Film";
        return $this->execute($query);
    }

    function getFilmById($id)
    {
        $query = "SELECT * FROM Film JOIN Studio ON Film.studio_id=Studio.studio_id JOIN Genre ON Film.genre_id=Genre.genre_id WHERE Film.film_id=$id";
        return $this->execute($query);
    }

    function searchFilm($keyword)
    {
        $query = "SELECT * FROM Film JOIN Studio ON Film.studio_id=Studio.studio_id JOIN Genre ON Film.genre_id=Genre.genre_id WHERE judul LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $tmp_file = $file['gambar']['tmp_name'];
        $foto = $file['gambar']['name'];
        // $gambar = $file['gambar'];
        $judul = $data['judul'];
        $tahun_rilis = $data['tahun_rilis'];
        $durasi = $data['durasi'];
        $studio_id = $data['studio_id'];
        $genre_id = $data['genre_id'];

        $dir = "assets/images/$foto";
        move_uploaded_file($tmp_file, $dir);
        // move_uploaded_file($file['tmp_name'], 'assets/images/' . $file['gambar']);
        // var_dump($file['gambar']);
        // die;

        $query = "INSERT INTO Film VALUES ('', '$judul', '$tahun_rilis', '$durasi', '$studio_id', '$genre_id', '$foto')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file, $gambar)
    {

        $tmp_file = $file['gambar']['tmp_name'];
        $foto = $file['gambar']['name'];

        if ($foto == "") {
            $foto = $gambar;
        }

        $dir = "assets/images/$foto";
        move_uploaded_file($tmp_file, $dir);


        $judul = $data['judul'];
        $tahun_rilis = $data['tahun_rilis'];
        $durasi = $data['durasi'];
        $studio_id = $data['studio_id'];
        $genre_id = $data['genre_id'];

        $query = "UPDATE Film SET judul='$judul', tahun_rilis='$tahun_rilis', durasi='$durasi', studio_id='$studio_id', genre_id='$genre_id', gambar = '$foto' WHERE film_id=$id";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM Film WHERE film_id=$id";
        return $this->executeAffected($query);
    }
}
