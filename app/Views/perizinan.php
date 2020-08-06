<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Perizinan</h4>
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
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Form Perizinan Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <form <form action="<?= base_url('/staff/ajukanIzin')?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="message-text1" name="tanggal_mulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="message-text1" name="tanggal_selesai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Keterangan</label>
                                            <textarea class="form-control" id="message-text1" name="keterangan" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Kategori</label>
                                            <select class="form-control" id="message-text1" name="kategori_izin" required>
                                                <option value="1">Izin</option>
                                                <option value="2">Sakit</option>
                                                <option value="3">Cuti</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Bukti</label>
                                            <input type="file" class="form-control" id="message-text1" name="bukti">
                                        </div>
                                    <button type="submit" class="btn btn-warning">Ajukan Izin</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <p>Form perizinan pegawai adalah layanan yang ditujukan untuk melakukan perizinan bagi pegawai yang berhalangan hadir bertugas</p>
                            </div>

                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Column -->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Riwayat Perizinan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php if($perizinan == null) { ?>
                                    <div class="alert alert-warning text-center">Tidak ada saran</div>
                                <?php }else{ ?>
                                    <table id="tabel-riwayat-saran" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Izin</th>
                                                <th>Rentang Waktu</th>
                                                <th>Alasan</th>
                                                <th>Kategori Izin</th>
                                                <th>Bukti</th>
                                                <th>Status Izin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;
                                        foreach($perizinan as $p) :?>
                                            <tr>
                                                <td>
                                                    <?= $a++;?>
                                                </td>
                                                <td>
                                                    <?= $p['tanggal_izin']?>
                                                </td>
                                                <td>
                                                    <?= $p['tanggal_mulai']. ' s/d '.$p['tanggal_selesai']?>
                                                </td>
                                                <td>
                                                    <?= $p['alasan']?>
                                                </td>
                                                <?php 
                                                    if($p['kategori_izin'] == 1){
                                                        echo '<td>Izin</td>';
                                                    }else if($p['kategori_izin'] == 2){
                                                        echo '<td>Sakit</td>';
                                                    }else{
                                                        echo '<td>Cuti</td>';
                                                    }
                                                ?>
                                                <td>
                                                    <a target="_blank" href="<?= base_url('assets/images/izin/'.$p['bukti'])?>"><i class="fas fa-file-alt"></i></a>
                                                </td>
                                                <?php 
                                                    if($p['status_izin'] == 1){
                                                        echo '<td class="text-success">Diterima</td>';
                                                    }else if($p['status_izin'] == 2){
                                                        echo '<td class="text-danger">Ditolak</td>';
                                                    }else{
                                                        echo '<td class="text-info">Diproses</td>';
                                                    }
                                                ?>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?= $this->endSection() ?>