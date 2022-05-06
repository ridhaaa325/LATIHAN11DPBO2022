<?php

// import classes
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Member.class.php");
include("includes/Buku.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();
$member->getMember();

// memanggil function add
if (isset($_POST['add'])) 
{
    $member->add($_POST);

    header("location:member.php");
}

// memanggil function delete
if (!empty($_GET['id_hapus'])) 
{
    $nim = $_GET['id_hapus'];
    $member->delete($nim);

    header("location:member.php");
}

// memanggil function update
if (isset($_POST['update'])) 
{
    $member->update($_POST);
 
    header("location:member.php");
}

$formUpdate = null;
if (!empty($_GET['id_update'])) 
{
    $nim = $_GET['id_update'];

    $member->getMemberByNIM($nim);
    $data_member = $member->getResult();
    $nama = $data_member['nama'];
    $jurusan = $data_member['jurusan'];

    $formUpdate .=
    "
    <h3 class='card-title text-center'>Update Data Member</h3>
        <div class='form-row'>
            <div class='form-group col'>
                <label for='nim'>NIM</label>
                <input type='text' class='form-control' name='nim' value='$nim' readonly/>
            </div>
        </div>
        <div class='form-row'>
        <div class='form-group col'>
            <label for='nama'>Nama</label>
            <input type='text' class='form-control' name='nama' value='$nama' required />
        </div>
        </div>

        <div class='form-row'>
        <div class='form-group col'>
            <label for='jurusan'>Jurusan</label>
            <input type='text' class='form-control' name='jurusan' value='$jurusan' required></input>
        </div>
        </div>

        <button type='submit' name='update' class='btn btn-primary mt-3'>Save</button>
    ";
}
else 
{
    $formUpdate .= 
    "
    <h3 class='card-title text-center'>Add Data Member</h3>
        <div class='form-row'>
            <div class='form-group col'>
                <label for='nim'>NIM</label>
                <input type='text' class='form-control' name='nim' required />
            </div>
        </div>

        <div class='form-row'>
        <div class='form-group col'>
            <label for='nama'>Nama</label>
            <input type='text' class='form-control' name='nama' required />
        </div>
        </div>

        <div class='form-row'>
        <div class='form-group col'>
            <label for='jurusan'>Jurusan</label>
            <input type='text' class='form-control' name='jurusan' required></input>
        </div>
        </div>

        <button type='submit' name='add' class='btn btn-primary mt-3'>Add</button>
    ";
}

$data = null;
$no = 1;

$member->getMember();
while (list($nim, $nama, $jurusan) = $member->getResult()) 
{
    $data .= "<tr>
        <td>" . $no++ . "</td>
        <td>" . $nim . "</td>
        <td>" . $nama . "</td>
        <td>" . $jurusan . "</td>
        <td>
        <a href='member.php?id_update=" . $nim . "' class='btn btn-warning' '>Update</a>
        <a href='member.php?id_hapus=" . $nim . "' class='btn btn-danger' '>Hapus</a>
        </td>
        </tr>";
}

$member->close();
$tpl = new Template("templates/member.html");
$tpl->replace("FORM", $formUpdate);
$tpl->replace("DATA_TABEL", $data);
$tpl->write();
