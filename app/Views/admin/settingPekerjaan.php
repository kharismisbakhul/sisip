<?= $this->extend('template') ?>

<?= $this->section('content'); ?>
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
                    <center class="m-t-30"> <img src="<?= base_url($u['foto_profil']) ?>" class="rounded-circle" width="150" />
                        <h4 class="card-title m-t-10"><?= $u['nama'] ?></h4>
                        <h5 class="card-title m-t-10"><?= $u['nama_status_user'] ?></h5>
                        <h6 class="card-subtitle"><?= ($pekerjaan != null) ? $pekerjaan['nama'] : 'Belum memiliki pekerjaan' ?></h6>

                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body"> <small class="text-muted">Email </small>
                    <h6><?= $u['email'] ?></h6> <small class="text-muted p-t-30 db">Nomer Telepon</small>
                    <h6><?= $u['no_telepon'] ?></h6> <small class="text-muted p-t-30 db">Alamat</small>
                    <h6><?= $u['alamat'] ?></h6>
                </div>
            </div>
            <div class="row">
                 <div class="col-12">
                    <a href="<?= base_url('/admin/managementUsers')?>" class="float-right btn btn-secondary">Kembali</a>
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
                        <a class="nav-link active" id="pills-tupoksi-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-tupoksi" aria-selected="false">Tupoksi</a>
                    </li>

                </ul>
                <!-- Tabs -->
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-tupoksi-tab">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4>Riwayat Jabatan <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#responsive-modal"><i class="fas fa-plus"></i></button></h4>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" style="width: 20%;">Jabatan</th>
                                            <th scope="col">Tanggal Menjabat</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $j = 1; ?>
                                        <?php foreach ($riwayat_pekerjaan as $rp) : ?>
                                            <tr>
                                                <th scope="row"><?= $j++ ?></th>
                                                <td>
                                                    <h5 class="m-b-0 font-16 font-medium"><?= $rp['nama_status_user'] ?></h5><span><?= $rp['nama']  ?></span>
                                                </td>
                                                <td>
                                                    <form action="<?= base_url('/AdminController/ubahTanggalMenjabat/'. $rp['id_riwayat_jabatan']) ?>" method="post">
                                                        <input type="hidden" name="no_induk" value="<?= $u['no_induk'] ?>">
                                                        <div class="form-group input-group mb-3">
                                                            <label style="margin-right: 20px;" for="tgl_mulai_jabat">Mulai</label>
                                                            <input type="date" name="periode_mulai_jabatan" id="tgl_mulai_jabat" class="form-control" value="<?= $rp['periode_mulai_jabatan'] ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-info" type="submit"><i class="fas fa-check-circle"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-right: 10px;" for="tgl_selesai_jabat">Selesai</label>
                                                            <?php if ($rp['periode_akhir_jabatan']) : ?>
                                                                <input id="tgl_selesai_jabat" type="date" name="periode_akhir_jabatan" class="form-control" value="<?= $rp['periode_akhir_jabatan'] ?>">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-info" type="submit"><i class="fas fa-check-circle"></i></button>
                                                                </div>
                                                            <?php else : ?>
                                                                <input name="periode_akhir_jabatan" id="tgl_selesai_jabat" type="date" class="form-control">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-secondary" type="submit"><i class="fas fa-check-circle"></i></button>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </form>

                                                </td>
                                                <td>
                                                    <?php if ($rp['status_aktif'] == 1) : ?>
                                                        <span class="btn btn-success btn-sm">Aktif</span>
                                                    <?php else : ?>
                                                        <span class="btn btn-danger btn-sm">Tidak Aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="<?= base_url('/AdminController/hapusRiwayatPekerjaan/'. $rp['id_riwayat_jabatan']) ?>?no_induk=<?= $u['no_induk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sistem akan menghapus data tugas, data daftar validasi tugas dan data presensi yang berkaitan dengan data riwayat pekerjaan bidang <?= $rp['nama'] ?> jabatan <?= $rp['nama_status_user'] ?>. Apakah anda yakin untuk dihapus ?')"><i class="fas fa-trash"></i></a>
                                                        <a href="<?= base_url('/AdminController/ubahStatusRiwayat/'.$rp['id_riwayat_jabatan'].'?no_induk='.$u['no_induk']) ?>" class="btn btn-info btn-sm"><i class="fas fa-check-circle"></i></a>
                                                    </div>

                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php if ($pekerjaan_sekarang) : ?>
                                    <h4>Pekerjaan <b><?= $pekerjaan['nama'] ?></b> Periode Mulai Jabatan <?= $pekerjaan['periode_mulai_jabatan'] ?></h4>
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Tugas</th>
                                                <th scope="col">Jenis Tugas</th>
                                                <th scope="col">Jumlah Tugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pekerjaan_sekarang as $ps) : ?>
                                                <tr>
                                                    <th scope="row"><?= $ps['nomor_pekerjaan'] ?></th>
                                                    <td><?= $ps['nama_tugas'] ?></td>
                                                    <td>
                                                        <?php if ($ps['periode'] == 1) : ?>
                                                            Harian
                                                        <?php else : ?>
                                                            Bulanan
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $ps['jumlah_total_tugas'] ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <h4>Belum memiliki pekerjaan</h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Riwayat Pekerjaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form method="post" action="<?= base_url('/admin/tambahRiwayatPekerjaan/'.$u['no_induk']) ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="riwayat_jabatan" class="control-label">Jabatan:</label>
                            <select class="custom-select mr-sm-2" id="riwayat_jabatan">
                                <option value="0" selected="">Pilih jabatan...</option>
                                <?php foreach ($status_user as $su) : ?>
                                    <option value="<?= $su['id_status_user'] ?>"><?= $su['nama_status_user'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="riwayat_bidang" class="control-label">Bidang:</label>
                            <select name="id_jabatan" required class="custom-select mr-sm-2" id="riwayat_bidang">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="periode_mulai_jabatan" class="control-label">Periode Mulai Jabatan:</label>
                            <input required class="custom-select mr-sm-2" id="periode_mulai_jabatan" name="periode_mulai_jabatan" type="date">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
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
<?= $this->endSection('content'); ?>