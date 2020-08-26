<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Hasil Penilaian Kinerja</h4>
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

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Informasi</h3> Berikut adalah informasi dari hasil penilaian kinerja
            </div>
            <div class="card">


                <div class="card-body">
                    <h4 class="card-title">Daftar Penilaian Kinerja</h4>
                    <h6 class="card-subtitle">Nama: <?= $penilaian['nama_pk'] ?> | Tanggal <?= $penilaian['tanggal_pk'] ?></h6>
                    <div class="table-responsive">
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
                    </div>
                </div>

                <div class="card-body">
                    <a class="btn btn-success" href="<?= base_url('AdminController/exportPenilaianKinerja/' . $penilaian['id_pk']) ?>">Export to Excel</a>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->


<?= $this->endSection('content') ?>