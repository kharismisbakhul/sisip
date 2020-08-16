<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Laporan Capaian Kerja Siboksi</title>
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
    header("Content-Disposition: attachment; filename=Laporan_Capaian_Kerja.xls");
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <h1>Laporan Capaian Kerja Pegawai</h1>
                <h4>Nama : <?= $user['nama']?></h4>
                <h4>NIP : <?= $user['no_induk']?></h4>
                <h4>Capaian Kerja Tahun <?= $tahun ?></h4>
                <!-- Tugas Utama -->
                <table class=" text-center table table-striped table-bordered" id="table-2">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tugas</th>
                        <th>Jenis Tugas</th>
                        <th>Total Dicapai</th>
                        <th>Total Target</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; foreach($rancangan_tugas as $rt) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $rt['nama_tugas']?></td>
                    <td>Utama</td>
                    <td><?= $rt['jumlah_tugas']?></td>
                    <td><?= $rt['jumlah_total_tugas']?></td>
                </tr>
                <?php endforeach?>
                </tbody>
                </table>
                <br><br>
                <!-- Tugas Tambahan -->
                <table class=" text-center table table-striped table-bordered" id="table-2">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tugas</th>
                        <th>Jenis Tugas</th>
                        <th>Total Dicapai</th>
                        <th>Tanggal Tugas</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; $count_tugas = 0; foreach($tugas_tambahan as $t) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $t['nama_tugas']?></td>
                    <td>Tambahan</td>
                    <td><?= $t['jumlah_tugas']?></td>
                    <td><?= $t['tanggal_tugas']?></td>
                </tr>
                <?php $count_tugas+=intval($t['jumlah_tugas']); endforeach;?>
                <tr>
                    <td colspan="3">Total Tugas</td>
                    <td colspan="2"><?= $count_tugas;?></td>
                </tr>
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