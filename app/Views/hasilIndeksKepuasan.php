<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Indeks Kepuasan Pegawai</h4>
            <div class="d-flex align-items-center">

            </div>
        </div>

    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-md-6 col-lg-12">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Informasi</h3> Halaman ini berisikan dari hasil pengisian Indeks Kepuasan Pegawai tanggal <strong><?= $tgl_ikp?></strong><br>untuk mencetak hasil bisa dengan menekan tombol <strong>Cetak Hasil</strong> dibawah
            </div>
            <div class="card">
                <?php $i = 1; ?>
                <?php foreach ($pertanyaan as $p) : ?>
                    <div class="card-body">
                        <p class="card-title"><?= ($i++) . '. ' . $p['pertanyaan'] ?>
                        </p>
                        Sangat baik : <?= $nilai[$p['id_pertanyaan']]['sangat_baik'] ?> orang
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="<?= 'width:' . ($nilai[$p['id_pertanyaan']]['sangat_baik'] / $jumlah * 100) ?>%">
                            </div>

                        </div>
                        <br>
                        Baik : <?= $nilai[$p['id_pertanyaan']]['baik'] ?> orang
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="<?= 'width:' . ($nilai[$p['id_pertanyaan']]['baik'] / $jumlah * 100) ?>%"></div>
                        </div>
                        <br>
                        Cukup : <?= $nilai[$p['id_pertanyaan']]['cukup'] ?> orang
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="<?= 'width:' . ($nilai[$p['id_pertanyaan']]['cukup'] / $jumlah * 100) ?>%">
                            </div>
                        </div>
                        <br>
                        Kurang : <?= $nilai[$p['id_pertanyaan']]['kurang'] ?> orang
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="<?= 'width:' . ($nilai[$p['id_pertanyaan']]['kurang'] / $jumlah * 100) ?>%"></div>
                        </div>

                    </div>
                <?php endforeach; ?>
                <div class="card-body">
                <a class="btn btn-success" href="<?= base_url('AdminController/exportKepuasanPegawai/' . $ikp['id']) ?>">Export to Excel</a>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->


<?= $this->endSection('content') ?>