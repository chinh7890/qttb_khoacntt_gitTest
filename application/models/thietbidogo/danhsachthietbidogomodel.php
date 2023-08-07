<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class danhsachthietbidogomodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='thietbidogo';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('thietbidogo');
		$data=$data->result_array();
		return $data;
	}

  public function soluongthietbi_donvi(){
      $query = "SELECT COUNT(tb.id) AS soluong, dv.tenviettat
      FROM thietbidogo tb, donvi dv, phong_kho pk 
      WHERE dv.id = pk.madonvi AND pk.id = tb.maphongkho
      GROUP BY dv.id
      ORDER BY soluong DESC";
      return $this->db->query($query)->result_array();
  }

	public function checkMaSo($model)
	{
		$query = 'SELECT maso FROM thietbidogo WHERE model="'.$model.'" ORDER BY id DESC LIMIT 1';
		return $this->db->query($query)->result_array();
	}

  public function laydonvicu($idphongkho){
      $query = 'SELECT DISTINCT tendonvi, maphong FROM phong_kho pk, donvi dv, thietbidogo tb WHERE pk.madonvi = dv.id AND tb.maphongkho = pk.id AND tb.id='. $idphongkho;
      return $this->db->query($query)->row();
  }

  public function layphongkho($iddonvi){
      $query = 'SELECT * FROM phong_kho WHERE madonvi='. $iddonvi;
      return $this->db->query($query)->result_array();
  }

  public function layphongkhobangten($iddv){
    $query = 'SELECT pk.id,pk.maphong FROM phong_kho pk WHERE madonvi = "'. $iddv.'" ORDER BY maphong';
    return $this->db->query($query)->result_array();
  }
  
  public function layNamSD($iddv){
      $query = 'SELECT DISTINCT namsd 
          FROM thietbidogo tb, phong_kho pk, donvi dv
          WHERE tb.maphongkho = pk.id AND pk.madonvi = dv.id AND dv.id = "'.$iddv.'" ORDER BY namsd ASC';
      return $this->db->query($query)->result_array();
  }

	public function themthietbidogo($data){
		$this->db->db_debug = false;

    if(!@$this->db->insert('thietbidogo',$data))
    {
        $error = $this->db->error();
        return false;
    }else{
        return $this->db->insert_id();
    }
	}

	public function layDSTheoDonVi($madonvi){
		$this->db->select('tb.id,
        					tb.tentb,
							tb.mota,
							tb.maso,
							tb.namsd,
							tb.nguongoc,
							tb.donvitinh,
							tb.gia,
							tb.chatluong,
							tb.maphongkho,
							tb.ghichu,
							tb.soluong,
							tb.maloai,
							dv.tendonvi,
							dv.tenviettat,
							loaitb.tenloai,
							tb.tinhtrang,
							pk.tenphong,
							pk.maphong
							');
        $this->db->from('thietbidogo tb, 
        	phong_kho pk, 
        	donvi dv,
        	loaithietbidogo loaitb
        	');
        $this->db->where('pk.id = tb.maphongkho');
        $this->db->where('pk.madonvi = dv.id');
        $this->db->where('loaitb.id = tb.maloai');
        $this->db->where('dv.id = '.$madonvi);
        
        $arrThietBi = $this->db->get()->result_array();

        return $arrThietBi;
	}


	public function laydulieuTongHop($madonvi)
	{
		$query = "SELECT DISTINCT *,COUNT(tentb) as soluong FROM thietbidogo tb,phong_kho pk, donvi dv WHERE pk.madonvi = dv.id AND tb.maphongkho = pk.id AND dv.id = ".$madonvi." group by tentb, maphongkho,tinhtrang,chatluong";
		return $this->db->query($query)->result_array();
	}


	// pagination
	var $table = "thietbidogo";  

    function make_condition($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong){
    	if($donvi != NULL)
        {
        	$this->db->where('dv.id = '.$donvi);
        }

        if($tenloai == "Xem tất cả"){}
        else if($tenloai != NULL)
        {
          $this->db->where('loaitb.tenloai = "'.$tenloai.'"');
        }

        if($nguongoc != NULL)
        {
        	$this->db->where('tb.nguongoc = "'.$nguongoc.'"');
        }

        if($tinhtrang != NULL)
        {
        	$this->db->where('tinhtrang LIKE "%'.$tinhtrang.'%"');
        }

        if($maphong != NULL)
        {
        	$this->db->where('tb.maphongkho = '.$maphong);
        }

        if($namsd != NULL){
            $this->db->where('tb.namsd = '.$namsd);
        }

        // lọc giá
        if($gia != NULL)
        {
        	if($gia == 1999999){
        		$this->db->where('tb.gia < 1999999');
        	}else if($gia == 15000000){
        		$this->db->where('tb.gia >= 15000000');
        	}else{
        		list($min, $max) = explode('-', $gia);
        		$this->db->where('tb.gia BETWEEN '.$min.' AND '.$max);
        	}
        }

        // lọc chất lượng
        if($chatluong != NULL)
        {
            if($chatluong == "0"){
                $this->db->where('tb.chatluong = 0');
            }
            else{
                list($minCL, $maxCL) = explode('-', $chatluong);
                $this->db->where('tb.chatluong BETWEEN '.$minCL.' AND '.$maxCL);
            }
        }
    }

    function make_query($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong)  
     {  
   		$this->db->select('tb.id,
					tb.tentb,
					tb.mota,
					tb.maso,
					tb.namsd,
					tb.nguongoc,
					tb.donvitinh,
					tb.gia,
					tb.chatluong,
					tb.tontai,
					tb.maphongkho,
					tb.ghichu,
					tb.maloai,
					tb.matinhtrang,
          tb.model,
					dv.tendonvi,
          dv.tenviettat,
					loaitb.tenloai,
					tinhtrang,
					pk.tenphong,
					pk.maphong
					');
        $this->db->from('thietbidogo tb, 
        	phong_kho pk, 
        	donvi dv,
        	loaithietbidogo loaitb
        	');
        $this->db->where('pk.id = tb.maphongkho');
        $this->db->where('pk.madonvi = dv.id');
        $this->db->where('loaitb.id = tb.maloai');
        // $this->db->where('tt.id = tb.matinhtrang');

        $this->make_condition($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong);

       if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != null)  
       {  
       		$this->db->group_start();
            $this->db->like("tb.tentb", $_POST["search"]["value"]);  
            $this->db->or_like("tb.maso", $_POST["search"]["value"]);  
            $this->db->or_like("tb.namsd", $_POST["search"]["value"]);  
            $this->db->or_like("dv.tendonvi", $_POST["search"]["value"]);  
            $this->db->or_like("tb.chatluong", $_POST["search"]["value"]);
            $this->db->group_end();
       }  
        
        $order_column = "";
        if(($this->session->userdata("tendonvi") == $donvi && $this->session->userdata("quyenhan") == "2") || $this->session->userdata("quyenhan") == "1"){
                $order_column = array(null, null, "maso", "tentb", "mota","namsd","nguongoc","donvitinh","gia","maphongkho","chatluong","ghichu","model","tinhtrang");  
        }
        else{
            $order_column = array(null, null , "tentb", "mota","namsd","nguongoc","donvitinh","gia","maphongkho","chatluong","ghichu","model","tinhtrang"); 
        } 

        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
      }  
      function make_datatables($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong){  
           $this->make_query($donvi, $tenloai,$nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong);  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong){  
           $this->make_query($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong);  

           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong)  
      {  
        $this->db->select('tb.id,
			tb.tentb,
			tb.mota,
			tb.maso,
			tb.namsd,
			tb.nguongoc,
			tb.donvitinh,
			tb.gia,
			tb.chatluong,
			tb.maphongkho,
			tb.ghichu,
			tb.tontai,
			tb.maloai,
			tb.matinhtrang,
			dv.tendonvi,
			loaitb.tenloai,
			tinhtrang,
			pk.tenphong,
			pk.maphong
			');
        $this->db->from('thietbidogo tb, 
        	phong_kho pk, 
        	donvi dv,
        	loaithietbidogo loaitb
        	');

        $this->make_condition($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $namsd, $chatluong);

        $this->db->where('pk.id = tb.maphongkho');
        $this->db->where('pk.madonvi = dv.id');
        $this->db->where('loaitb.id = tb.maloai');
        // $this->db->where('tt.id = tb.matinhtrang'); 
           return $this->db->count_all_results();  
      }  
}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */