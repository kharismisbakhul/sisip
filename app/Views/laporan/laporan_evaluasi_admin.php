<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Laporan Evaluasi dan Monitoring</h4>
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
                            <?php
                            if ($tanggal_mulai != null) {
                                echo '<h4>Laporan Evaluasi dan Monitoring ' . $tanggal_mulai . ' s/d ' . $tanggal_selesai . '</h4>';
                            }
                            else {
                                echo '<h4>Laporan Evaluasi dan Monitoring</h4>';
                            }
                            ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                    <div class="d-flex col-lg-5 mb-2">
                                    <?php if (session('id_status_user') == 1) { ?>
                                        <form action="<?= base_url('/admin/LaporanEvaluasi') ?>" method="get">
                                    <?php 
                                }
                                else if (session('id_status_user') == 3) { ?>
                                        <form action="<?= base_url('/direktur/LaporanEvaluasi') ?>" method="get">
                                    <?php 
                                }
                                else if (session('id_status_user') == 4) { ?>
                                        <form action="<?= base_url('/gm/LaporanEvaluasi') ?>" method="get">
                                    <?php 
                                }
                                else if (session('id_status_user') == 5) { ?>
                                        <form action="<?= base_url('/manager/LaporanEvaluasi') ?>" method="get">
                                    <?php 
                                }
                                else if (session('id_status_user') == 6) { ?>
                                        <form action="<?= base_url('/supervisor/LaporanEvaluasi') ?>" method="get">
                                    <?php 
                                } ?>
                                            <div class="input-group">
                                            <div class="form-group">
                                                <label for="waktu_mulai">Tanggal Mulai</label>
                                                <input type="date" class="form-control" name="waktu_mulai" placeholder="Waktu Mulai...">
                                            </div>
                                            <div class="form-group">
                                                <label for="waktu_selesai">Tanggal Selesai</label>
                                                <input type="date" class="form-control" name="waktu_selesai" placeholder="Waktu Selesai...">
                                            </div>
                                            <div class="form-group">
                                            <label for="waktu_selesai"></label><br>
                                                    <button class="btn btn-info mt-2" type="submit"><i
                                                            class="fas fa-search"></i></button>
                                            </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-7">
                                    <?php if ($tanggal_mulai != null) {?>
                                        <a target="_blank" href="<?= base_url('/exportLaporanEvaluasiAdmin?waktu_mulai='.$tgl_mulai.'&waktu_selesai='.$tgl_selesai) ?>" class="btn btn-success float-right mb-3"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    <?php }else {?>
                                        <a target="_blank" href="<?= base_url('/exportLaporanEvaluasiAdmin') ?>" class="btn btn-success float-right mb-3"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    <?php }?>
                                    </div>
                                    </div>

                                    <table id="zero_config" class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="align-middle" rowspan="2">No</th>
                                        <th class="align-middle" rowspan="2">Unit</th>
                                        <th class="align-middle" rowspan="2">Jabatan</th>
                                        <th class="align-middle" rowspan="2">Nama</th>
                                        <th class="align-middle" colspan="2">Deskripsi Tugas</th>
                                        <th class="align-middle" colspan="3">Periode</th>
                                        <th class="align-middle" rowspan="2">Jumlah Tugas Dikerjakan</th>
                                        <th class="align-middle" rowspan="2">Jumlah Target Tugas</th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Utama</th>
                                        <th class="align-middle">Tambahan</th>
                                        <th class="align-middle">Harian</th>
                                        <th class="align-middle">Mingguan</th>
                                        <th class="align-middle">Periodik</th>
                                    </tr>
        
                                </thead>
                                <tbody>
                                    <?php $index = 1;
                                    foreach ($pegawai as $p) : ?>
                                        <?php $count = 1;
                                        if ($p['rancangan_tugas'] == null) {
                                            echo '
                                            <tr>
                                                <td>' . ($index++) . '</td>
                                                <td>' . $p['unit_kerja']['nama'] . '</td>
                                                <td>' . $p['nama_jabatan'] . ' ' . $p['jabatan']['nama'] . '</td>
                                                <td>' . $p['nama'] . '</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>';
                                        }
                                        else {
                                            foreach ($p['rancangan_tugas'] as $t) : ?>  
                                        <tr>
                                        <?php if ($count == 1) { ?>
                                            <td><?php  ($count++) ?><?= ($index++) ?></td>
                                            <td><?= $p['unit_kerja']['nama'] ?></td>
                                            <td><?= $p['nama_jabatan'] . ' ' . $p['jabatan']['nama'] ?></td>
                                            <td><?= $p['nama'] ?></td>
                                        <?php 
                                    }
                                    else { ?>
                                                <td><?php  ($count++) ?><?= ($index++) ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                        <?php 
                                    } ?>
                                        <?php if ($t['id_rancangan_tugas'] != 0) { ?>
                                            <td><?= $t['nama_tugas'] ?></td>
                                            <td></td>
                                        <?php 
                                    }
                                    else { ?>
                                            <td></td>
                                            <td><?= $t['nama_tugas'] ?></td>
                                        <?php 
                                    } ?>
                                        <?php if ($t['periode'] == 1) { ?>
                                            <td>V</td>
                                            <td></td>
                                            <td></td>
                                        <?php 
                                    }
                                    else if ($t['periode'] == 3) { ?>
                                            <td></td>
                                            <td>V</td>
                                            <td></td>
                                        <?php 
                                    }
                                    else { ?>
                                            <td></td>
                                            <td></td>
                                            <td>V</td>
                                        <?php 
                                    } ?>
                                        <td><?= $t['jumlah_tugas'] ?></td>
                                        <td><?= $t['jumlah_total_tugas'] ?></td>
                                    </tr>
                                        <?php endforeach;
                                    } ?>
                                    <?php endforeach ?>
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