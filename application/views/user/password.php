<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>

		<div class="section-body">
			<div class="row">
				<div class="col">
					<?= $this->session->flashdata('message'); ?>

					<form action="<?= base_url('user/password'); ?>" method="post">
						<div class="card">
							<div class="card-body">
								<div class="form-group">
									<label for="exampleInputPassword1">Password Lama</label>
									<input type="password" class="form-control col-md-6" id="password_lama" name="password_lama">
									<?= form_error('password_lama', '<small class="text-danger pl-3">', '</small>') ?>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Password Baru</label>
									<input type="password" class="form-control col-md-6" id="password_baru1" name="password_baru1">
									<?= form_error('password_baru1', '<small class="text-danger pl-3">', '</small>') ?>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Masukkan Password Baru Sekali Lagi</label>
									<input type="password" class="form-control col-md-6" id="password_baru2" name="password_baru2">
									<?= form_error('password_baru2', '<small class="text-danger pl-3">', '</small>') ?>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Ubah Password</button>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>

		</div>
	</section>
</div>