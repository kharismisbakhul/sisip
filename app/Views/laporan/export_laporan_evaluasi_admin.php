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
        header("Content-Disposition: attachment; filename=Laporan_evaluasi_admin.xls");
    }
    else {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_evaluasi_atasan.xls");
    }
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <?php
                if ($tanggal_mulai != null) {
                    echo '<h1>Laporan Evaluasi Pegawai ' . $tanggal_mulai . ' s/d ' . $tanggal_selesai . '</h1>';
                }
                else {
                    echo '<h1>Laporan Evaluasi Pegawai</h1>';
                }
                ?>
                
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