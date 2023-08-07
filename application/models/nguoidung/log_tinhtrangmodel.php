<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log_tinhtrangmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='log_tinhtrang';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('log_tinhtrang');
		$data=$data->result_array();
		return $data;
	}


}
