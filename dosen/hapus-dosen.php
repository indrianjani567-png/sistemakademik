<?php
$idx=$_GET['id'];
require_once "../config.php";
$sql="delete from dosen where id='$idx'";
if($db->query($sql)){
    echo "<script>alert('Data Berhasil Dihapus');
    window.location.href='./?p=index.php';</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus');
    window.location.href='./?p=index.php';</script>";
}
?>