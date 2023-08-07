<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class phong_khocontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('donvi/phong_khomodel');
		$this->load->model('donvi/donvimodel');
		$this->load->model('nguoidung/taikhoanmodel');

		$this->load->library('excel');
	}

	public function index()
	{
		// $phong=$this->phong_khomodel->getAlldata();
		// $phong=array("mangphong"=> $phong);

		$dv=$this->donvimodel->getAlldata();
		$dv=array("mangdv"=> $dv);

		$tk=$this->taikhoanmodel->getAlldata();
		$tk=array("mangtk"=> $tk);

		$data = array();
		// $data['phong'] = $phong;
		$data['dv'] = $dv;
		$data['tk'] = $tk;

		$this->load->view('donvi/phong_kho',$data);
	}

	public function laydulieu(){
		$madonvi = $this->input->post('madonvi');
        $arrPhongKho = $this->phong_khomodel->layphongkho($madonvi);
        echo json_encode($arrPhongKho);
	}

	public function themphongkhomoi()
	{
		// $maphong=$this->input->post('maphong');
		// $tenphong=$this->input->post('tenphong');
		// $khu=$this->input->post('khu');
		// $lau=$this->input->post('lau');
		// $sophong=$this->input->post('sophong');
		$magv=$this->input->post('magv');
		$donvi=$this->input->post('donvi');

		// lấy thông tin đơn vị
		$dv = $this->donvimodel->get_info($donvi);

		// $data=array(
		// 	'maphong' => $maphong,
		// 	'tenphong' => $tenphong,
		// 	'khu' => $khu,
		// 	'lau' => $lau,
		// 	'sophong' => $sophong,
		// 	'magvql' => $magv,
		// 	'madonvi' => $donvi,
		// );

		// $tt=$this->phong_khomodel->themphongkho($data);



		if(isset($_FILES["file"]["name"]))
	  	{
		   $path = $_FILES["file"]["tmp_name"];
		   $object = PHPExcel_IOFactory::load($path);
		   foreach($object->getWorksheetIterator() as $worksheet)
		   {
			    $highestRow = $worksheet->getHighestRow();
			    $highestColumn = $worksheet->getHighestColumn();
			    for($row=2; $row<=$highestRow; $row++)
			    {
					
			    	$maphong = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
			    	$tenphong = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
			    	$khu = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			    	$lau = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			    	$sophong = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

			    	$input = array('maphong' => $maphong, 'tenphong' => $maphong." ".$dv->tenviettat);
			    	if($this->phong_khomodel->check_exists($input) == FALSE){
			    		$tenphong = $maphong." ".$dv->tenviettat;
			    		$data=array(
							'maphong' => $maphong,
							'tenphong' => $tenphong,
							'khu' => $khu,
							'lau' => $lau,
							'sophong' => $sophong,
							'magvql' => $magv,
							'madonvi' => $donvi,
						);

						$tt=$this->phong_khomodel->themphongkho($data);
			    	}
					
					
			    }
	  		}
	  		echo donvi_url('phong_khocontroller/index');
	  		// redirect(donvi_url('phong_khocontroller/index'),'refresh');
		}
		else
		{
			echo "Error";
		}
		
	}

	public function capnhatphongkho()
	{
		$id=$this->input->post('idUpdate');
		$maphongUpdate=$this->input->post('maphongUpdate');
		$tenphongUpdate=$this->input->post('tenphongUpdate');
		$khuUpdate=$this->input->post('khuUpdate');
		$lauUpdate=$this->input->post('lauUpdate');
		$sophongUpdate=$this->input->post('sophongUpdate');
		$magvUpdate=$this->input->post('magvUpdate');
		$donviUpdate=$this->input->post('donviUpdate');

		$data = array(
			'maphong' => $maphongUpdate,
			'tenphong' => $tenphongUpdate,
			'khu' => $khuUpdate,
			'lau' => $lauUpdate,
			'sophong' => $sophongUpdate,
			'magvql' => $magvUpdate,
			'madonvi' => $donviUpdate,
		);
		$check = $this->phong_khomodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(donvi_url('phong_khocontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}

	public function xoaphongkho()
	{
		$id = $this->uri->segment(4);
		$this->phong_khomodel->delete($id);
		redirect(donvi_url('phong_khocontroller/index'),'refresh');
	}
	

}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */