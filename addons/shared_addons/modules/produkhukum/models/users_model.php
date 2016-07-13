<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Users_model extends MY_Model
{
	
	var $table				= 'users';
	var $groups_table		= 'user_groups';
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Users_model()
	{
		parent::__construct();
	}
	
	// =============================
	// = ========== GET ========== =
	// =============================
		
	/**
	 * Get relevant user information by id
	 *
	 * @access	public
	 * @param	integer	User ID
	 */
	function get_user($id)
	{
		$this->db->select('user_id, join_date, location, name, surname, username, email, '.$this->db->dbprefix($this->groups_table).'.title AS user_group', FALSE);
		$this->db->join($this->groups_table, $this->groups_table.'.group_id = '.$this->table.'.FK_group_id');
		
		$query = $this->db->get_where($this->table, array('user_id' => $id));		
		return $query->row();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all users
	 *
	 * @access	public
	 */
	function get_all_users()
	{
		$this->db->select('user_id, join_date, name, surname, username, email, '.$this->db->dbprefix($this->groups_table).'.title AS user_group', FALSE);
		$this->db->join($this->groups_table, $this->groups_table.'.group_id = '.$this->table.'.FK_group_id');
		
		$query = $this->db->get($this->table);
				
		return $query->result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get Group
	 *
	 * Returns user group from db
	 *
	 * @access	private
	 * @param	string	table, user, where
	 * @return	string
	 */
	function get_group($id)
	{
		$this->db->select('title');
		$this->db->where('group_id IN (SELECT FK_group_id FROM '.$this->db->dbprefix($this->table).' WHERE user_id = '.$id.')', NULL, FALSE);
		
		$query = $this->db->get($this->groups_table);

		if ($query->num_rows() > 0)
		{
			$query = $query->row();
			return $query->title;
		}
		
		$query->free_result();
		return FALSE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Get Login Info
	 *
	 * Gets info needed for login
	 *
	 * @access	private
	 * @param	string	table, where
	 * @return	mixed
	 */
	function get_login_info($username)
	{
		$this->db->select('password, email, user_id, hash, last_failure, failed_logins, activation_code, change_password, active');
		$this->db->where('username', $username);
		$i = $this->db->get($this->table, 1, 0);

		return $var = ($i->num_rows() > 0) ? $i->row() : FALSE;
	}

	// =============================
	// = ========== ADD ========== =
	// =============================
	
	/**
	 * Add User
	 *
	 * Add user to the db
	 *
	 * @access	private
	 * @param	string	table, where
	 * @return	mixed
	 */
	function add_user($userdata)
	{		
		$this->db->set($userdata);
		$this->db->insert($this->table);
	}
	
	// ================================
	// = ========== UPDATE ========== =
	// ================================
	
	/**
	 * Insert New Password
	 *
	 * @access	private
	 * @param	string	password, username, salt
	 * @param	bool	force user password change
	 * @return	bool
	 */
	function update_password($password, $email, $change = FALSE)
	{
		$hash = sha1(microtime());
		$salt = $this->config->item('auth');
		$salt = $salt['salt'];

		$password = sha1($salt.$hash.$password);

		$change = $change ? '1' : '0';
		$data = array(
				'change_password'		=> $change,
				'password'				=> $password,
				'hash' 					=> $hash
        );

		$this->db->where('email', $email);
		$this->db->update($this->table, $data);
		
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update User Information
	 *
	 * @access	private
	 * @return	bool
	 */
	function update_profile()
	{
		$data = array(
			'name'		=>	$this->input->post('name'),
			'surname'	=>	$this->input->post('surname'),
			'location'	=>	$this->input->post('location'),
			'email'		=>	$this->input->post('email')
		);
		
		if($this->input->post('password'))
		{
			$this->update_password($this->input->post('password'), $this->user->email);
		}
		
		$this->db->where('email', $this->user->email);
		$this->db->update($this->table, $data);
		
	}
		
	// ================================
	// = ========== DELETE ========== =
	// ================================
	
	/**
	 * Delete a user
	 *
	 * @access	public
	 */
	function delete($id)
	{
		$this->db->delete($this->table, array('user_id' => $id));
	}
	
	// ================================
	// = ========== OTHERS ========== =
	// ================================

	/**
	 * Activate
	 *
	 * Sets activation code to null
	 *
	 * @access	private
	 * @param	string table, code
	 * @return	bool
	 */
	function activate ($code)
	{
		$this->db->where($this->table.'.activation_code', $code);
		$this->db->update($this->table, array($this->table.'.activation_code' => 0));

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Checks if $value for $field is already used
	 *
	 * @access	private
	 * @param	string	email
	 * @return	bool
	 */
	function check_unique($field, $value)
	{
		$this->db->select($field);
		$this->db->where($field, $value);
		$this->db->limit(1);
		
		return ($this->db->count_all_results($this->table) > 0) ? TRUE : FALSE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Increment failure count and set last login time
	 *
	 * @access	public
	 * @return	object	user object
	 */
	function increment_failures($id, $failed_so_far)
	{
		$now = time();
		$this->db->where('user_id', $id);
		
		if($failed_so_far < 4) // Not relevant beyond this point
		{
			$this->db->set('failed_logins', 'failed_logins + 1', FALSE);
		}
		
		$this->db->set('last_failure', $now);
		$this->db->update($this->table);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Resets login failure count
	 *
	 * @access	public
	 * @return	object	user object
	 */
	function reset_failures($id)
	{		
		$this->db->where('user_id', $id);
		$this->db->set('failed_logins', 0);
		
		$this->db->update($this->table);
	}

}

// END user_model.php
/* Location: ./application/models/users_model.php */