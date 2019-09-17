<!DOCTYPE html>

<html lang="en">

<head>
	<base href="./">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Login</title>

	<link rel="stylesheet" href="<?=base_url('assets/vendors/font-awesome/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/perfect-scrollbar/css/perfect-scrollbar.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/coreui/icons/css/coreui-icons.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/coreui/css/style.min.css')?>">
	<link rel="icon" href="<?=base_url('files/navicon.png')?>">
	<script src="<?=base_url('assets/vendors/jquery/jquery-3.4.1.min.js')?>"></script>
	<script src="<?=base_url('assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js')?>"></script>
	<script src="<?=base_url('assets/vendors/coreui/js/coreui.min.js')?>"></script>

</head>

<body class="app flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card-group">
					<div class="card p-4">
						<form action="<?=base_url('login')?>" method="post" class="card-body">
							<h1>Login</h1>
							<p class="text-muted">Sign In to your account</p>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fa fa-user"></i>
									</span>
								</div>
								<input class="form-control" name="username" type="text" placeholder="Username" required>
							</div>
							<div class="input-group mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fa fa-lock"></i>
									</span>
								</div>
								<input class="form-control" name="password" type="password" placeholder="Password">
							</div>
							<div class="row">
								<div class="col-6">
									<button class="btn btn-primary px-4" type="submit">Login</button>
								</div>
								<div class="col-6 text-right">
									<button class="btn btn-link px-0" type="button">Forgot password?</button>
									<a class="btn btn-link px-0" href="<?=base_url()?>">Home</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>