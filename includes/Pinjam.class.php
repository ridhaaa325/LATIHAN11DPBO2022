<?php

class Pinjam extends DB
{
    // untuk menampilkan data dari table pinjam
    function getPinjam()
    {
        $query = "SELECT * FROM pinjam ";

        return $this->execute($query);
    }

    // untuk menambahkan data
    function add($data)
    {   
        $nama = $data['nama'];
        $judul = $data['judul_buku'];
        $status = "sedang dipinjam";

        $query = "INSERT INTO pinjam VALUES ('', '$nama', '$judul', '$status')";

        return $this->execute($query);
    }

    // untuk menghapus data
    function delete($id)
    {
        $query = "DELETE FROM pinjam WHERE id_pinjam = $id";

        return $this->execute($query);
    }

    // update status peminjaman
    function updateStatusPinjam($id)
    {
        $status = "sudah dikembalikan";
        $query = "UPDATE pinjam SET status_pinjam = '$status' where id_pinjam = '$id'";

        return $this->execute($query);
    }
}
?>