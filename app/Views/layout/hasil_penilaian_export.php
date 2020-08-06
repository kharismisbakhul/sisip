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
    header("Content-Disposition: attachment; filename=penilaian-kinerja.xls");
    ?>
    <table class="table table-bordered table-hover toggle-circle" data-page-size="7">
        <thead class=" text-center">
            <tr>
                <th class="align-middle" rowspan="3" data-sort-initial="true" data-toggle="true">NO</th>
                <th class="align-middle" rowspan="3">ASPEK PENILAIAN</th>
                <th class="align-middle" rowspan="3">INDIKATOR</th>
                <!--jumlah anggota yang diberi nilai -->
                <th colspan="<?= count($penilaian_kinerja) ?>">PENILAIAN</th>
                <th class="align-middle" rowspan="3">20%</th>
                <th class="align-middle" rowspan="3">80%</th>
                <th class="align-middle" rowspan="3">TOTAL PENILAIAN</th>
            </tr>
            <tr>
                <?php foreach ($status as $s) : ?>
                    <th class="align-middle" colspan="<?= $s['jumlah'] ?>"><?= $s['nama'] ?></th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($status as $s) : ?>
                    <?php foreach ($penilaian_kinerja as $pk) : ?>
                        <?php if ($s['nama'] == $pk['status']) : ?>
                            <th class="align-middle"><?= $pk['nama'] ?></th>
                        <?php endif; ?>

                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>

            <?php $indek = 1;
            foreach ($pertanyaan as $p) : ?>
                <tr>
                    <td><?= $indek++; ?></td>
                    <td><?= $p['aspek_pk'] ?></td>
                    <td><?= $p['pertanyaan_pk'] ?></td>

                    <?php foreach ($penilaian_kinerja as $pk) : ?>
                        <?php if ($pk['nilai']) : ?>

                            <?php foreach ($pk['nilai'] as $t) : ?>
                                <?php if ($t['id_pertanyaan_pk'] == $p['id_pertanyaan_pk']) : ?>
                                    <td><?= $t['nilai'] ?></td>

                                <?php endif; ?>
                            <?php endforeach; ?>

                        <?php else : ?>
                            <td>0</td>

                        <?php endif; ?>

                    <?php endforeach; ?>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Jumlah</th>

                <?php foreach ($penilaian_kinerja as $pk) : ?>
                    <?php $sum = 0; ?>
                    <?php if ($pk['nilai']) : ?>
                        <?php foreach ($pk['nilai'] as $t) : ?>
                            <?php $sum += $t['nilai'] ?>
                        <?php endforeach; ?>
                        <td><?= $sum; ?></td>
                    <?php else : ?>
                        <td>0</td>
                    <?php endif; ?>
                <?php endforeach; ?>

                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <th colspan="3">Rata-rata</th>
                <?php foreach ($penilaian_kinerja as $pk) : ?>
                    <?php $sum = 0; ?>
                    <?php if ($pk['nilai']) : ?>
                        <?php foreach ($pk['nilai'] as $t) : ?>
                            <?php $sum += $t['nilai'] ?>
                        <?php endforeach; ?>
                        <td><?= $sum / count($pk['nilai']); ?></td>
                    <?php else : ?>
                        <td>0</td>
                    <?php endif; ?>
                <?php endforeach; ?>
                <td>0</td>
                <td>0</td>
                <td>0</td>

            </tr>
            <tr>
                <th colspan="3">Nilai Akhir</th>
                <?php foreach ($penilaian_kinerja as $pk) : ?>
                    <?php $sum = 0; ?>
                    <?php if ($pk['nilai']) : ?>
                        <?php foreach ($pk['nilai'] as $t) : ?>
                            <?php $sum += $t['nilai'] ?>
                        <?php endforeach; ?>
                        <td><?= ($sum / count($pk['nilai'])); ?>%</td>
                    <?php else : ?>
                        <td>0</td>
                    <?php endif; ?>
                <?php endforeach; ?>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>