<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hockymodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='hocky';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('hocky');
		$data=$data->result_array();
		return $data;
	}

	public function laydanhsach($madv)
	{
		$query = "SELECT * FROM hocky where madonvi = ".$madv." 
		order by tunam desc, id desc";
		return $this->db->query($query)->result();
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}


}