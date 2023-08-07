<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhommaymocthietbimodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='nhommaymocthietbi';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('nhommaymocthietbi');
		$data=$data->result_array();
		return $data;
	}
	public function themnhommaymocthietbi($tennhom){
		$data=array(
			'tennhom' => $tennhom
			
		);
		$this->db->insert('nhommaymocthietbi',$data);
		return $this->db->insert_id();
		
	}


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */