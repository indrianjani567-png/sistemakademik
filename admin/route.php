<?php

$p=$_GET['p'];

switch($p){

    case 'dosen':
        include "dosen.php"; //include menjadi require_once
        break;
    case 'mahasiswa':
        include "mahasiswa.php";
        break;
    case 'pegawai':
        include "pegawai.php";
        break;
    case 'gantipwd':
        include "gantipassword.php";
        break;
    case 'add-mhs':
        include "tambah-mahasiswa.php";
        break;
    case 'detail-mhs':
        include "detail-mahasiswa.php";
        break;
    case 'edit-mhs':
        include "edit-mahasiswa.php";   
        break;
    case 'hapus-mhs':
        include "hapus-mahasiswa.php";  
        break;
    case 'add-dosen':
        include "tambah-dosen.php";
        break;
    case 'detail-dosen':
        include "detail-dosen.php";
        break;
    case 'edit-dosen':
        include "edit-dosen.php";
        break;
    case 'hapus-dosen':
        include "hapus-dosen.php";
        break;
    case 'add-pegawai':
        include "add-pegawai.php"; 
        break;
    case 'edit-pegawai':
        include "edit-pegawai.php";
        break;
    case 'hapus-pegawai':
        include "hapus-pegawai.php";
        break;
    case 'detail-pegawai':
        include "detail-pegawai.php";
        break;
    default:
        require_once "dashboard.php";
        break;
}
?>