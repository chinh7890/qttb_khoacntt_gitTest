<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhatkybaotrimodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='nhatkybaotri';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('nhatkybaotri');
		$data=$data->result_array();
		return $data;
	}

	public function laydulieu($hk, $idphong){
		$query = "SELECT nk.id, nk.matb, nk.maphong, nk.mahocky, nk.ngaybaotri, nk.motahuhong,
		nk.noidungbaotri, nk.nguoibaotri, nk.nguoikiemtra, nk.ghichu, nk.matk,
		tb.tentb, tb.maso, FROM_UNIXTIME(ngaytao, '%d-%m-%Y') AS ngay
			FROM nhatkybaotri nk, maymocthietbi tb
			WHERE nk.matb = tb.id AND
			nk.mahocky = ".$hk." AND nk.maphong = ".$idphong." 
			ORDER BY ngaytao desc";
		return $this->db->query($query)->result_array();
	}

	public function xuatsonhatky($idphong, $idhocky){
	    $this->db->select('
	    	*
		');
		$this->db->from('nhatkybaotri nk,
			maymocthietbi tb
			');
		$this->db->where('nk.matb = tb.id');
		$this->db->where('nk.maphong = '.$idphong);
		$this->db->where('nk.mahocky = '.$idhocky);
		$this->db->order_by('ngaybaotri asc');

		$arrKetQua = $this->db->get()->result_array();

		return $arrKetQua;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result();
	}


}