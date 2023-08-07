<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class donvimodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='donvi';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('donvi');
		$data=$data->result_array();
		return $data;
	}

	public function laydonvi(){
      $query = 'SELECT *, dv.id AS iddv
      FROM donvi dv, loaidonvi ldv
      WHERE dv.maloai = ldv.id';

      return $this->db->query($query)->result_array();
  	}

	public function themdonvi($tendonvi,$tenviettat,$tochuc){
		$data=array(
			'tendonvi' => $tendonvi,
			'tenviettat' => $tenviettat,
			'maloai' => $tochuc
		);
		$this->db->insert('donvi',$data);
		return $this->db->insert_id();
		
	}


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */