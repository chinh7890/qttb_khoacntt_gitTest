<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhatkycontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nguoidung/taikhoanmodel');
		$this->load->model('donvi/donvimodel');
		$this->load->model('nguoidung/hockymodel');
		$this->load->model('donvi/phong_khomodel');
		$this->load->model('maymocthietbi/danhsachmaymocthietbimodel');

		$this->load->model('nguoidung/hockymodel');
		$this->load->model('nguoidung/nhatkymodel');
		$this->load->model('nguoidung/log_tinhtrangmodel');
	}

	public function timphongmay(){
		$request = $this->input->post('q');

		$query = "SELECT id,maphong, tenphong
		FROM phong_kho 
		WHERE maphong LIKE '".$request."%' order by maphong asc LIMIT 10";
        $result = $this->phong_khomodel->setQuery($query);

		echo json_encode($result);;
	}

	public function laytenphongkho(){
		$idphong = $this->input->post('idphong');
		
        $result = $this->phong_khomodel->get_info($idphong);

		echo json_encode($result);
	}

	public function index()
	{
		$donvi = $this->donvimodel->getAlldata();

		$data = array();
		$data['donvi'] = $donvi;
		$data['hocky'] = $this->hockymodel->laydanhsach($this->session->userdata("madonvi"));
		$this->load->view('ghiso/kysonhatky', $data);
	}

	public function themhocky(){
		$hocky = $this->input->post('hocky');
		$tunam = $this->input->post('tunam');
		$dennam = $this->input->post('dennam');
		$madonvi = $this->session->userdata("madonvi");

		$data = array(
			'hocky' => $hocky,
			'tunam' => $tunam,
			'dennam' => $dennam,
			'ngaytao' => time(),
			'madonvi' => $madonvi,
		);
		$this->hockymodel->create($data);
		echo nguoidung_url('nhatkycontroller/index');
	}

	public function xoahocky()
	{
		$id = $this->uri->segment(4);
		$this->hockymodel->delete($id);
		redirect(nguoidung_url('nhatkycontroller/index'),'refresh');
	}

	public function capnhathocky(){
		$id = $this->input->post('idUpdate');
		$hockyUpdate = $this->input->post('hockyUpdate');
		$tunamUpdate = $this->input->post('tunamUpdate');
		$dennamUpdate = $this->input->post('dennamUpdate');
		$data = array(
			'hocky' => $hockyUpdate,
			'tunam' => $tunamUpdate,
			'dennam' => $dennamUpdate,
			'ngaytao' => time()
		);

		$this->hockymodel->update($id, $data);
		redirect(nguoidung_url('nhatkycontroller/index'),'refresh');
	}

	public function luuhockyhientai(){
		$idhocky = $this->input->post('idhocky');
		$hocky_cu = $this->hockymodel->get_info_rule(array('current' => 1)); 

		$this->hockymodel->update($hocky_cu->id, array('current' => 0));
		$this->hockymodel->update($idhocky, array('current' => 1));
		echo nguoidung_url('nhatkycontroller/index');
	}


	// =====================================SỔ NHẬT KÝ===============================
	public function hienthinhatky()
	{
		$this->load->model('tinhtrang/tinhtrangmodel');
		$this->load->model('maymocthietbi/loaimaymocthietbimodel');

		$donvi = $this->donvimodel->getAlldata();
		$data = array();
		$data['donvi'] = $donvi;
		$data['loaimay'] = $this->loaimaymocthietbimodel->getAlldata();
		$data['tinhtrang'] = $this->tinhtrangmodel->getAlldata();
		$data['hocky'] = $this->hockymodel->laydanhsach($this->session->userdata("madonvi"));
		$data['phong'] = $this->phong_khomodel->layphongkho($this->session->userdata("madonvi"));
		$data['user'] = $this->taikhoanmodel->getAlldata();
		$this->load->view('ghiso/ghisonhatky', $data);
	}

	public function themnhatky(){
		$idphong = $this->input->post('idphong');
		$iduser = $this->session->userdata("id");
		$giovao = $this->input->post('giovao');
		$giora = $this->input->post('giora');
		$mucdich = $this->input->post('mucdich');
		$tinhtrangtruoc = $this->input->post('tinhtrangtruoc');
		$tinhtrangsau = $this->input->post('tinhtrangsau');

		$rsHocKy = $this->nhatkymodel->layhockymoinhat();
		// $tinhtrangtruoc = str_replace('<br />', PHP_EOL, $tinhtrangtruoc);
		$data = array(
			'maphong' => intval($idphong),
			'matk' => intval($iduser),
			'mahocky' => intval($rsHocKy->id),
			'ngay' => date('Y-m-d'),
			'giovao' => $giovao,
			'giora' => $giora,
			'mucdichsd' => $mucdich,
			'tinhtrangtruoc' => $tinhtrangtruoc,
			'tinhtrangsau' => $tinhtrangsau,
			'ngaytao' => time()
		);

		$this->nhatkymodel->create($data);
		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function themnhatky_cu(){
		$mahocky = $this->input->post('hockycu');
		$ngay = $this->input->post('ngaycu');
		$iduser = $this->input->post("gvcu");

		$idphong = $this->input->post('idphongcu');
		$giovao = $this->input->post('giovaocu');
		$giora = $this->input->post('gioracu');
		$mucdich = $this->input->post('mucdichcu');
		$tinhtrangtruoc = $this->input->post('tinhtrangtruoccu');
		$tinhtrangsau = $this->input->post('tinhtrangsaucu');

		$data = array(
			'maphong' => intval($idphong),
			'matk' => intval($iduser),
			'mahocky' => $mahocky,
			'ngay' => $ngay,
			'giovao' => $giovao,
			'giora' => $giora,
			'mucdichsd' => $mucdich,
			'tinhtrangtruoc' => $tinhtrangtruoc,
			'tinhtrangsau' => $tinhtrangsau,
			'ngaytao' => time()
		);

		$this->nhatkymodel->create($data);
		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function capnhatnhatky(){
		$id = $this->input->post('idUpdate');
		$idphong = $this->input->post('idKhoUpdate');
		$giovao = $this->input->post('giovao');
		$giora = $this->input->post('giora');
		$mucdich = $this->input->post('mucdich');
		$tinhtrangtruoc = $this->input->post('tinhtrangtruoc');
		$tinhtrangsau = $this->input->post('tinhtrangsau');

		$data = array(
			'maphong' => $idphong,
			'giovao' => $giovao,
			'giora' => $giora,
			'mucdichsd' => $mucdich,
			'tinhtrangtruoc' => $tinhtrangtruoc,
			'tinhtrangsau' => $tinhtrangsau,
			'ngaycapnhat' => time()
		);

		$this->nhatkymodel->update($id, $data);
		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function capnhattinhtrang(){
		$id = $this->input->post('idUpdate');
		$ghichuUpdate = $this->input->post('ghichuUpdate');
		$tinhtrang = $this->input->post('tinhtrangUpdate');
		$data = array(
			'ghichutinhtrang' => $ghichuUpdate,
			'tinhtrang' => $tinhtrang
		);
		$this->danhsachmaymocthietbimodel->update($id, $data);


		// thông tin số máy
		$thietbi = $this->danhsachmaymocthietbimodel->get_info_rule(array('id' => $id)); 

		// tạo file log
		$ghichu = "";
		if($tinhtrang == "Hư hỏng"){
			$ghichu = "Báo cáo thiết bị hư hỏng máy $thietbi->somay($ghichuUpdate)";
		}else{
			$loinhan = "";
			if($ghichuUpdate != "") $loinhan = "($ghichuUpdate)";
			$ghichu = "Báo cáo máy $thietbi->somay đã được sửa chữa $loinhan";
		}
		$data = array(
			'matb' => $id,
			'ghichu' => $ghichu,
			'matk' => $this->session->userdata("id"),
			'ngaytao' => time()
		);

		$this->log_tinhtrangmodel->create($data);

		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function xoanhatky()
	{
		$id = $this->uri->segment(4);	
		$this->nhatkymodel->delete($id);
		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function laydulieu()
	{
		$idphong = $this->input->post('idphong');
		$idhocky= $this->input->post('idhocky');

        $arrKetQua = $this->nhatkymodel->laydulieu($idphong,$idhocky);

        $arrSodo = $this->nhatkymodel->sodophongmay($idphong);

        $tengv = $this->nhatkymodel->tengvql($idphong);
        
        $data = array(
            'mangketqua' => $arrKetQua,
            'sodo' => $arrSodo,
            'tengv' => $tengv,
        );
        echo json_encode($data);
	}

	public function sodophongmay(){
		
	}


	public function xuatsonhatky()
	{
		$idPhong = $this->input->post('phongmayin');
		$idHocky = $this->input->post('hockyin');

		// LẤY NHẬT KÝ SỬ DỤNG
		$arrNhatKy = $this->nhatkymodel->xuatsonhatky($idPhong, $idHocky);

		// LẤY DANH MỤC THIẾT BỊ PHÒNG
		$input['where'] = array('maphongkho' => $idPhong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);

		// $path = public_url("bieumau/nhatky_demo.docx");
		$path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\nhatky_demo.docx";

		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);

		// đặt tên phòng
		$rsphong = $this->phong_khomodel->get_info_rule(array('id' => $idPhong)); 
		$templateProcessor->setValues(array('tenphong'=> $rsphong->maphong));

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
		$myFontStyle = array('name' => 'Minion Pro', 'size' => 11, 'bold' => true);
		$myParagraphStyle = array('align'=>'center', 'spaceBefore'=>50, 'spaceafter' => 50);
		$styleVCell = array('valign'=>'center'); 

		// Header DANH MỤC
		$table->addRow();
		$table->addCell(500,$styleVCell)->addText('STT', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Mã TB', $myFontStyle, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Tên TB', $myFontStyle, $myParagraphStyle );
		$table->addCell(7000,$styleVCell)->addText('Thông số kỹ thuật', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Năm sử dụng', $myFontStyle, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Ghi chú', $myFontStyle, $myParagraphStyle );

		// row data DANH MỤC
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 11,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
		
		$index = 1;
		foreach ($arr as $data) {
			$table->addRow();
			$table->addCell(500,$styleVCell)->addText($index, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->maso, $dataFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText($data->tentb, $dataFontStyle, $myParagraphStyle );
			$table->addCell(7000,$styleVCell)->addText($data->mota, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->namsd, $dataFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText($data->ghichu, $dataFontStyle, $myParagraphStyle );
			$index ++;
		}

		$templateProcessor->setComplexBlock('table', $table);

		$values = [];
		foreach ($arrNhatKy as $data) {
			array_push($values, [
					'ngay' => date("d/m/Y", strtotime($data['ngay'])),
					'giovao' =>$data['giovao'],
					'giora' =>$data['giora'],
					'monhoc' => preg_replace('~\R~u', '</w:t><w:br/><w:t>', 
						str_replace("&", " và ", $data['mucdichsd'])),
					'tinhtrangtruoc' => preg_replace('~\R~u', '</w:t><w:br/><w:t>', $data['tinhtrangtruoc']),
					'tinhtrangsau' => preg_replace('~\R~u', '</w:t><w:br/><w:t>', $data['tinhtrangsau']),
					'hoten' =>$data['hoten']
			]);

		}
		$templateProcessor->cloneRowAndSetValues ('ngay',$values);

		header("Content-Disposition: attachment; filename=nhatky.docx");
		$templateProcessor->saveAs("php://output");
	}

	// LOG_ TINH TRẠNG
	public function hienthitinhtrang(){
		// $donvi = $this->donvimodel->getAlldata();
		$data = array();
		// $data['donvi'] = $donvi;
		$data['phong'] = $this->phong_khomodel->layphongkho($this->session->userdata("madonvi"));
		$this->load->view('ghiso/log_tinhtrang', $data);
	}

}
require 'vendor/autoload.php';