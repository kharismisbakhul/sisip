<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Profil</h4>
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
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                        <div class="gambar rounded-circle">
                            <img src="<?= ($user['foto_profil']) ?  base_url($user['foto_profil']) : '/assets/images/users/default.jpg'  ?>" class="rounded-circle" width="150"/>
                        </div>
                        <h4 class="card-title m-t-10"><?= $user['nama'] ?></h4>
                        <h6 class="card-subtitle"><?= $user['nama_status_user']  ?></h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-lg-12 mb-2">
                                <button type="button" class="btn waves-effect waves-light btn-block btn-info btn-gambar" data-id="<?= $user['no_induk'] ?>" data-toggle="modal" data-target="#ubahGambar" data-whatever="@mdo">Ubah Gambar
                                    Profil</button>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <button type="button" class="btn btn-success waves-effect waves-light btn-block btn-password" data-id="<?= $user['no_induk'] ?>" data-toggle="modal" data-target="#ubahPassword" data-whatever="@mdo">Ubah
                                    Password</button>

                            </div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body"> <small class="text-muted">Email </small>
                    <h6><?= $user['email'] ?></h6> <small class="text-muted p-t-30 db">Nomor Telepon</small>
                    <h6><?= $user['no_telepon'] ?></h6> <small class="text-muted p-t-30 db">Alamat</small>
                    <h6><?= $user['alamat'] ?></h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Tabs -->
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                    </li>
                </ul>
                <!-- Tabs -->
                <div class="tab-content" id="pills-tabContent">


                    <div class="tab-pane fade show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                        <div class="card-body">
                            <form class="form-horizontal form-material" action="<?= base_url('/admin/profil') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label class="col-md-12">Nama</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Isikan nama anda ..." class="form-control form-control-line" name="nama" value="<?= $user['nama'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">NIP</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nomer induk pegawai ..." class="form-control form-control-line" name="nip" readonly value="<?= $user['no_induk'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" class="form-control form-control-line" name="email" id="example-email" value="<?= $user['email'] ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">No Telepon</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="no_telepon" value="<?= $user['no_telepon'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Alamat</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line" name="alamat"><?= $user['alamat'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <!-- Start Modeal -->
    <!-- ============================================================== -->
    <div class="modal fade" id="ubahPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Ubah Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" class="form-pwd">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Password Lama:</label>
                            <input type="text" class="form-control v-pwd" id="message-text1" readonly value="">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Password Baru:</label>
                            <input type="password" name="password1" class="form-control" id="password1">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Konfirmasi Password Baru:</label>
                            <input type="password" name="password2" class="form-control" id="password2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->

    <!-- Start Modeal -->
    <!-- ============================================================== -->
    <div class="modal fade" id="ubahGambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Upload Foto Profil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" class="form-gmbr" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Upload:</label>
                            <input type="file" class="form-control v-pwd" id="message-text1" name="foto_profil" readonly value="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->


</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<?= $this->endSection() ?>