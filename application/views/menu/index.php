<div class="main-content">
	<section class="section">


		<div class="row">
			<div class="col-12">
				<div class="section-body">
					<div class="card">
						<div class="card-header">
							<h4><?= $title; ?></h4>
						</div>
						<?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
						<?= $this->session->flashdata('message'); ?>


						<div class="card">
							<div class="card-body col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 table-responsive">


								<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Tambah Menu Baru</a>
								<table class="table table-striped text-center" id="table_id">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Menu</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; ?>
										<?php foreach ($menu as $m) : ?>
											<tr>
												<th scope="row"><?= $i; ?></th>
												<td><?= $m['menu']; ?></td>
												<td>
													<a href="#" class="badge badge-success btn-edit" data-id="<?= $m['id_menu']; ?>" data-menu="<?= $m['menu']; ?>"><i class=" fas fa-fw fa-pencil-alt"></i>Edit</a>
													<a href="#deletemodal" class="badge badge-danger" data-toggle="modal" onclick="$('#deletemodal #formdelete').attr('action', '<?= site_url('developer/hapusmenu/' .  $m['id_menu']) ?>')"><i class="far fa-trash-alt"></i> Delete</a>
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

<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newMenuModalLabel">Tambah Menu Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('developer/menu'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="formGroupExampleInput">Tambah Menu Baru</label>
						<input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
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

<form action="<?= base_url('developer/editmenu') ?>" method="post">
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label>Menu</label>
						<input type="text" class="form-control menu_baru" name="menu" placeholder="Nama Menu">
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
			const menu = $(this).data('menu');

			// Set data to Form Edit
			$('.id').val(id);
			$('.menu_baru').val(menu);
			// Call Modal Edit
			$('#editModal').modal('show');
		});

	});
</script>
