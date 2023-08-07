<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loaimaymocthietbicontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('maymocthietbi/loaimaymocthietbimodel');
	}

	public function index()
	{
		$kq=$this->loaimaymocthietbimodel->getAlldata();
		$kq=array("mangketqua"=> $kq);
		$this->load->view('maymocthietbi/loaimaymocthietbi',$kq);
	}
	public function themloaimaymocthietbi()
	{
		$tenloai=$this->input->post('tenloai');
		$tt=$this->loaimaymocthietbimodel->themloaimaymocthietbi($tenloai);
		
	}

	public function xoaloaimaymocthietbi()
	{
		$id = $this->uri->segment(4);
		$this->loaimaymocthietbimodel->delete($id);
		redirect(maymocthietbi_url('loaimaymocthietbicontroller/index'),'refresh');
	}

	public function capnhatloaithietbi()
	{
		$id=$this->input->post('idUpdate');
		$tenloaiUpdate=$this->input->post('tenloaiUpdate');

		$data = array(
			'tenloai'  => $tenloaiUpdate,
		);
		$check = $this->loaimaymocthietbimodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(maymocthietbi_url('loaimaymocthietbicontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}
	

}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */