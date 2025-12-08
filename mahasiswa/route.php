<?php

$p=$_GET['p'];

switch($p){
    case 'detail-mhs':
        include "detail-mahasiswa.php";
        break;
    case 'edit-mhs':
        include "edit-mahasiswa.php";
        break;
    case 'hapus-mhs':
        include "hapus-mahasiswa.php";
        break;
    default:
        require_once "index.php";
        break;
}
?>