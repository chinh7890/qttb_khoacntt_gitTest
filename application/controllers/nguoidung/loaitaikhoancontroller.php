<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loaitaikhoancontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nguoidung/loaitaikhoanmodel');
	}

	public function index()
	{
		$tk=$this->loaitaikhoanmodel->getAlldata();
		$tk=array("mangloaitk"=> $tk);

		$data = array();
		$data['tk'] = $tk;

		$this->load->view('nguoidung/loaitaikhoan',$data);
	}
	public function themloaitaikhoan()
	{
		$tenloai=$this->input->post('tenloai');
		$mota=$this->input->post('mota');

		$data=array(
			'tenloai' => $tenloai,
			'mota' => $mota,
		);

		$tt=$this->loaitaikhoanmodel->themloaitaikhoan($data);
	}

	public function xoaloaitaikhoan()
	{
		$id = $this->uri->segment(4);
		$check = $this->loaitaikhoanmodel->delete($id);
		redirect(nguoidung_url('loaitaikhoancontroller/index'),'refresh');
	}

	public function capnhatloaitaikhoan()
	{
		$id=$this->input->post('idUpdate');
		$tenloaiUpdate=$this->input->post('tenloaiUpdate');
		$motaUpdate=$this->input->post('motaUpdate');

		$data = array(
			'tenloai'  => $tenloaiUpdate,
			'mota'   => $motaUpdate,
		);
		$check = $this->loaitaikhoanmodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(nguoidung_url('loaitaikhoancontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}
	

}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */