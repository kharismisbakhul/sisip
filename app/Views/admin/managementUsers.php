<?= $this->extend('template') ?>


<?= $this->section('content') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Daftar User</h4>
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
                    <h4>Daftar User</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-end mb-2">
                                <a href="<?= base_url('/admin/tambahUser')?>" class="btn btn-success">Tambah
                                    User</a>
                            </div>
                            <table class="table table-hover" id="zero_config">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 10%">Foto</th>
                                        <th style="width: 15%;">Nama</th>
                                        <th style="width: 20%;">NIP/ID</th>
                                        <th style="width: 10%;">Role</th>
                                        <th style="width: 25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($users as $u) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td> <img src="<?= ($u['foto_profil']) ? base_url($u['foto_profil']) : base_url('/assets/images/users/default.jpg') ?>" alt="users" class="rounded-circle img-fluid" width="50" /></td>
                                            <td><?= $u['nama'] ?></td>
                                            <td><?= $u['no_induk'] ?></td>
                                            <td><?= $u['nama_status_user'] ?></td>
                                            <td>
                                                <div class="button-group">
                                                    <form action="<?= base_url('/admin/'. $u['no_induk']) ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn waves-effect waves-light btn-danger" onclick="return confirm('Apakah anda yakin <?= $u['nama'] ?> akan dihapus ?')"><i class="fas fa-trash"></i></button>
                                                    </form>

                                                    <a href="<?= base_url('/admin/ubahUser/'. $u['no_induk']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>

                                                    <?php if ($u['id_status_user'] != 1 && $u['id_status_user'] != 2) : ?>
                                                        <a href="<?= base_url('/admin/settingPekerjaan/'. $u['no_induk']) ?>" class="btn btn-primary"><i class="fas fa-id-badge"></i></a>
                                                    <?php endif; ?>

                                                    <button type="button" class="btn btn-warning btn-password" data-id="<?= $u['no_induk'] ?>" data-toggle="modal" data-target="#ubahPassword" data-whatever="@mdo"><i class="fas fa-key"></i></button>
                                                </div>
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


<!-- ============================================================== -->
<!-- Start Modeal -->
<!-- ============================================================== -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Nama:</label>
                        <input type="text" class="form-control" id="message-text1">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">NIP/ID:</label>
                        <input type="text" class="form-control" id="message-text1">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Tanggal Masuk:</label>
                        <input type="date" class="form-control" id="message-text1">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Email:</label>
                        <input type="email" class="form-control" id="message-text1">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Phone No:</label>
                        <input type="number" class="form-control" id="message-text1">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Alamat:</label>
                        <input type="number" class="form-control" id="message-text1">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Foto:</label>
                        <input type="file" class="form-control" id="message-text1">
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Role:</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option selected="">Pilih Role...</option>
                            <option value="1">Direksi</option>
                            <option value="2">Manager</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Modal -->
<!-- ============================================================== -->

<!-- Start Modeal -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Modal -->
<!-- ============================================================== -->

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



<?= $this->endSection('content') ?>