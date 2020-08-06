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
    header("Content-Disposition: attachment; filename=Laporan_keaktifan.xls");
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <h1>Laporan Keaktifan Pegawai</h1>
                <h4>Nama : <?= $user['nama']?></h4>
                <h4>NIP : <?= $user['no_induk']?></h4>
                <h4>Keaktifan Tahun <?= date('Y')?></h4>
                <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th class="align-middle text-center" colspan="<?= $batas_tanggal['jumlah_tanggal']?>">Tanggal</th>
                    <th class="align-middle text-center" rowspan="2">Jumlah Kehadiran</th>
                </tr>
                <tr>
                    <?php for($i = 1; $i <= intval($batas_tanggal['jumlah_tanggal']); $i++) {
                        echo '<th>'.$i.'</th>';
                    }?>
                </tr>

            </thead>
            <tbody>
                <?php $index = 1; $counter = 0;?>
                <tr>
                <?php for($i = 1; $i <= intval($batas_tanggal['jumlah_tanggal']); $i++) {
                        $tanggal = ($i < 10) ? '0'.$i : $i; 
                        $status = false;
                        for ($j=0; $j < count($presensi); $j++) { 
                            // echo "2020-07-".$tanggal.' &&& '.$presensi[$j]['tanggal_presensi'];die;
                            if($presensi[$j]['tanggal_presensi'] == "2020-07-".$tanggal){
                                echo '<td><i class="fa fa-check text-success" aria-hidden="true"></i>
                                </td>';
                                $status = true;
                                $counter++;
                                break;
                            }
                        }
                        if($status == false){
                            echo '<td><i class="fa fa-times text-danger" aria-hidden="true"></i>
                            </td>';
                        }
                }?>
                <td><?= $counter?></td>
                </tr>
            </tbody>
                </table>
                    <h4>Malang, <?= date('d M Y')?></h4>
                </section>
            </div>
        </div>
    </div>
</body>

</html>