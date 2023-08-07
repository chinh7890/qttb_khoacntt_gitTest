<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loaithietbidogocontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('thietbidogo/loaithietbidogomodel');
	}

	public function index()
	{
		$kq=$this->loaithietbidogomodel->getAlldata();
		$kq=array("mangketqua"=> $kq);
		$this->load->view('thietbidogo/loaithietbidogo',$kq);
	}
	public function themloaithietbidogo()
	{
		$tenloai=$this->input->post('tenloai');
		$tt=$this->loaithietbidogomodel->themloaithietbidogo($tenloai);
	}
	
	public function xoaloaithietbidogo()
	{
		$id = $this->uri->segment(4);
		$this->loaithietbidogomodel->delete($id);
		redirect(thietbidogo_url('loaithietbidogocontroller/index'),'refresh');
	}

	public function capnhatloaithietbi()
	{
		$id=$this->input->post('idUpdate');
		$tenloaiUpdate=$this->input->post('tenloaiUpdate');

		$data = array(
			'tenloai'  => $tenloaiUpdate,
		);
		$check = $this->loaithietbidogomodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(thietbidogo_url('loaithietbidogocontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}
}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */