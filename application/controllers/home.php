<?php
class Home extends Controller{
	private $pagename;

	function Home(){
		parent::Controller();
		$this->pagename = "Home";
	}

	function index(){
		$data['page_main'] = 'beone_intro';
		$data['page_side_1'] = 'login_form';
		$this->load->view('includes/template', $data);
	}

	function register(){
		$data['page_main'] = 'register_form';
		//$data['page_side_1'] = 'login_form';
		$this->load->view('includes/template', $data);
	}

	function activate(){
		$data['page_main'] = 'activate_form';
		//$data['page_side_1'] = 'login_form';
		$this->load->view('includes/template', $data);
	}

	function register_action(){
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|callback_email_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('repassword', 'Retype Password', 'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->register();
		}

		else
		{
			$this->load->model('member_model');

			if($query = $this->member_model->register_member())
			{
				/*send an email*/
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			}
			else
			{
				$this->register();
			}
		}
	}

	function activate_action(){
		$this->form_validation->set_rules('code', 'Activation Code', 'trim|required|exact_length[32]|callback_code_check');

		if($this->form_validation->run() == FALSE)
		{
			$this->activate();
		}

		else
		{
			$this->load->model('member_model');

			if($query = $this->member_model->activate_member())
			{
				redirect(base_url());
			}
			else
			{
				$this->register();
			}
		}
	}


	function email_check($email)
	{
		$this->load->model('member_model');

		if($query = $this->member_model->is_email_used())
		{
			$this->form_validation->set_message('email_check', 'The %s is registered already');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function code_check($email)
	{
		$this->load->model('member_model');

		$check_result = $this->member_model->code_check();

		if($check_result==1)
		{
			$this->form_validation->set_message('code_check', 'The %s has been activated');
			return FALSE;
		}else if($check_result==-1){
			$this->form_validation->set_message('code_check', 'The %s does not exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function login_action(){
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}

		else
		{
			$this->load->model('member_model');

			if($query = $this->member_model->login())
			{
				$data = array(
				/*TODO: Sessions must use ID and not Email */
				'email' => $this->input->post('email'),
				'is_logged_in' => true
				);
				
				$this->session->set_userdata($data);
				redirect('member');
			}
			else
			{
				$this->index();
			}
		}
	}
}
?>