<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <form action="<?= base_url('developer') ?>" method="post">

                <div class="card">
                    <div class="card-header">
                        <h4>Registrasi Admin</h4>
                    </div>

                    <?= $this->session->flashdata('message'); ?>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="inputAddress">Nama Depan</label>
                                <input type="text" class="form-control" id="nDepan" name="nDepan" placeholder="Masukkan Nama Depan" value="<?= set_value('nDepan'); ?>" required>
                                <?= form_error(' nDepan', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputAddress">Nama Belakang</label>
                                <input type="text" class="form-control" id="nBelakang" name="nBelakang" placeholder="Masukkan Nama Belakang" value="<?= set_value('nBelakang'); ?>" required>
                                <?= form_error(' nBelakang', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" value="<?= set_value('username'); ?>" required>
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group col-4">
                                <label for="nohp">No HP</label>
                                <input type="tel" class="form-control" name="nohp" id="nohp" placeholder="Masukkan No HP" value="<?= set_value('nohp'); ?>" required>
                                <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group col-4">
                                <label for="unit_id">Unit</label>
                                <select name="id_unit" id="id_unit" class="form-control">
                                    <?php foreach ($unit as $u) : ?>
                                        <option value="<?= $u['id_unit'] ?>"><?= $u['nama_unit']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Password</label>
                                <input class="form-control" type="password" name="password1" id="password1" placeholder="Masukkan Password" required>
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Ulang Password</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Silahkan Masukkan Ulang Password" required>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"> Daftar</button>
                        <button type="reset" class="btn btn-danger"> Reset</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
</div>