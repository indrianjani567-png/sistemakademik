<?php
$db=new mysqli("localhost","root","","siakaddb"); //server, user, password, nama database
if($db){
    // echo"Koneksi Berhasil"; 
}else{
    echo"Koneksi Gagal";    
}
?>