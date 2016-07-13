<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Listings extends MY_Controller
{
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Listings()
	{
		parent::MY_Controller();
		
		// Force login
		$this->access->restrict();
		
		// Load required classes
		$this->load->model('listings_model', 'listings');
		$this->load->library('validation');
		$this->load->library('pagination');
		$this->load->helper('text');
		
		// Template Settings
		$this->template->sidebar('member');
		$this->template->metas('title', 'Member Backend :: Listings');
	}

	// --------------------------------------------------------------------
	
	/**
	 * Show user's listings
	 *
	 * @access	public
	 */
	function index()
	{
		$this->offset();
	}
	
	function offset($offset=FALSE)
	{
		if($_SERVER['REQUEST_METHOD']=='POST') {
			$nomor = $this->input->post('nomor');
			$tahun = $this->input->post('tahun');
			$category = $this->input->post('category');
		}else{
			$nomor = $this->session->userdata('adm_filter_nomor');
			$tahun = $this->session->userdata('adm_filter_tahun');
			$category = ;
		}
		$this->session->set_userdata(array('adm_filter_nomor'=>$nomor,'adm_filter_tahun'=>$tahun,'adm_filter_kategori'=>$category));
		$data = $this->listings->get_user_entries($nomor, $tahun, $category, $this->user->id, $this->pagination->per_page, $offset);
		$data['adm_filter_nomor'] = $nomor;
		$data['adm_filter_tahun'] = $tahun;
		$data['adm_filter_kategori'] = $category;
		$data['categories'] = $this->listings->get_all_categories();
		if( count($data['entries']) == 0)
		{
			// Category doesn't exist
			$this->session->set_flashdata('msg', 'Kategori tidak ada.');
			//redirect();
		}
		else if($data['total_rows'] == 0)
		{
			// Category is empty, we show a flash message
			$this->session->set_flashdata('msg', 'Belum ada data.');
			//redirect();
		}
		else
		{
			// Set pagination
			$config['base_url'] 	= site_url('member/listings/offset');
			$config['total_rows'] 	= $data['total_rows'];
			$this->pagination->initialize($config);
						
			$data['pagination'] 	= $this->pagination->create_links();
		}
		
		$this->template->display('member/listings/show', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add a new entry
	 *
	 * @access	public
	 */
	function add($active = FALSE)
	{
		$this->template->metas('title', 'Member Backend :: Listings :: Add');
		
		$this->load->helper('form');
		
		$data['categories'] = $this->listings->get_all_categories();
		$data['active'] = $active;
		
		$config['upload_path'] = 'C:/xampp/htdocs/demo/codeigniter/public/download/';
		$config['allowed_types'] = 'pdf|doc|xls|docx';
		$config['max_size']	= '10000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload("url") )
		{
			$data['upload_data'] = $this->upload->display_errors();
		}else{
			$data['upload_data'] = $this->upload->data();
		}
		//print("<pre>");print_r($data);print("</pre>");
		if ( ! $this->_validate_form() )
		{
			$this->template->display('member/listings/add', $data);
		}
		else
		{
			if ( !$this->upload->do_upload("url") )
			{
				$data['upload_data'] = $this->upload->display_errors();
				$id = $this->listings->add_entry();
			}else{
				$data['upload_data'] = $this->upload->data();
				$id = $this->listings->add_entry($data['upload_data']['file_name']);
			}
			
			$this->session->set_flashdata('msg', 'Entrian sudah tersimpan ['.anchor('listings/details/'.$id, 'view').'].');
			redirect('member/listings');
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Edit an entry
	 *
	 * @param	integer	id of the entry to edit
	 * @access	public
	 */
	function edit($id)
	{
		$this->template->metas('title', 'Member Backend :: Listings :: Edit');
		
		$this->load->helper('form');
		
		$data['categories'] = $this->listings->get_all_categories();
		$data['entry'] = $this->listings->get_entry($id);

		// Can only edit your own entries			
		if($data['entry']->FK_user_id !== $this->user->id)
		{
			show_error('The entry you are trying to edit does not exist, or it does not belong to you.');
			exit;
		}
		
		$config['upload_path'] = 'C:/xampp/htdocs/demo/codeigniter/public/download/';
		$config['allowed_types'] = 'pdf|doc|xls|docx';
		$config['max_size']	= '10000';
		$this->load->library('upload', $config);
		
		if ( ! $this->_validate_form() )
		{
			$this->template->display('member/listings/edit', $data);
		}
		else
		{			
			if ( !$this->upload->do_upload("url") )
			{
				$data['upload_data'] = $this->upload->display_errors();
				$this->listings->update_entry($id, $data['entry']->FK_category_id);
			}else{
				$data['upload_data'] = $this->upload->data();
				$this->listings->update_entry($id, $data['entry']->FK_category_id, $data['upload_data']['file_name']);
			}
			$this->session->set_flashdata('msg', 'Entry Updated ['.anchor('listings/details/'.$id, 'view').'].');
			redirect('member/listings');
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Remove an entry
	 *
	 * @param	integer	id of the entry to remove
	 * @access	public
	 */
	function remove($id)
	{
		confirm('Anda yakin ingin menghapus entrian ini?');
		
		$entry = $this->listings->get_entry($id);
		
		// Can only remove your own entries
		if($entry->FK_user_id !== $this->user->id)
		{
			show_error('The entry you are trying to delete does not exist, or it does not belong to you.');
			exit;
		}
								
		$this->listings->delete_entry($id);

		$this->session->set_flashdata('msg', 'Entrian sudah dihapus');
		redirect('member/listings');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Validation for add and edit
	 *
	 * @access	private
	 */
	function _validate_form()
	{
		$rules = array(
				'category'		=>	'trim|required|numeric',
				'title'			=>	'trim|required|strip_tags|xss_clean|max_length[100]',
				'regyear'		=>	'trim|required|numeric',
				'description'	=>	'trim|required|strip_tags|xss_clean|max_length[500]',
				'url'			=>	'trim'
		);
		$this->validation->set_rules($rules);
		
		$fields = array(
				'category'		=>	'Category',
				'title'			=>	'Title',
				'regyear'		=>	'Regyear',
				'description'	=>	'Description',
				'url'			=>	'URL'
		);
		$this->validation->set_fields($fields);
		
		return ($this->validation->run() == FALSE) ? FALSE : TRUE;
	}
}

/* End of file listings.php */
/* Location: ./application/controllers/member/listings.php */