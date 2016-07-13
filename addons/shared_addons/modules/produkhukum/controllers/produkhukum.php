<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProdukHukum extends Public_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	public $limit = 15;
	function __construct()
	{
		parent::__construct();
		// Load Necessary files
		$this->load->model('listings_model', 'listings');
		$this->load->helper('text');	
	}

	// --------------------------------------------------------------------
    
	/**
	 * Default Controller Function
	 *
	 * @access	public
	 */
    function index()
    {
		$pagination = create_pagination('produkhukum/index/page/', $this->listings->count_all_entries(), $this->limit, 4);
		$categories	= $this->listings->get_all_categories();
		$listingsbyyear = $this->listings->get_entries_by_year();
		//print("<pre>");print_r($pagination);print("</pre>");
		$entries = $this->listings->get_all_entries(array('limit' => $pagination['limit'], 'offset' => $pagination['offset']));
		
		$this->template
				->set('pagination', $pagination)
				->set('categories', $categories)
				->set('listingsbyyear', $listingsbyyear)
				->set('entries', $entries)
				->build('categories');
    }

	// --------------------------------------------------------------------
	
	/**
	 * Display all categories
	 *
	 * @access	public
	 */
	function categories()
	{
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Display the requested category listings
	 *
	 * @access	public
	 * @param	string	category name
	 */
    function category($category = FALSE, $offset = FALSE)
    {							
		// Get the entries for the requested category
		$data = $this->listings->get_category_listings(intval($category), $this->limit, array());
		$pagination = array();
		if($data['total_rows'] == 0)
		{
			// Category is empty, we show a flash message
			$this->session->set_flashdata('msg', 'Kategori ini kosong.');
			$entries = $this->listings->get_category_listings(intval($category), array());
		}
		else
		{
			// Set pagination
			$pagination = create_pagination('produkhukum/category/'.intval($category), count($data['entries']), $this->limit, 4);
			$entries = $this->listings->get_category_listings(intval($category), array('limit' => $pagination['limit'], 'offset' => $pagination['offset']));
		}
		
		$categories	= $this->listings->get_all_categories();
		$listingsbyyear = $this->listings->get_entries_by_year();
		$this->template
				->set('pagination', $pagination)
				->set('categories', $categories)
				->set('listingsbyyear', $listingsbyyear)
				->set('entries', $entries)
				->build('listings/listings');
    }
	
	// --------------------------------------------------------------------
    
	/**
	 * Display the requested category listings
	 *
	 * @access	public
	 * @param	string	category name
	 */
    function year($year = FALSE, $offset = FALSE)
    {
		// Get the entries for the requested category
		$data = $this->listings->get_listings_by_year(intval($year), array());
		$pagination = array();
		$selectedyear = $year;
		
		if( count($data['entries']) == 0)
		{
			// Category doesn't exist
			$this->session->set_flashdata('msg', 'Produk Hukum pada tahun ini tidak ada.');
			//redirect();
		}
		else if($data['total_rows'] == 0)
		{
			// Category is empty, we show a flash message
			$this->session->set_flashdata('msg', 'Produk Hukum pada tahun ini kosong.');
			//redirect();
		}
		else
		{						
			$pagination = create_pagination('produkhukum/year/'.intval($year), count($data['entries']), $this->limit, 4);
			$entries = $this->listings->get_listings_by_year(intval($year), array('limit' => $pagination['limit'], 'offset' => $pagination['offset']));
		}
		
		//print('<pre>');print_r($pagination['limit']);print('</pre>');
		$categories	= $this->listings->get_all_categories();
		$listingsbyyear = $this->listings->get_entries_by_year();
		$this->template
				->set('pagination', $pagination)
				->set('categories', $categories)
				->set('listingsbyyear', $listingsbyyear)
				->set('selectedyear', $selectedyear)
				->set('entries', $entries)
				->build('listings/listings_by_year');
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Display the requested category listings
	 *
	 * @access	public
	 * @param	string	category name
	 */
    function search($offset = FALSE)
    {
		// Get the entries for the requested category
		$total_rows = $this->listings->count_search_result($this->input->post('nomor'), $this->input->post('tahun'), $this->input->post('tentang'), array());
		$pagination = array();
		
		if($total_rows == 0)
		{
			// Category is empty, we show a flash message
			$this->session->set_flashdata('msg', 'Produk Hukum pada tahun ini kosong.');
			$entries = array();
		}
		else
		{
			// Set pagination
			$pagination = create_pagination('produkhukum/search/', $total_rows, $this->limit, 3);
			$entries = $this->listings->get_search_result($this->input->post('nomor'), $this->input->post('tahun'), $this->input->post('tentang'), array('limit' => $pagination['limit'], 'offset' => $pagination['offset']));		
		}
		
		//print('<pre>');print_r($entries);print('</pre>');
		
		$categories	= $this->listings->get_all_categories();
		$listingsbyyear = $this->listings->get_entries_by_year();
		$this->template
				->set('pagination', $pagination)
				->set('categories', $categories)
				->set('listingsbyyear', $listingsbyyear)
				->set('total_rows', $total_rows)
				->set('entries', $entries)
				->build('listings/search');
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Display a listing details
	 *
	 * @access	public
	 * @param	int		listing ID (entry ID)
	 */
	function details($entry_id)
	{
		$this->load->model('users_model', 'users');
		$this->listings->set_detail_hits( intval($entry_id) );
		$entry = $this->listings->get_entry( intval($entry_id) );
		
		if( count($entry) == 0)
		{
			// Entry doesn't exist
			$this->session->set_flashdata('msg', 'Data produk hukum ini tidak tersedia.');
			redirect();
		}
		
		//$data['owner'] = $this->users->get_user($data['entry']->FK_user_id);
		$categorylistings = $this->listings->get_category_listings($entry->FK_category_id, array('limit' => 10));
		$categories	= $this->listings->get_all_categories();
		$listingsbyyear = $this->listings->get_entries_by_year();
		$this->template
				->set('categories', $categories)
				->set('categorylistings', $categorylistings)
				->set('listingsbyyear', $listingsbyyear)
				->set('entry', $entry)
				->build('listings/details');		
	}
	
	function download($entry_id)
	{
		$entry = $this->listings->get_entry( intval($entry_id) );
		$this->listings->set_download_hits( intval($entry_id) );
		$filedownload = '/uploads/default/produkhukum/'.$entry->url;
		//print_r($filedownload);exit;
		//$this->load->helper('download');
		//$data = file_get_contents($filedownload); // Read the file's contents
		//force_download($entry->url, $data);
		redirect($filedownload);
	}
}


/* End of file listings.php */
/* Location: ./application/controllers/listings.php */