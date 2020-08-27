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
        header("Content-Disposition: attachment; filename=Daftar_Saran.xls");
    ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <?php
                if($waktu_mulai != null & $waktu_selesai != null){
                    echo '<h4>Daftar Saran '.date('d-m-Y', strtotime($waktu_mulai)).' s/d '.date('d-m-Y', strtotime($waktu_selesai)).'</h4>';
                }else{
                    echo '<h4>Daftar Saran</h4>';
                }
                ?>
                
                            <table class="table table-hover" id="zero_config">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 15%;">Nama</th>
                                        <th style="width: 15%;">No Induk</th>
                                        <th style="width: 5%;">Tanggal</th>
                                        <th style="width: 5%">Kategori Feedback</th>
                                        <th style="width: 20%">Feedback</th>
                                        <th style="width: 20%;">File Pendukung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($saran as $s) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $s['nama'] ?></td>
                                            <td><?= $s['no_induk'] ?></td>
                                            <td><?= date('d-m-Y', strtotime($s['tanggal'])) ?></td>
                                            <td><?= $s['nama_kategori'] ?></td>
                                            <td><?= $s['feedback'] ?></td>
                                            <td>
                                                <?php if ($s['file_pendukung']) : ?>
                                                    <?= base_url('/assets/images/file_pendukung/'.$s['file_pendukung']) ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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