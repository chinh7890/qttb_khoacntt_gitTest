<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class muasamvattumodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='muasamvattu';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('muasamvattu');
		$data=$data->result_array();
		return $data;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result();
	}

	function themdenghi($data = array())
	 {
		$this->db->insert('muasamvattu', $data);
		return $this->db->insert_id();
	 }


}
