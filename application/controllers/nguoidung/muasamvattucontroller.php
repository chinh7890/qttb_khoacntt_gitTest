<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class muasamvattucontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nguoidung/muasamvattumodel');
		$this->load->model('nguoidung/tb_mua_sam_model');
		$this->load->model('nguoidung/nhatkymodel');
		$this->load->model('nguoidung/hockymodel');
		$this->load->library('excel');
	}

	public function index()
	{
		$rsHocKy = $this->nhatkymodel->layhockymoinhat();
		
		// danh sách vật tư
		$query = "SELECT *, vt.id AS idvt
			FROM muasamvattu vt, taikhoan tk, donvi dv 
			WHERE tk.id = vt.magv AND tk.madonvi = dv.id
			AND vt.idhk = ".$rsHocKy->id." AND dv.id = ".$this->session->userdata("madonvi");
		$vt = $this->muasamvattumodel->queryDB($query);

		// tổng giá trị
		$query = "SELECT SUM(giatri) AS TongGiaTri
			FROM muasamvattu vt, taikhoan tk, donvi dv 
			WHERE tk.id = vt.magv AND tk.madonvi = dv.id
			AND vt.idhk = ".$rsHocKy->id." AND dv.id = ".$this->session->userdata("madonvi");
		$gt = $this->muasamvattumodel->queryDB($query);


		if(count($gt) > 0) $TongGiaTri = $gt[0]->TongGiaTri;
		else $TongGiaTri = 0;

		$data = array();
		$data['vt'] = $vt;
		$data['tonggiatri'] = $TongGiaTri;
		$data['hocky'] = $this->hockymodel->laydanhsach($this->session->userdata("madonvi"));

		$this->load->view('ghiso/muasamvattu',$data);
	}

	public function laydulieu()
	{
		$idhocky= $this->input->post('idhocky');

        // $rsHocKy = $this->nhatkymodel->layhockymoinhat();
		
		// danh sách vật tư
		$query = "SELECT *, vt.id AS idvt
			FROM muasamvattu vt, taikhoan tk, donvi dv 
			WHERE tk.id = vt.magv AND tk.madonvi = dv.id
			AND vt.idhk = ".$idhocky." AND dv.id = ".$this->session->userdata("madonvi");
		$vt = $this->muasamvattumodel->queryDB($query);

		// tổng giá trị
		$query = "SELECT SUM(giatri) AS TongGiaTri
			FROM muasamvattu vt, taikhoan tk, donvi dv 
			WHERE tk.id = vt.magv AND tk.madonvi = dv.id
			AND vt.idhk = ".$idhocky." AND dv.id = ".$this->session->userdata("madonvi");
		$gt = $this->muasamvattumodel->queryDB($query);


		if(count($gt) > 0) $TongGiaTri = $gt[0]->TongGiaTri;
		else $TongGiaTri = 0;

		$data = array();
		$data['mangketqua'] = $vt;
		$data['tonggiatri'] = $TongGiaTri;
		$data['hocky'] = $this->hockymodel->laydanhsach($this->session->userdata("madonvi"));
        
        echo json_encode($data);
	}

	public function themdenghi()
	{
		$tendenghi=$this->input->post('tendenghi');
		$tinhtrang=$this->input->post('tinhtrang');
		$giatri=$this->input->post('giatri');
		$kygiaonhan=$this->input->post('kygiaonhan');
		$kythanhtoan=$this->input->post('kythanhtoan');
		$file = $this->input->post('filedenghi');

		$rsHocKy = $this->nhatkymodel->layhockymoinhat();

		//-------------upload file ---------
		$config['upload_path'] = './public/muasamvattu/';
		$config['allowed_types'] = 'pdf|doc|docx|jpg|png|jpeg';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload("filedenghi"))
		{
			$data = array('upload_data' => $this->upload->data());

			$upload_data = $this->upload->data(); 
			$tentaptin = $upload_data['file_name'];
		}

		$data=array(
			'tendenghi' => $tendenghi,
			'tentaptin' => $tentaptin,
			'tinhtrang' => $tinhtrang,
			'giatri' => $giatri,
			'giaonhan' => ($kygiaonhan == "1" )? 1: 0,
			'thanhtoan' => ($kythanhtoan == "1" )? 1: 0,
			'create_at' => time(),
			'idhk' => intval($rsHocKy->id),
			'magv' => $this->session->userdata("id")
		);


		$this->muasamvattumodel->create($data);

		redirect(nguoidung_url('muasamvattucontroller/index'),'refresh');
	}

	public function themdenghi_excel()
	{
		$tendenghi=$this->input->post('tendenghi');
		$tinhtrang=$this->input->post('tinhtrang');

		$rsHocKy = $this->nhatkymodel->layhockymoinhat();

		$data=array(
			'tendenghi' => $tendenghi,
			'tinhtrang' => $tinhtrang,
			'create_at' => time(),
			'idhk' => intval($rsHocKy->id),
			'magv' => $this->session->userdata("id")
		);

		$id_denghi = $this->muasamvattumodel->themdenghi($data);


		if(isset($_FILES["filedenghi"]["name"]))
	  	{
		   $path = $_FILES["filedenghi"]["tmp_name"];

		   $object = PHPExcel_IOFactory::load($path);
		   
	   		$worksheet = $object->getSheet(0);
		    $highestRow = $worksheet->getHighestRow();
		    $highestColumn = $worksheet->getHighestColumn();

		    $veviecdenghi = $worksheet->getCellByColumnAndRow(2, 4)->getValue();
		    $noidungdenghi = $worksheet->getCellByColumnAndRow(2, 10)->getValue();
		    $data_update=array(
				'veviecdenghi' => $veviecdenghi,
				'noidungdenghi' => $noidungdenghi
			);
			$this->muasamvattumodel->update($id_denghi, $data_update);

		    for($row=13; $row<=$highestRow; $row++)
		    {
		    	$tentb = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
		    	$mota = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
		    	$gia =  $worksheet->getCellByColumnAndRow(3, $row)->getValue();
		    	$soluong = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
		    	if($tentb != "" && $mota != "" && $gia != ""){
		    		$data_tb=array(
						'tentb' => $tentb,
						'mota' => $mota,
						'gia' => $gia,
						'soluong' => $soluong,
						'trangthai'=> $tinhtrang,
						'idmuasam' => $id_denghi
					);
					$this->tb_mua_sam_model->themtb($data_tb);
		    	}
			}						
		}
		else
		{
			echo "Error";
		}

		redirect(nguoidung_url('muasamvattucontroller/index'),'refresh');
	}

	public function xoadenghi()
	{
		$id = $this->uri->segment(4);
		$path = './public/muasamvattu/';
		// xóa tập tin cũ
		$vt = $this->muasamvattumodel->get_info($id, "tentaptin");
		$check = $this->muasamvattumodel->delete($id);
		if($check == true && $vt->tentaptin != ""){
			unlink($path.$vt->tentaptin);
		}
		redirect(nguoidung_url('muasamvattucontroller/index'),'refresh');
	}

	public function capnhatdenghi()
	{
		$id=$this->input->post('idUpdate');
		$tendenghi=$this->input->post('tendenghi');
		$tinhtrang=$this->input->post('tinhtrang');
		$giatri=$this->input->post('giatri');
		$tentaptin = "";

		//-------------upload file ---------
		$path = './public/muasamvattu/';
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'pdf|doc|docx|jpg|png|jpeg';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload("filedenghi"))
		{
			$data = array('upload_data' => $this->upload->data());

			$upload_data = $this->upload->data(); 
			$tentaptin = $upload_data['file_name'];
		}

		if($tentaptin == ""){
			$data=array(
				'tendenghi' => $tendenghi,
				'tinhtrang' => $tinhtrang,
				'giatri' => $giatri,
				'create_at' => time(),
				'magv' => $this->session->userdata("id")
			);
		}else{
			$data=array(
				'tendenghi' => $tendenghi,
				'tentaptin' => $tentaptin,
				'tinhtrang' => $tinhtrang,
				'giatri' => $giatri,
				'create_at' => time(),
				'magv' => $this->session->userdata("id")
			);

			// xóa tập tin cũ
			$vt = $this->muasamvattumodel->get_info($id, "tentaptin");
			unlink($path.$vt->tentaptin);
		}

		$check = $this->muasamvattumodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(nguoidung_url('muasamvattucontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}

	public function xemchitiet()
	{
		$id = $this->uri->segment(4);
		$data = array();
		$data['key'] = $id;
		$data['denghi'] = $this->muasamvattumodel->get_info($id);
		$data['mangtb'] = $this->tb_mua_sam_model->getAlldata();
		$this->load->view('ghiso/chitietmuasam',$data);
	}

	public function luuthietbi_denghi()
	{
		$idtbmua=$this->input->post('idtbmua');
		$tentb=$this->input->post('tentb');
		$mota=$this->input->post('mota');
		$gia=$this->input->post('gia');
		$soluong=$this->input->post('soluong');
		$trangthai=$this->input->post('trangthai');

		$idmuasam = $this->input->post('key');
		$veviecdenghi = $this->input->post('veviecdenghi');
		$noidungdenghi = $this->input->post('noidungdenghi');

		$data=array(
			'veviecdenghi' => $veviecdenghi,
			'noidungdenghi' => $noidungdenghi
		);
		$this->muasamvattumodel->update($idmuasam, $data);

		if(count($idtbmua) > 0){
			for ( $i=0 ; $i < count($idtbmua); $i++) { 
				$gia_goc = str_replace(',', '', $gia[$i]);
				$data_tb=array(
					'tentb' => $tentb[$i],
					'mota' => $mota[$i],
					'gia' => $gia_goc,
					'soluong' => $soluong[$i],
					'trangthai'=> $trangthai[$i]
				);
				$this->tb_mua_sam_model->update($idtbmua[$i], $data_tb);
			}
		}
		
		redirect(nguoidung_url('muasamvattucontroller/index'),'refresh');
	}

	public function indenghi()
	{
		$id = $this->uri->segment(4);

		$path = public_url("bieumau/DeNghi.docx");
		// $path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\DeNghi.docx";

		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);

		// đặt tên phòng
		$denghi = $this->muasamvattumodel->get_info($id); 
		$templateProcessor->setValues(array(
			'veviecdenghi'=> $denghi->veviecdenghi,
			'noidungdenghi'=> $denghi->noidungdenghi
		));

		//table
		$table = new \PhpOffice\PhpWord\Element\Table([
		    'borderSize' => 6, 
		    'borderColor' => 'black', 
		    'spaceBefore'=>0,
			'spaceAfter'=>0,
			'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
			'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER
		]);
		
		// style header
		$myFontStyle_header = array('name' => 'Minion Pro', 'size' => 11, 'bold' => true);
		$myParagraphStyle = array('align'=>'center', 'spaceBefore'=>50, 'spaceafter' => 50);
		$styleVCell = array('valign'=>'center'); 

		// Header DANH MỤC
		$table->addRow();
		$table->addCell(500,$styleVCell)->addText('STT', $myFontStyle_header, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Nội dung trang bị', $myFontStyle_header, $myParagraphStyle );
		$table->addCell(11000,$styleVCell)->addText('Đặc điểm kỹ thuật', $myFontStyle_header, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Đơn giá ước tính', $myFontStyle_header, $myParagraphStyle );
		$table->addCell(2000,$styleVCell)->addText('Số lượng', $myFontStyle_header, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Thành tiền', $myFontStyle_header, $myParagraphStyle );
		$table->addCell(4000,$styleVCell)->addText('Ghi chú', $myFontStyle_header, $myParagraphStyle );

		// row data DANH MỤC
		$myFontStyle = array('name' => 'Minion Pro', 'size' => 11);
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 13,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
		
		$mangtb= $this->tb_mua_sam_model->laythietbi($id); 
		$index = 1;
		$tongtien = 0;
		foreach ($mangtb as $data) {
			$table->addRow();

			$thanhtien = $data->gia * $data->soluong;
			$tongtien += $thanhtien;

			$table->addCell(500,$styleVCell)->addText($index, $myFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText($data->tentb, $myFontStyle, $myParagraphStyle );
			$table->addCell(11000,$styleVCell)->addText($data->mota, $myFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText(number_format($data->gia), $myFontStyle, $myParagraphStyle );
			$table->addCell(2000,$styleVCell)->addText($data->soluong, $myFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText(number_format($thanhtien), $myFontStyle, $myParagraphStyle );
			$table->addCell(4000,$styleVCell)->addText("", $myFontStyle, $myParagraphStyle );
			$index ++;
		}

		$cellColSpan = array('gridSpan' => 3);
		$table->addRow();
		$table->addCell(1000,$cellColSpan)->addText('TỔNG CỘNG', $myFontStyle_header, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText(NULL);
		$table->addCell(2000,$styleVCell)->addText(NULL );
		$table->addCell(3000,$styleVCell)->addText(number_format($tongtien), $myFontStyle_header, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText(NULL );

		$templateProcessor->setComplexBlock('table', $table);

		

		header("Content-Disposition: attachment; filename=DeNghi".time().".docx");
		$templateProcessor->saveAs("php://output");
	}
	

}
require 'vendor/autoload.php';
