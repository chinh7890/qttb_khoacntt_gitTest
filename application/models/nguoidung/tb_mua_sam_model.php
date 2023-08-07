<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tb_mua_sam_model extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='tb_mua_sam';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('tb_mua_sam');
		$data=$data->result_array();
		return $data;
	}

	public function laythietbi($idmuasam)
	{
		$query = "SELECT * FROM tb_mua_sam WHERE idmuasam=".$idmuasam;
		return $this->db->query($query)->result();
	}


	public function queryDB($query)
	{
		return $this->db->query($query)->result();
	}

	function themtb($data = array())
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}




}
