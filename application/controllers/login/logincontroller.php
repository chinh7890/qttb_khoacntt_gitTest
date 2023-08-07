<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logincontroller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login/loginmodel');
		$this->load->model('nguoidung/loaitaikhoanmodel');
		$this->load->model('donvi/donvimodel');
	}

	public function index()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('login','login','callback_check_login');	
			if ($this->form_validation->run()) {
				$user = $this->input->post('username');

				$input = array('email' => $user);
				$account = $this->loginmodel->get_info_rule($input);
				$this->session->set_userdata('hoten',$account->hoten);
				$this->session->set_userdata('id',$account->id);
				
				// đặt quyền
				// $input = array('id' => $account->maloaitk);
				// $loaitk = $this->loaitaikhoanmodel->get_info_rule($input);
				$this->session->set_userdata('quyenhan',$account->maloaitk);

				// đơn vị
				if($account->madonvi == NULL){
					$this->session->set_userdata('tendonvi',null);
				}else{
					$input = array('id' => $account->madonvi);
					$donvi = $this->donvimodel->get_info_rule($input);
					$this->session->set_userdata('tendonvi',$donvi->tendonvi);
					$this->session->set_userdata('madonvi',$donvi->id);
				}
				

				redirect(base_url('homecontroller'),'refresh');
			} 
		}
		$this->load->view('login/login');
	}

	public function check_login()
	{
		$user = $this->input->post('username');
		$password = $this->input->post('pass');
		$where = array('email'=>$user,'matkhau'=>$password);

		if($this->loginmodel->check_exists($where))
		{
			return true;
		}
		else {
			$this->form_validation->set_message(__FUNCTION__ ,'Không đăng nhập thành công');
			return false;
		}
	}

	function logout()
	{
		if($this->session->userdata('hoten') != NULL)
		{
			$this->session->unset_userdata('hoten');
			$this->load->view('login/login');
		}
	}

	public function doimatkhau()
	{
		
		$this->load->view('login/doimatkhau');
	}

	public function luumatkhau()
	{
		if($this->input->post())
		{
			$user = $this->input->post('username');
			$passcu = $this->input->post('passcu');
			$passmoi = $this->input->post('passmoi');

			$input = array('email' => $user);
			$account = $this->loginmodel->get_info_rule($input);
			
			if($account == NULL)
			{
				echo "Không có tài khoản ".$user;
			}
			else if($account->matkhau != $passcu)
			{
				echo "Mật khẩu cũ không đúng!";
			}
			else if($passmoi == NULL)
			{
				echo "Mật khẩu mới không bỏ trống!";
			}
			else
			{
				$data = array('matkhau' => $passmoi);
				$this->loginmodel->update($account->id, $data);
				echo "homecontroller";
			}
		}
		else{
			// $this->load->view('login/doimatkhau');
			echo "Không bỏ trống";
		}
	}
}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */