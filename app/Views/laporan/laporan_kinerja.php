<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Laporan Evaluasi dan Monitoring</h4>
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
                                <h4>Keaktifan Pegawai Mei 2020</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                    <div class="d-flex col-lg-5 mb-2">
                                        <form action="" method="get">
                                            <div class="input-group">
                                                <select class="custom-select " id="inlineFormCustomSelect">
                                                    <option selected hidden>Pilih Bulan...</option>
                                                    <?php foreach ($bulan as $b) {
                                                        echo '<option value="'.$b['id_bulan'].'">'.$b['nama_bulan'].'</option>';
                                                    }?>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type="button"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-7">
                                        <a target="_blank" href="<?= base_url('/exportCapaianKerja') ?>" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    </div>
                                    </div>

                                    <table id="zero_config" class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th data-sort-initial="true" data-toggle="true">No</th>
                                        <th>Nama</th>
                                        <th>Nomer Induk</th>
                                        <th>Pekerjaan</th>
                                        <th>Status</th>
                                        <th>Rata-Rata Nilai</th>
                                        <?php $i = 1;; ?>
                                        <?php foreach ($pertanyaan as $p) : ?>
                                            <th data-hide="phone, tablet"><span class="font-bold"><?= ($i++) . '. ' . $p['pertanyaan_pk'] ?></span></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <div class="m-t-10">
                                    <div class="d-flex">
                                        <div class="ml-auto">
                                            <div class="form-group">
                                                <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <tbody>
                                    <?php $j = 1; ?>
                                    <?php foreach ($penilaian_kinerja as $pk) : ?>
                                        <tr>
                                            <td><?= $j++ ?></td>
                                            <td><?= $pk['nama'] ?></td>
                                            <td><?= $pk['no_induk'] ?></td>
                                            <td><?= ($pk['pekerjaan']) ? $pk['pekerjaan']['nama'] : 'Tidak ada pekerjaan' ?></td>
                                            <td><?= $pk['status'] ?> </td>
    
                                            <?php if ($pk['nilai']) : ?>
                                                <?php $temp = 0; ?>
                                                <?php foreach ($pk['nilai'] as $pkn) : ?>
                                                    <?php $temp += $pkn['nilai'];
    
                                                    ?>
                                                <?php endforeach; ?>
                                                <?php $rata2 = $temp / count($pk['nilai']); ?>
                                                <td><?= $rata2 ?></td>
                                            <?php else : ?>
                                                <td>0</td>
                                            <?php endif; ?>
    
    
    
                                            <?php if ($pk['nilai']) : ?>
                                                <?php foreach ($pk['nilai'] as $pkn) : ?>
                                                    <?php foreach ($pertanyaan as $p) : ?>
                                                        <?php if ($p['id_pertanyaan_pk'] == $pkn['id_pertanyaan_pk']) : ?>
                                                            <td><b>Nilai : </b><?= $pkn['nilai'] ?></td>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <?php foreach ($pertanyaan as $p) : ?>
                                                    <td><b>Nilai :</b>0</td>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
    
                                        </tr>
                                    <?php endforeach; ?>
    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <?php $jumlah = 6 + count($pertanyaan) ?>
                                        <td colspan="<?= $jumlah ?>">
                                            <div class="text-right">
                                                <ul class="pagination">
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
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
<?= $this->endSection() ?>