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
                                <h4>Keaktifan Pegawai - <?= $bln .' '.$tahun; ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                    <div class="d-flex col-lg-5 mb-2">
                                    <?php if(session('id_status_user') == 1) {?>
                                        <form action="<?= base_url('/admin/laporanKeaktifan')?>" method="get">
                                    <?php }else if(session('id_status_user') == 3) {?>
                                        <form action="<?= base_url('/direktur/laporanKeaktifan')?>" method="get">
                                    <?php }else if(session('id_status_user') == 4) {?>
                                        <form action="<?= base_url('/gm/laporanKeaktifan')?>" method="get">
                                    <?php }else if(session('id_status_user') == 5) {?>
                                        <form action="<?= base_url('/manager/laporanKeaktifan')?>" method="get">
                                    <?php }else if(session('id_status_user') == 6) {?>
                                        <form action="<?= base_url('/supervisor/laporanKeaktifan')?>" method="get">
                                    <?php }?>
                                            <div class="input-group">
                                                <select class="custom-select " id="inlineFormCustomSelect" name="bulan">
                                                    <option selected hidden value="">Pilih Bulan...</option>
                                                    <?php foreach ($bulan as $b) {
                                                        echo '<option value="'.$b['id_bulan'].'">'.$b['nama_bulan'].'</option>';
                                                    }?>
                                                </select>
                                                <select class="custom-select " id="inlineFormCustomSelect" name="tahun">
                                                    <option selected hidden value="">Pilih Tahun...</option>
                                                    <?php 
                                                        for ($i=2018; $i <= 2050; $i++) { 
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                            # code...
                                                        }
                                                    ?>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type="submit"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-7">
                                        <a target="_blank" href="<?= base_url('/exportLaporanKeaktifanAdmin?bulan='.$bb.'&tahun='.$tahun) ?>" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    </div>
                                    </div>

                                    <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="align-middle text-center" rowspan="2">Nama Pegawai</th>
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
                                    <?php $index = 1; ?>
                                    <tr>
                                    <?php 
                                    for ($p=0; $p < count($pegawai); $p++) { 
                                        $counter = 0;
                                        $counter_izin = 0;
                                        echo '<tr>
                                        <td>'.$pegawai[$p]['nama'].'</td>
                                        <td>'.$pegawai[$p]['nama_jabatan'].' '.$pegawai[$p]['jabatan']['nama'].'</td>
                                        <td>'.$pegawai[$p]['unit_kerja']['nama'].'</td>';
                                        for($i = 1; $i <= intval($jumlah_tanggal); $i++) {
                                            $tanggal = ($i < 10) ? '0'.$i : $i; 
                                            $status = false;
                                            for ($j=0; $j < count($pegawai[$p]['presensi']); $j++) { 
                                                if($pegawai[$p]['presensi'][$j]['tanggal_presensi'] == $t.'-'.$bb.'-'.$tanggal){
                                                    if($pegawai[$p]['presensi'][$j]['status_presensi'] != 0){
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
                                        };
                                        echo '<td>'.$counter.'</td>';
                                        echo '<td>'.$counter_izin.'</td>';
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