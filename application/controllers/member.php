<?php
class Member extends Controller
{
	function Member()
	{
		parent::Controller();

	}

	function index(){
		$data = array();
		if($this->is_logged_in()){
			$data['page_main'] = 'beone_intro';
			$data['page_side_1'] = 'questions_menu.php';
			$this->load->view('includes/template', $data);
		}else{
			$data['page_main'] = 'beone_intro';
			$data['page_side_1'] = 'login_form.php';
			$this->load->view('includes/template', $data);
		}
	}

	function members_area()
	{
		$this->load->view('logged_in_area');
	}



	function another_page() // just for sample
	{
		echo 'good. you\'re logged in.';
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true){
			return false;
		}else{
			return true;
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}

}
?>