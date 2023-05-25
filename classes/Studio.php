<?php 
class Studio extends DB
{
    function getStudio()
    {
        $query = "SELECT * FROM Studio";
        return $this->execute($query);
    }

    function getStudioById($id)
    {
        $query = "SELECT * FROM Studio WHERE studio_id=$id";
        return $this->execute($query);
    }

    function addStudio($data)
    {
        $nama_studio = $data['name'];
        $query = "INSERT INTO Studio VALUES('', '$nama_studio')";
        return $this->executeAffected($query);
    }

    function updateStudio($id, $data)
    {
        $nama_studio = $data['name'];
        $query = "UPDATE Studio SET nama_studio='$nama_studio' WHERE studio_id=$id";
        return $this->executeAffected($query);
    }

    function deleteStudio($id)
    {
        $query = "DELETE FROM Studio WHERE studio_id=$id";
        return $this->executeAffected($query);
    }
}
