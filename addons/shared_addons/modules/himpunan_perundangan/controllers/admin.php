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
			      array(
				    
			'field'   => 'FK_category_id',
			'label'   => 'cate id',
			'rules'   => 'trim|required'),
			         array(
				    
			'field'   => 'title',
			'label'   => 'Nomor',
			'rules'   => 'trim|required|ma_length[255]'),    array(
				    
			'field'   => 'regyear',
			'label'   => 'Tahun',
			'rules'   => 'numeric|trim|required'),
				 array(
				    
			'field'   => 'description',
			'label'   => 'Keterangan',
			'rules'   => 'trim|required'),   
	);
	
	public $catrules = array(
		'name'				=> 'trim|required|ma_length[100]',
		'entry_order'		=> 'trim|required'
	);
	
	function __construct()
	{
		parent::__construct(); 
		
		// Load required classes
		$this->config->load('files/files');
		$this->load->model('listings_model', 'listings'); 
		$this->lang->load('himpunan_perundangan');
		$this->load->config('myconfig');
		$this->load->library('form_validation');
	    $this->_path = FCPATH . 'uploads/default/produkhukum';
	}

	// --------------------------------------------------------------------
	
	/**
	 * List all entries
	 *
	 * @access	public
	 */
	function index()
	{
		$pagination = create_pagination('admin/himpunan_perundangan/index', $this->listings->count_all_entries());	
		$entries = $this->listings->get_all_entries(array('limit' => $pagination['limit'], 'offset' => $pagination['offset']));	
		//print('<pre>');print_r($this->data->entries);print('</pre>');
		$categories = $this->listings->get_all_categories();
		
		if(@$_POST['search']){
			redirect('admin/himpunan_perundangan/search/'.$this->input->post('search'));
		}else if(@$_POST['catid']){
			redirect('admin/himpunan_perundangan/bycategory/'.$this->input->post('catid'));
		} 
		$this->template
		->set('entries', $entries)
		->set('pagination', $pagination)
		->set('categories', $categories)
		->build('admin/entries/list');
	}
	
	function search()
	{
		$pagination = create_pagination('admin/himpunan_perundangan/search/'.$this->uri->segment(4), $this->listings->count_admin_search_results(array('keyword' => $this->uri->segment(4))), $this->limit, 5);
		$entries = $this->listings->get_admin_search_results(array('keyword' => $this->uri->segment(4), 'limit' => $pagination['limit'], 'offset' => $pagination['offset'])); 
		$categories = $this->listings->get_all_categories();
		if(@$_POST['search']){
			redirect('admin/himpunan_perundangan/search/'.$this->uri->segment(4));
		}else if(@$_POST['catid']){
			redirect('admin/himpunan_perundangan/bycategory/'.$this->uri->segment(4));
		}else{
			$this->template
			->set('entries', $entries)
			->set('pagination', $pagination)
			->set('categories', $categories)
			->build('admin/entries/list');
		}
	}
	
	function bycategory()
	{
		$pagination = create_pagination('admin/himpunan_perundangan/bycategory/'.$this->uri->segment(4), $this->listings->count_admin_search_results(array('catid' => $this->uri->segment(4))), $this->limit, 5);
		$entries = $this->listings->get_admin_search_results(array('catid' => $this->uri->segment(4), 'limit' => $pagination['limit'], 'offset' => $pagination['offset'])); 
		$categories = $this->listings->get_all_categories();
		//print('<pre>');print_r($this->uri->segment(4));print('</pre>');
		if(@$_POST['search']){
			redirect('admin/himpunan_perundangan/search/'.$this->uri->segment(4));
		}else if(@$_POST['catid']){
			redirect('admin/himpunan_perundangan/bycategory/'.$this->uri->segment(4));
		}else{
			$this->template
			->set('entries', $entries)
			->set('pagination', $pagination)
			->set('categories', $categories)
			->build('admin/entries/list');
		}
	}
	
	 
	
	function edit($id = 0)
	{	
		if (empty($id)) redirect('admin/himpunan_perundangan/index');
		
		$entry = $this->listings->get_entry($id);
		if (!$entry) redirect('admin/himpunan_perundangan/create');
		
		$type = 'd';//document
		$allowed = $this->config->item('files_allowed_file_ext');

		$config['upload_path'] = $this->_path;
		$config['allowed_types'] = $allowed[$type];

		$this->load->library('upload', $config);
		
		$this->form_validation->set_rules($this->rules);
		
		foreach(array_keys($this->rules) as $field)
		{
			if(isset($_POST[$field])) $entry->$field = $this->form_validation->$field;
		}
			
		if ($this->form_validation->run())
		{
			$filename = $entry->url;
			$type = 'd';
			
			if ( ! empty($_FILES['userfile']['name']))
			{
				$allowed = $this->config->item('files_allowed_file_ext');
				$config['upload_path'] = $this->_path;
				$config['allowed_types'] = $allowed[$type];

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('userfile'))
					{
						$this->data->messages['notice'] = $this->upload->display_errors();
						 
					}
					else
					{
						$img = array('upload_data' => $this->upload->data());
							$arrInput = array(
							'FK_category_id'	=> $this->input->post('FK_category_id'),
							'sub_category_id'	=> $this->input->post('sub_category_id'),
							'title'				=> $this->input->post('title'),
							'regyear'			=> $this->input->post('regyear'),
							'description'		=> $this->input->post('description'),
							'url'				=> $img['upload_data']['file_name'],
							'old_cat'			=> $this->input->post('old_cat')
							  );
							//print_r($arrInput);
							$this->listings->update_entry($arrInput, $id);
							$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_edit_success'), $this->input->post('title')));			
							redirect('admin/himpunan_perundangan/index');
					}
			}else{
				$arrInput = array(
							'FK_category_id'	=> $this->input->post('FK_category_id'),
							'sub_category_id'	=> $this->input->post('sub_category_id'),
							'title'				=> $this->input->post('title'),
							'regyear'			=> $this->input->post('regyear'),
							'description'		=> $this->input->post('description'), 
							'old_cat'			=> $this->input->post('old_cat')
							  );
							//print_r($arrInput);
							$this->listings->update_entry($arrInput, $id);
							$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_edit_success'), $this->input->post('title')));			
							redirect('admin/himpunan_perundangan/index');
			}
			
			
		}
		
		// Load WYSIWYG editor
		$categories = $this->listings->get_all_categories();
		$Subcategories = $this->listings->get_all_Subcategories();
		$this->template
		->set('entry', $entry)
		->set('categories', $categories)
		->set('Subcategories', $Subcategories)
		->build('admin/entries/edit');
	}
	
	function create()
	{
		$messages = '';
		$this->form_validation->set_rules($this->rules);
		$type = 'd';//document

		$config['upload_path'] = $this->_path;
		$config['allowed_types'] = "pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar";
		
		print('<pre>');print_r($config);print('</pre>');

		$this->load->library('upload', $config);
			
		if ($this->form_validation->run())
		{
			if (!$this->upload->do_upload('userfile'))
			{
				$messages = $this->upload->display_errors();
				foreach($this->rules as $key => $field)
				{
					$article->$field['field'] = set_value($field['field']);
				}
			}else{
				$img = array('upload_data' => $this->upload->data());
				$arrInput = array(
							'FK_category_id'	=> $this->input->post('FK_category_id'),
							'FK_user_id'		=> $this->session->userdata('user_id'),
							'sub_category_id'	=> $this->input->post('sub_category_id'),
							'active'			=> 0,
							'title'				=> $this->input->post('title'),
							'regyear'			=> $this->input->post('regyear'),
							'description'		=> $this->input->post('description'),
							'date_added'		=> date('Y-m-d H:i:s'),
							'url'				=> (!empty($img['upload_data']['file_name'])?$img['upload_data']['file_name']:''),
							'hits'				=> 0,
							'downloaded'		=> 0
							);
				//print('<pre>');print_r($arrInput);print('</pre>');
				$this->listings->add_entry($arrInput);
				$this->session->set_flashdata('success', sprintf($this->lang->line('produkhukum_document_add_success'), $this->input->post('title')));
				redirect('admin/himpunan_perundangan/index');
			} 
			 //redirect('admin/himpunan_perundangan/index');
		}else{
			foreach($this->rules as $key => $field)
				{
					$article->$field['field'] = set_value($field['field']);
				}
		}
		//print('<pre>');print_r($this->session->userdata['user_id']);print('</pre>');
		
		$Subcategories = $this->listings->get_all_Subcategories();
		$categories = $this->listings->get_all_categories();
		$this->template
		->set('hasilQuery', $article)
		->set('categories', $categories)
		->set('Subcategories', $Subcategories)
		->set('messages', $messages)
		->build('admin/entries/add');
	}
	 
	function category($id="")
	{
		$data = $this->listings->get_category_listings($id); // Gets entries and category
		//print_r($data);
		if( count($data['entries']) == 0)
		{
			// Category doesn't exist
			$this->session->set_flashdata('msg', 'Kategori ini tidak ada.');
			redirect('admin/himpunan_perundangan/categories');
		}
		else if(!empty($data['category']->entry_count) == 0)
		{
			// Category is empty, we show a flash message
			$this->session->set_flashdata('msg', 'Kategori ini masih kosong.');
			//redirect('admin/himpunan_perundangan/categories');
		}
		
		$this->template->build('admin/entries/list', $data);
	}
	
	function createcategory()
	{
		$this->load->library('form_validation');
		$rules=array(
			      array(
				    
			'field'   => 'title',
			'label'   => 'Judul',
			'rules'   => '|callback__createTitleCheck'));
		 
		$this->form_validation->set_rules($rules);
		//$this->form_validation->set_fields();
		
		foreach(array_keys($rules) as $field)
		{
			$entry->$field = (isset($_POST[$field])) ? $this->form_validation->$field : '';
		}
		
		if ($this->form_validation->run())
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
			redirect('admin/himpunan_perundangan/categories');
		}
		$this->template->build('admin/categories/add');	
	}
	
	function editcategory($id = 0)
	{
		if (empty($id)) redirect('admin/himpunan_perundangan/categories');
		
		$this->data->category = $this->listings->get_category($id);
		if (!$this->data->category) redirect('admin/himpunan_perundangan/createcategory');
		
		$this->load->library('form_validation');
		$rules=array(
			      array(
				    
			'field'   => 'title',
			'label'   => 'Judul',
			'rules'   => '|callback__createTitleCheck'));
		 
		$this->form_validation->set_rules($rules);
		//$this->form_validation->set_fields();
		
		foreach(array_keys($rules) as $field) 
		{
			if(isset($_POST[$field])) $entry->$field = $this->form_validation->$field;
		}
			
		if ($this->form_validation->run())
		{
			$arrInput = array(
							'category_id'		=> $this->input->post('category_id'),
							'name'				=> $this->input->post('name'),
							'description'		=> $this->input->post('name'),
							'entry_order'		=> $this->input->post('entry_order')
							  );
			$this->listings->update_category($id);
			$this->session->set_flashdata('success', sprintf($this->lang->line('bankdata_edit_success'), $this->input->post('title')));			
			redirect('admin/himpunan_perundangan/categories');
		}
		
		$this->template->build('admin/categories/edit');
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
				redirect('admin/himpunan_perundangan/index');
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
		redirect('index.php/admin/himpunan_perundangan/index');
	}
}

/* End of file entries.php */
/* Location: ./application/controllers/admin/entries.php */