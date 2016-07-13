<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends Admin_Controller
{
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function __construct()
	{
		parent::Admin_Controller();
		
		// Load required classes
		$this->load->model('listings_model', 'listings');
		$this->load->library('validation');

	}

	// --------------------------------------------------------------------
	
	/**
	 * List all categories
	 *
	 * @access	public
	 */
	function index()
	{
		$this->data->categories = $this->listings->get_all_categories();
		$this->layout->create('admin/categories/list', $this->data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add a new category
	 *
	 * @access	public
	 */
	function add()
	{
		$this->template->metas('title', 'Administration Backend :: Categories :: Add');
		
		$this->load->helper('form');
		
		if ( ! $this->_validate_form() )
		{
			$this->template->display('admin/categories/add');
		}
		else
		{
			$id = $this->listings->add_category();
			$this->session->set_flashdata('msg', 'Category Created ['.anchor('member/listings/add/'.$id, 'Add an Entry').'].');
			redirect('admin/categories');
		}
	}
	
	// --------------------------------------------------------------------
		
	/**
	 * Edit a category
	 *
	 * @param	integer	id of the category to edit
	 * @access	public
	 */
	function edit($id)
	{
		$this->template->metas('title', 'Administration Backend :: Categories :: Edit');
		
		$this->load->helper('form');
		
		$data['category'] = $this->listings->get_category($id);
		
		if ( ! $this->_validate_form( $data['category']->name ) )
		{
			$this->template->display('admin/categories/edit', $data);
		}
		else
		{
			$this->listings->update_category($id);
			$this->session->set_flashdata('msg', 'Category Updated');
			redirect('admin/categories');
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Remove a category
	 *
	 * @param	integer	id of the entry to remove
	 * @access	public
	 */
	function remove($id)
	{
		confirm('Do you really want to remove this category?');
		
		//@TODO: Give the administrator the option to move entries instead of deleting
		
		$this->listings->delete_category($id);  // Child entries deleted by db constraint
		
		$this->session->set_flashdata('msg', 'Category Deleted');
		redirect('admin/categories');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Validation for add and edit
	 *
	 * @access	private
	 */
	function _validate_form($old_name = '')
	{
		$rules = array(
				'name'			=>	'trim|required||max_length[100]|check_category['.$old_name.']',
				'description'	=>	'trim||max_length[500]'
		);
		$this->validation->set_rules($rules);
		
		$fields = array(
				'name'			=>	'Name',
				'description'	=>	'Description'
		);
		$this->validation->set_fields($fields);
		
		return ($this->validation->run() == FALSE) ? FALSE : TRUE;
	}
}

/* End of file categories.php */
/* Location: ./application/controllers/admin/categories.php */