<?php

	include "connect.php";
	$maso = $_POST['maso'];
	$chatluong = $_POST['chatluong'];
	$ghichu = $_POST['ghichu'];
	$tinhtrang = $_POST['tinhtrang'];
	$maphongkho = $_POST['maphongkho'];
	
	$check = false;
	
	$sql = "UPDATE maymocthietbi SET 
		chatluong='".$chatluong."',
		ghichu='".$ghichu."',
		tinhtrang='".$tinhtrang."',
		maphongkho=".$maphongkho."
		WHERE maso='".$maso."'";
	if ($conn->query($sql) === TRUE) {
		$check = true;
	} else {
		$check = false;
	}
	
	// check nếu maymoc không có thì qua đồ gỗ
	$sql = "UPDATE thietbidogo SET 
		chatluong='".$chatluong."',
		ghichu='".$ghichu."',
		tinhtrang='".$tinhtrang."',
		maphongkho=".$maphongkho."
	WHERE maso='".$maso."'";
	if ($conn->query($sql) === TRUE) {
		$check = true;
	} else {
		$check = false;
	}
	
	echo json_encode($check);

?>