<div class="main-content">
	<section class="section">


		<div class="row">
			<div class="col-12">


				<div class="section-body">
					<div class="card">
						<div class="card-header">
							<h4>Role Access : <?= $role['nama_role']; ?></h4>
						</div>
						<?= $this->session->flashdata('message'); ?>
						<div class="card-body table-responsive">


							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Menu</th>
										<th scope="col">Access</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($menu as $m) : ?>
										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><?= $m['menu']; ?></td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" <?= check_access($role['id_role'], $m['id_menu']); ?> data-role="<?= $role['id_role']; ?>" data-menu="<?= $m['id_menu']; ?>">
												</div>
											</td>
										</tr>
										<?php $i++ ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
