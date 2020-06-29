<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
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
                <!-- Info box -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_validasi ?></h2>
                                        <h6>Pekerjaan yang
                                            sudah divalidasi</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-check-box"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_belum_validasi ?></h2>
                                        <h6>Pekerjaan yang
                                            belum divalidasi</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-clipboard"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_revisi ?></h2>
                                        <h6>Pekerjaan yang direvisi</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-alert"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_bawahan ?></h2>
                                        <h6>Jumlah pegawai bawahan</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-alert"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <div class="row">

                    <div class="col-md-12 col-lg-4">
                        <div class="card ">
                            <div class="card-body">
                                <h4 class="card-title">Diagram Progres Kinerja</h4>
                                <div id="visitor" style="height:253px; width:100%;" class="m-t-20"></div>
                                <!-- row -->
                                <div class="row m-t-30 m-b-15">
                                    <!-- column -->
                                    <div class="col-4 birder-right text-left">
                                        <h4 class="m-b-0">60
                                            <small>
                                                <i class="fas fa-stop text-info"></i>
                                            </small>
                                        </h4>Desktop
                                    </div>
                                    <!-- column -->
                                    <div class="col-4 birder-right text-center">
                                        <h4 class="m-b-0">28
                                            <small>
                                                <i class="fas fa-stop text-danger"></i>
                                            </small>
                                        </h4>Mobile
                                    </div>
                                    <!-- column -->
                                    <div class="col-4 text-right">
                                        <h4 class="m-b-0">12
                                            <small>
                                                <i class="fas fa-stop text-secondary"></i>
                                            </small>
                                        </h4>Tablet
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-12 col-lg-8">
                        <div class="row">
                            <?php if($user['isPresensi'] == 0){?>
                            <div class="col-lg-12">

                                <div class="card bg-light-info no-card-border">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10">
                                                <h4>Reminder</h4>
                                                <span>Anda belum melakukan presensi hari ini tanggal <b><?= date('d-m-Y')?></b>.
                                                    Segera lakukan presensi sebelum pukul <b>07.30 </b>!</span>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="icon-Information" style="font-size: 50px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h4 class="card-title">Pengumuman</h4>
                                            </div>

                                        </div>
                                        <div>
                                            <div class="table-responsive">
                                            <?php if($pengumuman != null) { ?>
                                                <table class="table v-middle">
                                                    <tbody>
                                                        <?php foreach($pengumuman as $p) :?>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="m-r-10">
                                                                        <i class="fas fa-fw fa-bullhorn"
                                                                            style="font-size: 40px;"></i>
                                                                    </div>
                                                                    <div class="">
                                                                        <h4 class="m-b-0 font-16"><?= $p['pengumuman']?></h4>
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-user mr-2"></i><?= $p['nama']?></span>
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-calendar-plus mr-2"></i><?= $p['tanggal_pengumuman']?></span>
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-clock mr-2"></i><?= $p['waktu_pengumuman']?></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                                <?php }else{?>
                                                        <p class="alert-warning p-3 text-center">Tidak ada pengumuman</p>
                                                        <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- Column -->


                    <!-- Column -->
                    <div class="col-md-12 col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h4 class="card-title">Absensi Pegawai Hari Ini 05 Mei 2020</h4>
                                            </div>

                                        </div>
                                        <div>
                                            <div class="table-responsive">
                                                <table class="table v-middle">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="../../assets/images/users/4.jpg"
                                                                        alt="user" width="60" class="rounded-circle">
                                                                    <div class="comment-text w-100">
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-user mr-2"></i>Ayu
                                                                            Multazam</span>
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-calendar-plus mr-2"></i>22-05-2020</span>
                                                                        <span
                                                                            class="label label-rounded label-primary">In
                                                                            :
                                                                            07.30</span>
                                                                        <span
                                                                            class="label label-rounded label-success">Out
                                                                            :
                                                                            15.30</span>

                                                                        <br>
                                                                        <span>
                                                                            <i
                                                                                class="fas fa-map-marker-alt mr-2"></i>Jl.
                                                                            Simpang Candi Panggung Gang 3/2 Malang, Jawa
                                                                            Timur
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td align="right">

                                                                <button type="button"
                                                                    class="btn btn-sm waves-effect waves-light btn-warning">WFH</button>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="../../assets/images/users/4.jpg"
                                                                        alt="user" width="60" class="rounded-circle">
                                                                    <div class="comment-text w-100">
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-user mr-2"></i>Ayu
                                                                            Multazam</span>
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-calendar-plus mr-2"></i>22-05-2020</span>
                                                                        <span
                                                                            class="label label-rounded label-primary">In
                                                                            :
                                                                            07.30</span>
                                                                        <span
                                                                            class="label label-rounded label-success">Out
                                                                            :
                                                                            15.30</span>

                                                                        <br>
                                                                        <span>
                                                                            <i
                                                                                class="fas fa-map-marker-alt mr-2"></i>Jl.
                                                                            Simpang Candi Panggung Gang 3/2 Malang, Jawa
                                                                            Timur
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td align="right">

                                                                <button type="button"
                                                                    class="btn btn-sm waves-effect waves-light btn-warning">WFH</button>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="../../assets/images/users/4.jpg"
                                                                        alt="user" width="60" class="rounded-circle">
                                                                    <div class="comment-text w-100">
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-user mr-2"></i>Ayu
                                                                            Multazam</span>
                                                                        <span class="mr-3"><i
                                                                                class="fas fa-calendar-plus mr-2"></i>22-05-2020</span>
                                                                        <span
                                                                            class="label label-rounded label-primary">In
                                                                            :
                                                                            07.30</span>
                                                                        <span
                                                                            class="label label-rounded label-success">Out
                                                                            :
                                                                            15.30</span>

                                                                        <br>
                                                                        <span>
                                                                            <i
                                                                                class="fas fa-map-marker-alt mr-2"></i>Jl.
                                                                            Simpang Candi Panggung Gang 3/2 Malang, Jawa
                                                                            Timur
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td align="right">

                                                                <button type="button"
                                                                    class="btn btn-sm waves-effect waves-light btn-warning">WFH</button>


                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- Column -->
                    <div class="col-md-12 col-lg-4">
                        <div class="card ">
                            <div class="card-body">
                                <h4 class="card-title">Data Permintaan Validasi Pegawai</h4>
                                <div id="visitor" style="height:253px; width:100%;" class="m-t-20"></div>
                                <!-- row -->
                                <div class="row m-t-30 m-b-15">
                                    <!-- column -->
                                    <div class="col-3 birder-right text-left">
                                        <h4 class="m-b-0">60
                                            <small>
                                                <i class="fas fa-stop text-success"></i>
                                            </small>
                                        </h4>Valid
                                    </div>
                                    <!-- column -->
                                    <div class="col-3 birder-right text-center">
                                        <h4 class="m-b-0">28
                                            <small>
                                                <i class="fas fa-stop text-info"></i>
                                            </small>
                                        </h4>Proses
                                    </div>
                                    <!-- column -->
                                    <div class="col-3 text-right">
                                        <h4 class="m-b-0">12
                                            <small>
                                                <i class="fas fa-stop text-danger"></i>
                                            </small>
                                        </h4>Tolak
                                    </div>
                                    <div class="col-3 text-right">
                                        <h4 class="m-b-0">12
                                            <small>
                                                <i class="fas fa-stop text-warning"></i>
                                            </small>
                                        </h4>Revisi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>