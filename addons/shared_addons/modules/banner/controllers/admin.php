<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{
	protected $resCat = array();
	protected $rules=array(
		array(
		 'field' => 'title',
		 'label' => 'Title',
		 'rules' => 'required'
		 
		),
		array(
		 'field' => 'link_file',
		 'label' => 'Filename',
		 'rules' => 'trim'
		 
		),
		array(
		 'field' => 'page',
		 'label' => 'Page',
		 'rules' => 'trim'
		 
		),
		array(
		 'field' => 'txtUrl',
		 'label' => 'Url',
		 'rules' => 'required'
		 
		),
		array(
		 'field' => 'txtUrut',
		 'label' => 'Urutan',
		 'rules' => 'numeric|required'
		 
		)
	);
	
	protected $section = 'posts';
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('banner_m');
		$this->load->model('files/file_m');
		$this->load->model('files/file_folders_m');
		$this->lang->load('banner');
		$this->load->model('banner_categories_m');
		$this->load->model('banner_client_m');
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
		$catData = $this->banner_categories_m->getCategories();
		if ($catData)
		{
			foreach($catData as $data => $val){
				$this->resCat[$val->id] = $val->title;
			}
		}
		$this->_path = FCPATH  . 'uploads/Banner/';
	}
	
	// Admin: List all banner
	function index()
	{
		// Create pagination links
		$total_rows = $this->banner_m->countBanner();
		$pagination = create_pagination('admin/banner/index', $total_rows, 20, 4);		
		// Using this data, get the relevant results
		$banners = $this->banner_m->getBanners(array('limit' => $pagination['limit']));	
		

		//pagination from search
		if(@$_POST['search']){
		redirect('admin/banner/search/'.$_POST['search']);
		}else{
		$this->template
		->set('total_rows', $total_rows)
		->set('pagination', $pagination)
		->set('banners', $banners)
		->build('admin/index');
		}
		return;
	}
	
	function search()
	{
		// Create pagination links
		$total_rows = $this->banner_m->countBanner();
		$pagination = create_pagination('admin/banner/search/'.$this->uri->segment(4), $total_rows,20,5);		
		// Using this data, get the relevant results
		$banner = $this->banner_m->getBanners(array('limit' => $pagination['limit']));	
		
 
		return $this->template
		->set('total_rows', $total_rows)
		->set('pagination', $pagination)
		->set('banner', $banner)
		->build('admin/index');
		 
		 
	}
	
	// Admin: Create a new Category
	function create()
	{
		$this->load->library('form_validation');  
		$this->form_validation->set_rules($this->rules); 
		
		if ($this->form_validation->run())
		{

			$dataForm=array(
				'title'	=> $this->input->post('title'), 
				'category_id'=> $this->input->post('txtCat'),
				'page'=> $this->input->post('txtPage'),
				'link_url'=> $this->input->post('txtUrl'),
				'link_text'=> $this->input->post('txtLink'),
				'link_file'=> trim($this->input->post('txtLinkFile')),
				'updateby' => $this->input->post('user'),
				'dateupdates'=>date('Y/m/d H:i:s'),
				'urutan' => $this->input->post('txtUrut'),
				'simpan' => $this->input->post('txtSimpan'),
				'slug'	=> url_title(strtolower($this->input->post('title')))
			);
			
			if ($this->banner_m->newBanner($dataForm))
			{
				$this->session->set_flashdata('success', $this->lang->line('cat_edit_success'));
			}		
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('cat_edit_error'));
			}
			redirect('admin/banner/index');		
		}
		// Required for validation
		foreach ($this->rules as $rule)
		{
			$banner->{$rule['field']} = $this->input->post($rule['field']);
		}
		$banner->file->filename = '';
		 
		 
		$this->template
			->append_js('module::form.js')
			->append_js('module::functions.js')
			->append_css('module::banner.css')
			->set('categories', $this->resCat)
			->set('banner', $banner)
			->build('admin/form');
	}
	
	function imageSection(){
		$this->data->inputan=$_POST['queryString'];
		return $this->load->view('admin/view_image',$this->data);
	}
	

	// Admin: Edit a Category
	function edit($slug = '')
	{	
		if (!$slug)
		{
			redirect('admin/banner/index');
		}
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules($this->rules); 
		
		if ($this->form_validation->run())
		{
			$dataForm=array(
			'title'	=> $this->input->post('title'), 
			'category_id'=> $this->input->post('txtCat'),
			'page'=> $this->input->post('txtPage'),
			'link_url'=> $this->input->post('txtUrl'),
			'link_text'=> $this->input->post('txtLink'),
			'link_file'=> trim($this->input->post('txtLinkFile')),
			'updateby' => $this->input->post('user'),
			'dateupdates'=>date('Y/m/d H:i:s'),
			'urutan' => $this->input->post('txtUrut'),
			'simpan' => $this->input->post('txtSimpan'),
			'slug'	=> url_title(strtolower($this->input->post('title')))
			);
			
			if ($this->banner_m->updateBanner($dataForm, $slug))
			{
				$this->session->set_flashdata('success', $this->lang->line('cat_edit_success'));
			}		
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('cat_edit_error'));
			}

			redirect('admin/banner/index');
			
		}

		$banner = $this->banner_m->getBanner($slug);
		
		if ($banner->link_file!=0)
		{
			$banner->file = $this->file_m->get($banner->link_file);
			if ($banner->file)
			{
				$banner->file = '';
				$banner->file->filename = '';
			}else{
				$banner->file = '';
				$banner->file->filename = '';
			}
		}else{
			$banner->file = '';
			$banner->file->filename = '';
		}
		//print('<pre style="margin:50px">');print_r($banner);print('</pre>');
		
		$this->template
			->append_js('module::form.js')
			->append_js('module::functions.js')
			->append_css('module::banner.css')
			->set('categories', $this->resCat)
			->set('banner', $banner)
			->build('admin/form');
	}	

	function translate($slug = '')
	{	
		if (!$slug)
		{
			redirect('admin/banner/index');
		}
		$this->load->library('form_validation');
		$this->load->library('frontpage');
		$rules['title_en'] = 'trim|required'; 
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_fields();
		
		if ($this->form_validation->run())
		{		
			if ($this->banner_m->updateBanner_en($_POST, $slug))
			{
				$this->session->set_flashdata('success', $this->lang->line('cat_translate_success'));
			}		
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('cat_translate_error'));
			}
			redirect('admin/banner/index');
		}
		
		$this->data->category = $this->banner_m->getBanner($slug);		
		foreach(array_keys($rules) as $field)
		{
			if(isset($_POST[$field])) $this->data->category->$field = $this->form_validation->$field;
		}
		 
		$this->data->category->directory=$this->frontpage->ListDir('./application/public/img/Banner');
		$this->data->category->banner_category=$this->banner_categories_m->listSection();
		$this->data->category->client=$this->banner_client_m->listSection();
		$this->template->build('admin/form', $this->data);
	}	
	
	// Admin: Delete a Category
	function delete($slug = '')
	{	
		$slug_array = (!empty($slug)) ? array($slug) : $this->input->post('delete');
		
		// Delete multiple
		if(!empty($slug_array))
		{
			$deleted = 0;
			$to_delete = 0;
			foreach ($slug_array as $slug) 
			{
				if($this->banner_m->deleteBanner($slug))
				{
					$deleted++;
				}
				else
				{
					$this->session->set_flashdata('error', sprintf($this->lang->line('cat_mass_delete_error'), $slug));
				}
				$to_delete++;
			}
			
			if( $deleted > 0 )
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('cat_mass_delete_success'), $deleted, $to_delete));
			}
		}		
		else
		{
			$this->session->set_flashdata('error', $this->lang->line('cat_no_select_error'));
		}		
		redirect('admin/banner/index');
	}	
	
	// Callback: from create()
	function _check_title($title = '')
	{
		if ($this->banner_m->checkTitle($title))
		{
			$this->form_validation->set_message('_check_title', sprintf($this->lang->line('cat_already_exist_error'), $title));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
?>