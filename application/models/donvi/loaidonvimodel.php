<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loaidonvimodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='loaidonvi';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('loaidonvi');
		$data=$data->result_array();
		return $data;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}


}