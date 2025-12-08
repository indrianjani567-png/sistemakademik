<?php

$p = $_GET['p'];

switch ($p) {

    case 'detail-dosen':
        include "detail-dosen.php";
        break;
    case 'edit-dosen':
        include "edit-dosen.php";
        break;
    case 'hapus-dosen':
        include "hapus-dosen.php";
        break;
    default:
        require_once "index.php";
        break;
}