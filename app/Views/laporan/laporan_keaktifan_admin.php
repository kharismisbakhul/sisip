<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Laporan Keaktifan</h4>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">

                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Keaktifan Pegawai - <?= $bln .' '.$tahun ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                    <div class="d-flex col-lg-5 mb-2">
                                        <form action="<?= base_url('/admin/laporanKeaktifan')?>" method="get">
                                            <div class="input-group">
                                                <select class="custom-select " id="inlineFormCustomSelect" name="bulan">
                                                    <option selected hidden value="">Pilih Bulan...</option>
                                                    <?php foreach ($bulan as $b) {
                                                        echo '<option value="'.$b['id_bulan'].'">'.$b['nama_bulan'].'</option>';
                                                    }?>
                                                </select>
                                                <select class="custom-select " id="inlineFormCustomSelect" name="tahun">
                                                    <option selected hidden value="">Pilih Tahun...</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type="submit"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-7">
                                        <a target="_blank" href="<?= base_url('/exportCapaianKerja') ?>" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    </div>
                                    </div>

                                    <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="align-middle text-center" rowspan="2">Nama Pegawai</th>
                                        <th class="align-middle text-center" rowspan="2">Jabatan</th>
                                        <th class="align-middle text-center" colspan="<?= $batas_tanggal['jumlah_tanggal']?>">Tanggal</th>
                                        <th class="align-middle text-center" rowspan="2">Jumlah Kehadiran</th>
                                    </tr>
                                    <tr>
                                        <?php for($i = 1; $i <= intval($batas_tanggal['jumlah_tanggal']); $i++) {
                                            echo '<th>'.$i.'</th>';
                                        }?>
                                    </tr>
        
                                </thead>
                                <tbody>
                                    <?php $index = 1; ?>
                                    <tr>
                                    <?php 
                                    for ($p=0; $p < count($pegawai); $p++) { 
                                        $counter = 0;
                                        echo '<tr>
                                        <td>'.$pegawai[$p]['nama'].'</td>
                                        <td>'.$pegawai[$p]['nama_jabatan'].' '.$pegawai[$p]['jabatan']['nama'].'</td>';
                                        for($i = 1; $i <= intval($batas_tanggal['jumlah_tanggal']); $i++) {
                                            $tanggal = ($i < 10) ? '0'.$i : $i; 
                                            $status = false;
                                            for ($j=0; $j < count($pegawai[$p]['presensi']); $j++) { 
                                                // echo "2020-07-".$tanggal.' &&& '.$presensi[$j]['tanggal_presensi'];die;
                                                if($pegawai[$p]['presensi'][$j]['tanggal_presensi'] == "2020-07-".$tanggal){
                                                    echo '<td><i class="fa fa-check text-success" aria-hidden="true"></i>
                                                    </td>';
                                                    $status = true;
                                                    $counter++;
                                                    break;
                                                }
                                            }
                                            if($status == false){
                                                echo '<td><i class="fa fa-times text-danger" aria-hidden="true"></i>
                                                </td>';
                                            }
                                        };
                                        echo '<td>'.$counter.'</td>';
                                        echo '</tr>';
                                    }?>
                                    
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?= $this->endSection() ?>