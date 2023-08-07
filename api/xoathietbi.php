<?php

	include "connect.php";
	$maso = $_POST['maso'];
	
	$check = false;
	
	$sql = "DELETE FROM maymocthietbi WHERE maso=".$maso;
	if ($conn->query($sql) === TRUE) {
		$check = true;
	} else {
		$check = false;
	}
	
	// check nếu maymoc không có thì qua đồ gỗ
	$sql = "DELETE FROM thietbidogo WHERE maso=".$maso;
	if ($conn->query($sql) === TRUE) {
		$check = true;
	} else {
		$check = false;
	}
	
	echo json_encode($check);

?>