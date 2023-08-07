<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loaithietbidogomodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='loaithietbidogo';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('loaithietbidogo');
		$data=$data->result_array();
		return $data;
	}
	public function themloaithietbidogo($tenloai){
		$data=array(
			'tenloai' => $tenloai
		);
		$this->db->insert('loaithietbidogo',$data);
		return $this->db->insert_id();
		
	}

	public function layloaidogo($tenloai){
        $query = 'SELECT * FROM loaithietbidogo WHERE tenloai = "'. $tenloai.'"';
        return $this->db->query($query)->row();
    }


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */