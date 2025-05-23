<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="javascript:void(0)" class="brand-link">
		<img src="<?= base_url(); ?>/assets-admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminPanel</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<?php
				if ((session()->get('jenis_kelamin')) == 'L') {
					$avatar = "<img src='" . base_url() . "/assets-admin/img/male.png' class='rounded-circle'>";
				} else {
					$avatar = "<img src='" . base_url() . "/assets-admin/img/female.png' class='rounded-circle'>";
				}
				?>
				<?= $avatar; ?>
			</div>
			<div class="info">
				<a href="javascript:void(0)" class="d-block"> <?= session()->get('username') ?>
				</a>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?php if ($active == "dashboard") {
																						echo "active";
																					} ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-header">DATA MASTER</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/pengguna') ?>" class="nav-link <?php if ($active == "pengguna") {
																					echo "active";
																				} ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Data Pengguna
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/jurusan') ?>" class="nav-link <?php if ($active == "jurusan") {
																					echo "active";
																				} ?>">
						<i class="nav-icon fas fa-book"></i>
						<p>
							Data Jurusan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/kelas') ?>" class="nav-link <?php if ($active == "kelas") {
																					echo "active";
																				} ?>">
						<i class="nav-icon fas fa-columns"></i>
						<p>
							Data Kelas
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/akademik') ?>" class="nav-link <?php if ($active == "akademik") {
																					echo "active";
																				} ?>">
						<i class="nav-icon fas fa-clock"></i>
						<p>
							Data Tahun Akademik
						</p>
					</a>
				</li>
				<li class="nav-header">LAINNYA</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/password')?>" class="nav-link <?php if ($active == "password") {
																				echo "active";
																			} ?>">
						<i class="nav-icon fas fa-key"></i>
						<p>
							Ubah Kata Sandi
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('login/logout'); ?>" class="nav-link">
						<i class="nav-icon fas fa-power-off"></i>
						<p>
							Keluar
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/informasi') ?>" class="nav-link <?php if ($active == "informasi") {
																						echo "active";
																					} ?>">
						<i class="nav-icon fas fa-info"></i>
						<p>
							Informasi
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
