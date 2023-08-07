<?php

	include "connect.php";
	$email = $_POST['email'];
	$matkhau = $_POST['matkhau'];

	$query = "SELECT * FROM taikhoan WHERE email='".$email."' AND matkhau='".$matkhau."'";
	
	
	$arrUser = array();
	$data = mysqli_query($conn,$query);
	while($row = mysqli_fetch_assoc($data))
	{
		array_push($arrUser,new User($row['id'],$row['hoten'],$row['maloaitk']));
	}
	
	echo json_encode($arrUser);
	
	class User{
		function User($id,$hoten,$chucvu)
		{
			$this->id = $id;
			$this->hoten = $hoten;
			$this->chucvu = $chucvu;
		}
	}

?>