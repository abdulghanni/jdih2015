<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	public $limit = 20;
	public $rules = array(	 
		'FK_category_id'	=> 'trim|required',
		'title'				=> 'trim|required|ma_length[255]',
		'regyear'			=> 'trim|required',
		'description'		=> 'trim|required'
	);
	
	public $catrules = array(
		'name'				=> 'trim|required|ma_length[100]',
		'entry_order'		=> 'trim|required'
	);
	
	function __construct()
	{
		parent::Admin_Controller(); 
		
		// Load required classes
		$this->load->model('listings_model', 'listings'); 
		$this->lang->load('produkhukum');
		$this->load->config('myconfig');
	}

	// --------------------------------------------------------------------
	
	/**
	 * List all entries
	 *
	 * @access	public
	 */
	function index()
	{
		$this->data->pagination = create_pagination('admin/produkhukum/index', $this->listings->count_all_entries(), $this->limit, 4);	
		$this->data->entries = $this->listings->get_all_entries(array('limit' => $this->data->pagination['limit']));	
		//print('<pre>');print_r($this->data->entries);print('</pre>');
		$this->data->categories = $this->listings->get_all_categories();
		
		if(@$_POST['search']){
			redirect('admin/produkhukum/search/'.$this->input->post('search'));
		}else if(@$_POST['catid']){
			redirect('admin/produkhukum/bycategory/'.$this->input->post('catid'));
		} 
		$this->layout->create('admin/entries/list', $this->data);
	}
	
	function search()
	{
		$this->data->pagination = create_pagination('admin/produkhukum/search/'.$this->uri->segment(4), $this->listings->count_admin_search_results(array('keyword' => $this->uri->segment(4))), $this->limit, 5);
		$this->data->entries = $this->listings->get_admin_search_results(array('keyword' => $this->uri->segment(4), 'limit' => $this->data->pagination['limit'])); 
		$this->data->categories = $this->listings->get_all_categories();
		if(@$_POST['search']){
			redirect('admin/produkhukum/search/'.$this->uri->segment(4));
		}else if(@$_POST['catid']){
			redirect('admin/produkhukum/bycategory/'.$this->uri->segment(4));
		}else{
			$this->layout->create('admin/entries/list', $this->data);
		}
	}
	
	function bycategory()
	{
		$this->data->pagination = create_pagination('admin/produkhukum/bycategory/'.$this->uri->segment(4), $this->listings->count_admin_search_results(array('catid' => $this->uri->segment(4))), $this->limit, 5);
		$this->data->entries = $this->listings->get_admin_search_results(array('catid' => $this->uri->segment(4), 'limit' => $this->data->pagination['limit'])); 
		$this->data->categories = $this->listings->get_all_categories();
		//print('<pre>');print_r($this->uri->segment(4));print('</pre>');
		if(@$_POST['search']){
			redirect('admin/produkhukum/search/'.$this->uri->segment(4));
		}else if(@$_POST['catid']){
			redirect('admin/produkhukum/bycategory/'.$this->uri->segment(4));
		}else{
			$this->layout->create('admin/entries/list', $this->data);
		}
	}
	
	function categories()
	{
		
	}
	
	function edit($id = 0)
	{	
		if (empty($id)) redirect('admin/produkhukum/index');
		
		$this->data->entry = $this->listings->get_entry($id);
		if (!$this->data->entry) redirect('admin/produkhukum/create');
		
		$this->load->library('validation');
		$this->validation->set_rules($this->rules);
		$this->validation->set_fields();
		
		foreach(array_keys($this->rules) as $field)
		{
			if(isset($_POST[$field])) $this->data->entry->$field = $this->validation->$field;
		}
			
		if ($this->validation->run())
		{
			/*$myuploadconfig = $this->config->item('produkhukum_upload');
			$this->load->library('upload', $myuploadconfig);
			$mydoc = array();
			if ($this->upload->do_upload("url"))
			{
				$mydoc = $this->upload->data();
			}*/
			
			$upload_cfg['upload_path'] = APPPATH.'public/download/produkhukum';
			$upload_cfg['allowed_types'] = 'pdf|zip|jpg|zip';
			$upload_cfg['max_size'] = '400000000';
			$upload_cfg['encrypt_name'] = TRUE;
			$this->load->library('upload', $upload_cfg); 
			if($this->upload->do_upload("url"))
			{
				$mydoc = $this->upload->data(); 
			}
			
			$arrInput = array(
							'FK_category_id'	=> $this->input->post('FK_category_id'),
							'title'				=> $this->input->post('title'),
							'regyear'			=> $this->input->post('regyear'),
							'description'		=> $this->input->post('description'),
							'url'				=> (!empty($mydoc['file_name'])?$mydoc['file_name']:''),
							'old_cat'			=> $this->input->post('old_cat')
							  );
			//print_r($arrInput);
			$this->listings->update_entry($arrInput, $id);
			$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_edit_success'), $this->input->post('title')));			
			redirect('admin/produkhukum/index');
		}
		
		// Load WYSIWYG editor
		$this->data->categories = $this->listings->get_all_categories();
		$this->layout->create('admin/entries/edit', $this->data);
	}
	
	function create()
	{
		$this->load->library('validation');
		$this->rules['title'] .= '|callback__createTitleCheck';
		$this->validation->set_rules($this->rules);
		$this->validation->set_fields();
		
		foreach(array_keys($this->rules) as $field)
		{
			$this->data->entry->$field = (isset($_POST[$field])) ? $this->validation->$field : '';
		}
		
		if ($this->validation->run())
		{
			//$this->load->library('upload', $myuploadconfig);
			//$upload_cfg['upload_path'] = '/var/www/html/jakv1/application/public/download/produkhukum';
			$upload_cfg['upload_path'] = APPPATH.'public/download/produkhukum';
			//echo APPPATH; exit;
			$upload_cfg['allowed_types'] = 'pdf|zip|jpg|zip';
			$upload_cfg['max_size'] = '400000000';
			$upload_cfg['encrypt_name'] = TRUE;
			$this->load->library('upload', $upload_cfg); 
			if($this->upload->do_upload("url"))
			{
				$mydoc = $this->upload->data();
				$myfile = $mydoc['file_name'];
			}else{
				$mydoc = array();
				$myfile = '';
			}
			$arrInput = array(
					'FK_category_id'	=> $this->input->post('FK_category_id'),
					'FK_user_id'		=> $this->session->userdata['user_id'],
					'active'		=> 0,
					'title'			=> $this->input->post('title'),
					'regyear'		=> $this->input->post('regyear'),
					'description'		=> $this->input->post('description'),
					'date_added'		=> date('Y-m-d H:i:s'),
					'url'			=> $myfile,
					'hits'			=> 0,
					'downloaded'		=> 0
				);
			//print('<pre>');print_r($arrInput);print('</pre>');
			//exit;
			if ($this->listings->add_entry($arrInput))
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_document_add_success'), $this->input->post('title')));
			}else{
				$this->session->set_flashdata('failed', sprintf($this->upload->display_errors(), $this->input->post('title')));
			}
			
			redirect('admin/produkhukum/index');
		}
		//print('<pre>');print_r($this->session->userdata['user_id']);print('</pre>');
		$this->data->categories = $this->listings->get_all_categories();
		$this->layout->create('admin/entries/add', $this->data);
	}
	 
	function category($id)
	{
		$data = $this->listings->get_category_listings($id); // Gets entries and category
		
		if( count($data['entries']) == 0)
		{
			// Category doesn't exist
			$this->session->set_flashdata('msg', 'Kategori ini tidak ada.');
			redirect('admin/categories');
		}
		else if($data['category']->entry_count == 0)
		{
			// Category is empty, we show a flash message
			$this->session->set_flashdata('msg', 'Kategori ini masih kosong.');
			redirect('admin/categories');
		}
		
		$this->template->display('admin/entries/list', $data);
	}
	
	function createcategory()
	{
		$this->load->library('validation');
		$this->rules['title'] .= '|callback__createTitleCheck';
		$this->validation->set_rules($this->catrules);
		$this->validation->set_fields();
		
		foreach(array_keys($this->catrules) as $field)
		{
			$this->data->entry->$field = (isset($_POST[$field])) ? $this->validation->$field : '';
		}
		
		if ($this->validation->run())
		{
			$arrInput = array(
						'name'				=> $this->input->post('name'),
						'description'		=> '',
						'entry_count'		=> 0,
						'entry_order'		=> $this->input->post('entry_order')
						);
			//print('<pre>');print_r($arrInput);print('</pre>');
			$this->listings->add_category($arrInput);
			$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_document_add_success'), $this->input->post('title')));
			redirect('admin/produkhukum/categories');
		}
		$this->layout->create('admin/categories/add', $this->data);	
	}
	
	function editcategory($id = 0)
	{
		if (empty($id)) redirect('admin/produkhukum/categories');
		
		$this->data->category = $this->listings->get_category($id);
		if (!$this->data->category) redirect('admin/produkhukum/createcategory');
		
		$this->load->library('validation');
		$this->validation->set_rules($this->catrules);
		$this->validation->set_fields();
		
		foreach(array_keys($this->rules) as $field)
		{
			if(isset($_POST[$field])) $this->data->entry->$field = $this->validation->$field;
		}
			
		if ($this->validation->run())
		{
			$arrInput = array(
							'category_id'		=> $this->input->post('category_id'),
							'name'				=> $this->input->post('name'),
							'description'		=> $this->input->post('name'),
							'entry_order'		=> $this->input->post('entry_order')
							  );
			$this->listings->update_category($id);
			$this->session->set_flashdata('success', sprintf($this->lang->line('bankdata_edit_success'), $this->input->post('title')));			
			redirect('admin/produkhukum/categories');
		}
		
		$this->layout->create('admin/categories/edit', $this->data);
	}
	
	function action()
	{
		switch($this->input->post('btnAction'))
		{
			case 'publish':
				$this->publish();
			break;
			case 'delete':
				$this->delete();
			break;
			default:
				redirect('admin/produkhukum/index');
			break;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Remove an entry
	 *
	 * @param	integer	id of the entry to remove
	 * @access	public
	 */
	function delete($id = 0)
	{
		$ids = ($id) ? array($id) : $this->input->post('action_to');
		$titles = array();
		foreach ($ids as $id)
		{
			// Get the current page so we can grab the id too
			if($entry = $this->listings->get_entry($id) )
			{
				$this->listings->delete_entry($id);
				
				// Wipe cache for this model, the content has changed
				$this->cache->delete('listings');				
				$titles[] = $entry->title;
			}
		}
		// Some articles have been published
		if(!empty($titles))
		{
			// Only publishing one article
			if( count($titles) == 1 )
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_delete_success'), $titles[0]));
			}			
			// Publishing multiple articles
			else
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_mass_delete_success'), implode('", "', $titles)));
			}
		}		
		// For some reason, none of them were published
		else
		{
			$this->session->set_flashdata('notice', $this->lang->line('produkhukum_delete_error'));
		}		
		redirect('admin/produkhukum/index');
	}
}

/* End of file entries.php */
/* Location: ./application/controllers/admin/entries.php */
