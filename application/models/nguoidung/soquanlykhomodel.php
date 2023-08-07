<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class soquanlykhomodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='soquanlykho';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('nhatkyphongmay');
		$data=$data->result_array();
		return $data;
	}

	public function layhockymoinhat(){
		$query = 'SELECT id, hocky FROM hocky ORDER BY id DESC';
		return $this->db->query($query)->row();
	}

	public function laydulieu($idphong, $idhocky){
	    $this->db->select('
	    	*,
	    	DATE_FORMAT(ngaymuon,"%d %M %Y") AS datesort,
			sk.id As idNhatKy,
			tk.id As idTaiKhoan
			
		');
		$this->db->from('soquanlykho sk,
			taikhoan tk, 
			maymocthietbi tb,
			hocky hk
			');
		$this->db->where('sk.matk = tk.id');
		$this->db->where('sk.mahocky = hk.id');
		$this->db->where('sk.matb = tb.id');
		$this->db->where('sk.maphong = '.$idphong);
		$this->db->where('sk.mahocky = '.$idhocky);
		$this->db->order_by('datesort desc');

		$arrKetQua = $this->db->get()->result_array();

		return $arrKetQua;
	}

	public function xuatsonhatky($idphong, $idhocky){
	    $this->db->select('
	    	*,
	    	DATE_FORMAT(ngaymuon,"%d %M %Y") AS datesort,
			sk.id As idNhatKy,
			tk.id As idTaiKhoan,
			tb.id As idTb
		');
		$this->db->from('soquanlykho sk,
			taikhoan tk, 
			maymocthietbi tb
			');
		$this->db->where('sk.matk = tk.id');
		$this->db->where('sk.matb = tb.id');
		$this->db->where('sk.maphong = '.$idphong);
		$this->db->where('sk.mahocky = '.$idhocky);
		$this->db->order_by('datesort desc');

		$arrKetQua = $this->db->get()->result_array();

		return $arrKetQua;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}


}