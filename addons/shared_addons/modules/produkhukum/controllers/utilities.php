<?php

class Utilities extends MY_Controller {

	function Utilities()
	{
		parent::MY_Controller();
	}

	// --------------------------------------------------------------------

	function index()
	{
		$data['page_title'] = $this->lang->line('menu_utilities');
		$this->template->display('admin/utilities/index', $data);
	}

	function database_backup()
	{

			$this->load->dbutil();
			$this->load->helper(array('file', 'download'));

			$filename = ($this->config->item('download_filename_prefix') != '') ? $this->config->item('download_filename_prefix') : 'direktorihukum';

			$prefs = array(
							'format' 	=> 'zip',
							'filename' 	=> $filename.'_'.date ("Ymd").'.zip',
						);

			// Backup your entire database and assign it to a variable
			$backup =& $this->dbutil->backup($prefs);
			write_file('db_temp/' . $prefs['filename'], $backup);
			force_download($prefs['filename'], $backup);
	}
}
?>