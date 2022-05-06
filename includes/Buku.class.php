<?php

class Buku extends DB
{
    // untuk menampilkan data dari table buku
    function getBuku()
    {
        $query = "SELECT * FROM buku";
        return $this->execute($query);
    }

    // untuk menambahkan data
    function add($data)
    {
        $judul = $data['tjudul'];
        $penerbit = $data['tpenerbit'];
        $deskripsi = $data['tdeskripsi'];
        $status = "-";
        $author = $data['cmbauthor'];

        $query = "INSERT INTO buku VALUES ('', '$judul', '$penerbit', '$deskripsi', '$status', '$author')";

        return $this->execute($query);
    }

    // untuk menghapus data
    function delete($id)
    {
        $query = "DELETE FROM buku WHERE id_buku = '$id'";

        return $this->execute($query);
    }

    // untuk update status buku
    function statusBuku($id)
    {
        $status = "Best Seller";
        $query = "UPDATE buku SET status = '$status' where id_buku = '$id'";

        return $this->execute($query);
    }
    
    function getJudulByID($id_buku)
    {
        $query = "SELECT judul_buku FROM buku WHERE id_buku = '$id_buku'";

        return $this->execute($query);
    }
}

?>