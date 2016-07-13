<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Comments controller (frontend)
 *
 * @package		PyroCMS\Core\Modules\Comments\Controllers
 * @author		PyroCMS Dev Team
 * @copyright   Copyright (c) 2012, PyroCMS LLC
 */
class Tes extends CI_Controller
{
	/**
	 * An array containing the validation rules
	 * 
	 * @var array
	 */
	private $validation_rules = array(
		array(
			'field' => 'name',
			'label' => 'Nama Pengirim',
			'rules' => 'trim'
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email'
		),
		array(
			'field' => 'subject',
			'label' => 'Subyek',
			'rules' => 'trim|required|max_length[255]'
		),
		array(
			'field' => 'message',
			'label' => 'Pesan',
			'rules' => 'trim|required'
		),
	);

	/**
	 * Constructor method
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Create a new comment
	 *
	 * @param type $module The module that has a comment-able model.
	 * @param int $id The id for the respective comment-able model of a module.
	 */
	public function index()
	{
		$this->load->view('tes/index');
	}
}
