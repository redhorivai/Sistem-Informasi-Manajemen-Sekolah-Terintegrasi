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
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Form Pengaturan Website</h3>
						</div>
						<form action="javascript:void(0)" id='formInput' class="form-data">
							<?php foreach ($pengaturan as $key): ?>
								<input type="hidden" name="id" value="<?= $key->id; ?>">
								<div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<label>Nama Sekolah <span class='text-danger'>*</span></label>
												<input type="text" value="<?= $key->nama_sekolah; ?>" name="nama_sekolah" class="form-control" id="nama_sekolah" placeholder="">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label>Telepon Sekolah <span class='text-danger'>*</span></label>
												<input type="int" value="<?= $key->telepon_sekolah; ?>" name="telepon_sekolah" class="form-control" id="telepon_sekolah" placeholder="">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label>Email Sekolah <span class='text-danger'>*</span></label>
												<input type="email" class="form-control" value="<?= $key->email_sekolah; ?>" name="email_sekolah" id="email_sekolah" placeholder="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<label>Link Facebook</label>
												<input type="text" value="<?= $key->link_facebook; ?>" class="form-control" name="link_facebook" id="link_facebook" placeholder="">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label>Link Youtube</label>
												<input type="text" value="<?= $key->link_youtube; ?>" class="form-control" name="link_youtube" id="link_youtube" placeholder="">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label>Link Instagram</label>
												<input type="text" value="<?= $key->link_instagram; ?>" class="form-control" name="link_instagram" id="link_instagram" placeholder="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Deskripsi Sekolah</label>
												<textarea rows="5" id="deskripsi_sekolah" name="deskripsi_sekolah" class="form-control"><?= $key->deskripsi_sekolah; ?></textarea>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Alamat Sekolah</label>
												<textarea rows="5" id="alamat_sekolah" name="alamat_sekolah" class="form-control"><?= $key->alamat_sekolah; ?></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<label for="file_icon">File Icon</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="file_icon" name="file_icon" onchange="previewImage(this, 'preview-icon')">
														<label class="custom-file-label" for="file_icon">Choose file</label>
													</div>
													<div class="input-group-append">
														<span class="input-group-text">Upload</span>
													</div>
												</div>
												<img id="preview-icon" class="img-fluid mt-2" style="max-height: 150px;" src="<?= base_url('assets-admin/uploads/' . ($key->file_icon ?: '800x600.png')) ?>" alt="Preview Icon">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label for="file_logo">File Logo</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="file_logo" name="file_logo" onchange="previewImage(this, 'preview-logo')">
														<label class="custom-file-label" for="file_logo">Choose file</label>
													</div>
													<div class="input-group-append">
														<span class="input-group-text">Upload</span>
													</div>
												</div>
											</div>
											<img id="preview-logo" class="img-fluid mt-2" style="max-height: 150px;" src="<?= base_url('assets-admin/uploads/' . ($key->file_logo ?: '800x600.png')) ?>" alt="Preview Logo">
										</div>
										<div class="col-4">
											<div class="form-group">
												<label for="file_slider">File Slider</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="file_slider" name="file_slider" onchange="previewImage(this, 'preview-slider')">
														<label class="custom-file-label" for="file_slider">Choose file</label>
													</div>
													<div class="input-group-append">
														<span class="input-group-text">Upload</span>
													</div>
												</div>
											</div>
											<img id="preview-slider" class="img-fluid mt-2" style="max-height: 150px;" src="<?= base_url('assets-admin/uploads/' . ($key->file_slider ?: '800x600.png')) ?>" alt="Preview Slider">
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<label>Deksripsi Footer</label>
												<textarea rows="5" id="deskripsi_footer" name="deskripsi_footer" class="form-control"><?= $key->deskripsi_footer; ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="card-footer">
									<button class="btn btn-primary" onclick="_updateData()">Perbarui</button>
								</div>
							<?php endforeach ?>
						</form>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<script type="text/javascript">
	var baseUrl = "<?= base_url('assets-admin/uploads') ?>/";
	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').html(fileName);
	});

	function previewImage(input, targetId) {
		const file = input.files[0];
		if (file) {
			const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
			if (!allowedTypes.includes(file.type)) {
				toastr.error("File harus berupa gambar (JPG, PNG).");
				input.value = ''; // Reset input
				document.getElementById(targetId).src = ''; // Kosongkan preview
				return;
			}

			const reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById(targetId).src = e.target.result;
			};
			reader.readAsDataURL(file);
		}
	}

	function _updateData() {

		const fields = [{
				id: "nama_sekolah",
				required: true
			},
			{
				id: "telepon_sekolah",
				required: true
			},
			{
				id: "email_sekolah",
				required: false
			}
		];

		let isValid = true;

		// Validasi input
		fields.forEach(field => {
			const $el = $("#" + field.id);
			if (field.required && !$el.val()) {
				$el.addClass("is-invalid");
				isValid = false;
			} else {
				$el.removeClass("is-invalid");
			}
		});
		if (!isValid) {
			toastr.warning("Silakan lengkapi data yang wajib diisi.");
			return;
		}

		if (confirm(`Yakin data akan disimpan?`)) {
			$.ajax({
				url: "<?= site_url('PengaturanSekolah/update_data') ?>",
				type: "POST",
				data: new FormData($('#formInput')[0]),
				dataType: 'JSON',
				contentType: false,
				processData: false,
				success: function(data) {
					if (data.sukses) {
						toastr.success(`Data berhasil disimpan`);
						// Update preview gambar jika ada data nama file baru dari response server
						if (data.file_icon) {
							$('#preview-icon').attr('src', baseUrl + data.file_icon + '?' + new Date().getTime());
						}
						if (data.file_logo) {
							$('#preview-logo').attr('src', baseUrl + data.file_logo + '?' + new Date().getTime());
						}
						if (data.file_slider) {
							$('#preview-slider').attr('src', baseUrl + data.file_slider + '?' + new Date().getTime());
						}
					} else if (data.gagal) {
						if (data.message) {
							toastr.error(data.message);
						} else {
							toastr.error("Terjadi kesalahan saat menyimpan data.");
						}
					}
				},
				error: function(xhr, status, error) {
					toastr.error("Gagal memproses permintaan.");
				}
			});
		}
	}
</script>
<?= $this->endSection() ?>