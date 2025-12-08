<?php
require_once "../config.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];

    // Query insert sesuai tabel pegawai
    $sql = "INSERT INTO pegawai (nama, jabatan, alamat, waktu) VALUES ('$nama', '$jabatan', '$alamat', NOW())";
    
    if ($db->query($sql)) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location='./?p=pegawai';</script>";
    } else {
        echo "<script>alert('Gagal Menyimpan Data');</script>";
    }
}
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Pegawai</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="./?p=pegawai">Pegawai</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Pegawai</h3>
                </div>
                <form method="post" action="">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama Lengkap">
                        </div>
                        <div class="form-group mb-3">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" required placeholder="Contoh: Staff Administrasi">
                        </div>
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="./?p=pegawai" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>