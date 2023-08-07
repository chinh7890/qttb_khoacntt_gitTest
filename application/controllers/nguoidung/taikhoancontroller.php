<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class taikhoancontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nguoidung/taikhoanmodel');
		$this->load->model('nguoidung/loaitaikhoanmodel');
		$this->load->model('donvi/donvimodel');
	}

	public function index()
	{
		$loaitk=$this->loaitaikhoanmodel->getAlldata();
		$loaitk=array("mangloaitk"=> $loaitk);

		$tk=$this->taikhoanmodel->getAlldata();
		$tk=array("mangtk"=> $tk);

		$dv=$this->donvimodel->getAlldata();
		$dv=array("mangdv"=> $dv);

		$data = array();
		$data['loaitk'] = $loaitk;
		$data['tk'] = $tk;
		$data['dv'] = $dv;

		$this->load->view('nguoidung/taikhoan',$data);
	}
	public function themtaikhoan()
	{
		$hoten=$this->input->post('hoten');
		$cmnd=$this->input->post('cmnd');
		$matkhau=$this->input->post('matkhau');
		$email=$this->input->post('email');
		$chucvu=$this->input->post('chucvu');
		$loaitaikhoan=$this->input->post('loaitaikhoan');
		$donvi=$this->input->post('donvi');

		if($donvi == ""){
			$data=array(
				'hoten' => $hoten,
				'cmnd' => $cmnd,
				'matkhau' => $matkhau,
				'email' => $email,
				'chucvu' => $chucvu,
				'maloaitk' => $loaitaikhoan
			);
		}else {
			$data=array(
				'hoten' => $hoten,
				'cmnd' => $cmnd,
				'matkhau' => $matkhau,
				'email' => $email,
				'chucvu' => $chucvu,
				'maloaitk' => $loaitaikhoan,
				'madonvi' => $donvi,
			);
		}

		

		$tt=$this->taikhoanmodel->themtaikhoan($data);
		echo nguoidung_url('taikhoancontroller/index');
	}

	public function xoataikhoan()
	{
		$id = $this->uri->segment(4);
		$check = $this->taikhoanmodel->delete($id);
		redirect(nguoidung_url('taikhoancontroller/index'),'refresh');
	}
	
	public function capnhattaikhoan()
	{
		$id=$this->input->post('idUpdate');
		$hotenUpdate=$this->input->post('hotenUpdate');
		$cmndUpdate=$this->input->post('cmndUpdate');
		$matkhauUpdate=$this->input->post('matkhauUpdate');
		$emailUpdate=$this->input->post('emailUpdate');
		$chucvuUpdate=$this->input->post('chucvuUpdate');
		$loaitaikhoanUpdate=$this->input->post('loaitaikhoanUpdate');
		$donviUpdate=$this->input->post('donviUpdate');

		$data = array(
			'hoten' => $hotenUpdate,
			'cmnd' => $cmndUpdate,
			'matkhau' => $matkhauUpdate,
			'email' => $emailUpdate,
			'chucvu' => $chucvuUpdate,
			'maloaitk' => $loaitaikhoanUpdate,
			'madonvi' => $donviUpdate,
		);
		$check = $this->taikhoanmodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(nguoidung_url('taikhoancontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}

	}

}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */