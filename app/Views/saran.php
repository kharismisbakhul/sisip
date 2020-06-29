<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Saran</h4>
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
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Form Saran Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="<?= base_url('/staff/saran')?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <input type="hidden" name="user" value="<?= $user['no_induk']?>">
                                        <label class="col-md-12">Feedback</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line" name="feedback"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Kategori</label>
                                        <div class="col-md-12">
                                            <select class="custom-select form-control form-control-line"
                                                id="inlineFormCustomSelect" name="kategori_saran">
                                                <option selected="" hidden selected>Pilih Kategori...</option>
                                                <?php foreach($kategori_saran as $ks) : ?>
                                                <option value="<?= $ks['id_kategori']?>"><?= $ks['nama_kategori']?></option>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">File Pendukung</label>
                                        <div class="col-md-12">
                                            <input type="file" name="file_pendukung">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <p>Form saran pegawai adalah layanan yang ditujukan untuk memberikan masukan
                                    untuk kemajuan system dan kita bersama</p>
                            </div>

                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Column -->


            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?= $this->endSection() ?>