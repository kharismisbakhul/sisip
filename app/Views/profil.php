<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Profil Pegawai</h4>
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
                                <center class="m-t-30"> <img src="<?=base_url($user['foto_profil'])?>"
                                        class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?= $user['nama']?></h4>
                                    <h6 class="card-subtitle"><?= $user['nama_jabatan'].' '.$user['jabatan']['nama']?></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-lg-12 mb-2">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-block btn-info" data-toggle="modal" data-target="#ubahFoto">Ubah Gambar
                                                Profil</button>
                                        </div>
                                        <!-- <div class="col-lg-12 mb-2">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-block btn-warning" data-toggle="modal" data-target="#izin">Ajukan
                                                Izin</button>
                                        </div> -->
                                        <div class="col-lg-12 mb-2">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-block btn-success" data-toggle="modal" data-target="#ubahPassword">Ubah
                                                Password</button>
                                        </div>


                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="card-body"> <small class="text-muted">Email </small>
                                <h6><?= $user['email']?></h6> <small class="text-muted p-t-30 db">Nomor Telepon</small>
                                <h6><?= $user['no_telepon']?></h6> <small class="text-muted p-t-30 db">Alamat</small>
                                <h6><?= $user['alamat']?></h6>
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
                                    <a class="nav-link active" id="pills-tupoksi-tab" data-toggle="pill"
                                        href="#last-month" role="tab" aria-controls="pills-tupoksi"
                                        aria-selected="false">Tupoksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month"
                                        role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="last-month" role="tabpanel"
                                    aria-labelledby="pills-tupoksi-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <form class="m-b-25" action="" method="POST">
                                                <div class="input-group">
                                                    <select class="custom-select" id="inputGroupSelect04">
                                                        <option selected="">Periode Kerja...</option>
                                                        <option value="1">2018</option>
                                                        <option value="2">2019</option>
                                                        <option value="3">2020</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <h4>Pekerjaan <b><?= $user['nama_jabatan'].' '.$user['jabatan']['nama']?></b> Periode <?= date('Y')?></h4>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Nama Tugas</th>
                                                        <th scope="col">Jenis Tugas</th>
                                                        <th scope="col">Tugas Dikerjakan</th>
                                                        <th scope="col">Jumlah Total</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; foreach($rancangan_tugas as $rt) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++;?></th>
                                                        <td><?= $rt['nama_tugas']?></td>
                                                            <?php if($rt['status_tugas'] == 1){
                                                                echo '<td>Utama</td>';   
                                                            }else{
                                                                echo '<td>Tambahan</td>';   
                                                            }?>
                                                        <td><?= $rt['jumlah_tugas']?> </td>
                                                        <td><?= $rt['jumlah_total_tugas']?> </td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
                                            </table>
                                            <h4>Penilaian Kinerja</h4>
                                            <hr>
                                            <h5 class="m-t-30">Capaian Kinerja Anda <span class="pull-right"><?= $jumlah_tugas_berlangsung;?> dari
                                                    <?= $jumlah_total_tugas;?></span>
                                            </h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?= $jumlah_tugas_berlangsung;?>"
                                                    aria-valuemin="0" aria-valuemax="<?= $jumlah_total_tugas;?>"
                                                    style="width:<?= ((1) * 100);?>%; height:6px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="previous-month" role="tabpanel"
                                    aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material" action="<?= base_url('/staff/profil')?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="form-group">
                                                <label class="col-md-12">Nama</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Isikan nama anda ..."
                                                        class="form-control form-control-line" name="nama" value="<?= $user['nama']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">NIP</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Nomer induk pegawai ..."
                                                        class="form-control form-control-line" name="nip" readonly value="<?= $user['no_induk']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com"
                                                        class="form-control form-control-line" name="email"
                                                        id="example-email" value="<?= $user['email']?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12">No Telepon</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890"
                                                        class="form-control form-control-line" name="no_telepon" value="<?= $user['no_telepon']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Alamat</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5"
                                                        class="form-control form-control-line" name="alamat"><?= $user['alamat']?></textarea>
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


        <!-- Start Modal Ubah Foto -->
        <!-- ============================================================== -->
        <div class="modal fade" id="ubahFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah Foto Profil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?= base_url('/staff/ubahFoto')?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Foto Profil</label>
                                <input type="file" class="form-control" id="message-text1" name="foto">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Ubah Foto Profil</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Modal -->
        <!-- ============================================================== -->

        <!-- Start Modal Ajukan Izin -->
        <!-- ============================================================== -->
        <div class="modal fade" id="izin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Ajukan Izin</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form <form action="<?= base_url('/staff/ajukanIzin')?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="message-text1" name="tanggal_mulai">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="message-text1" name="tanggal_selesai">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Keterangan</label>
                                <textarea class="form-control" id="message-text1" name="keterangan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Kategori</label>
                                <select class="form-control" id="message-text1" name="kategori_izin">
                                    <option value="1">Izin</option>
                                    <option value="2">Sakit</option>
                                    <option value="3">Cuti</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Bukti</label>
                                <input type="file" class="form-control" id="message-text1" name="bukti">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Ajukan Izin</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Modal -->
        <!-- ============================================================== -->

        <!-- Start Modal Ubah Password -->
        <!-- ============================================================== -->
        <div class="modal fade" id="ubahPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?= base_url('/staff/ubahPassword')?>" method="post">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Password Lama:</label>
                                <input type="password" class="form-control" id="message-text1" name="pass1">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Password Baru:</label>
                                <input type="password" class="form-control" id="message-text1" name="pass2">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Konfirmasi Password Baru:</label>
                                <input type="password" class="form-control" id="message-text1" name="pass3">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Ubah Password</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Modal -->
        <!-- ============================================================== -->

<?= $this->endSection() ?>