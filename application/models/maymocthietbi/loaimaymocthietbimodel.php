<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loaimaymocthietbimodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='loaimaymocthietbi';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('loaimaymocthietbi');
		$data=$data->result_array();
		return $data;
	}
	public function themloaimaymocthietbi($tenloai){
		$data=array(
			'tenloai' => $tenloai
			
		);
		$this->db->insert('loaimaymocthietbi',$data);
		return $this->db->insert_id();
		
	}

	public function layloaimaymoc($tenloai){
        $query = 'SELECT * FROM loaimaymocthietbi WHERE tenloai = "'. $tenloai.'"';
        return $this->db->query($query)->row();
    }


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */