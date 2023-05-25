<?php 
class Genre extends DB
{
    function getGenre()
    {
        $query = "SELECT * FROM Genre";
        return $this->execute($query);
    }

    function getGenreById($id)
    {
        $query = "SELECT * FROM Genre WHERE genre_id=$id";
        return $this->execute($query);
    }

    function addGenre($data)
    {
        $nama_genre = $data['name'];
        $query = "INSERT INTO Genre (nama_genre) VALUES ('$nama_genre')";
        return $this->executeAffected($query);
    }

    function updateGenre($id, $data)
    {
        $nama_genre = $data['name'];
        $query = "UPDATE Genre SET nama_genre='$nama_genre' WHERE genre_id=$id";
        return $this->executeAffected($query);
    }

    function deleteGenre($id)
    {
        $query = "DELETE FROM Genre WHERE genre_id=$id";
        return $this->executeAffected($query);
    }
}
