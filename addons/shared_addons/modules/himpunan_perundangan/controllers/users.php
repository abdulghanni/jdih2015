<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Admin
{
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Users()
	{
		parent::MY_Admin();
		
		// Load required classes
		$this->load->model('users_model', 'users');
		
		// Template Settings
		$this->template->metas('title', 'Administration Backend :: Users');
	}

	// --------------------------------------------------------------------
	
	/**
	 * List all users
	 *
	 * @access	public
	 */
	function index()
	{
		$data['users'] = $this->users->get_all_users();		
		$data['content'] = $this->load->view('admin/users/list', $data, TRUE);
		
		$this->template->display('admin/users/list', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Registration Page
	 *
	 * @access	public
	 */
	function add()
	{
		$this->template->metas('title', 'Tambah Pengguna');
		$this->template->sidebar('member');

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
			
			$this->template->display('admin/users/add', $data);
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
					redirect('admin/users');
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
	 * Remove a user
	 *
	 * @param	integer	id of the user to remove
	 * @access	public
	 */
	function remove($id)
	{
		confirm('Do you really want to delete this user and all his entries?');
				
		// Superadmin id == 1
		if ($id === '1')
		{
			// @TODO: Style have to go in a CSS stylesheet, not mixed in code
			$this->session->set_flashdata('msg', '<b style="color: #800;">Superadmin cannot be deleted</b>');
			redirect('admin/users');
		}
		else if ($this->user->id !== '1' AND $this->access->get_group($id) === 'Administrators')
		{
			show_error('You do not have permission to delete other Administrators.');
		}
		
		$this->load->model('listings_model', 'listings');
		
		$this->listings->delete_user_entries($id);
		$this->users->delete($id);
		
		$this->session->set_flashdata('msg', 'User Deleted');
		redirect('admin/users');
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */