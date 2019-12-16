<!-- CREATE TABLE -->
<!-- CREATE TABLE tb_admin (
id INT(10) PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(50),
pwd VARCHAR(50)
) -->
<?php
session_start();
require '../config.php';
if (isset($_POST['submit_login'])) {

	$username = $_POST['username'];
	$password = $_POST['pass'];
	$sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$username'");

	if (mysqli_num_rows($sql) === 1) {
		$data = mysqli_fetch_assoc($sql);
		if ($password === $data['pwd']) {

			$_SESSION['id'] = $data['id'];
			$_SESSION['username'] = $data['username'];
			header("Location: ../dashboard.php"); //lokasi
			exit();

		}
		$error = "Username/password salah";
	}
	$akun = "Anda belum terdaftar";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="POST">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					
					<?php if(isset($error)) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <b><?=$error; ?></b>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php elseif(isset($akun)) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <b><?=$akun; ?></b>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php endif; ?>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="username" autofocus>
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="submit_login" type="submit">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-81">
					</div>
				</form>
			</div>
		</div>
	</div>	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>