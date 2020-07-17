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
                    <h4>Capaian Kerja Pegawai Tahun 2020</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <div class="d-flex justify-content-end mb-2">
                            <form action="" method="get">
                                <div class="input-group">
                                    <select class="custom-select " id="inlineFormCustomSelect">
                                        <option selected="">Pilih Periode Kerja...</option>
                                        <option value="1">2020</option>
                                        <option value="2">2019</option>
                                        <option value="3">2018</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="button"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
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
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        Memimpin UB Guest House dan International Dormitory serta menjadi
                                        motivator bagi karyawan
                                    </td>
                                    <td>
                                        Utama
                                    </td>
                                    <td>
                                        10
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        2
                                    </td>
                                    <td>
                                        Memimpin UB Guest House dan International Dormitory serta menjadi
                                        motivator bagi karyawan
                                    </td>
                                    <td>
                                        Utama
                                    </td>
                                    <td>
                                        10
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        3
                                    </td>
                                    <td>
                                        Memimpin UB Guest House dan International Dormitory serta menjadi
                                        motivator bagi karyawan
                                    </td>
                                    <td>
                                        Utama
                                    </td>
                                    <td>
                                        10
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        4
                                    </td>
                                    <td>
                                        Memimpin UB Guest House dan International Dormitory serta menjadi
                                        motivator bagi karyawan
                                    </td>
                                    <td>
                                        Utama
                                    </td>
                                    <td>
                                        10
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        Memimpin UB Guest House dan International Dormitory serta menjadi
                                        motivator bagi karyawan
                                    </td>
                                    <td>
                                        Utama
                                    </td>
                                    <td>
                                        10
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        6
                                    </td>
                                    <td>
                                        Memimpin UB Guest House dan International Dormitory serta menjadi
                                        motivator bagi karyawan
                                    </td>
                                    <td>
                                        Utama
                                    </td>
                                    <td>
                                        10
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        7
                                    </td>
                                    <td>
                                        Membuat prosedur standar UB Guest
                                        House
                                    </td>
                                    <td>
                                        Tambahan
                                    </td>
                                    <td>
                                        10
                                    </td>
                                    <td>
                                        100
                                    </td>
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
                    <table class="table v-middle ">
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
                                            <button type="button" class="btn btn-sm waves-effect waves-light btn-info">Detail</button>

                                            <a class="btn btn-sm  waves-effect waves-light btn-success" href="<?= base_url('/supervisor/daftarPenilaian') . '/' . $sb['no_induk'] ?>">Penilaian</a>


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


<?= $this->endSection() ?>