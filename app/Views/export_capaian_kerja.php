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
    header("Content-Disposition: attachment; filename=Laporan_capaian_kerja.xls");
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <h1>Laporan Capaian Kerja Pegawai</h1>
                <h4>Nama : <?= $user['nama']?></h4>
                <h4>NIP : <?= $user['no_induk']?></h4>
                <h4>Capaian Kerja Tahun <?= date('Y')?></h4>
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
                <?php $i = 1; foreach($tugas as $t) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $t['nama_tugas']?></td>
                        <?php if($t['id_rancangan_tugas'] != 0) { ?>
                            <td>Utama</td>
                        <?php } else {?>
                            <td>Tambahan</td>
                        <?php }?>
                        <td><?= $t['jumlah_tugas']?></td>
                        <td><?= $t['jumlah_total_tugas']?></td>
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