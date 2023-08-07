<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lichsuthietbidogomodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='lichsuthietbidogo';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('lichsuthietbidogo');
		$data=$data->result_array();
		return $data;
	}

	public function themlichsu($data){
		$this->db->insert('lichsuthietbidogo',$data);
		return $this->db->insert_id();
	}


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */