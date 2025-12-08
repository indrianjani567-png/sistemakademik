<?php
// Pastikan ID ditangkap dengan benar
$idx = $_GET['id'];
require_once "../config.php";

// Query ke tabel pegawai
$sql = "SELECT * FROM pegawai WHERE id='$idx'";
$data = $db->query($sql);
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Detail Pegawai</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="./?p=pegawai">Pegawai</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Detail
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Lengkap</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-bordered table-hover">
                                        <?php
                                        // Cek apakah data ditemukan
                                        if ($data->num_rows > 0) {
                                            foreach ($data as $d) {
                                                // Tidak perlu switch case prodi/gender karena tabel pegawai isinya teks langsung
                                                echo "<tr>
                                                        <td style='width: 30%; background-color: #f9f9f9;'><b>Nama Pegawai</b></td>
                                                        <td>$d[nama]</td>
                                                      </tr>";
                                                echo "<tr>
                                                        <td style='background-color: #f9f9f9;'><b>Jabatan</b></td>
                                                        <td>$d[jabatan]</td>
                                                      </tr>";
                                                echo "<tr>
                                                        <td style='background-color: #f9f9f9;'><b>Alamat</b></td>
                                                        <td>$d[alamat]</td>
                                                      </tr>";
                                                echo "<tr>
                                                        <td style='background-color: #f9f9f9;'><b>Waktu Input/Update</b></td>
                                                        <td>$d[waktu]</td>
                                                      </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='2' class='text-center text-danger'>Data tidak ditemukan</td></tr>";
                                        }
                                        ?>
                                    </table>
                                    <br>
                                    <a href="./?p=pegawai" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>