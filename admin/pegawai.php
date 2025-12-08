<?php
require_once "../config.php";

// Inisialisasi variabel untuk menghindari error undefined
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : 'nama';

if (isset($_POST['cari'])) {
    // Pencarian sederhana karena Jabatan, Nama, Alamat semua tipe string/text
    $sql = "SELECT * FROM pegawai WHERE $category LIKE '%$keyword%'";
} else {
    $sql = "SELECT * FROM pegawai";
}

$data = $db->query($sql);
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Dashboard Pegawai</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard Pegawai</li>
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
                            <h3 class="card-title">Data Pegawai</h3>
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
                                <div class="col-12">
                                    <table>
                                        <tr>
                                            <td>
                                                <a href="./?p=add-pegawai" class="btn btn-success" style="width: 130px">+ Pegawai</a>
                                            </td>
                                            <td>
                                                <form method="post" action="#">
                                                    <input type="text" name="keyword" placeholder="Cari Pegawai" value='<?= $keyword ?>' class="form-control d-inline-block" style="width: auto; display: inline;">
                                                    <select name='category' class="form-select d-inline-block" style="width: auto; display: inline;">
                                                        <option value='nama' <?php if ($category == "nama") echo 'selected' ?>>Nama</option>
                                                        <option value='jabatan' <?php if ($category == "jabatan") echo 'selected' ?>>Jabatan</option>
                                                        <option value='alamat' <?php if ($category == "alamat") echo 'selected' ?>>Alamat</option>
                                                    </select>
                                                    <input type="submit" name="cari" value="Search" class="btn btn-primary">
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    
                                    <?php
                                    if (isset($_POST['cari'])) {
                                        $count = mysqli_num_rows($data);
                                        if ($count > 0) {
                                            echo "<div class='alert alert-info'><i>Ditemukan <b>$count</b> data dengan kata kunci <b>'$keyword'</b> pada kategori <b>'$category'</b>.</i></div>";
                                        } else {
                                            echo "<div class='alert alert-warning'><i>Tidak ditemukan data dengan kata kunci <b>'$keyword'</b> pada kategori <b>'$category'</b>.</i></div>";
                                        }
                                    }
                                    ?>
                                    
                                    <style>
                                        .td-highlight {
                                            background-color: #fff3cd !important;
                                            font-weight: bold !important;
                                        }
                                    </style>
                                    
                                    <table class="table table-striped table-hover mt-3">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Alamat</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($data as $d) {
                                                $no++;
                                                $highlightCell = "";
                                                if (isset($_POST['cari'])) {
                                                    $valueToCheck = $d[$category];
                                                    if (stripos($valueToCheck, $keyword) !== false && $keyword !== '') {
                                                        $highlightCell = "class='td-highlight'";
                                                    }
                                                }
                                                echo "<tr>
                                                    <td>$no</td>
                                                    <td " . ($category == 'nama' ? $highlightCell : "") . ">$d[nama]</td>
                                                    <td " . ($category == 'jabatan' ? $highlightCell : "") . ">$d[jabatan]</td>
                                                    <td " . ($category == 'alamat' ? $highlightCell : "") . ">$d[alamat]</td>
                                                    <td>
                                                        <a href='./?p=detail-pegawai&id=$d[id]' class='btn btn-xs btn-info'>Detail</a>
                                                        <a href='./?p=edit-pegawai&id=$d[id]' class='btn btn-xs btn-warning'>Edit</a>
                                                        <a href='./?p=hapus-pegawai&id=$d[id]' class='btn btn-xs btn-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                                                    </td>
                                                </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>