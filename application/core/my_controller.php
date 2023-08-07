<?php 
/**
 * summary
 */
class My_controller extends CI_Controller
{
    /**
     * summary
     */
    public function __construct()
    {
        parent::__construct();
        $this->check_url();
    }

    private function check_url()
    {
    	$hoten = $this->session->userdata('hoten');
        // $quyen = $this->session->userdata('quyen');

        if($hoten == NULL)
        {
            redirect(login_url('logincontroller/index'),'refresh');
        }

        // if(!$hoten)
        // {
        //     redirect(login_url('login/login'));
        // }
    }
}
?>