<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Informasi Manajemen Sekolah Terintegrasi - SiMaKora</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/css/adminlte.min.css">
	<!-- Toast -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/toastr/toastr.min.css">

</head>

<body class="hold-transition login-page" style="background: url('<?= base_url();?>/assets-admin/img/bg.svg');">
	<div class="login-box" id="main-content">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="javascript:void(0)" class="h1"><b>Admin </b>Panel</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Silakan Masuk</p>

				<form id="login_form" method="post">
					<?= csrf_field(); ?>
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" style="text-transform:lowercase;">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember">
								<label for="remember">
									Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button id="btnLogin" type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->
	<?php
	if (!empty(session()->getFlashdata('sukses'))) {
		echo '<div class="flash_msg" data-successful="' . session()->getFlashdata('sukses') . '"></div>';
	} else if (!empty(session()->getFlashdata('gagal'))) {
		echo '<div class="flash_msg" data-failed="' . session()->getFlashdata('gagal') . '"></div>';
	} else if (!empty(session()->getFlashdata('error'))) {
		echo '<div class="flash_msg" data-goofy="' . session()->getFlashdata('error') . '"></div>';
	}
	?>

	<!-- jQuery -->
	<script src="<?= base_url(); ?>/assets-admin/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url(); ?>/assets-admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>/assets-admin/js/adminlte.min.js"></script>
	<!-- Toast -->
	<script src="<?= base_url(); ?>/assets-admin/plugins/toastr/toastr.min.js"></script>
	<!-- validate -->
	<script src="<?= base_url(); ?>/assets-admin/js/validasi-login.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#login_form').submit(function(e) {
				e.preventDefault();

				let username = $('#username').val().trim();
				let password = $('#password').val().trim();

				if (username === "") {
					toastr.warning('Silakan masukan username anda');
					$('#username').focus();
					return;
				} else if (password === "") {
					toastr.warning('Silakan masukan kata sandi anda');
					$('#password').focus();
					return;
				}

				$.ajax({
					type: "POST",
					url: "<?= base_url('login/get_login'); ?>",
					data: $(this).serialize(),
					dataType: "JSON",
					beforeSend: function() {
						$('#btnLogin').prop('disabled', true).text('Memproses...');
					},
					success: function(response) {
						toastr.options = {
							"closeButton": true,
							"progressBar": true,
							"positionClass": "toast-top-center",
							"timeOut": "2000"
						};

						if (response.status === true) {
							toastr.success(response.message);
							setTimeout(() => {
								window.location.href = "<?= base_url('/admin/dashboard'); ?>";
							}, 2000);
						} else {
							toastr.error(response.message || "Login gagal. Silakan coba lagi.");
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
						toastr.error('Terjadi kesalahan pada server.');
					},
					complete: function() {
						$('#btnLogin').prop('disabled', false).text('Login');
					}
				});
			});
		});
	</script>

</body>

</html>