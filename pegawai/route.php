<?php

$p = isset($_GET['p']) ? $_GET['p'] : '';

switch ($p) {
    case 'detail-pegawai':
        include "detail-pegawai.php";
        break;
    case 'edit-pegawai':
        include "edit-pegawai.php";
        break;
    case 'hapus-pegawai':
        include "hapus-pegawai.php";
        break;
    default:
        require_once "index.php";
        break;
}

?>
