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
										<th scope="col">Nama Lengkap</th>
										<th scope="col">Username</th>
										<th scope="col">No HP</th>
										<th scope="col">Unit</th>
										<th scope="col">Role</th>
										<th scope="col">Status</th>
										<th scope="col">Action</th>

									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($userJoin as $uj) : ?>
										<?php if ($user['role_id'] == 1) : ?>
											<?php if ($uj['role_id'] != 1) : ?>
												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $uj['nama_depan']; ?> <?= $uj['nama_belakang']; ?></td>
													<td><?= $uj['username']; ?></td>
													<td><?= $uj['nohp']; ?></td>
													<td><?= $uj['nama_unit']; ?></td>
													<td><?= $uj['nama_role']; ?></td>
													<td>
														<?php if ($uj['active'] == 1) : ?>
															Aktif
														<?php elseif ($uj['active'] == 0) :  ?>
															Tidak Aktif
														<?php endif; ?>
													</td>
													<td>
														<a href="#" class="badge badge-success btn-edit" data-id="<?= $uj['id_user']; ?>" data-nama="<?= $uj['nama_depan']; ?>" data-namabel="<?= $uj['nama_belakang']; ?>" data-username="<?= $uj['username']; ?>" data-role="<?= $uj['role_id']; ?>" data-nohp="<?= $uj['nohp']; ?>" data-gambar="<?= base_url('assets/img/avatar/') . $uj['foto_user'] ?>" data-unit="<?= $uj['unit_id']; ?>"><i class=" fas fa-fw fa-pencil-alt"></i>Edit</a>
														<?php if ($uj['active'] == 1) : ?>
															<a href="#" class="badge badge-danger btn-hapus" data-id="<?= $uj['id_user']; ?>" data-nama="<?= $uj['nama_depan']; ?>"><i class="far fa-trash-alt"></i> <small>Deactivate</small> </a>
														<?php elseif ($uj['active'] == 0) : ?>
															<a href="#" class="badge badge-warning btn-aktif" data-id="<?= $uj['id_user']; ?>" data-nama="<?= $uj['nama_depan']; ?>"><i class="far fa-trash-alt"></i> <small>Activate</small> </a>
														<?php endif; ?>
													</td>
												</tr>
												<?php $i++ ?>
											<?php endif; ?>
										<?php else :  ?>
											<?php if (($uj['role_id'] != 1 and $uj['role_id'] != 2)) : ?>
												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $uj['nama']; ?></td>
													<td><?= $uj['username']; ?></td>
													<td><?= $uj['nohp']; ?></td>
													<td><?= $uj['nama_role']; ?></td>
													<td>
														<?php if ($uj['active'] == 1) : ?>
															<a href="#" class="badge badge-danger btn-hapus" data-id="<?= $uj['id_user']; ?>" data-nama="<?= $uj['nama_depan']; ?>"><i class="far fa-trash-alt"></i> <small>Deactivate</small> </a>
														<?php elseif ($uj['active'] == 0) : ?>
															<a href="#" class="badge badge-warning btn-hapus" data-id="<?= $uj['id_user']; ?>" data-nama="<?= $uj['nama_depan']; ?>"><i class="far fa-trash-alt"></i> <small>Activate</small> </a>
														<?php endif; ?>
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


<form action="<?= base_url('developer/editdatauser') ?>" method="post" enctype="multipart/form-data" id="editdata">
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Role User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label>Username </label>
							<input type="text" class="form-control username" name="username" placeholder="username" readonly>
						</div>
						<div class="form-group col-sm-6">
							<label>No HP</label>
							<input type="text" class="form-control nohp" name="nohp" placeholder="No HP">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label>Nama Depan</label>
							<input type="text" class="form-control nama" name="nama" placeholder="Nama Depan">
						</div>
						<div class="form-group col-sm-6">
							<label>Nama Belakang</label>
							<input type="text" class="form-control namabel" name="namabel" placeholder="Nama Belakang">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Role</label>
							<select name="role_id" id="role_id" class="form-control role">
								<?php foreach ($role as $r) : ?>
									<?php if ($r['id_role']) : ?>
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

						<div class="form-group col-md-6">
							<label>Unit</label>
							<select name="unit_id" id="unit_id" class="form-control unit">
								<?php foreach ($unit as $u) : ?>
									<?php if ($u['id_unit']) : ?>
										<option value="<?= $u['id_unit']; ?>" selected><?= $u['nama_unit']; ?></option>
									<?php else : ?>
										<?php if ($user['role_id'] == 1) : ?>
											<option value="<?= $u['id_unit']; ?>"><?= $u['nama_unit']; ?></option>
										<?php else :  ?>
											<?php if ($u['id_unit'] != 1) : ?>
												<option value="<?= $u['id_unit']; ?>"><?= $u['nama_unit']; ?></option>
											<?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>

								<?php endforeach; ?>
							</select>
						</div>
					</div>


					<div class="form-group row">
						<label for="foto" class="col-sm-2 col-form-label">Foto Profile</label>
						<div class="col-sm-10">
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
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Password Baru (Kosongkan Jika Tidak Mengubah)</label>
							<input type="password" class="form-control" name="password1" id="password1" placeholder="Password Baru">
						</div>
						<div class="form-group col-md-6">
							<label>Ulang Password Baru </label>
							<input type="password" class="form-control" name="password2" id="password2" placeholder="Ulang Password Baru">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Password Anda </label>
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


<form action="<?= base_url('developer/hapususer') ?>" method="post">
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
					<button type="submit" class="btn btn-danger btn-ok" id="deletemenuu" name="deactive"><i class="far fa-trash-alt"></i> Delete</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form action="<?= base_url('developer/hapususer') ?>" method="post">
	<div class="modal fade" id="aktifmodal" tabindex="-1" role="dialog" aria-labelledby="aktifmodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="aktifmodalLabel"></h5>
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
					<button type="submit" class="btn btn-warning btn-ok" id="aktifmenuu" name="active"><i class="far fa-trash-alt"></i> Activate</button>
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
			const namabel = $(this).data('namabel');
			const username = $(this).data('username');
			const role = $(this).data('role');
			const unit = $(this).data('unit');
			const nohp = $(this).data('nohp');
			const gambar = $(this).data('gambar');
			// Set data to Form Edit
			$('.id').val(id);
			$('.nama').val(nama);
			$('.namabel').val(namabel);
			$('.username').val(username);
			$('.role').val(role);
			$('.unit').val(unit);
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

	$(document).ready(function() {
		$('.btn-aktif').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const nama = $(this).data('nama');

			// Set data to Form Edit
			$('.id').val(id);
			document.getElementById("aktifmodalLabel").innerHTML = "Sudah Siap Mengaktifkan User " + nama;
			// Call Modal Edit
			$('#aktifmodal').modal('show');
		});
	});

	$(document).ready(function() {
		$('#editdata').submit(function(e) {
			var form = this;
			e.preventDefault();
			// Check Passwords are the same
			if ($('#password1').val() == $('#password2').val()) {
				form.submit();
			} else {
				alert('Password Baru Tidak Sama');
				return false;
			}
		});
	});
</script>