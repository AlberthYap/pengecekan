<body>

	<div id="app">
		<section class="section">
			<div class="d-flex flex-wrap align-items-stretch">
				<div class="col-lg-4 col-md-12 col-12 order-lg-1 min-vh-100 order-2 bg-white">
					<div class="p-2 m-3">
						<br>
						<br>
						<br>
						<br>
						<img src="<?= base_url('assets/img/logoap1bali.png') ?>" alt="logo" width="70%" height="70%" style="display: block; margin: auto;" class="mb-5 mt-2">

						<?= $this->session->flashdata('message'); ?>
						<form method="POST" action="<?= base_url('auth/index'); ?>" class=" needs-validation" novalidate="">
							<div class="form-group">



								<label for="email">Username</label>
								<input type="text" id="username" name="username" class="form-control" value="<?= set_value('username'); ?>" tabindex="1" required autofocus>

								<div class="invalid-feedback">
									Silahkan Masukkan Username

								</div>
							</div>

							<div class="form-group">
								<div class="d-block">
									<label for="password" class="control-label">Password</label>
								</div>
								<input type="password" id="password" name="password" class="form-control" required>
								<div class="invalid-feedback">
									Silahkan Masukkan Password Anda

								</div>
							</div>

							<div class="form-group text-center">

								<button type="submit" class="btn btn-primary btn-lg col-12 btn-icon icon-right rounded-pill">
									Login
								</button>
							</div>
						</form>
					</div>
				</div>


				<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?= base_url('assets/img/unsplash/Bali-Thumbnail.webp') ?>">
					<div class="absolute-bottom-left index-2">
						<div class="text-light p-2 pb-2">
							<div class="mb-2 pb-3">
								<h1 class="mb-2 display-7 font-weight-bold">Welcome To Angkasa Pura I</h1>
								<h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>