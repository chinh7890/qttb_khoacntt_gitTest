<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class phong_khomodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='phong_kho';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('phong_kho');
		$data=$data->result_array();
		return $data;
	}

	public function layphongkho($iddonvi){
      $query = 'SELECT pk.id, pk.maphong, pk.tenphong, pk.khu, pk.lau, pk.sophong, pk.magvql, dv.tendonvi, tk.hoten
      FROM phong_kho pk, donvi dv, taikhoan tk 
      WHERE pk.madonvi = dv.id AND tk.id = pk.magvql AND pk.madonvi='. $iddonvi.
      ' ORDER BY pk.maphong';

      return $this->db->query($query)->result_array();
  	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}

	public function themphongkho($data){
		$this->db->db_debug = false;

        if(!@$this->db->insert('phong_kho',$data))
        {
            $error = $this->db->error();
            return false;
        }else{
            return $this->db->insert_id();
        }
	}


}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */