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
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan_Evaluasi.xls");
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <h1>Laporan Evaluasi dan Monitoring Pegawai</h1>
                <h4>Nama : <?= $user['nama']?></h4>
                <h4>NIP : <?= $user['no_induk']?></h4>
                <h4>Jabatan : <?= $jabatan['nama_status_user'].' '.$jabatan['nama']?></h4>
                    <table class=" text-center table table-striped table-bordered" id="table-2">
                    <thead>
                    <tr>
                        <th class="align-middle" rowspan="2">No</th>
                        <th class="align-middle" rowspan="2">Unit</th>
                        <th class="align-middle" rowspan="2">Jabatan</th>
                        <th class="align-middle" rowspan="2">Nama</th>
                        <th class="align-middle" colspan="2">Deskripsi Tugas</th>
                        <th class="align-middle" colspan="3">Periode</th>
                        <th class="align-middle" rowspan="2">Jumlah Tugas Dilakukan</th>
                        <th class="align-middle" rowspan="2">Jumlah Target Dilakukan</th>
                    </tr>
                    <tr>
                        <th class="align-middle">Utama</th>
                        <th class="align-middle">Mingguan</th>
                        <th class="align-middle">Tambahan</th>
                        <th class="align-middle">Harian</th>
                        <th class="align-middle">Periodik</th>
                    </tr>

                </thead>
                <tbody>
                <?php $index = 1; foreach($rancangan_tugas as $rt) :?>
                <tr>
                    <?php if($index == 1) {?>
                        <td><?= ($index++)?></td>
                        <td><?= $unit_kerja['nama']?></td>
                        <td><?= $user['nama_jabatan'].' '.$user['jabatan']['nama']?></td>
                        <td><?= $user['nama']?></td>
                    <?php }else{?>
                            <td><?= ($index++)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    <?php }?>
                        <td><?= $rt['nama_tugas']?></td>
                        <td></td>
                    <?php if($rt['periode'] == 1) {?>
                        <td>V</td>
                        <td></td>
                        <td></td>
                    <?php }else if($rt['periode'] == 3){?>
                        <td></td>
                        <td>V</td>
                        <td></td>
                    <?php }else{?>
                        <td></td>
                        <td></td>
                        <td>V</td>
                    <?php }?>
                        <td><?= $rt['jumlah_tugas']?></td>
                        <td><?= $rt['jumlah_total_tugas']?></td>
                </tr>
                <?php endforeach?>
                <?php foreach($tugas_tambahan as $tt) :?>
                <tr>
                    <td><?= ($index++)?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= $tt['nama_tugas']?></td>
                    <?php if($tt['periode'] == 1) {?>
                        <td>V</td>
                        <td></td>
                        <td></td>
                    <?php }else if($tt['periode'] == 3){?>
                        <td></td>
                        <td>V</td>
                        <td></td>
                    <?php }else{?>
                        <td></td>
                        <td></td>
                        <td>V</td>
                    <?php }?>
                    <td><?= $tt['jumlah_tugas']?></td>
                    <td>0</td>
                </tr>
                <?php endforeach?>
            </tbody>
                </table>
                <br><br><br>
                <div class="row mt-3">
                <div class="col-4">
                    Menyetujui,<br><?= $atasan['nama_status_user'].' '.$atasan['nama_jabatan']?><br><br><br>
                    <p style="margin-top:100px;"><u><?= $atasan['nama_user']?></u><br>NIK. <?= $atasan['no_induk']?></p>
                </div>
                <div class="col-4">
			
		        </div>
                <div class="col-4">
                    Malang, <?php 
                        $bulan = array (1 =>   'Januari',
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
                    echo $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                    ?> <br>
                    <?= $jabatan['nama_status_user'].' '.$jabatan['nama']?>,<br><br><br>
                    <p style="margin-top:100px;"><u><?= session('nama')?></u><br>NIK. <?= session('no_induk')?></p>
                </div>
	            </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>