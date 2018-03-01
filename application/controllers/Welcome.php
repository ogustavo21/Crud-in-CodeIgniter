<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){

        parent::__construct();
        $this->load->database();
  			$this->load->helper('url');
  	 		$this->load->model('user_model');
       		$this->load->library('session');

}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function example(){

		$this->load->view('example.php');
						}


function login_user(){
  $user_login=array(

  'user_email'=>$this->input->post('user_email'),
  'user_password'=>$this->input->post('user_password')

    );

    $data=$this->user_model->login_user($user_login['user_email'],$user_login['user_password']);
      if($data)
      {
        $this->session->set_userdata('user_id',$data['id']);
        redirect('examples');

      }
      else{
        $this->session->set_flashdata('error_msg', 'Ocurrio un eror, Intenta nuevamente');
        $this->load->view("welcome_message.php");

      }

}
}
