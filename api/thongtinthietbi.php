<?php

	include "connect.php";
	$maso = $_POST['maso'];

	$select_maymoc = "SELECT 
	tb.id,
	tentb,
	maso,
	mota,
	namsd,
	nguongoc,
	donvitinh,
	gia,
	chatluong,
	ghichu,
	tinhtrang,
	maphong
	FROM maymocthietbi tb, phong_kho pk WHERE tb.maphongkho=pk.id AND maso='".$maso."'";
	$select_dogo = "SELECT 
	tb.id,
	tentb,
	maso,
	mota,
	namsd,
	nguongoc,
	donvitinh,
	gia,
	chatluong,
	ghichu,
	tinhtrang,
	maphong
	FROM thietbidogo tb, phong_kho pk WHERE tb.maphongkho=pk.id AND maso='".$maso."'";
	
	
	$arrThietBi = array();
	$data = mysqli_query($conn,$select_maymoc);
	while($row = mysqli_fetch_assoc($data))
	{
		array_push($arrThietBi,new Thietbi(
			$row['id'],
			$row['tentb'],
			$row['maso'],
			$row['mota'],
			$row['namsd'],
			$row['nguongoc'],
			$row['donvitinh'],
			$row['gia'],
			$row['chatluong'],
			$row['ghichu'],
			$row['tinhtrang'],
			$row['maphong']
			));
	}
	
	$data = mysqli_query($conn,$select_dogo);
	while($row = mysqli_fetch_assoc($data))
	{
		array_push($arrThietBi,new Thietbi(
			$row['id'],
			$row['tentb'],
			$row['maso'],
			$row['mota'],
			$row['namsd'],
			$row['nguongoc'],
			$row['donvitinh'],
			$row['gia'],
			$row['chatluong'],
			$row['ghichu'],
			$row['tinhtrang'],
			$row['maphong']
			));
	}
	
	echo json_encode($arrThietBi);
	
	class Thietbi{
		function Thietbi($id,$tentb,$maso,$mota,$namsd,$nguongoc,$donvitinh,$gia,$chatluong,$ghichu,$tinhtrang,$maphong)
		{
			$this->id = $id;
			$this->tentb = $tentb;
			$this->maso = $maso;
			$this->mota = $mota;
			$this->namsd = $namsd;
			$this->nguongoc = $nguongoc;
			$this->donvitinh = $donvitinh;
			$this->gia = $gia;
			$this->chatluong = $chatluong;
			$this->ghichu = $ghichu;
			$this->tinhtrang = $tinhtrang;
			$this->maphong = $maphong;
		}
	}

?>