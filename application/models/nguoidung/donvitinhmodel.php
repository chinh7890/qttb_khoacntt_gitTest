<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class donvitinhmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='donvitinh';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('donvitinh');
		$data=$data->result();
		return $data;
	}

	public function laydanhsach($madv)
	{
		$query = "SELECT * FROM hocky where madonvi = ".$madv." 
		order by tunam desc, hocky desc";
		return $this->db->query($query)->result();
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}


}