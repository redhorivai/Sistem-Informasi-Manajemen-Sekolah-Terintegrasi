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
										<th>Kode Jurusan</th>
										<th>Nama Jurusan</th>
										<th>Keterangan</th>
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
							<label>Kode Jurusan: <span class='text-danger'>*</span></label>
							<input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan" placeholder="masukan kode jurusan" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Nama Jurusan: <span class='text-danger'>*</span></label>
							<input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="masukan nama jurusan" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Keterangan: </label>
							<textarea rows="3" id="keterangan" name="keterangan" class="form-control"></textarea>
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