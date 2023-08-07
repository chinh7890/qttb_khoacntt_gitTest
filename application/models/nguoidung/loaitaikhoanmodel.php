<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loaitaikhoanmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='loaitaikhoan';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('loaitaikhoan');
		$data=$data->result_array();
		return $data;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}

	public function themloaitaikhoan($data){
		$this->db->insert('loaitaikhoan',$data);
		return $this->db->insert_id();
		
	}


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */