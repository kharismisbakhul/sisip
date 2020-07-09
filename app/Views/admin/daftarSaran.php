<?= $this->extend('template') ?>


<?= $this->section('content') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Daftar Saran</h4>
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
                    <h4>Daftar Saran</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">

                            <table class="table table-hover" id="zero_config">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 10%">Foto Profil</th>
                                        <th style="width: 15%;">Nama</th>
                                        <th style="width: 15%;">No Induk</th>
                                        <th style="width: 10%">Kategori Feedback</th>
                                        <th style="width: 10%">Feedback</th>
                                        <th style="width: 20%;">File Pendukung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($saran as $s) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td> <img src="<?= ($s['foto_profil']) ? base_url($s['foto_profil']) : base_url('assets/images/users/default.jpg') ?>" alt="users" class="rounded-circle img-fluid" width="50" /></td>
                                            <td><?= $s['nama'] ?></td>
                                            <td><?= $s['no_induk'] ?></td>
                                            <td><?= $s['nama_kategori'] ?></td>
                                            <td><?= $s['feedback'] ?></td>
                                            <td>
                                                <?php if ($s['file_pendukung']) : ?>
                                                    <a target="_blank" href="<?= base_url('/assets/images/file_pendukung/'.$s['file_pendukung']) ?>"> <i class="fas fa-file"></i> File Pendukung</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->


<?= $this->endSection('content') ?>