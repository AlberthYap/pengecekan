<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>

		<div class="section-body">
			<div class="row mt-3">
				<div class="col-lg-8">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">

					<?= form_open_multipart('user/edit'); ?>

					<div class="form-group row">
						<label for="username" class="col-sm-2 col-form-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
							<?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="nohp" class="col-sm-2 col-form-label">No Handphone</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nohp" name="nohp" value="<?= $user['nohp']; ?>">
							<?= form_error('nohp', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="foto" class="col-sm-2 col-form-label">Foto Profile</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									<img src="<?= base_url('assets/img/avatar/') . $user['foto'] ?>" class="img-thumbnail">
								</div>
								<div class="col-sm-9">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="foto" name="foto">
										<label class="custom-file-label" for="foto">Choose file</label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row justify-content-end">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-primary">Edit</button>
						</div>
					</div>

					</form>
				</div>
			</div>
		</div>
	</section>
</div>
