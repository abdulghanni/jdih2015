<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller
{
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Profile()
	{
		parent::MY_Controller();
		
		// Load required classes
		$this->load->model('users_model', 'users');
		
		// Template Settings
		$this->template->sidebar('member');
		$this->template->metas('title', 'Member Backend :: Profile');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Remap controller calls
	 *
	 * @access	public
	 */
	function _remap($method)
	{		
		// The safest way to do this - don't use method_exists
		$methods = array('show', 'edit');
		
		if ( in_array($method, $methods) )
		{
			$this->$method();
		}
		else
		{
			$this->show(intval($method));
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Show a public user profile
	 *
	 * @access	public
	 */
	function show($id = '')
	{
		$data['user'] = ($id == '') ? $this->user : $this->users->get_user($id);
		
		if( count($data['user']) < 1)
		{
			$this->session->set_flashdata('msg', 'The page you were looking for could not be found.');
			redirect();
		}
		
		$this->template->metas('title', 'Member Backend :: Profile :: '.$data['user']->username);
		$data['user']->join_date = strtotime($data['user']->join_date . " GMT");	// unix timestamp
		
		$this->template->sidebar('member');
		$this->template->display('member/profile/show', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Edit your own profile
	 *
	 * @access	public
	 */
	function edit()
	{
		$this->template->metas('title', 'Member Backend :: Profile :: Edit');
		
		$this->access->restrict();
		
		$this->load->library('validation');
		$this->load->helper('form');	

		$rules = array(
				'name'			=>	'trim|strip_tags|xss_clean|max_length[50]',
				'surname'		=>	'trim|strip_tags|xss_clean|max_length[50]',
				'location'		=>	'trim|strip_tags|xss_clean|max_length[50]',
				'password'		=>	'trim',
				'pass_conf'		=>	'trim|matches[password]',
				'email'	 		=>	'trim|required|valid_email|check_email['.$this->user->email.']',
				'old_password'	=>	'trim|required|check_password'
		);
		$this->validation->set_rules($rules);
		
		$fields = array(
				'name'			=>	'first name',
				'surname'		=>	'last name',
				'location'		=>	'location',
				'password'		=>	'new password',
				'pass_conf'		=>	'password confirmation',
				'email'			=>	'email',
				'old_password'	=>	'existing password'
		);
		$this->validation->set_fields($fields);
				
		if ($this->validation->run() == FALSE)
		{
			$this->template->display('member/profile/edit');
		}
		else
		{
			$this->users->update_profile();
			$this->session->set_flashdata('msg', 'Profile Information Saved');
			redirect('member/profile/edit');
		}
	}
}

/* End of file profile.php */
/* Location: ./application/controllers/member/profile.php */