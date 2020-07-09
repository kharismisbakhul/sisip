<?php $this->extend('template'); ?>
<?php $this->section('content'); ?>
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
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">

        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Daftar Pertanyaan </h4><span><i class="fas fa-fw fa-calendar-alt"></i>
                        <?= $indeks['tanggal'] ?></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover ">
                            <thead>
                                <tr>

                                    <th style="width: 70%;">Tambah Pertanyaan</th>
                                    <th style="width: 25%;">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <form action="<?= base_url('/admin/tambahIndeksPertanyaan')?>" method="post">
                                        <td>
                                            <input type="hidden" name="id_indeks" value="<?= $indeks['id'] ?>">
                                            <textarea style="width: 850px;" type="text" name="pertanyaan" class="form-control"></textarea>
                                        </td>
                                        <td>
                                            <div class="button-group">
                                                <button type="submit" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i>Tambah</button>

                                            </div>
                                        </td>
                                    </form>
                                </tr>


                            </tbody>
                        </table>


                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 70%;">Soal</th>
                                    <th style="width: 25%;">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pertanyaan as $p) : ?>
                                    <tr>
                                        <form action="<?= base_url('/admin/editIndeksPertanyaan/'.$p['id_pertanyaan']) ?>" method="post">
                                            <td><?= $i++; ?></td>
                                            <td>
                                                <input type="hidden" name="id_indeks" value="<?= $p['id_indeks'] ?>">
                                                <textarea style="width: 800px;" name="pertanyaan" type="text" class="form-control"><?= $p['pertanyaan'] ?></textarea>
                                            </td>
                                            <td>
                                                <div class="button-group">
                                                    <button type="submit" class="btn waves-effect waves-light btn-info"><i class="fas fa-edit mr-2"></i>Simpan</button>
                                                    <a href="<?= base_url('/admin/hapusIndeksPertanyaan/'. $p['id_pertanyaan'].'/'. $p['id_indeks']) ?>" class="btn waves-effect waves-light btn-danger"><i class="fas fa-trash mr-2"></i>Hapus</a>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>

</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<?php $this->endSection('content'); ?>