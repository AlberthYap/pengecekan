<!-- untuk mengisi sidebar harus mengisi menu, sub menu dan isi menu terlebih dahulu -->

<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?= base_url('dashboard'); ?>"><img src="<?= base_url('assets/img/logoap1bali.png') ?>" alt="" width="75%" height="75%"></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="">AP1</a>
		</div>
		<ul class="sidebar-menu">



			<!-- QUERY MENU-->
			<?php
			$role_id = $this->session->userdata('role_id');
			$queryMenu = "SELECT `user_menu`.*
							FROM `user_menu`
							JOIN `user_access`
							ON `user_menu`.`id_menu` = `user_access`.`menu_id`
							WHERE `user_access`.`role_id` = $role_id 
						   ORDER BY `user_menu`.`id_menu` DESC
						 ";
			$menu = $this->db->query($queryMenu)->result_array();

			?>

			<?php foreach ($menu as $m) :  ?>
				<li class="menu-header">
					<?php if ($m['id_menu'] != 3) :  ?>
						<?= $m['menu']; ?>
					<?php endif; ?>
				</li>
				<?php
				$menuId = $m['id_menu'];
				$querySub = "SELECT * FROM `user_sub_menu` JOIN `user_menu`
							ON `user_sub_menu`.`menu_id` = `user_menu`.`id_menu`
						WHERE `user_sub_menu`.`menu_id` = $menuId
								";
				$subMenu = $this->db->query($querySub)->result_array();
				?>
				<?php foreach ($subMenu as $sm) : ?>
					<?php
					$subId = $sm['id_sub'];
					$queryIsi = "SELECT * FROM `user_isi` JOIN `user_sub_menu`
							ON `user_isi`.`sub_id` = `user_sub_menu`.`id_sub`
						WHERE `user_isi`.`sub_id` = $subId
								";
					$isiMenu = $this->db->query($queryIsi)->result_array();

					?>

					<?php if ($sm['tipe'] == 0 && $m['id_menu'] != 3) :  ?>
						<?php if ($lokasi == $sm['sub']) :  ?>
							<li class="nav-item dropdown active">
								<a href="#" class="nav-link has-dropdown"><i class="<?= ($sm['icon']); ?>"></i><span><?= ($sm['sub']); ?></span></a>
							<?php else : ?>
							<li class="nav-item dropdown">
								<a href="#" class="nav-link has-dropdown"><i class="<?= ($sm['icon']); ?>"></i><span><?= ($sm['sub']); ?></span></a>

							<?php endif; ?>

							<ul class="dropdown-menu">
								<?php foreach ($isiMenu as $im) : ?>
									<?php if ($title == $im['title']) :  ?>
										<li class="active"><a class="nav-link" href="<?= base_url($im['url']); ?>"><?= $im['title']; ?></a></li>
									<?php else : ?>
										<li><a class="nav-link" href="<?= base_url($im['url']); ?>"><?= $im['title']; ?></a></li>

									<?php endif; ?>

								<?php endforeach; ?>

							</ul>
							</li>
						<?php elseif ($sm['tipe'] == 1) : ?>
							<?php foreach ($isiMenu as $im) : ?>
								<?php if ($lokasi == $sm['sub']) :  ?>
									<li class="active">
										<a href="<?= base_url($im['url']) ?>" class="nav-link"><i class="<?= ($sm['icon']); ?>"></i><span><?= ($sm['sub']); ?></span></a>
									</li>
								<?php else :  ?>
									<li>
										<a href="<?= base_url($im['url']) ?>" class="nav-link"><i class="<?= ($sm['icon']); ?>"></i><span><?= ($sm['sub']); ?></span></a>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>


					<?php endforeach; ?>
				<?php endforeach; ?>
				<!-- <li class="menu-header"> Logout
				</li>
				<li>
					<a href="<?= base_url('auth/logout'); ?>" class="nav-link text-danger" data-toggle="modal" data-target="#logoutmodal">
						<i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span>
					</a>
				</li> -->


		</ul>


	</aside>
</div>