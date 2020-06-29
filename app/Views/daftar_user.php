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

                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Daftar User</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <div class="d-flex justify-content-end mb-2">
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#tambahUser" data-whatever="@mdo">Tambah
                                                Pengumuman</button>
                                        </div>
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">No</th>
                                                    <th style="width: 10%">Foto</th>
                                                    <th style="width: 15%;">Nama</th>
                                                    <th style="width: 20%;">NIP/ID</th>
                                                    <th style="width: 10%;">Role</th>
                                                    <th style="width: 10%;">Aktif</th>
                                                    <th style="width: 25%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td> <img src="../../assets/images/users/1.jpg" alt="users"
                                                            class="rounded-circle img-fluid" width="50" /></td>
                                                    <td>Salsabila Ayu</td>
                                                    <td>412132132</td>
                                                    <td>Pegawai</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="modal" data-target="#editUser"
                                                                data-whatever="@mdo"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <a href="v_setting_pekerjaan.html"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-id-badge"></i></a>
                                                            <button type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#ubahPassword"
                                                                data-whatever="@mdo"><i class="fas fa-key"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td> <img src="../../assets/images/users/1.jpg" alt="users"
                                                            class="rounded-circle img-fluid" width="50" /></td>
                                                    <td>Salsabila Ayu</td>
                                                    <td>412132132</td>
                                                    <td>Pegawai</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="modal" data-target="#editUser"
                                                                data-whatever="@mdo"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <a href="v_setting_pekerjaan.html"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-id-badge"></i></a>
                                                            <button type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#ubahPassword"
                                                                data-whatever="@mdo"><i class="fas fa-key"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td> <img src="../../assets/images/users/1.jpg" alt="users"
                                                            class="rounded-circle img-fluid" width="50" /></td>
                                                    <td>Salsabila Ayu</td>
                                                    <td>412132132</td>
                                                    <td>Pegawai</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="modal" data-target="#editUser"
                                                                data-whatever="@mdo"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <a href="v_setting_pekerjaan.html"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-id-badge"></i></a>
                                                            <button type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#ubahPassword"
                                                                data-whatever="@mdo"><i class="fas fa-key"></i></button>
                                                        </div>
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
        <!-- Start Modeal -->
        <!-- ============================================================== -->
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Status:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
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
        <div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Status:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
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
        <div class="modal fade" id="ubahPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Password Baru:</label>
                                <input type="password" class="form-control" id="message-text1">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Konfirmasi Password Baru:</label>
                                <input type="password" class="form-control" id="message-text1">
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
        
<?= $this->endSection() ?>