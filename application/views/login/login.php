<!DOCTYPE html>
<html lang="en">
<head>
	<title>Quản trị thiết bị</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo public_url('login/');?>css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo public_url('login/');?>images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" 
				action="<?php echo login_url('logincontroller/index');?>"
				method="post">
				
					<img class="login100-form-logo" src="<?php echo public_url('login/');?>images/logo.png" />

					<span class="login100-form-title p-b-34 p-t-27">
						Quản trị thiết bị
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" id="username" name="username" placeholder="Tài khoản">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" type="password" name="pass" placeholder="Mật khẩu">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Đăng nhập
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo public_url('login/');?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo public_url('login/');?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>js/main.js"></script>


</body>
</html>