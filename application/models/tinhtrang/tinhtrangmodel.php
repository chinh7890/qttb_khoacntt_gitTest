<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tinhtrangmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='tinhtrangthietbi';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('tinhtrangthietbi');
		$data=$data->result_array();
		return $data;
	}
	// public function themdonvi($tendonvi,$tenviettat){
	// 	$data=array(
	// 		'tendonvi' => $tendonvi,
	// 		'tenviettat' => $tenviettat
	// 	);
	// 	$this->db->insert('donvi',$data);
	// 	return $this->db->insert_id();
		
	// }


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */