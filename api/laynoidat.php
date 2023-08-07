<?php

	include "connect.php";
	$maphong = $_POST['maphong'];
	
	$select ="SELECT pk.id, maphong FROM donvi dv, phong_kho pk
		WHERE pk.madonvi = dv.id AND pk.madonvi = (SELECT madonvi FROM phong_kho WHERE maphong = '".$maphong."')";
	
	$arrMaphong = array();
	$data = mysqli_query($conn,$select);
	while($row = mysqli_fetch_assoc($data))
	{
		array_push($arrMaphong,new Phong(
			$row['id'],
			$row['maphong']
		));
	}
	
	echo json_encode($arrMaphong);
	
	class Phong{
		function Phong($id,$maphong)
		{
			$this->id = $id;
			$this->maphong = $maphong;
		}
	}

?>