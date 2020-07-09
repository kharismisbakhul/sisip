<?= $this->extend('template') ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <form action="<?= base_url('/admin/saveUser')?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Nama:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id=" message-text1" name="nama" placeholder="Masukan nama...">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama') ?>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">NO Induk:</label>
                            <input type="text" class="form-control" id="message-text1" name="no_induk" placeholder="Masukan no induk...">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Tahun Masuk:</label>
                            <input type="text" pattern="[0-9]{4}" class="form-control" id="message-text1" name="tahun_masuk" placeholder="Masukan tahun...">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Email:</label>
                            <input type="email" class="form-control" id="message-text1" name="email" placeholder="Masukan email...">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Phone No:</label>
                            <input type="number" class="form-control" id="message-text1" name="no_telepon" placeholder="Masukan no telepon">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Alamat:</label>
                            <input type="text" class="form-control" id="message-text1" name="alamat" placeholder="Masukan alamat...">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Foto:</label>
                            <input type="file" class="form-control" id="message-text1" name="foto_profil">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Role:</label>
                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status_user">
                                <option selected="">Pilih Role...</option>
                                <?php foreach ($status_user as $su) : ?>
                                    <option value="<?= $su['id_status_user'] ?>"><?= $su['nama_status_user'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection('content'); ?>