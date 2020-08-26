<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Laporan Rekapitulasi Presensi</h4>
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
                            <h4>Laporan Rekapitulasi Presensi</h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                <div class="d-flex col-lg-8 mb-2">
                                        <div class="input-group">
                                            <div class="form-group">
                                                <h3>Laporan Presensi Tanggal <?= $tanggal_mulai.' - '.$tanggal_selesai?></h3>
                                                <h5>Nama : <?= $pegawai['nama']?></h5>
                                                <h5>Jabatan : <?= $pegawai['jabatan']['nama_status_user'].' '.$pegawai['jabatan']['nama']?></h5>
                                                <h5>Unit : <?= $pegawai['unit_kerja']['nama']?></h5>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                        <form action="<?= base_url('AdminController/exportLaporanRekapAdmin') ?>" method="post">
                                            <input type="hidden" class="form-control" name="pegawai" value="<?= $input['pegawai']?>">
                                            <input type="hidden" class="form-control" name="waktu_mulai" value="<?= $input['waktu_mulai']?>">
                                            <input type="hidden" class="form-control" name="waktu_selesai" value="<?= $input['waktu_selesai']?>">
                                            <button target="submit" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                        </form>
                                </div>
                                </div>
                                <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center">No</th>
                                    <th class="align-middle text-center">Tanggal Presensi</th>
                                    <th class="align-middle text-center">Status Kerja</th>
                                    <th class="align-middle text-center">Jam Masuk</th>
                                    <th class="align-middle text-center">Lokasi Masuk</th>
                                    <th class="align-middle text-center">Jam Pulang</th>
                                    <th class="align-middle text-center">Lokasi Pulang</th>
                                    <th class="align-middle text-center">Keterlambatan</th>
                                </tr>
    
                            </thead>
                            <tbody>
                                <?php 
                                $bulan = array(
                                    1 => 'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember'
                                );

                                $index = 1; $counter = 0; $counter_izin = 0; $keterlambatan = 0;
                                        $tanggal = $tgl_mulai;
                                        $tgl_selesai_temp = date('Y-m-d', strtotime('+1 days '.$tgl_selesai));
                                        while($tanggal != $tgl_selesai_temp){
                                            $split = explode('-', $tanggal);
                                            for ($i=0; $i < count($presensi); $i++) { 
                                                if($presensi[$i]['tanggal_presensi'] == $tanggal){
                                                    if($presensi[$i]['status_presensi'] != 0){
                                                        echo 
                                                        '<tr>
                                                            <td>'.($index++).'</td>
                                                            <td>'.$split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0].'</td>
                                                            <td>'.'Izin'.'</td>
                                                            <td>'.'-'.'</td>
                                                            <td>'.'-'.'</td>
                                                            <td>'.'-'.'</td>
                                                            <td>'.'-'.'</td>
                                                            <td>'.'0'.'</td>
                                                        </tr>';
                                                        $counter_izin++;
                                                        break;
                                                    }else{
                                                        $status_kerja = '';
                                                        if($presensi[$i]['status_tempat_kerja'] == 1){
                                                            $status_kerja = 'WFH';
                                                        }else if($presensi[$i]['status_tempat_kerja'] == 2){
                                                            $status_kerja = 'WFO';
                                                        }else{
                                                            $status_kerja = 'WO';
                                                        }

                                                        $jam_pulang = '';
                                                        $lokasi_pulang = '';
                                                        $terlambat = 0;
                                                        if($presensi[$i]['waktu_presensi_keluar'] == null){
                                                            $jam_pulang = '-';
                                                            $keterlambatan += 120;
                                                        }else{
                                                            $jam_pulang = $presensi[$i]['waktu_presensi_keluar'];
                                                            $date3=date_create($jam_kerja['jam_kerja_keluar']);
                                                            $date4=date_create($presensi[$i]['waktu_presensi_keluar']);
                                                            $diffe=date_diff($date3,$date4);
                                                            $j = intval($diffe->format("%h")*60);
                                                            $m = intval($diffe->format("%i"))+$j;
                                                            if(strtotime($jam_kerja['jam_kerja_keluar']) > strtotime($presensi[$i]['waktu_presensi_keluar'])){
                                                                $terlambat += $m;

                                                            }
                                                        }

                                                        if($presensi[$i]['lokasi_keluar'] == null){
                                                            $lokasi_pulang = '-';
                                                        }else{
                                                            $lokasi_pulang = $presensi[$i]['lokasi_keluar'];
                                                        }

                                                        $date1=date_create($jam_kerja['jam_kerja_masuk']);
                                                        $date2=date_create($presensi[$i]['waktu_presensi_masuk']);
                                                        $diff=date_diff($date1,$date2);
                                                        $jam = intval($diff->format("%h")*60);
                                                        $menit = intval($diff->format("%i"))+$jam;
                                                        $terlambat += $menit;
                                                        $keterlambatan += $terlambat;
                                                        // echo $menit;

                                                        echo 
                                                        '<tr>
                                                            <td>'.($index++).'</td>
                                                            <td>'.$split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0].'</td>
                                                            <td>'.$status_kerja.'</td>
                                                            <td>'.$presensi[$i]['waktu_presensi_masuk'].'</td>
                                                            <td>'.$presensi[$i]['lokasi'].'</td>
                                                            <td>'.$jam_pulang.'</td>
                                                            <td>'.$lokasi_pulang.'</td>
                                                            <td>'.$terlambat.'</td>
                                                        </tr>';
                                                        $counter++;
                                                        break;
                                                    }
                                                }
                                                
                                            }
                                            if($presensi == null && !in_array($tanggal,$weekend)){
                                                echo 
                                                '<tr>
                                                    <td>'.($index++).'</td>
                                                    <td>'.$split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0].'</td>
                                                    <td class="text-danger">'.'Tidak Masuk'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'-'.'</td>
                                                </tr>';
                                                // $keterlambatan += 120;
                                            }
                                            if(in_array($tanggal,$weekend)){
                                                echo 
                                                '<tr>
                                                    <td>'.($index++).'</td>
                                                    <td>'.$split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0].'</td>
                                                    <td class="text-warning">'.'Weekend'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'-'.'</td>
                                                    <td>'.'0'.'</td>
                                                </tr>';
                                            }
                                            $tanggal = date('Y-m-d', strtotime('+1 days '.$tanggal));
                                        }
                                    ?>
                                <tr>
                                    <td colspan="7" class="align-middle text-left">Total Keterlambatan/Pulang Mendahului (Menit)</td>
                                    <td class="align-middle"><?= $keterlambatan?></td>
                                </tr>
                                
                            </tbody>
                                </table>
                                
                                <br><br>
                                <p>* Lupa presensi masuk atau lupa presensi pulang dihitung 120 menit</p>
                                <?php if(session('id_status_user') == 1){?>
                                    <a href="<?= base_url('/admin/rekapitulasiPresensi')?>" class="btn btn-secondary">Kembali</a>
                                <?php }else if(session('id_status_user') == 6){?>
                                    <a href="<?= base_url('/supervisor/rekapitulasiPresensi')?>" class="btn btn-secondary">Kembali</a>
                                <?php }else if(session('id_status_user') == 5){?>
                                    <a href="<?= base_url('/manager/rekapitulasiPresensi')?>" class="btn btn-secondary">Kembali</a>
                                <?php }else if(session('id_status_user') == 4){?>
                                    <a href="<?= base_url('/gm/rekapitulasiPresensi')?>" class="btn btn-secondary">Kembali</a>
                                <?php }else if(session('id_status_user') == 3){?>
                                    <a href="<?= base_url('/direktur/rekapitulasiPresensi')?>" class="btn btn-secondary">Kembali</a>
                                <?php }?>
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