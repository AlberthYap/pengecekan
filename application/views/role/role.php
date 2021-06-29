<div class="main-content">
	<section class="section">


		<div class="row">
			<div class="col-12">

				<div class="section-body">
					<div class="card">
						<div class="card-header">
							<h4>Role</h4>
						</div>
						<?= $this->session->flashdata('message'); ?>

						<div class="card-body table-responsive">

							<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Tambah Role Baru</a>
							<table class="table table-striped text-center" id="table_id">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Role</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $i = 1; ?>
									<?php foreach ($role as $r) : ?>
										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><?= $r['nama_role']; ?></td>
											<td>
												<a href="<?= base_url('developer/roleaccess/') . $r['id_role']; ?>" class="badge badge-warning"><i class="fas fa-fw fa-pencil-alt"></i>Access</a>
												<?php if ($r['id_role'] != 1 and $r['id_role'] != 2) : ?>
													<a href="#" class="badge badge-success btn-edit" data-id="<?= $r['id_role']; ?>" data-role="<?= $r['nama_role']; ?>"><i class=" fas fa-fw fa-pencil-alt"></i>Edit</a>
													<?php if ($r['id_role'] != 3) : ?>
														<a href="#deletemodal" class="badge badge-danger" data-toggle="modal" onclick="$('#deletemodal #formdelete').attr('action', '<?= site_url('developer/hapusrole/' .  $r['id_role']) ?>')"><i class="far fa-trash-alt"></i> Delete</a>
													<?php endif; ?>
												<?php endif; ?>
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

<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newRoleModalLabel">Tambah Role Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('developer/role'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="formGroupExampleInput">Tambah Role Baru</label>
						<input type="text" class="form-control" id="role" name="role" placeholder="Nama Role">
					</div>
				</div>
				<div class="modal-footer bg-whitesmoke">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>


<form action="<?= base_url('developer/editrole') ?>" method="post">
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Role User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Role</label>
						<input type="text" class="form-control role" name="role" placeholder="role">
					</div>
				</div>
				<div class="modal-footer bg-whitesmoke">
					<input name="id" class="id" hidden>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-undo"></i> Close</button>
					<button type="submit" class="btn btn-primary"><i class=" fas fa-fw fa-pencil-alt"></i>Update</button>
				</div>
			</div>
		</div>
	</div>
</form>


<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deletemodalLabel">Sudah Siap Untuk Menghapus Data?</h5>

			</div>
			<div class="modal-body">Tekan Tombol Delete Untuk Menghapus Data</div>
			<form id="formdelete" action="" method="POST">
				<div class="modal-footer bg-whitesmoke">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-undo"></i> Close</button>
					<button type="submit" class="btn btn-danger btn-ok" id="deletemenuu"><i class="far fa-trash-alt"></i> Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('.btn-edit').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const role = $(this).data('role');
			// Set data to Form Edit
			$('.id').val(id);
			$('.role').val(role);
			// Call Modal Edit
			$('#editModal').modal('show');
		});
	});
</script>