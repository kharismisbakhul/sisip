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
                                        <form action="<?= base_url('/staff/laporanKeaktifan')?>" method="get">
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
                                        <a target="_blank" href="<?= base_url('/exportLaporanKeaktifan?bulan='.$bb.'&tahun='.$tahun) ?>" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    </div>
                                    </div>

                                    <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="align-middle text-center" rowspan="2">Nama</th>
                                        <th class="align-middle text-center" rowspan="2">Jabatan</th>
                                        <th class="align-middle text-center" rowspan="2">Unit Kerja</th>
                                        <th class="align-middle text-center" colspan="<?= $jumlah_tanggal?>">Tanggal</th>
                                        <th class="align-middle text-center" rowspan="2">Jumlah Kehadiran</th>
                                        <th class="align-middle text-center" rowspan="2">Jumlah Izin</th>
                                    </tr>
                                    <tr>
                                        <?php for($i = 1; $i <= intval($jumlah_tanggal); $i++) {
                                            echo '<th>'.$i.'</th>';
                                        }?>
                                    </tr>
        
                                </thead>
                                <tbody>
                                    <?php $index = 1; $counter = 0; $counter_izin = 0;?>
                                    <tr>
                                    <td><?= $user['nama']?></td>
                                    <td><?= $jabatan['nama_status_user'].' '.$jabatan['nama']?></td>
                                    <td><?= $unit_kerja['nama']?></td>
                                    <?php for($i = 1; $i <= intval($jumlah_tanggal); $i++) {
                                            $tanggal = ($i < 10) ? '0'.$i : $i; 
                                            $status = false;
                                            for ($j=0; $j < count($presensi); $j++) { 
                                                if($presensi[$j]['tanggal_presensi'] == ($t.'-'.$bb.'-'.$tanggal)){
                                                    if($presensi[$j]['status_presensi'] != 0){
                                                        echo '<td><i class="fa fa-circle text-warning" aria-hidden="true"></i>
                                                        </td>';
                                                        $status = true;
                                                        $counter_izin++;
                                                        break;
                                                    }else{
                                                        echo '<td><i class="fa fa-check text-success" aria-hidden="true"></i>
                                                        </td>';
                                                        $status = true;
                                                        $counter++;
                                                        break;
                                                    }
                                                }
                                            }
                                            if($status == false){
                                                if(in_array(($t.'-'.$bb.'-'.$tanggal),$weekend)){
                                                    echo '<td><i class="fa fa-minus text-info" aria-hidden="true"></i>
                                                    </td>';
                                                }else{
                                                    echo '<td><i class="fa fa-times text-danger" aria-hidden="true"></i>
                                                    </td>';
                                                }
                                            }
                                    }?>
                                    <td><?= $counter?></td>
                                    <td><?= $counter_izin?></td>
                                    </tr>
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