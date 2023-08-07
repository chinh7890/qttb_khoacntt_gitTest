<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sovattugiangdaymodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='sovattugiangday';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('sovattugiangday');
		$data=$data->result_array();
		return $data;
	}

	public function layhockymoinhat(){
		$query = 'SELECT id, hocky FROM hocky ORDER BY id DESC';
		return $this->db->query($query)->row();
	}

	public function laydulieu($hk, $madonvi){
		$query = "SELECT *, COUNT(id) AS sl
			FROM `sovattugiangday` 
			WHERE `mahocky` = ".$hk." AND `madonvi` = ".$madonvi." 
			GROUP BY create_at, danhmuc, ghichu
			ORDER BY `create_at` desc";
		return $this->db->query($query)->result_array();



		//    $this->db->select('*');
		// $this->db->from('sovattugiangday');
		// $this->db->where('mahocky = '.$hk);
		// $this->db->where('madonvi = '.$this->session->userdata("madonvi"));
		// $this->db->order_by('create_at desc');
		// $arrKetQua = $this->db->get()->result_array();
		// return $arrKetQua;
	}

	public function laythietbi($maphongkho){
		$query = 'SELECT *, COUNT(id) AS sl
			FROM maymocthietbi
			WHERE maphongkho = '.$maphongkho.' 
			AND tinhtrang = "Đang sử dụng"
			GROUP BY tentb';
		return $this->db->query($query)->result_array();
	}

	public function xuatsovattu($mahocky){
	    $this->db->select('
	    	*,
	    	COUNT(id) AS SoLuot
		');
		$this->db->from('sovattugiangday');
		
		$this->db->where('mahocky = '.$mahocky);
		$this->db->group_by(array("ten_gv1", "ten_gv2"));

		$arrKetQua = $this->db->get()->result_array();

		return $arrKetQua;
	}

	public function capnhatthongtin($create_at, $tentb ,$data)
	{
		$this->db->where('create_at', $create_at);
		$this->db->where('danhmuc', $tentb);
		$this->db->update('sovattugiangday', $data);
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}


}