<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Admin
{
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Pages()
	{
		parent::MY_Admin();
		
		// Template Settings
		$this->template->metas('title', 'Administration Backend :: Pages');
	}

	// --------------------------------------------------------------------
	
	/**
	 * Controller Default Function
	 *
	 * @access	public
	 */
	function index()
	{
		$this->template->display('admin/pages');
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */