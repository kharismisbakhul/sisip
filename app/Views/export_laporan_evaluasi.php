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
                    <table class=" text-center table table-striped table-bordered" id="table-2">
                    <thead>
                    <tr>
                        <th class="align-middle" rowspan="2">No</th>
                        <th class="align-middle" rowspan="2">Unit</th>
                        <th class="align-middle" rowspan="2">Jabatan</th>
                        <th class="align-middle" rowspan="2">Nama</th>
                        <th class="align-middle" colspan="2">Deskripsi Tugas</th>
                        <th class="align-middle" colspan="2">Periode</th>
                    </tr>
                    <tr>
                        <th class="align-middle">Utama</th>
                        <th class="align-middle">Tambahan</th>
                        <th class="align-middle">Harian</th>
                        <th class="align-middle">Periodik</th>
                    </tr>

                </thead>
                <tbody>
                <?php $index = 1; foreach($tugas as $t) :?>
                <tr>
                    <?php if($index == 1) {?>
                        <td><?= ($index++)?></td>
                        <td>Guest House</td>
                        <td><?= $user['nama_jabatan'].' '.$user['jabatan']['nama']?></td>
                        <td><?= $user['nama']?></td>
                    <?php }else{?>
                            <td><?= ($index++)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    <?php }?>
                        <td><?= $t['nama_tugas']?></td>
                    <td></td>
                    <?php if($t['periode'] == 1) {?>
                        <td>V</td>
                        <td></td>
                    <?php }else{?>
                        <td></td>
                        <td>V</td>
                    <?php }?>
                </tr>
                <?php endforeach?>
                </tbody>
                </table>
                    <h4>Malang, <?= date('d M Y')?></h4>
                </section>
            </div>
        </div>
    </div>
</body>

</html>