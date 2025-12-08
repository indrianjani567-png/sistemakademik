<?php
$idx = isset($_GET['id']) ? intval($_GET['id']) : 0;
// If this file is opened directly (not via ?p=edit-pegawai), redirect to the wrapper
if (!isset($_GET['p'])) {
    header('Location: ./index.php?p=edit-pegawai&id=' . $idx);
    exit();
}
require_once "../config.php";

if ($idx == 0) {
    header('Location: ./index.php');
    exit();
}

$sql = "select * from pegawai where id='$idx'";
$data = $db->query($sql);
?>

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Pegawai</h3>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard Pegawai
                        </li>
                    </ol>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card Header-->
                        <div class="card-header">
                            <!--begin::Card Title-->
                            <h3 class="card-title"></h3>
                            <!--end::Card Title-->
                            <!--begin::Card Toolbar-->
                            <div class="card-tools">
                                <button
                                    type="button"
                                    class="btn btn-tool"
                                    data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-tool"
                                    data-lte-toggle="card-remove"
                                    title="Remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <!--end::Card Toolbar-->
                        </div>
                        <!--end::Card Header-->
                        <!--begin::Card Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="col-md-6">
                                <form method="post" action="#">
                                    <?php
                                    if ($_POST['simpanEdit']) {
                                        $nama = $_POST['nama'];
                                        $alamat = $_POST['alamat'];
                                        $jabatan = $_POST['jabatan'];

                                        $sql = "update pegawai set nama='$nama', alamat='$alamat', jabatan='$jabatan' where id='$idx'";
                                        $hasil = $db->query($sql);

                                        if ($hasil) {
                                            echo "<div class='alert alert-success'>Data Berhasil diupdate</div>";
                                            // re-query to get updated data
                                            $data = $db->query("select * from pegawai where id='$idx'");
                                        } else {
                                            echo "<div class='alert alert-danger'>Data Gagal diupdate</div>";
                                        }
                                    }
                                    ?>
                                    <table class="table table-bordered">
                                        <?php
                                        if (!$data || $data->num_rows == 0) {
                                            echo "<tr><td colspan='2'>Data tidak ditemukan</td></tr>";
                                        } else {
                                            foreach ($data as $d) {
                                                // Show the ID as readonly
                                                echo "<tr><td>ID Pegawai</td><td><input type='text' name='id' value='" . htmlspecialchars($d['id']) . "' class='form-control' readonly></td></tr>";
                                                echo "<tr><td>Nama</td><td><input type='text' name='nama' value='" . htmlspecialchars($d['nama']) . "' class='form-control'></td></tr>";
                                                echo "<tr><td>Alamat</td><td><textarea class='form-control' name='alamat'>" . htmlspecialchars($d['alamat']) . "</textarea></td></tr>";
                                                echo "<tr><td>Jabatan</td><td><input type='text' name='jabatan' value='" . htmlspecialchars($d['jabatan']) . "' class='form-control'></td></tr>";
                                                echo "<tr><td></td><td>
                          <input type='submit' name='simpanEdit' value='Simpan Perubahan' class='btn btn-primary'></td></tr>";
                                            }
                                        }
                                        ?>
                                    </table>
                                    <a href="./?p=index" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                            <!--begin::Col-->
                            <!--end::Col-->
                            <!--begin::Col-->
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <div id="sidebar-color-code" class="w-100"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Card Body-->
                    <!--begin::Card Footer-->
                    <!--end::Card Footer-->
                </div>
                <!--end::Card-->

                <!--end::Card-->
                <!--begin::Card-->
                <!--end::Card-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>