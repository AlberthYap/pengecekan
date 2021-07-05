<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>



		<div class="section-body">
			<div class="row mt-3">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-sm-12 col-lg-7">
					<div class="card author-box card-primary">
						<div class="card-body">
							<div class="author-box-left">
								<img alt="image" src="<?= base_url('assets/img/avatar/') . $user['foto_user'] ?>" class="rounded-circle author-box-picture">
								<div class="clearfix"></div>
							</div>
							<div class="author-box-details">
								<div class="author-box-name mt-4">
									<h3>Nama : <?= $user['nama_depan']; ?> <?= $user['nama_belakang'] ?></h3>
									<h3>Username : <?= $user['username']; ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>