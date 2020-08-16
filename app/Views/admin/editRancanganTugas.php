<?php $this->extend('template'); ?>
<?php $this->section('content'); ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h4 class="page-title">Rancangan Tugas Jabatan <?= $jabatan['nama_status_user'] ?> Bagian <?= $jabatan['nama'] ?></h4>
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
                    <h4>Daftar Rancangan Tugas </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Nomer</th>
                                    <th style="width: 50%;">Nama Tugas</th>
                                    <th style="width: 20%;">Periode</th>
                                    <th style="width: 10%;">Jumlah Tugas</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <form id="createFormRancangan" method="post">
                                        <td>
                                            <input type="nummber" class="form-control nomor_pekerjaan" name="nomor_pekerjaan" id="nomor_pekerjaan">
                                        </td>
                                        <td>
                                            <input type="hidden" id="id_jabatan" name="id_jabatan" value="<?= $jabatan['id_jabatan'] ?>" class="id_jabatan">
                                            <textarea style="width: 500px;" id="nama_tugas" type="text" name="nama_tugas" class="form-control nama_tugas"></textarea>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select style="width: 100px;" class="custom-select col-12 periode" id="inlineFormCustomSelect" name="periode">
                                                    <option value="1" selected>Harian</option>
                                                    <option value="3">Mingguan</option>
                                                    <option value="2">Bulanan</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control jumlah_tugas" name="jumlah_tugas">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-group">
                                                <button type="button" id="tambah-rancangan" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i></button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>

                            </tbody>
                        </table>


                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Nomer</th>
                                    <th style="width: 50%;">Nama Tugas</th>
                                    <th style="width: 20%;">Periode</th>
                                    <th style="width: 10%;">Jumlah Tugas</th>
                                    <th style="width: 10%;">Action</th>

                                </tr>
                            </thead>
                            <tbody class="tabel-rancangan">
                                <?php foreach ($rancangan as $r) : ?>
                                    <tr>
                                        <form class="editFormRancangan<?= $r['id_rancangan_tugas'] ?>" method="post">
                                            <td>
                                                <input type="nummber" class="form-control" name="nomer" value="<?= $r['nomor_pekerjaan'] ?>" id="nomor_pekerjaan<?= $r['id_rancangan_tugas'] ?>">
                                            </td>
                                            <td>
                                                <input type="hidden" id="id_jabatan" name="id_jabatan" value="<?= $r['id_jabatan'] ?>">
                                                <textarea style="width: 500px;" id="nama_tugas<?= $r['id_rancangan_tugas'] ?>" type="text" name="nama_tugas" class="form-control"><?= $r['nama_tugas'] ?></textarea>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select style="width: 100px;" class="custom-select col-12" id="periode<?= $r['id_rancangan_tugas'] ?>" name="periode">
                                                        <?php if ($r['periode'] == 1) { ?>
                                                            <option value="1" selected>Harian</option>
                                                            <option value="3">Mingguan</option>
                                                            <option value="2">Bulanan</option>
                                                        <?php }else if ($r['periode'] == 3) { ?>
                                                            <option value="1">Harian</option>
                                                            <option value="3" selected>Mingguan</option>
                                                            <option value="2">Bulanan</option>
                                                        <?php }else { ?>
                                                            <option value="1">Harian</option>
                                                            <option value="3">Mingguan</option>
                                                            <option value="2" selected>Bulanan</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" value="<?= $r['jumlah_total_tugas'] ?>" class="form-control" name="jumlah_tugas" id="jumlah_tugas<?= $r['id_rancangan_tugas'] ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="button-group">
                                                    <button type="button" class="btn waves-effect waves-light btn-info edit-pertanyaan" data-id="<?= $r['id_rancangan_tugas'] ?>" onclick="editRancanganTugas(<?= $r['id_rancangan_tugas'] ?>)"><i class=" fas fa-edit mr-2"></i>Simpan</button>
                                                    <a href="/admin/hapusRancanganTugas/<?= $r['id_rancangan_tugas'] ?>/<?= $r['id_jabatan'] ?>" class="btn waves-effect waves-light btn-danger"><i class="fas fa-trash mr-2"></i>Hapus</a>
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

<script>


</script>

<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<?php $this->endSection('content'); ?>