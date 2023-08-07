<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loginmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='taikhoan';
	}
	// public function getAlldata(){
	// 	$this->db->select('*');
	// 	$data= $this->db->get('cauhoi');
	// 	$data=$data->result_array();
	// 	return $data;
	// }
	// public function themcauhoi($data){
	// 	$this->db->insert('cauhoi',$data);
	// 	return $this->db->insert_id();
		
	// }


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */