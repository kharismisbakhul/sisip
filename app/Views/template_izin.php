<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= "Template izin - ".session('nama')?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style type="text/css" media="print">
		/* @page {size:landscape}  */

		.main-content {
			position: relative;
			top: 20px;
		}

		body {
			font-family: sans-serif;
		}
	</style>
</head>

<body>
	<div class="kop-surat mt-2 pb-2" style="border-bottom: 3px solid black;">
		<div class="row">
			<div class="col-2">
				<div id="logo-ub"><img src="https://kadowisudaku.com/wp-content/uploads/2016/11/Logo-Universitas-Brawijaya-UB.jpg" alt="logo ub" style="width: 150px;"></div>
			</div>
			<div class="col-10 text-center" style="padding-right: 10rem">
				<span class="h4 font-weight-normal">KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</span> <br>
				<span class="h4 font-weight-normal">UNIVERSITAS BRAWIJAYA</span> <br>
				<span class="h4 font-weight-bold">BADAN USAHA NON AKADEMIK</span> <br>
				<!-- yang ini nanti disesuaikan dengan fakultas ekonomi nya -->
				<span class="p" style="font-size: 14px;">
                    Gedung Layanan Bersama Lt.1. Jl. MT. Haryono 169 Malang 65145. Indonesia
					<br> Telp. +62341 575777, 551611 ext. 161 ; Fax +62341 565420
				</span>
			</div>
		</div>
	</div>
	<div class="judul text-center mt-3">
		<h5>FORMULIR IZIN TIDAK MASUK KERJA / TERLAMBAT / PULANG LEBIH AWAL</h5>
	</div>
	<div class="row mt-3">
		<div class="col-12">
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-8">Yang bertandatangan di bawah ini:</label>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2">Nama</label>
					<div class="col-sm-10">: <?= session('nama')?></div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2">NIP/NIK</label>
					<div class="col-sm-10">: <?= session('no_induk')?></div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2">Jabatan</label>
					<div class="col-sm-10">: <?= $jabatan['nama_status_user'].' '.$jabatan['nama']?></div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2">Unit Kerja</label>
					<div class="col-sm-10">: <?= $unit_kerja['nama']?></div>
				</div>
				<div class="form-group row col-sm-12">Menyatakan bahwa pada hari <?= $hari_mulai.' s/d '. $hari_selesai?> tanggal <?= date('d-m-Y', strtotime($izin['tanggal_mulai']))." s/d ".date('d-m-Y', strtotime($izin['tanggal_selesai']))?>
				</div>
				<div class="row col-sm-12">
					<input type="checkbox" name="" id="" value="Tidak masuk kerja" checked><label>Tidak masuk kerja</label><br>
				</div>
				<div class="row col-sm-12">
					<input type="checkbox" name="" id="" value="Datang terlambat"><label>Datang terlambat</label><br>
				</div>
				<div class="row col-sm-12">
					<input type="checkbox" name="" id="" value="Pulang kerja lebih awal"><label>Pulang kerja lebih awal</label><br>
				</div>
				<div class="row col-sm-12">
					<input type="checkbox" name="" id="" value="______________________"><label>______________________</label>
				</div>
				<div class="row col-sm-12">
					<p>Dikarenakan</p>
				</div>
				<div class="row col-sm-12">
					<u><p><?= $izin['kategori'] .' - '.$izin['alasan']?></p></u>
				</div>
				<div class="row col-sm-12">
					<p>Demikian pernyataan saya dan saya bertanggungjawab atas kebenarannya</p>
				</div>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-4">
            Menyetujui,<br><?= $atasan['nama_status_user'].' '.$atasan['nama_jabatan']?><br>
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
			<?= $jabatan['nama_status_user'].' '.$jabatan['nama']?>,<br>
			<p style="margin-top:100px;"><u><?= session('nama')?></u><br>NIK. <?= session('no_induk')?></p>
		</div>
	</div>
	<script>
		window.print()
	</script>
</body>

</html>