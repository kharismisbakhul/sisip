<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
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
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> <?= $pesan ?>
            </div>
            <div class="card">
                <?php if ($pertanyaan != null) : ?>
                    <form action="/staff/saveIndeksKepuasan" method="post">
                        <?php $i = 1; ?>
                        <input type="hidden" name="no_induk" value="<?= $user['no_induk'] ?>">
                        <input type="hidden" name="id_indeks" value="<?= $pertanyaan[0]['id_indeks'] ?>">
                        <?php foreach ($pertanyaan as $p) : ?>
                            <div class="card-body">
                                <p class="card-title"><?= $i++ . '. ' . $p['pertanyaan'] ?>
                                </p>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="q<?= $i ?>1" name="q<?= $p['id_pertanyaan'] ?>" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="q<?= $i ?>1">Kurang</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="q<?= $i ?>2" name="q<?= $p['id_pertanyaan'] ?>" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="q<?= $i ?>2">Cukup</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="q<?= $i ?>3" name="q<?= $p['id_pertanyaan'] ?>" class="custom-control-input" value="3">
                                    <label class="custom-control-label" for="q<?= $i ?>3">Baik</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="q<?= $i ?>4" name="q<?= $p['id_pertanyaan'] ?>" class="custom-control-input" value="4">
                                    <label class="custom-control-label" for="q<?= $i ?>4">Sangat Baik</label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Simpan Jawaban</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<?= $this->endSection() ?>