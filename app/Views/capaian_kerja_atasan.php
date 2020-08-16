<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Capaian Kerja</h4>
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
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Capaian Kerja Tahun <?= $tahun?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <div class="row">
                                    <div class="d-flex col-lg-8 mb-2">
                                        <form action="<?= base_url('/supervisor/capaianKerja')?>" method="get">
                                            <div class="input-group">
                                                <select class="custom-select " id="inlineFormCustomSelect" name="tahun">
                                                    <option selected value="" hidden>Pilih Tahun...</option>
                                                    <?php 
                                                    for ($i=2020; $i < 2030; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                    };
                                                    ?>
                                                    
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type="submit"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <a target="_blank" href="<?= base_url('/exportCapaianKerja?tahun='.$tahun) ?>" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    </div>
                                    </div>

                        <table id="zero_config" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tugas</th>
                                    <th>Jenis Tugas</th>
                                    <th>Total Dicapai</th>
                                    <th>Total Target</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; foreach($rancangan_tugas as $rt) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $rt['nama_tugas']?></td>
                                <td>Utama</td>
                                <td><?= $rt['jumlah_tugas']?></td>
                                <td><?= $rt['jumlah_total_tugas']?></td>
                            </tr>
                        <?php endforeach?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>Tugas Tambahan  <button class="btn btn-secondary" data-toggle="modal" data-target="#detailTugasTambahanAtasan">Detail</button></td>
                                <td>Tambahan</td>
                                <td><?= $jumlah_tugas_tambahan?></td>
                                <td>0</td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <div class="row">

        <div class="col-lg-6">

            <div class="card earning-widget">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex">
                            <div>
                                <h4 class="card-title m-b-0">Daftar Pegawai</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <table class="table v-middle " id="tabel-daftar-bawahan">
                        <tbody>
                            <?php foreach ($staff_bawahan as $sb) :  ?>
                                <tr>
                                    <td style="width:40px"><img src="<?= base_url($sb['foto_profil']) ?>" width="60" class="rounded-circle" alt="logo"></td>
                                    <td>
                                        <div class="comment-text w-100">
                                            <h5 class="d-block"><?= $sb['nama'] ?></h5>
                                            <i class="fas fa-id-card mr-2"></i> <span><?= $sb['no_induk'] ?></span><br>
                                            <i class="fas fa-user-md mr-2"></i> <span><?= $sb['nama_jabatan'] ?></span>
                                        </div>
                                    </td>
                                    <td align="right">
                                        <div class="button-group">
                                            <button type="button" class="btn btn-sm waves-effect waves-light btn-info button-detail-bawahan" data-toggle="modal" data-target="#detail-bawahan" data-foto="<?= $sb['foto_profil'] ?>" data-nama="<?= $sb['nama']?>" data-nip="<?= $sb['no_induk']?>" data-jabatan="<?= $sb['nama_jabatan']?>" data-status="<?= $sb['nama_status_user']?>" data-email="<?= $sb['email']?>" data-no="<?= $sb['no_telepon']?>" data-alamat="<?= $sb['alamat']?>">Detail</button>

                                            <button type="button" class="btn btn-sm waves-effect waves-light btn-secondary button-capaian-bawahan" data-toggle="modal" data-target="#capaian-bawahan" data-tahun="<?= $tahun ?>" data-induk="<?= $sb['no_induk']?>" >Capaian Kerja</button>

                                            <a class="btn btn-sm  waves-effect waves-light btn-success" href="<?= base_url('/supervisor/daftarPenilaian') . '/' . $sb['no_induk'] ?>">Penilaian Kinerja</a>


                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body ml-5">
                    <img src="../../assets/images/undraw_dashboard.svg" width="63%" class="mx-auto d-block" alt="">
                </div>
                <div class="card-body ml-5">
                    <h3>Penilaian Kinerja</h3>
                    <p><?php if ($penilaian_kinerja) : ?>
                            Nama : <?= $penilaian_kinerja['nama_pk'] ?> <br> Status :<button class="ml-2 btn btn-sm btn-info"> <?= ($penilaian_kinerja['status_pk'] == 1) ? 'Aktif' : 'Tidak aktif' ?> </button>
                        <?php else : ?>
                        <?php endif; ?>

                    </p>
                    <h3>Capaian Kerja Bawahan</h3>
                    <p>Silahkan klik detail untuk melihat capain kerja
                        bawahan anda.</p>
                    <h3>Jumlah Bawahan</h3>
                    <h1>
                        <?php if ($staff_bawahan) {
                            echo count($staff_bawahan);
                        } else {
                            echo 0;
                        }
                        ?>
                    </h1>
                </div>

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

<!-- Modal Detail Bawahan-->
<div class="modal fade detail-bawahan" id="detail-bawahan" tabindex="-1" role="dialog" aria-labelledby="detail-bawahanTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detail-bawahanTitle">Detail Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <figure class="figure text-center">
                            <img src="" class="img-thumbnail rounded-circle" style="width: 350px; height: 350px;" alt="" id="foto">
                        </figure>
                    </div>
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_induk">Nomor Induk</label>
                                <input type="text" class="form-control" id="no_induk" name="no_induk" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="" readonly>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

        <div class="modal fade" id="detailTugasTambahanAtasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Detail Tugas Tambahan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                        <?php if($tugas_tambahan == null) {
                                        echo '<div class="alert alert-warning text-center">Tidak ada tugas tambahan</div>';
                                        } else {?>
                                    <table id="zero_config" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tugas Tambahan</th>
                                                <th>Total Dicapai</th>
                                                <th>Tanggal Tugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($tugas_tambahan as $t) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $t['nama_tugas']?></td>
                                                <td><?= $t['jumlah_tugas']?></td>
                                                <td><?= $t['tanggal_tugas']?></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <?php }?>
                        </div>
                    </div>
                </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal Capaian Bawahan-->
<div class="modal fade capaian-bawahan" id="capaian-bawahan" tabindex="-1" role="dialog" aria-labelledby="detail-bawahanTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detail-bawahanTitle">Detail Capaian Bawahan Tahun <?= $tahun?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Nama:</h5>
                <h5>No Induk:</h5>
                <h5>Jabatan:</h5>
            </div>
        </div>
    </div>
    </div>

        <div class="modal fade" id="detailTugasTambahanAtasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Detail Tugas Tambahan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                        <?php if($tugas_tambahan == null) {
                                        echo '<div class="alert alert-warning text-center">Tidak ada tugas tambahan</div>';
                                        } else {?>
                                    <table id="zero_config" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tugas Tambahan</th>
                                                <th>Total Dicapai</th>
                                                <th>Tanggal Tugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($tugas_tambahan as $t) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $t['nama_tugas']?></td>
                                                <td><?= $t['jumlah_tugas']?></td>
                                                <td><?= $t['tanggal_tugas']?></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <?php }?>
                        </div>
                    </div>
                </div>
    </div>
</div>
<!-- End Modal -->



<?= $this->endSection() ?>