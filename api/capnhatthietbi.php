<?php

	include "connect.php";
	// $idtb = $_POST['idtb'];
	$maso = $_POST['maso'];
	$chatluong = $_POST['chatluong'];
	$ghichu = $_POST['ghichu'];
	$tinhtrang = $_POST['tinhtrang'];
	// $idkho = $_POST['idkho'];
	// $maphongkhocu = $_POST['maphongkhocu'];
	// $maphongkhomoi = $_POST['maphongkhomoi'];
	
	$check = false;
	
	$sql = "SELECT * FROM `maymocthietbi` WHERE maso = '".$maso."'";
	if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
		$sql = "UPDATE maymocthietbi SET 
		chatluong='".$chatluong."',
		ghichu='".$ghichu."',
		tinhtrang='".$tinhtrang."'
		WHERE maso='".$maso."'";
		$conn->query($sql);

		$check = true;
		// if($maphongkhocu != $maphongkhomoi){
		// 	$select_donvi="SELECT tendonvi FROM `donvi` dv, phong_kho pk 
		// 	WHERE dv.id=pk.madonvi AND dv.id = (SELECT madonvi FROM phong_kho WHERE maphong='".$maphongkhocu."')
		// 	LIMIT 1";
		// 	$data = mysqli_query($conn,$select_donvi);
		// 	$row = mysqli_fetch_assoc($data);
		// 	$tendonvi = $row['tendonvi'];
			
		// 	$noidung = "Chuyển từ ".$maphongkhocu." của ". $tendonvi . " sang ". $maphongkhomoi . " của ". $tendonvi;
		// 	$sql = "INSERT INTO lichsumaymocthietbi(noidung,ngay,mammtb)
		// 	VALUES (
		// 		'".$noidung."', 
		// 		'".date("Y/m/d")."', 
		// 		".$idtb."
		// 	)";
		// 	if ($conn->query($sql) === TRUE) {
		// 		$check = true;
		// 	} else {
		// 		$check = false;
		// 	}
		// }
	} else {
		$check = false;
	}
	
	// check nếu maymoc không có thì qua đồ gỗ
	$sql = "UPDATE thietbidogo SET 
		chatluong='".$chatluong."',
		ghichu='".$ghichu."',
		tinhtrang='".$tinhtrang."'
	WHERE maso='".$maso."'";
	if($check === false){
		if ($conn->query($sql) === TRUE) {
			$check = true;
			// if($maphongkhocu != $maphongkhomoi){
			// 	$select_donvi="SELECT tendonvi FROM `donvi` dv, phong_kho pk 
			// 	WHERE dv.id=pk.madonvi AND dv.id = (SELECT madonvi FROM phong_kho WHERE maphong='".$maphongkhocu."')
			// 	LIMIT 1";
			// 	$data = mysqli_query($conn,$select_donvi);
			// 	$row = mysqli_fetch_assoc($data);
			// 	$tendonvi = $row['tendonvi'];
				
			// 	$noidung = "Chuyển từ ".$maphongkhocu." của ". $tendonvi . " sang ". $maphongkhomoi . " của ". $tendonvi;
			// 	$sql = "INSERT INTO lichsuthietbidogo(noidung,ngay,matbdg)
			// 	VALUES (
			// 		'".$noidung."', 
			// 		'".date("Y/m/d")."', 
			// 		".$idtb."
			// 	)";
			// 	if ($conn->query($sql) === TRUE) {
			// 		$check = true;
			// 	} else {
			// 		$check = false;
			// 	}
			// }
		} else {
			$check = false;
		}
	}
	
	echo json_encode($check);

?>