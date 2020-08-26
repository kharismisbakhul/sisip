<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Laporan Capaian Kerja SiSip</title>
    <!-- General CSS Files -->
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <?php
    if (session('id_status_user') == 1) {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_rekap_presensi_admin.xls");
    }
    else {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_rekap_presensi_atasan.xls");
    }
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <h3>Laporan Presensi Tanggal <?= $tanggal_mulai.' - '.$tanggal_selesai?></h3>
                <h5>Nama : <?= $pegawai['nama']?></h5>
                <h5>Jabatan : <?= $pegawai['jabatan']['nama_status_user'].' '.$pegawai['jabatan']['nama']?></h5>
                <h5>Unit : <?= $pegawai['unit_kerja']['nama']?></h5>
                
                <table id="zero_config" class="table table-hover table-bordered">
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
                <br><br><br>
                <div class="row mt-3">
                <div class="col-4">
                    
                </div>
                <div class="col-4">
			
		        </div>
                <div class="col-4">
                    Malang, <?php 
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
                            $split = explode('-', date('Y-m-d'));
                            echo $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
                            ?><br><br><br>
                    <p style="margin-top:100px;"><u><?= session('nama') ?></u><br>NIK. <?= session('no_induk') ?></p>
                </div>
	            </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>