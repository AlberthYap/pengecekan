<div class="main-content">
	<section class="section">

		<div class="row">
			<div class="col-12">

				<div class="section-body">
					<div class="card">
						<div class="card-header">
							<h4>Data User</h4>
						</div>
						<?= $this->session->flashdata('message'); ?>
						<div class="card-body table-responsive">
							<table class="table table-striped text-center" id="table_id">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nama</th>
										<th scope="col">Username</th>
										<th scope="col">No HP</th>
										<th scope="col">Role</th>
										<th scope="col">Action</th>

									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($isiUser as $iu) : ?>
										<?php if ($user['role_id'] == 1) : ?>
											<?php if ($iu['role_id'] != 1 and $iu['deleted'] == 0) : ?>
												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $iu['nama']; ?></td>
													<td><?= $iu['username']; ?></td>
													<td><?= $iu['nohp']; ?></td>
													<td><?= $iu['nama_role']; ?></td>
													<td>
														<a href="#" class="badge badge-success btn-edit" data-id="<?= $iu['id']; ?>" data-nama="<?= $iu['nama']; ?>" data-username="<?= $iu['username']; ?>" data-role="<?= $iu['role_id']; ?>" data-nohp="<?= $iu['nohp']; ?>" data-gambar="<?= base_url('assets/img/avatar/') . $iu['foto'] ?>"><i class=" fas fa-fw fa-pencil-alt"></i>Edit</a>
														<a href="#" class="badge badge-danger btn-hapus" data-id="<?= $iu['id']; ?>" data-nama="<?= $iu['nama']; ?>"><i class="far fa-trash-alt"></i> Delete</a>
													</td>
												</tr>
												<?php $i++ ?>
											<?php endif; ?>
										<?php else :  ?>
											<?php if (($iu['role_id'] != 1 and $iu['role_id'] != 2) and $iu['deleted'] == 0) : ?>
												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $iu['nama']; ?></td>
													<td><?= $iu['username']; ?></td>
													<td><?= $iu['nohp']; ?></td>
													<td><?= $iu['nama_role']; ?></td>
													<td>
														<a href="#" class="badge badge-success btn-edit" data-id="<?= $iu['id']; ?>" data-nama="<?= $iu['nama']; ?>" data-username="<?= $iu['username']; ?>" data-role="<?= $iu['role_id']; ?>" data-nohp="<?= $iu['nohp']; ?>" data-gambar="<?= base_url('assets/img/avatar/') . $iu['foto'] ?>"><i class=" fas fa-fw fa-pencil-alt"></i>Edit</a>
														<a href="#" class="badge badge-danger btn-hapus" data-id="<?= $iu['id']; ?>" data-nama="<?= $iu['nama']; ?>"><i class="far fa-trash-alt"></i> Delete</a>
													</td>
												</tr>
												<?php $i++ ?>
											<?php endif; ?>
										<?php endif; ?>
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


<form action="<?= base_url('admin/editrolestatus') ?>" method="post" enctype="multipart/form-data">
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
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Username : </label>
						<input type="text" class="form-control username col-sm-9" name="username" placeholder="username" readonly>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Nama</label>
						<input type="text" class="form-control nama col-sm-9" name="nama" placeholder="Nama">
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">No HP</label>
						<input type="text" class="form-control nohp col-sm-9" name="nohp" placeholder="No HP">
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Role</label>
						<select name="role_id" id="role_id" class="form-control role col-sm-9">
							<?php foreach ($role as $r) : ?>
								<?php if ($r['id_role'] == $isiUser['role_id']) : ?>
									<option value="<?= $r['id_role']; ?>" selected><?= $r['nama_role']; ?></option>
								<?php else : ?>
									<?php if ($user['role_id'] == 1) : ?>
										<option value="<?= $r['id_role']; ?>"><?= $r['nama_role']; ?></option>
									<?php else :  ?>
										<?php if ($r['id_role'] != 1) : ?>
											<option value="<?= $r['id_role']; ?>"><?= $r['nama_role']; ?></option>
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>

							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group row">
						<label for="foto" class="col-sm-3 col-form-label">Foto Profile</label>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-3">
									<img id="gambar" class="img-thumbnail">
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
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Password</label>
						<input type="password" class="form-control col-sm-9" name="password" id="password" placeholder="Password Anda" required>
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


<form action="<?= base_url('admin/hapususer') ?>" method="post">
	<div class="modal fade" id="deleteemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deletemodalLabel"></h5>
				</div>


				<div class="modal-body">
					<div class="form-group">
						<label>Masukkan Password Terlebih Dahulu</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Password Anda" required>
					</div>
				</div>

				<div class="modal-footer bg-whitesmoke">
					<input name="id" class="id" hidden>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-undo"></i> Close</button>
					<button type="submit" class="btn btn-danger btn-ok" id="deletemenuu"><i class="far fa-trash-alt"></i> Delete</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$(document).ready(function() {
		$('.btn-edit').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const nama = $(this).data('nama');
			const username = $(this).data('username');
			const role = $(this).data('role');
			const nohp = $(this).data('nohp');
			const gambar = $(this).data('gambar');
			// Set data to Form Edit
			$('.id').val(id);
			$('.nama').val(nama);
			$('.username').val(username);
			$('.role').val(role);
			$('.nohp').val(nohp);
			$('#gambar').attr('src', gambar);

			// Call Modal Edit
			$('#editModal').modal('show');
		});
	});

	$(document).ready(function() {
		$('.btn-hapus').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const nama = $(this).data('nama');

			// Set data to Form Edit
			$('.id').val(id);
			document.getElementById("deletemodalLabel").innerHTML = "Sudah Siap Menghapus User " + nama;
			// Call Modal Edit
			$('#deleteemodal').modal('show');
		});
	});
</script>
