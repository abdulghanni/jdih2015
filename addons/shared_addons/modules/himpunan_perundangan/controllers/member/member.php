<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller
{
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Member()
	{
		parent::MY_Controller();
		
		// Template Settings
		$this->template->sidebar('member');
		$this->template->metas('title', 'Member Backend');
	}

	// --------------------------------------------------------------------
	
	/**
	 * Controller Default Function
	 *
	 * @access	public
	 */
	function index()
	{
		$this->access->restrict();

		$this->template->display('member/home');
	}

	// --------------------------------------------------------------------
	
	/**
	 * Registration Page
	 *
	 * @access	public
	 */
	function register()
	{
		$this->template->metas('title', 'Registration');
		$this->template->sidebar('register');
		
		// Only logged out users
		$this->access->restrict('logged_out');

		// Load required files
		$this->load->library('validation');
		$this->load->helper('form');
		
		// Set rules
		$rules = array(
				'email'	 		=>	'trim|required|valid_email|check_email',
				'username'		=>	'trim|required|strip_tags|xss_clean|max_length[15]|check_username',
				'password'		=>	'trim|required',
				'p_confirm'		=>	'trim|required|matches[password]',
				'name'			=>	'trim|strip_tags|xss_clean|max_length[50]',
				'f_name'		=>	'trim|strip_tags|xss_clean|max_length[50]',
				'location'		=>	'trim|strip_tags|xss_clean|max_length[50]',
				'terms'			=>	'trim|required|check_terms',
		);
		$this->validation->set_rules($rules);
		
		// Set fields
		$fields = array(
				'email'	 		=>	'e-mail',
				'username'		=>	'username',
				'password'		=>	'password',
				'p_confirm'		=>	'password confirmation',
				'name'			=>	'last name',
				'f_name'		=>	'first name',
				'location'		=>	'location',
				'terms'			=>	'terms',
		);
		$this->validation->set_fields($fields);
		
		// The only isset rule we have is the terms - perfect
		$this->validation->set_message('isset', 'You must agree to the terms to use this service.');
		
		// Run the validation
		if ($this->validation->run() == FALSE)
		{
			$data['token'] = generate_token();
			
			$this->template->display('member/register', $data);
		}
		else
		{
			$userdata = array(
					'surname'		=>	$this->input->post('name'),
					'name'			=>	$this->input->post('f_name'),
					'username'		=>	$this->input->post('username'),
					'email'			=>	$this->input->post('email'),
					'password'		=>	$this->input->post('password'),
					'location'		=>	$this->input->post('location'),
					'active'		=>	'1'
							);
						
			$register = $this->access->register($userdata);
			
			switch($register)
			{
				case 'REGISTRATION_SUCCESS':
					$this->session->set_flashdata('msg', 'Registration complete! You can now log in.');
					redirect('member/login');
				case 'REGISTRATION_SUCCESS_EMAIL':
					$this->session->set_flashdata('msg', 'Registration complete, a confirmation email has been sent!');
					redirect('');
				default:
					show_error('Registration failed');
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Login Function
	 *
	 * @access	public
	 */
	function login()
	{
		// Only logged out users
		$this->access->restrict('logged_out');

		// Load required files
		$this->load->library('validation');
		$this->load->helper('form');

		$rules = array(
				'username'	=>	'trim|required|strip_tags|xss_clean',
				'password'	=>	'trim|required',
				'token'		=>	'check_login|required'
		);
		
		$this->validation->set_rules($rules);
		
		$fields = array(
				'username'	=>	'username',
				'password'	=>	'password'
		);
		
		$this->validation->set_fields($fields);
		
		if ($this->validation->run() == FALSE)
		{
			$this->template->metas('title', 'Login');
			$data['token'] = generate_token();
			
			$this->session->keep_flashdata('referrer');
			$this->template->display('member/login', $data);
		}
		else
		{
			$uri = $this->session->flashdata('referrer') ? $this->session->flashdata('referrer') : 'member';
			redirect($uri);
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Logout Function
	 *
	 * @access	public
	 */
	function logout()
	{
		if ($this->user->confirm_logout)
		{
			confirm('Really log out?');
		}
		
		$this->access->logout();
		redirect('');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Forgotten Password Function
	 *
	 * @access	public
	 */
	function forgot()
	{
		$this->load->library('validation');		
		$this->load->helper('form');

		$rules['email'] = 'trim|required|email';
		$this->validation->set_rules($rules);
		
		$fields['email'] = 'email';
		$this->validation->set_fields($fields);
		
		if ($this->validation->run() == FALSE)
		{
			$this->template->metas('title', 'Forgotten Password');
			$this->template->display('member/forgot');
		}
		else
		{
			if ( $this->access->forgotten_password($this->input->post('email')) )
			{
				$this->session->set_flashdata('msg', 'A new password has been sent.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'An error occurred.');
			}
			redirect('member/login');
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Activate Email Verified Account
	 *
	 * @access	public
	 */
	function activate($code = FALSE)
	{
		if (! $code)
		{
			show_404();
		}

		if ($this->access->activate($code))
		{
			$this->session->set_flashdata('msg', 'Your account has been activated');
			redirect('member/login');
		}
		else
		{
			show_404();
		}
	}
}

/* End of file member.php */
/* Location: ./application/controllers/member/member.php */