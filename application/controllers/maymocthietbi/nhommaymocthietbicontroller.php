<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhommaymocthietbicontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('maymocthietbi/nhommaymocthietbimodel');
	}

	public function index()
	{
		$this->load->model('maymocthietbi/nhommaymocthietbimodel');
		$kq=$this->nhommaymocthietbimodel->getAlldata();
		$kq=array("mangketqua"=> $kq);
		$this->load->view('maymocthietbi/nhommaymocthietbi',$kq);
	}
	public function themnhommaymocthietbi()
	{
		$tennhom=$this->input->post('tennhom');
		console.log($tennhom+"day");
		$this->load->model('maymocthietbi/nhommaymocthietbimodel');
		$tt=$this->nhommaymocthietbimodel->themnhommaymocthietbi($tennhom);
		
	}

	public function xoanhommaymocthietbi()
	{
		$id = $this->uri->segment(4);
		$this->nhommaymocthietbimodel->delete($id);
		redirect(maymocthietbi_url('nhommaymocthietbicontroller/index'),'refresh');
	}

	public function capnhatnhomthietbi()
	{
		$id=$this->input->post('idUpdate');
		$tennhomUpdate=$this->input->post('tennhomUpdate');

		$data = array(
			'tennhom'  => $tennhomUpdate,
		);
		$check = $this->nhommaymocthietbimodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(maymocthietbi_url('nhommaymocthietbicontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}
	

}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */