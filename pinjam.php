<?php

// import classes
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Pinjam.class.php");
include("includes/Member.class.php");
include("includes/Author.class.php");

$buku = new Buku($db_host, $db_user, $db_pass, $db_name);
$member = new Member($db_host, $db_user, $db_pass, $db_name);
$pinjam = new Pinjam($db_host, $db_user, $db_pass, $db_name);
$buku->open();
$member->open();
$pinjam->open();

// memanggil function add
if (isset($_POST['add'])) 
{   
    $pinjam->add($_POST);
    
    header("location:pinjam.php");
}

// memanggil function hapus
if (!empty($_GET['id_hapus'])) 
{
    $id_pinjam = $_GET['id_hapus'];
    $pinjam->delete($id_pinjam);
    
    header("location:pinjam.php");
}

// memanggil function update status
if (!empty($_GET['id_status'])) 
{
    $pinjam->updateStatusPinjam($_GET['id_status']);

    header("location:pinjam.php");
}

$status = false;
$data = null;
$no = 1;
$dataNama = null;
$dataJudul = null;

$pinjam->getPinjam();
while (list($id_pinjam, $nim, $id_buku, $status) = $pinjam->getResult()) 
{
    $member->getNamaByNIM($nim);
    $data_nama = $member->getResult();
    $nama = $data_nama['nama'];

    $buku->getJudulByID($id_buku);
    $data_judul = $buku->getResult();
    $judul = $data_judul['judul_buku'];

    if ($status == "sedang dipinjam") 
    {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $nama . "</td>
            <td>" . $judul . "</td>
            <td>" . $status . "</td>
            <td>
            <a href='pinjam.php?id_status=" . $id_pinjam . "' class='btn btn-warning' '>Update</a>
            <a href='pinjam.php?id_hapus=" . $id_pinjam . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    }
    else
    {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $nama . "</td>
            <td>" . $judul . "</td>
            <td>" . $status . "</td>
            <td>
            <a href='pinjam.php?id_hapus=" . $id_pinjam . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    }
}


$member->getMember();
while (list($nim, $nama, $jurusan) = $member->getResult()) {
    $dataNama .= "<option value='".$nim."'>".$nama."</option>";
}

$buku->getBuku();
while (list($id_buku, $judul, $penerbit, $deskripsi, $status, $id_author) = $buku->getResult()) {
    $dataJudul .= "<option value='".$id_buku."'>".$judul."</option>";
}

$pinjam->close();
$member->close();
$buku->close();
$tpl = new Template("templates/pinjam.html");
$tpl->replace("OPTION_NAMA", $dataNama);
$tpl->replace("OPTION_TITLE", $dataJudul);
$tpl->replace("DATA_TABEL", $data);
$tpl->write();