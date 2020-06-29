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
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                                    aria-hidden="true">×</span> </button>
                            <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> This is an
                            example top alert. You can edit what u wish. Aww yeah, you successfully read this important
                            alert message. This example text is going to run a bit longer so that you can see how
                            spacing within an alert works with this kind of content.
                        </div>
                        <div class="card">
                            <form action="" method="post">
                                <div class="card-body">
                                    <p class="card-title">1. Bagaimana Persyaratan yang harus dipenuhi
                                        dalam pengurusan pelayanan, baik
                                        persyaratan teknis maupun administratif di
                                        PN Palangka Raya?
                                    </p>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q11" name="q1" class="custom-control-input">
                                        <label class="custom-control-label" for="q11">Sangat Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q12" name="q1" class="custom-control-input">
                                        <label class="custom-control-label" for="q12">Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q13" name="q1" class="custom-control-input">
                                        <label class="custom-control-label" for="q13">Cukup</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q14" name="q1" class="custom-control-input">
                                        <label class="custom-control-label" for="q14">Kurang</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-title">2. Menurut Bpk/Ibu/Sdr bagaimana
                                        prosedur/tata cara pelayanan, termasuk
                                        pengaduan di PN Palangka Raya
                                    </p>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q21" name="q2" class="custom-control-input">
                                        <label class="custom-control-label" for="q21">Sangat Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q22" name="q2" class="custom-control-input">
                                        <label class="custom-control-label" for="q22">Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q23" name="q2" class="custom-control-input">
                                        <label class="custom-control-label" for="q23">Cukup</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q23" name="q2" class="custom-control-input">
                                        <label class="custom-control-label" for="q23">Kurang</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-title">3. Bagaimana jangka waktu pelayanan yang
                                        Pelayanan diperlukan untuk menyelesaikan
                                        seluruh proses Pelayanan dari setiap jenis
                                        pelayanan di PN Palangka Raya
                                    </p>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q31" name="q3" class="custom-control-input">
                                        <label class="custom-control-label" for="q31">Sangat Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q32" name="q3" class="custom-control-input">
                                        <label class="custom-control-label" for="q32">Baik</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q33" name="q3" class="custom-control-input">
                                        <label class="custom-control-label" for="q33">Cukup</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="q34" name="q3" class="custom-control-input">
                                        <label class="custom-control-label" for="q34">Kurang</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button class="btn btn-success">Simpan Jawaban</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?= $this->endSection() ?>