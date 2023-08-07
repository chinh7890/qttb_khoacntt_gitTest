<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class taikhoanmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='taikhoan';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('taikhoan');
		$data=$data->result_array();
		return $data;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}

	public function themtaikhoan($data){
		$this->db->insert('taikhoan',$data);
		return $this->db->insert_id();
		
	}


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */