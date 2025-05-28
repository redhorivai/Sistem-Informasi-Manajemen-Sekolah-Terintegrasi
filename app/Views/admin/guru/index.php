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
							<span><a onclick="_tambahData()"><button type="button" class="btn bg-gradient-primary"><i class="nav-icon fas fa-plus"></i> Tambah Data</button></a></span>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= form_open() ?>
							<table id="viewTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width:20px;">No</th>
										<th>Nama Lengkap</th>
										<th>NUPTK</th>
										<th>Status</th>
										<th>Jabatan</th>
										<th style="width: 167px;">Aksi</th>
									</tr>
								</thead>
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
<!-- awal modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" id='formInput' class="form-data">
				<input type="hidden" name="id">
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group">
							<label>Nama Lengkap: <span class='text-danger'>*</span></label>
							<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="masukan nama lengkap" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Gelar Belakang: <span class='text-danger'>*</span></label>
							<input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" placeholder="masukan gelar belakang" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>NIK: <span class='text-danger'>*</span></label>
							<input type="int" class="form-control" id="nik" name="nik" placeholder="masukan nik" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>NUPTK: <span class='text-danger'>*</span></label>
							<input type="text" class="form-control" id="nuptk" name="nuptk" placeholder="masukan nuptk" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Email: <span class='text-danger'>*</span></label>
							<input type="email" class="form-control" id="email" name="email" placeholder="masukan email" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Telepon: <span class='text-danger'>*</span></label>
							<input type="int" class="form-control" id="telepon" name="telepon" placeholder="masukan telepon" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin: <span class='text-danger'>*</span></label>
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="jenis_kelamin" name="jenis_kelamin" data-allow-clear="true" style="width:100%">
								<option disabled selected>-- Pilih Jenis Kelamin --</option>
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat: </label>
							<textarea rows="3" id="alamat" name="alamat" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Status: <span class='text-danger'>*</span></label>
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="status" name="status" data-allow-clear="true" style="width:100%">
								<option disabled selected>-- Pilih Jenis Status --</option>
								<option value="asn">ASN</option>
								<option value="pppk">PPPK</option>
								<option value="non_pnsd">Non PNSD</option>
							</select>
						</div>
						<div class="form-group">
							<label>Jabatan: <span class='text-danger'>*</span></label>
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="jabatan" name="jabatan" data-allow-clear="true" style="width:100%">
								<option disabled selected>-- Pilih Jenis Jabatan --</option>
								<option value="wali_kelas">Wali Kelas</option>
								<option value="guru_matapelajaran">Guru Mata Pelajaran</option>
							</select>
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
</div>
<!-- akhir moda -->
<?= $this->endSection() ?>