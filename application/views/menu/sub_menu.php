<div class="main-content">
	<section class="section">



		<div class="row">
			<div class="col-12">

				<div class="section-body">
					<div class="card">
						<div class="card-header">
							<h4><?= $title; ?></h4>
						</div>

						<?php if (validation_errors()) : ?>
							<div class="alert alert-danger" role="alert">
								<?= validation_errors(); ?>
							</div>
						<?php endif; ?>
						<?= $this->session->flashdata('message'); ?>
						<div class="card-body table-responsive">

							<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Sub Menu Baru</a>
							<table class="table table-striped text-center" id="table_id">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Sub Menu</th>
										<th scope="col">Icon</th>
										<th scope="col">Menu</th>
										<th scope="col">Tipe Menu</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($subMenu as $sm) : ?>
										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><?= $sm['sub']; ?></td>
											<td> <i class="<?= $sm['icon']; ?>"></i></td>
											<td><?= $sm['menu']; ?></td>
											<td>
												<?php if ($sm['tipe'] == 0) :  ?>
													Drop Down
												<?php elseif ($sm['tipe'] == 1) :  ?>
													Tanpa Drop Down
												<?php endif; ?>
											</td>
											<td>
												<a href="#" class="badge badge-success btn-edit" data-id="<?= $sm['id_sub']; ?>" data-sub="<?= $sm['sub']; ?>" data-icon="<?= $sm['icon']; ?>" data-menu="<?= $sm['menu_id']; ?>" data-tipe="<?= $sm['tipe']; ?>"><i class=" fas fa-fw fa-pencil-alt"></i>Edit</a>
												<a href="#deletemodal" class="badge badge-danger" data-toggle="modal" onclick="$('#deletemodal #formdelete').attr('action', '<?= site_url('developer/hapussub/' .  $sm['id_sub']) ?>')"><i class="far fa-trash-alt"></i> Delete</a>
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

<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newSubMenuModalLabel">Tambah Sub Menu Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('developer/subMenu'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="sub" name="sub" placeholder="Nama Sub Menu">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="icon" name="icon" placeholder="Masukkan Icon">
					</div>
					<div class="form-group">
						<select name="menu_id" id="menu_id" class="form-control">
							<?php foreach ($menu as $m) : ?>
								<option value="<?= $m['id_menu'] ?>"><?= $m['menu']; ?></option>

							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" aria-label="Default select example" name="tipe" id="tipe">
							<option value="0">Drop Down</option>
							<option value="1">Tanpa Drop Down</option>
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

<form action="<?= base_url('developer/editsub') ?>" method="post">
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Sub Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label>Sub Menu</label>
						<input type="text" class="form-control sub" name="sub" placeholder="Nama Sub">
					</div>
					<div class="form-group">
						<label>Icon</label>
						<input type="text" class="form-control icon" name="icon" placeholder="Icon">
					</div>
					<div class="form-group">
						<label>Menu</label>
						<select name="menu_id" id="menu_id" class="form-control menu_id">
							<?php foreach ($menu as $m) : ?>
								<?php if ($m['id_menu'] == $submenu['menu_id']) : ?>
									<option value="<?= $m['id_menu']; ?>" selected><?= $m['menu']; ?></option>
								<?php else : ?>
									<option value="<?= $m['id_menu']; ?>"><?= $m['menu']; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Tipe Menu</label>
						<select name="tipe" id="tipee" class="form-control tipe">
							<option value="0">Drop Down</option>
							<option value="1">Tanpa Drop Down</option>

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
			const sub = $(this).data('sub');
			const icon = $(this).data('icon');
			const menu = $(this).data('menu');
			const tipe = $(this).data('tipe');
			// Set data to Form Edit
			$('.id').val(id);
			$('.sub').val(sub);
			$('.icon').val(icon);
			$('.menu_id').val(menu);
			$('#tipee').val(tipe).change();
			// Call Modal Edit
			$('#editModal').modal('show');
		});
	});
</script>
