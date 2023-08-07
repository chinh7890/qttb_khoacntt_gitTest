<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bieumaumodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='bieumau';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('bieumau');
		$data=$data->result_array();
		return $data;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result();
	}


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */