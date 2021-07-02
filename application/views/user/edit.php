<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>

		<div class="section-body">
			<div class="row mt-3">
				<div class="col-lg-12">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?= form_open_multipart('user/edit'); ?>
					<div class="card">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-2">
									<label>Username</label>
									<input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>

								</div>
								<div class="form-group col-md-5">
									<label>Email</label>
									<input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
								</div>
								<div class="form-group col-md-5">
									<label for="nohp">No Handphone</label>
									<input type="text" class="form-control" id="nohp" name="nohp" value="<?= $user['nohp']; ?>">
									<?= form_error('nohp', '<small class="text-danger pl-3">', '</small>') ?>

								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-6">
									<label for="nama">Nama Depan</label>
									<input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= $user['nama_depan']; ?>">
									<?= form_error('nama_depan', '<small class="text-danger pl-3">', '</small>') ?>
								</div>
								<div class="form-group col-6">
									<label for="nama">Nama Belakang</label>
									<input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= $user['nama_belakang']; ?>">
									<?= form_error('nama_belakang', '<small class="text-danger pl-3">', '</small>') ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-12">
									<label for="foto">Foto Profile</label>
									<div class="col-md-12">
										<div class="form-row">
											<div class="col-sm-3">
												<img src="<?= base_url('assets/img/avatar/') . $user['foto_user'] ?>" class="img-thumbnail">
											</div>
											<div class="col-sm-9">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="foto" name="foto">
													<label class="custom-file-label" for="foto">Choose file</label>
												</div>
												<button type="submit" class="btn btn-primary mt-3">Edit</button>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>