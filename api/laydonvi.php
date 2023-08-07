<?php

	include "connect.php";

	$query = "SELECT * FROM donvi";
	
	
	$arrDonvi = array();
	$data = mysqli_query($conn,$query);
	while($row = mysqli_fetch_assoc($data))
	{
		array_push($arrDonvi,new Donvi($row['id'],$row['tendonvi']));
	}
	
	echo json_encode($arrDonvi);
	
	class Donvi{
		function Donvi($id,$tendonvi)
		{
			$this->id = $id;
			$this->tendonvi = $tendonvi;
		}
	}

?>