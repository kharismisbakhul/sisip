<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h4 class="page-title">Penilaian Kinerja Pegawai ( <?= $staff['nama'] ?> - <?= $staff['no_induk'] ?>)</h4>
            <div class="row">
                <div class="col-12">
                    <?php if (session('id_status_user') == 6) { ?>
                        <a href="<?= base_url('/supervisor/capaianKerja') ?>" class="float-left mt-2 btn btn-secondary">Kembali</a>
                    <?php } else if (session('id_status_user') == 5) { ?>
                        <a href="<?= base_url('/manager/capaianKerja') ?>" class="float-left mt-2 btn btn-secondary">Kembali</a>
                    <?php } else if (session('id_status_user') == 4) { ?>
                        <a href="<?= base_url('/gm/capaianKerja') ?>" class="float-left mt-2 btn btn-secondary">Kembali</a>
                    <?php } else if (session('id_status_user') == 3) { ?>
                        <a href="<?= base_url('/direktur/capaianKerja') ?>" class="float-left mt-2 btn btn-secondary">Kembali</a>
                    <?php } ?>
                </div>
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
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> <?= $info ?>
            </div>
            <div class="card">
                <?php if ($pertanyaan != null) : ?>
                    <form action="<?= base_url('/supervisor/savePertanyaanPenilaian/' . $staff['no_induk']) ?>" method="post">
                        <?php $i = 1; ?>
                        <?php foreach ($pertanyaan as $p) : ?>
                            <div class="card-body">
                                <p class="card-title"><?= $i++ . '. ' . $p['pertanyaan_pk'] ?>
                                </p>
                                <div class="form-group">
                                    <input type="number" name="nilai<?= $p['id_pertanyaan_pk'];  ?>" class="form-control" id="message-text1" placeholder="masukan range nilai 0 hingga 100" value="">
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="card-body">
                            <button type="submit" onclick="return confirm('Apakah anda sudah yakin ?')" class="btn btn-success">Simpan Jawaban</button>
                        </div>
                    </form>

                <?php else : ?>
                    <?php $i = 1; ?>
                    <?php if ($hasil != null) : ?>
                        <?php foreach ($hasil as $p) : ?>
                            <div class="card-body">
                                <p class="card-title"><?= $i++ . '. ' . $p['pertanyaan_pk'] ?>
                                </p>
                                <div class="form-group">
                                    <input type="text" name="nilai<?= $p['id_pertanyaan_pk'];  ?>" class="form-control" id="message-text1" placeholder="masukan range nilai 0 hingga 100" readonly value="<?= $p['nilai'] ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<?= $this->endSection() ?>