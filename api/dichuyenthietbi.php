<?php

	include "connect.php";
	$idtb = $_POST['idtb'];
	$maso = $_POST['maso'];
	$idkho = $_POST['idkho'];
	$maphongkhomoi = $_POST['maphongkhomoi'];
	
	$check = false;
	
	
	// lấy thiết bị
	$select_thietbi = "SELECT * FROM maymocthietbi tb, donvi dv, phong_kho pk WHERE tb.maphongkho = pk.id AND pk.madonvi = dv.id AND maso='".$maso."'";
	$data = mysqli_query($conn,$select_thietbi);
	$thietbi = mysqli_fetch_assoc($data);
	if($thietbi['id'] != 0){
		//ghi lịch sử
		if($maphongkhomoi != $thietbi['maphongkho']){
			$select_donvi="SELECT tendonvi FROM `donvi` dv, phong_kho pk 
			WHERE dv.id=pk.madonvi AND pk.id = ".$idkho;
			$data = mysqli_query($conn,$select_donvi);
			$row = mysqli_fetch_assoc($data);
			$tendonvi = $row['tendonvi'];
			
			$noidung = "Chuyển từ ".$thietbi['maphong']." của ". $thietbi['tendonvi'] . " sang ". $maphongkhomoi . " của ". $tendonvi;
			$sql = "INSERT INTO lichsumaymocthietbi(noidung,ngay,mammtb)
			VALUES (
				'".$noidung."', 
				'".date("Y/m/d")."', 
				".$idtb."
			)";
			if ($conn->query($sql) === TRUE) {
				$sql = "UPDATE maymocthietbi SET 
				maphongkho=".$idkho."
				WHERE maso='".$maso."'";

				if ($conn->query($sql) === TRUE){
					$check = true;
				}else{
					$check = false;
				}
			} else {
				$check = false;
			}
		}
	}
	else{
		$check = false;
	}

	
	
	// check nếu maymoc không có thì qua đồ gỗ
	if($check === false){
		// lấy thiết bị
		$select_thietbi = "SELECT * FROM thietbidogo tb, donvi dv, phong_kho pk WHERE tb.maphongkho = pk.id AND pk.madonvi = dv.id AND maso='".$maso."'";
		$data = mysqli_query($conn,$select_thietbi);
		$thietbi = mysqli_fetch_assoc($data);
		if($thietbi['id'] != 0){
			//ghi lịch sử
			if($maphongkhomoi != $thietbi['maphongkho']){
				$select_donvi="SELECT tendonvi FROM `donvi` dv, phong_kho pk 
				WHERE dv.id=pk.madonvi AND pk.id = ".$idkho;
				$data = mysqli_query($conn,$select_donvi);
				$row = mysqli_fetch_assoc($data);
				$tendonvi = $row['tendonvi'];
				
				$noidung = "Chuyển từ ".$thietbi['maphong']." của ". $thietbi['tendonvi'] . " sang ". $maphongkhomoi . " của ". $tendonvi;
				$sql = "INSERT INTO lichsuthietbidogo(noidung,ngay,matbdg)
				VALUES (
					'".$noidung."', 
					'".date("Y/m/d")."', 
					".$idtb."
				)";
				if ($conn->query($sql) === TRUE) {
					$sql = "UPDATE thietbidogo SET 
					maphongkho=".$idkho."
					WHERE maso='".$maso."'";

					if ($conn->query($sql) === TRUE){
						$check = true;
					}else{
						$check = false;
					}
				} else {
					$check = false;
				}
			}
		}
		else{
			$check = false;
		}
	}
	
	echo json_encode($check);

?>