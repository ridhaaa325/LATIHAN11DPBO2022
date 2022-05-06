<?php

class Author extends DB
{   
    // untuk menampilkan data dari table author
    function getAuthor()
    {
        $query = "SELECT * FROM author";
        return $this->execute($query);
    }

    // untuk menambahkan data
    function add($data)
    {
        $name = $data['tname'];
        $status = "Pendatang baru";
        
        $query = "INSERT INTO author VALUES ('', '$name', '$status')";

        return $this->execute($query);
    }

    // untuk menghapus data
    function delete($id)
    {    
        $query = "DELETE FROM author WHERE id_author = '$id'";

        return $this->execute($query);
    }

    // untuk update status author
    function statusAuthor($id)
    {
        $status = "Senior";
        $query = "UPDATE author SET status = '$status' where id_author = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}

?>