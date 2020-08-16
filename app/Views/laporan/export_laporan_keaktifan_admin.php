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
    header("Content-Disposition: attachment; filename=Laporan_keaktifan_admin.xls");
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <h1>Laporan Keaktifan Pegawai</h1>
                <h4>Keaktifan <?= 'Bulan '.$bln.' Tahun '.$tahun?></h4>
                <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th class="align-middle text-center" rowspan="2">Nama Pegawai</th>
                    <th class="align-middle text-center" rowspan="2">Jabatan</th>
                    <th class="align-middle text-center" rowspan="2">Unit Kerja</th>
                    <th class="align-middle text-center" colspan="<?= $jumlah_tanggal?>">Tanggal</th>
                    <th class="align-middle text-center" rowspan="2">Jumlah Kehadiran</th>
                    <th class="align-middle text-center" rowspan="2">Jumlah Izin</th>
                </tr>
                <tr>
                    <?php for($i = 1; $i <= intval($jumlah_tanggal); $i++) {
                        echo '<th>'.$i.'</th>';
                    }?>
                </tr>

                </thead>
                <tbody>
                <?php $index = 1; ?>
                <tr>
                <?php 
                for ($p=0; $p < count($pegawai); $p++) { 
                    $counter = 0;
                    $counter_izin = 0;
                    echo '<tr>
                    <td>'.$pegawai[$p]['nama'].'</td>
                    <td>'.$pegawai[$p]['nama_jabatan'].' '.$pegawai[$p]['jabatan']['nama'].'</td>
                    <td>'.$pegawai[$p]['unit_kerja']['nama'].'</td>';
                    for($i = 1; $i <= intval($jumlah_tanggal); $i++) {
                        $tanggal = ($i < 10) ? '0'.$i : $i; 
                        $status = false;
                        for ($j=0; $j < count($pegawai[$p]['presensi']); $j++) { 
                            if($pegawai[$p]['presensi'][$j]['tanggal_presensi'] == $t.'-'.$bb.'-'.$tanggal){
                                if($pegawai[$p]['presensi'][$j]['status_presensi'] != 0){
                                    echo '<td><i class="fa fa-circle text-warning" aria-hidden="true">O</i>
                                    </td>';
                                    $status = true;
                                    $counter_izin++;
                                    break;
                                }else{
                                    echo '<td><i class="fa fa-check text-success" aria-hidden="true">V</i>
                                    </td>';
                                    $status = true;
                                    $counter++;
                                    break;
                                }
                            }
                        }
                        if($status == false){
                            if(in_array(($t.'-'.$bb.'-'.$tanggal),$weekend)){
                                echo '<td><i class="fa fa-minus text-info" aria-hidden="true">-</i>
                                </td>';
                            }else{
                                echo '<td><i class="fa fa-times text-danger" aria-hidden="true">X</i>
                                </td>';
                            }
                        }
                    };
                    echo '<td>'.$counter.'</td>';
                    echo '<td>'.$counter_izin.'</td>';
                    echo '</tr>';
                }?>
                
                </tbody>
                </table>
                <br><br><br>
                <table>
                    <thead>
                    <tr>
                    <td colspan="2">Keterangan</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                     <td>V</td>
                     <td>Masuk</td>
                    </tr>
                    <tr>
                     <td>X</td>
                     <td>Tidak Masuk</td>
                    </tr>
                    <tr>
                     <td>O</td>
                     <td>Izin</td>
                    </tr>
                    <tr>
                     <td>-</td>
                     <td>Weekend</td>
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
                    ?><br><br><br>
                    <p style="margin-top:100px;"><u><?= session('nama')?></u><br>NIK. <?= session('no_induk')?></p>
                </div>
	            </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>