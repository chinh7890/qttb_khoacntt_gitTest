<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class donvicontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('donvi/donvimodel');
	}

	public function index()
	{
		$this->load->model('donvi/donvimodel');
		$kq=$this->donvimodel->laydonvi();
		$kq=array("mangketqua"=> $kq);
		$this->load->view('donvi/donvi',$kq);
	}
	public function themdonvimoi()
	{
		$tendonvi=$this->input->post('tendonvi');
		$tenviettat=$this->input->post('tenviettat');
		$tochuc=$this->input->post('tochuc');
		$this->load->model('donvi/donvimodel');
		$tt=$this->donvimodel->themdonvi($tendonvi,$tenviettat,$tochuc);
	}

	public function xoadonvi()
	{
		$id = $this->uri->segment(4);
		$donvi = $this->donvimodel->get_info($id);
		$check = $this->donvimodel->delete($id);
		redirect(donvi_url('donvicontroller/index'),'refresh');
	}

	public function capnhatdonvi()
	{
		$id=$this->input->post('idUpdate');
		$tendonvi=$this->input->post('tendonvi');
		$tenviettat=$this->input->post('tenviettat');
		$tochuc=$this->input->post('tochuc');

		$data = array(
			'tendonvi'  => $tendonvi,
			'tenviettat'   => $tenviettat,
			'maloai' => $tochuc
		);
		$check = $this->donvimodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(donvi_url('donvicontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}
	
	public function laydonvi()
	{
		$iddv = $this->input->post('iddv');

        // lấy du lieu theo đơn vị
		$input['where'] = array('maloai' => $iddv);
        $arrDV = $this->donvimodel->get_list($input);
        
        echo json_encode($arrDV);
	}

	
}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */