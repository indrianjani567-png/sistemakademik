<?php
require_once "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM pegawai WHERE id = '$id'";
    
    if ($db->query($sql)) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location='./?p=pegawai';</script>";
    } else {
        echo "<script>alert('Gagal Menghapus Data'); window.location='./?p=pegawai';</script>";
    }
} else {
    echo "<script>window.location='./?p=pegawai';</script>";
}
?>