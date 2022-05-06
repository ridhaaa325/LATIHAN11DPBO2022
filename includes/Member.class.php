<?php

class Member extends DB
{
    // untuk menampilkan data dari table member
    function getMember()
    {
        $query = "SELECT * FROM member";

        return $this->execute($query);
    }
    
    // untuk menambahkan data
    function add($data)
    {   
        $nim = $data['nim'];
        $nama = $data['nama'];
        $jurusan = $data['jurusan'];
        
        $query = "INSERT INTO member VALUES ('$nim', '$nama', '$jurusan')";

        return $this->execute($query);
    }

    // untuk menghapus data
    function delete($nim)
    {
        $query = "DELETE FROM member WHERE nim = $nim";

        return $this->execute($query);
    }

    // untuk update data
    function update($data)
    {
        $nim = $data['nim'];
        $nama = $data['nama'];
        $jurusan = $data['jurusan'];
        
        $query = "UPDATE member SET nama = '$nama', jurusan = '$jurusan' WHERE nim = '$nim'";

        return $this->execute($query);
    }

    // mendapatkan data berdasarkan nim
    function GetMemberByNIM($nim)
    {
        $query = "SELECT * FROM member WHERE nim = '$nim'";

        return $this->execute($query);
    }

    // mendapatkan nama berdasarkan nim
    function GetNamaByNIM($nim)
    {
        $query = "SELECT nama FROM member WHERE nim = '$nim'";

        return $this->execute($query);
    }

}
?>