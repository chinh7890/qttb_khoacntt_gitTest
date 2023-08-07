<!DOCTYPE html>
<html>
<head>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo public_url('login/');?>images/bg-01.jpg');">
			<div class="wrap-login100">
				<!-- <form class="login100-form"> -->
				
					<img class="login100-form-logo" src="<?php echo public_url('login/');?>images/logo.png" />

					<span class="login100-form-title p-b-34 p-t-27">
						Đổi mật khẩu
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" id="username" name="username" placeholder="Tài khoản">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" id="passcu" name="passcu" placeholder="Mật khẩu cũ">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" id="passmoi" name="passmoi" placeholder="Mật khẩu mới">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onclick="xacnhan()">
							Xác nhận thay đổi
						</button>
					</div>

					<!-- <div class="text-center p-t-90">
						<a class="txt1" onclick="quenmatkhau()">
							Quên mật khẩu
						</a>
					</div> -->
				<!-- </form> -->
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?php echo public_url('login/');?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo public_url('login/');?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>vendor/tilt/tilt.jquery.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo public_url('login/');?>js/main.js"></script>

<script>
	function xacnhan(){
        $.ajax({
          url: 'luumatkhau',
          type: 'POST',
          // dataType: 'json',
          data: {
            username: $('#username').val(),
            passcu: $('#passcu').val(),
            passmoi: $('#passmoi').val(),
          },
          success: function (data) {
            
            if(data == "homecontroller")
            {
            	var baseurl = window.location.origin+"/quanlythietbi/";
            	window.location.href = baseurl + data;
            }
            else if(data != "")
            {
            	alert(data);
            }
            
          },
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        });
    }
</script>

</body>
</html>