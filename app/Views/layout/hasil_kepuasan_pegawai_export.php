<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Hasil Penilaian Kinerja</title>
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
    header("Content-Disposition: attachment; filename=kepuasan-pegawai.xls");
    ?>
    <h4>Hasil Indeks Kepuasan Pegawai tanggal <strong><?= $tgl_ikp?></strong></h4>
    <table class="table table-bordered table-hover toggle-circle" data-page-size="7">
        <thead class=" text-center">
            <tr>
                <th class="align-middle" rowspan="2" data-sort-initial="true" data-toggle="true">NO</th>
                <th class="align-middle" rowspan="2">Pertanyaan</th>
                <th class="align-middle" rowspan="1" colspan="4">Indikator Kepuasan</th>
            </tr>
            <tr>
                <th class="align-middle">Sangat Baik</th>
                <th class="align-middle">Baik</th>
                <th class="align-middle">Cukup</th>
                <th class="align-middle">Kurang</th>
            </tr>
        </thead>

        <tbody>

            <?php $indek = 1;
            foreach ($pertanyaan as $p) : ?>
                <tr>
                    <td><?= $indek++; ?></td>
                    <td><?= $p['pertanyaan'] ?></td>
                    <td><?= $nilai[$p['id_pertanyaan']]['sangat_baik'] ?></td>
                    <td><?= $nilai[$p['id_pertanyaan']]['baik'] ?></td>
                    <td><?= $nilai[$p['id_pertanyaan']]['cukup'] ?></td>
                    <td><?= $nilai[$p['id_pertanyaan']]['kurang'] ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</body>

</html>