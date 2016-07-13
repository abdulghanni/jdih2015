<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Page()
	{
		parent::MY_Controller();
		
		// Load required files
		$this->load->model('pages_model' , 'pages');
		$this->load->model('listings_model', 'listings');
	}

	// --------------------------------------------------------------------
    
	/**
	 * Initial Method
	 *
	 * @access	public
	 */
	function index()
	{
		$this->show();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Display the page passed as uri segment
	 *
	 * @access	public
	 */	
	function show($url = FALSE)
	{
		// If no URL was set, we set a default one to prevent errors
		if( ! $url)
		{
			$url = 'home';
		}		
				
		if( ! $data['page'] = $this->pages->get($url))
		{
			show_404();
		}

		// Set page meta tags
		$metas = array(
						'title' 			=> $data['page']->title,
						'meta_description' 	=> $data['page']->meta_description,
						'meta_keywords' 	=> $data['page']->meta_keywords
						);
		
		$this->template->metas($metas);
		$datasidebar['newlistings'] = $this->listings->get_new_entries(5, FALSE);
		$datasidebar['listingsbyyear'] = $this->listings->get_entries_by_year();
		$this->template->sidebar('default', $datasidebar);
		$this->template->display('page', $data);
	}
}


/* End of file page.php */
/* Location: ./application/controllers/page.php */