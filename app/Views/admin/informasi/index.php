<?= $this->extend('admin/layout/main_layout'); ?>
<!-- MAIN CONTENT -->
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard'); ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= $title; ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<!-- <span><a onclick="_tambahData()"><button type="button" class="btn bg-gradient-primary"><i class="nav-icon fas fa-plus"></i> Tambah Data</button></a></span> -->
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= form_open() ?>
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width:20px;">No</th>
										<th colspan="2" style="text-align: center;">DATA INFORMASI</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td style="width: 400px;">Nama Sistem</td>
										<td>Penerimaan Penerimaan Peserta Didik Baru</td>
									</tr>
									<tr>
										<td>2</td>
										<td style="width: 400px;">Deskripsi Sistem</td>
										<td>Sistem ini digunakan untuk manajemen Penerimaan Peserta Didik Baru</td>
									</tr>
									<tr>
										<td>3</td>
										<td style="width: 400px;">Tujuan Pengembangan</td>
										<td>Pendaftaran sekolah jauh lebih mudah dan dapat dikelola dengan baik oleh pihak sekolah</td>
									</tr>
									<tr>
										<td>4</td>
										<td style="width: 400px;">Hak Akses Pengguna</td>
										<td>
											<ul class="mb-0">
												<li><strong>Admin:</strong> Manajemen pengguna, kontrol penuh sistem</li>
												<li><strong>User:</strong> pengelolaan laporan PPDB</li>
											</ul>
										</td>
									</tr>
									<tr>
										<td>5</td>
										<td style="width: 400px;">Teknologi & Tools yang Digunakan</td>
										<td>
											<ul class="mb-0">
												<li><strong>Framework Backend:</strong> CodeIgniter 4 (PHP 7.4+)</li>
												<li><strong>Database:</strong> MySQL / MariaDB</li>
												<li><strong>Frontend:</strong> Bootstrap 4, jQuery, DataTables</li>
												<li><strong>Server:</strong> Apache / Nginx</li>
												<li><strong>Version Control:</strong> Git (GitHub / GitLab)</li>
												<li><strong>Tools Pengembangan:</strong> VS Code, XAMPP</li>
												<li><strong>Template:</strong> AdminLTE 3</li>
											</ul>
										</td>
									</tr>
									<tr>
										<td>6</td>
										<td style="width: 400px;">Kontak Pengembang</td>
										<td>
											<ul class="mb-0">
												<li><strong>Email:</strong> sriwijayabersamateknologi@gmail.com</li>
												<!-- <li><strong>Website:</strong> sribertech.shop</li> -->
												<li><strong>Github:</strong> https://github.com/redhorivai</li>
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
							<?= form_close() ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- Modal -->
<!-- Modal -->
<!-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" id='form' class="form-data">
				<input type="hidden" name="id">
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group">
							<label>Nama: <span class='text-danger'>*</span></label>
							<input type="text" class="form-control" id="nama" name="nama" placeholder="masukan nama" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Jenis kelamin: <span class='text-danger'>*</span></label>
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="jenis_kelamin" name="jenis_kelamin" data-allow-clear="true" style="width:100%">
								<option disabled selected>-- Pilih Jenis Kelamin --</option>
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Telepon: <span class='text-danger'>*</span></label>
							<input type="number" class="form-control" id="telepon" name="telepon" placeholder="masukan telepon" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Email: <span class='text-danger'>*</span></label>
							<input type="email" class="form-control" id="email" name="email" placeholder="masukan email" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Username: <span class='text-danger'>*</span></label>
							<input type="email" class="form-control" id="username" name="username" placeholder="masukan username" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Level Akses: <span class='text-danger'>*</span></label>
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="level" name="level" data-allow-clear="true" style="width:100%">
								<option disabled selected>-- Pilih Level Akses --</option>
								<option value="user">User</option>
								<option value="admin">Admin</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat: <span class='text-danger'>*</span></label>
							<textarea rows="3" id="alamat" name="alamat" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-primary" onclick="_simpanData()">Simpan Data</button>
				</div>
			</form>
		</div>
	</div>
</div> -->
<!-- /.modal -->
<?= $this->endSection() ?>
