<?php
class Member_model extends Model{


	private function register_email($email, $code){
		$this->email->set_newline("\r\n");

		$this->email->from('beone@trilabs.co.tz', 'beOne Register');
		$this->email->to($email);
		$this->email->subject('beOne Registration');
		$message = "Hi,<br />";
		$message .= "Thank for registering to the beOne, marriage counselling tool.<br />";
		$message .= "<a href='http://localhost/beone/index.php/home/activate'>Activate your account</a><br />";
		$message .= "Your coupling code is <strong>".$code."</strong>. <br />Please keep this email, you will need this code to pair up with your fiance<br /><br />";
		$message .= "Regards.<br /> beOne Team";
		$this->email->message($message);

		if($this->email->send())
		{
			return TRUE;
		}else{
			show_error($this->email->print_debugger());
		}
	}

	function validate()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('membership');

		if($query->num_rows == 1)
		{
			return true;
		}

	}

	function register_member()
	{
		$code = md5(time());
		$member_data = array(
			'email'=>$this->input->post('email'),
			'security'=>0, 
			'secretword'=>md5($this->input->post('password')), 
			'status'=>0, 
			'lastlogin'=>date('Y-m-d H:i:s'), 
			'code'=>$code);

		if($this->db->insert('login', $member_data)){
			return $this->register_email($this->input->post('email'), $code);
		}
	}

	function is_email_used() {
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('login');

		if ($query->num_rows == 1) {
			return true;
		}else{
			return false;
		}
	}

	function code_check() {
		$this->db->where('code', $this->input->post('code'));
		$query = $this->db->get('login');

		if ($query->num_rows == 1) {
			$row = $query->row();
			if($row->status==1){
				return 1;
			}else{
				return 0;
			}
		}else{
			return -1;
		}
	}

	function activate_member(){
		$data = array('status' => 1);
		$this->db->where('code', $this->input->post('code'));

		return $this->db->update('login', $data);
	}
	

	function login()
	{
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('secretword', md5($this->input->post('password')));
		$query = $this->db->get('login');

		if($query->num_rows == 1)
		{
			return true;
		}else{
			return false;
		}
	}

}