<?php
$idx = isset($_GET['id']) ? intval($_GET['id']) : 0;
// If this file is opened directly (not via ?p=detail-pegawai), redirect to the wrapper
if (!isset($_GET['p'])) {
    header('Location: ./index.php?p=detail-pegawai&id=' . $idx);
    exit();
}
require_once "../config.php";

if ($idx == 0) {
    $data = [];
} else {
    $sql = "select * from pegawai where id='$idx'";
    $data = $db->query($sql);
}
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
                    <h3 class="mb-0">Detail Pegawai</h3>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <?php
                                        if (!$data || $data->num_rows == 0) {
                                            echo "<tr><td colspan='2'>Data tidak ditemukan</td></tr>";
                                        } else {
                                            foreach ($data as $d) {
                                                echo "<tr><td>ID Pegawai</td><td>" . htmlspecialchars($d['id']) . "</td></tr>";
                                                echo "<tr><td>Nama</td><td>" . htmlspecialchars($d['nama']) . "</td></tr>";
                                                echo "<tr><td>Alamat</td><td>" . htmlspecialchars($d['alamat']) . "</td></tr>";
                                                echo "<tr><td>Jabatan</td><td>" . htmlspecialchars($d['jabatan']) . "</td></tr>";
                                            }
                                        }
                                        ?>
                                    </table>
                                    <a href="./?p=index" class="btn btn-secondary">Kembali</a>
                                </div>
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