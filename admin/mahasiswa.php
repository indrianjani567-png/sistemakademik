<?php
require_once "../config.php";
$keyword=$_POST['keyword'];;
$category=$_POST['category'];

if($_POST['cari']){
  if($category=="prodi"){
    if($keyword=="Teknik Informatika"){
      $prodi=1;
    } elseif($keyword=="Sistem Informasi"){
      $prodi=2;
    } else {
      $prodi=0;
    }
    $sql="select * from mhs where $category like '%$prodi%'";
  } else {
    $sql="select * from mhs where $category like '%$keyword%'";
  } 
}else{
  $sql="select * from mhs";
}
  $data=$db->query($sql);
// var_dump($data);
?>

<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-sm-6"><h3 class="mb-0">Dashboard Mahasiswa</h3></div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Dashboard Mahasiswa
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
                        data-lte-toggle="card-collapse"
                      >
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-remove"
                        title="Remove"
                      >
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
                      <!--begin::Col-->
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
                            foreach($data as $d) { //foreach adalah perulangan khusus array
                              $no++;
                              if($d ['prodi']==1){
                                $prodi="Teknik Informatika";
                              }elseif($d['prodi']==2){
                                $prodi="Sistem Informasi";
                              }else{
                                $prodi="Tidak diketahui";
                              }
                              $highlightCell = "";
                              if (isset($_POST['cari'])) {

                                  if ($category == 'prodi') {
                                      $valueToCheck = $prodi;
                                  } else {
                                      $valueToCheck = $d[$category];
                                  }

                                  if (stripos($valueToCheck, $keyword) !== false && $keyword !== '') {
                                      $highlightCell = "class='td-highlight'";
                                  }
                              }
                              echo "<tr>
                              <td>$no</td>
                              <td " . ($category=='nim' ? $highlightCell : "") . ">$d[nim]</td>
                              <td " . ($category=='nama' ? $highlightCell : "") . ">$d[nama]</td>
                              <td " . ($category=='prodi' ? $highlightCell : "") . ">$prodi</td>
                              <td " . ($category=='gender' ? $highlightCell : "") . ">$d[gender]</td>
                              <td " . ($category=='alamat' ? $highlightCell : "") . ">$d[alamat]</td>
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