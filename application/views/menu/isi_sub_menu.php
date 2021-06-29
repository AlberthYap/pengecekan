<div class="main-content">
	<section class="section">

		<div class="row">
			<div class="col-12">

				<div class="section-body">
					<div class="card">
						<div class="card-header">
							<h4><?= $title; ?></h4>
						</div>
						<?= $this->session->flashdata('message'); ?>
						<div class="card-body table-responsive">

							<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newIsiMenuModal">Tambah Isi Sub Menu Baru</a>
							<table class="table table-striped text-center" id="table_id">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Isi Sub Menu</th>
										<th scope="col">URL</th>
										<th scope="col">Sub Menu</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($isiMenu as $im) : ?>
										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><?= $im['title']; ?></td>
											<td> <?= $im['url']; ?></td>
											<td><?= $im['sub']; ?></td>
											<td>
												<a href="#" class="badge badge-success btn-edit" data-id="<?= $im['id_isi']; ?>" data-title="<?= $im['title']; ?>" data-url="<?= $im['url']; ?>" data-sub="<?= $im['sub_id']; ?>"><i class=" fas fa-fw fa-pencil-alt"></i>Edit</a>
												<a href="#deletemodal" class="badge badge-danger" data-toggle="modal" onclick="$('#deletemodal #formdelete').attr('action', '<?= site_url('developer/hapusisi/' .  $im['id_isi']) ?>')"><i class="far fa-trash-alt"></i> Delete</a>

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

<div class="modal fade" id="newIsiMenuModal" tabindex="-1" aria-labelledby="newIsiMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newIsiMenuModalLabel">Tambah Isi Sub Menu Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('developer/isiMenu'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="title" name="title" placeholder="Nama Isi Sub Menu">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="url" name="url" placeholder="Masukkan URL">
					</div>
					<div class="form-group">
						<select name="sub_id" id="sub_id" class="form-control">
							<?php foreach ($submenu as $sm) : ?>
								<option value="<?= $sm['id_sub'] ?>"><?= $sm['sub']; ?></option>

							<?php endforeach; ?>
						</select>
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


<form action="<?= base_url('developer/editisi') ?>" method="post">
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Isi Sub Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Isi Sub Menu</label>
						<input type="text" class="form-control isi" name="isi" placeholder="Nama Isi Sub">
					</div>
					<div class="form-group">
						<label>Icon</label>
						<input type="text" class="form-control url" name="url" placeholder="Url">
					</div>
					<div class="form-group">
						<label>Sub Menu</label>
						<select name="sub_id" id="sub_id" class="form-control sub_id">
							<?php foreach ($submenu as $sm) : ?>
								<?php if ($sm['id_sub'] == $isimenu['sub_id']) : ?>
									<option value="<?= $sm['id_sub']; ?>" selected><?= $sm['sub']; ?></option>
								<?php else : ?>
									<option value="<?= $sm['id_sub']; ?>"><?= $sm['sub']; ?></option>
								<?php endif; ?>

							<?php endforeach; ?>
						</select>
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
			const title = $(this).data('title');
			const url = $(this).data('url');
			const sub = $(this).data('sub');
			// Set data to Form Edit
			$('.id').val(id);
			$('.isi').val(title);
			$('.url').val(url);
			$('.sub_id').val(sub);
			// Call Modal Edit
			$('#editModal').modal('show');
		});
	});
</script>
