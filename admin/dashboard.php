<?php
// Pastikan file config.php berisi koneksi database ($db)
require_once "../config.php";

// --- 1. LOGIKA PENGHITUNGAN TOTAL DATA UNTUK DASHBOARD CARDS ---

// Menghitung Total Mahasiswa
$sql_total_mhs = "SELECT COUNT(*) AS total_mhs FROM mhs";
$result_total_mhs = $db->query($sql_total_mhs);
if ($result_total_mhs) {
    $row_total_mhs = $result_total_mhs->fetch_assoc();
    $mahasiswa = $row_total_mhs['total_mhs'];
} else {
    $mahasiswa = "Error";
}

// Menghitung Total Pegawai (Contoh Asumsi)
$sql_total_pegawai = "SELECT COUNT(*) AS total_pegawai FROM pegawai";
$result_total_pegawai = $db->query($sql_total_pegawai);
$row_total_pegawai = $result_total_pegawai->fetch_assoc();
$pegawai = $row_total_pegawai['total_pegawai'];

// Menghitung Total Dosen (Contoh Asumsi)
$sql_total_dosen = "SELECT COUNT(*) AS total_dosen FROM dosen";
$result_total_dosen = $db->query($sql_total_dosen);
$row_total_dosen = $result_total_dosen->fetch_assoc();
$dosen = $row_total_dosen['total_dosen'];

// --- 2. LOGIKA PENCARIAN DAN FILTER DATA MAHASISWA ---

$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$no = 0;

if(isset($_POST['cari'])) {
    if($category=="prodi"){
        if($keyword=="Teknik Informatika"){
            $prodi_id=1;
        } elseif($keyword=="Sistem Informasi"){
            $prodi_id=2;
        } else {
            $prodi_id=0;
        }
        $sql="select * from mhs where prodi = '$prodi_id'";
    } else {
        $sql="select * from mhs where $category like '%$keyword%'";
    } 
} else {
    $sql="select * from mhs";
}
    
$data=$db->query($sql);
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Dashboard Mahasiswa</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard Mahasiswa
                        </li>
                    </ol>
                </div>
                </div>
            </div>
        </div>
    <div class="app-content">
        <div class="container-fluid">
            
            <div class="row mt-4">

                <div class="col-md-4">
                    <div class="small-box bg-primary text-white rounded-3 p-3">
                        <div class="inner">
                            <h3><?php echo $mahasiswa; ?></h3>
                            <p>Total Mahasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-people-fill" style="font-size:40px;"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="small-box bg-success text-white rounded-3 p-3">
                        <div class="inner">
                            <h3><?php echo $pegawai; ?></h3>
                            <p>Total Pegawai</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-badge-fill" style="font-size:40px;"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="small-box bg-warning text-white rounded-3 p-3">
                        <div class="inner">
                            <h3><?php echo $dosen; ?></h3>
                            <p>Total Dosen</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-lines-fill" style="font-size:40px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Mahasiswa</h3>
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
                                <div class="row">
                                    <table><tr><td>
                                    <a href="./?p=add-mhs" class="btn btn-success" style="width: 110px">+ Mahasiwa</a>
                                    </td><td>
                                    <form method="post" action="#">
                                        <input type="text" name="keyword" placeholder="Cari Mahasiswa" value='<?=$keyword?>'>
                                        <select name='category'>
                                            <option value='nim' <?php if($category=="nim") echo 'selected'?>>NIM</option>
                                            <option value='nama' <?php if($category=="nama") echo 'selected'?>>Nama</option>
                                            <option value='prodi' <?php if($category=="prodi") echo 'selected'?>>Prodi</option>
                                            <option value='gender' <?php if($category=="gender") echo 'selected'?>>Jenis Kelamin</option>
                                            <option value='alamat' <?php if($category=="alamat") echo 'selected'?>>Alamat</option>
                                        </select>
                                        <input type="submit" name="cari" value="Search" class="btn btn-default">
                                    </form>
                                    </td></tr>
                                    </table>
                                    <br>
                                    <?php
                                    if (isset($_POST['cari'])) {
                                        $count = mysqli_num_rows($data);
                                        if ($count > 0) {
                                            echo "<br><div class='alert alert-info'><i>Ditemukan <b>$count</b> data dengan kata kunci <b>'$keyword'</b> pada kategori <b>'$category'</b>.</i></div>";
                                        } else {
                                            echo "<br><div class='alert alert-warning'><i>Tidak ditemukan data dengan kata kunci <b>'$keyword'</b> pada kategori <b>'$category'</b>.</i></div>";
                                        }
                                    }
                                    ?>
                                    <style>
                                    .td-highlight {
                                        background-color: #fff3cd !important;
                                        font-weight: bold !important;
                                    }
                                    </style>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr><th>No</th><th>NIM</th><th>Nama</th><th>Prodi</th><th>Gender</th><th>Alamat</th><th>Opsi</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($data as $d) {
                                                $no++;
                                                // Konversi ID Prodi ke nama
                                                if($d ['prodi']==1){
                                                    $prodi_display="Teknik Informatika";
                                                }elseif($d['prodi']==2){
                                                    $prodi_display="Sistem Informasi";
                                                }else{
                                                    $prodi_display="Tidak diketahui";
                                                }
                                                
                                                $highlightCell = "";
                                                if (isset($_POST['cari'])) {
                                                    $valueToCheck = ($category == 'prodi') ? $prodi_display : $d[$category];
                                                    if (stripos($valueToCheck, $keyword) !== false && $keyword !== '') {
                                                        $highlightCell = "class='td-highlight'";
                                                    }
                                                }
                                                
                                                // Tentukan kolom mana yang akan diberi highlight
                                                $nim_highlight = ($category=='nim') ? $highlightCell : "";
                                                $nama_highlight = ($category=='nama') ? $highlightCell : "";
                                                $prodi_highlight = ($category=='prodi') ? $highlightCell : "";
                                                $gender_highlight = ($category=='gender') ? $highlightCell : "";
                                                $alamat_highlight = ($category=='alamat') ? $highlightCell : "";
                                                
                                                echo "<tr>
                                                <td>$no</td>
                                                <td $nim_highlight>$d[nim]</td>
                                                <td $nama_highlight>$d[nama]</td>
                                                <td $prodi_highlight>$prodi_display</td>
                                                <td $gender_highlight>$d[gender]</td>
                                                <td $alamat_highlight>$d[alamat]</td>
                                                <td>
                                                <a href='./?p=detail-mhs&id=$d[id]' class='btn btn-xs btn-info'>Detail</a>
                                                <a href='./?p=edit-mhs&id=$d[id]' class='btn btn-xs btn-warning'>Edit</a>
                                                <a href='./?p=hapus-mhs&id=$d[id]' class='btn btn-xs btn-danger'>Hapus</a>
                                                </td></tr>";
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