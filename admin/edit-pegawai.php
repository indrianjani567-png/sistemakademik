<?php
require_once "../config.php";

$id = $_GET['id'];
$query = $db->query("SELECT * FROM pegawai WHERE id = '$id'");
$data = $query->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];

    // Query update
    $sql = "UPDATE pegawai SET nama='$nama', jabatan='$jabatan', alamat='$alamat' WHERE id='$id'";
    
    if ($db->query($sql)) {
        echo "<script>alert('Data Berhasil Diupdate'); window.location='./?p=pegawai';</script>";
    } else {
        echo "<script>alert('Gagal Mengupdate Data');</script>";
    }
}
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Pegawai</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="./?p=pegawai">Pegawai</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Pegawai</h3>
                </div>
                <form method="post" action="">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="<?= $data['jabatan'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required><?= $data['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                        <a href="./?p=pegawai" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>