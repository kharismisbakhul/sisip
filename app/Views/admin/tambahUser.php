<?= $this->extend('template') ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">
    <div class="row">

        <div class="col-8">
            <h4 class="mb-2">Tambah User</h4>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <form action="/admin/saveUser" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Nama:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id=" message-text1" name="nama" placeholder="Masukan nama..." value="<?= old('nama') ?>">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">No Induk:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('no_induk')) ? 'is-invalid' : '' ?>" id=" message-text1" name="no_induk" placeholder="Masukan no induk..." value="<?= old('no_induk') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_induk') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Tahun Masuk:</label>
                            <input type="text" pattern="[0-9]{4}" class="form-control <?= ($validation->hasError('tahun_masuk')) ? 'is-invalid' : '' ?>" id="message-text1" name="tahun_masuk" placeholder="Masukan tahun..." value="<?= old('tahun_masuk') ?>">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Email:</label>
                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="message-text1" name="email" placeholder="Masukan email..." value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Phone No:</label>
                            <input type="number" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : '' ?>" id="message-text1" name="no_telepon" placeholder="Masukan no telepon" value="<?= old('no_telepon') ?>">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Alamat:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?> " id="message-text1" name="alamat" placeholder="Masukan alamat..." value="<?= old('alamat') ?>">

                            <div class="invalid-feedback">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Foto:</label>
                            <input type="file" class="form-control <?= ($validation->hasError('foto_profil')) ? 'is-invalid' : '' ?>" id="message-text1" name="foto_profil">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Pilih Role:</label>
                            <select class="custom-select mr-sm-2 <?= ($validation->hasError('status_user')) ? 'is-invalid' : '' ?>" id="inlineFormCustomSelect" name="status_user">
                                <?php foreach ($status_user as $su) : ?>
                                    <option value="<?= $su['id_status_user'] ?>"><?= $su['nama_status_user'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Data tidak boleh kosong
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('/admin/managementUsers') ?>" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection('content'); ?>