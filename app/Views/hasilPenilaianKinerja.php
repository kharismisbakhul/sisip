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

        <div class="col-sm-12 col-md-6 col-lg-12">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> This is an
                example top alert. You can edit what u wish. Aww yeah, you successfully read this important
                alert message. This example text is going to run a bit longer so that you can see how
                spacing within an alert works with this kind of content.
            </div>
            <div class="card">


                <div class="card-body">
                    <h4 class="card-title">Daftar Penilaian Kinerja</h4>
                    <h6 class="card-subtitle">Nama: <?= $penilaian['nama_pk'] ?> | Tanggal <?= $penilaian['tanggal_pk'] ?></h6>
                    <div class="table-responsive">
                        <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                            <thead>
                                <tr>
                                    <th data-sort-initial="true" data-toggle="true">No</th>
                                    <th>Nama</th>
                                    <th>Nomer Induk</th>
                                    <th>Pekerjaan</th>
                                    <th>Status</th>
                                    <th>Rata-Rata Nilai</th>
                                    <?php $i = 1;; ?>
                                    <?php foreach ($pertanyaan as $p) : ?>
                                        <th data-hide="phone, tablet"><span class="font-bold"><?= ($i++) . '. ' . $p['pertanyaan_pk'] ?></span></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <div class="m-t-10">
                                <div class="d-flex">
                                    <div class="ml-auto">
                                        <div class="form-group">
                                            <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <tbody>
                                <?php $j = 1; ?>
                                <?php foreach ($penilaian_kinerja as $pk) : ?>
                                    <tr>
                                        <td><?= $j++ ?></td>
                                        <td><?= $pk['nama'] ?></td>
                                        <td><?= $pk['no_induk'] ?></td>
                                        <td><?= ($pk['pekerjaan']) ? $pk['pekerjaan']['nama'] : 'Tidak ada pekerjaan' ?></td>
                                        <td><?= $pk['status'] ?> </td>

                                        <?php if ($pk['nilai']) : ?>
                                            <?php $temp = 0; ?>
                                            <?php foreach ($pk['nilai'] as $pkn) : ?>
                                                <?php $temp += $pkn['nilai'];

                                                ?>
                                            <?php endforeach; ?>
                                            <?php $rata2 = $temp / count($pk['nilai']); ?>
                                            <td><?= $rata2 ?></td>
                                        <?php else : ?>
                                            <td>0</td>
                                        <?php endif; ?>



                                        <?php if ($pk['nilai']) : ?>
                                            <?php foreach ($pk['nilai'] as $pkn) : ?>
                                                <?php foreach ($pertanyaan as $p) : ?>
                                                    <?php if ($p['id_pertanyaan_pk'] == $pkn['id_pertanyaan_pk']) : ?>
                                                        <td><b>Nilai : </b><?= $pkn['nilai'] ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <?php foreach ($pertanyaan as $p) : ?>
                                                <td><b>Nilai :</b>0</td>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <?php $jumlah = 6 + count($pertanyaan) ?>
                                    <td colspan="<?= $jumlah ?>">
                                        <div class="text-right">
                                            <ul class="pagination">
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <button class="btn btn-info">Cetak Hasil</button>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->


<?= $this->endSection('content') ?>