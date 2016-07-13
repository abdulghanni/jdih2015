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
		parent::Public_Controller();
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
        $this->categories();
    }

	// --------------------------------------------------------------------
	
	/**
	 * Display all categories
	 *
	 * @access	public
	 */
	function categories()
	{
		$this->data->pagination = create_pagination('produkhukum/index/', $this->listings->count_all_entries(), $this->limit, 3);
		$this->data->categories	= $this->listings->get_all_categories();
		$this->data->listingsbyyear = $this->listings->get_entries_by_year();
		//print("<pre>");print_r($this->data->pagination);print("</pre>");
		$this->data->entries = $this->listings->get_all_entries(array('limit' => $this->data->pagination['limit']));
		$this->data->title = "Produk Hukum Terbaru";
		$this->layout->create('categories', $this->data);
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
		$this->data->pagination = array();
		if($data['total_rows'] == 0)
		{
			// Category is empty, we show a flash message
			$this->session->set_flashdata('msg', 'Kategori ini kosong.');
			$this->data->entries = $this->listings->get_category_listings(intval($category), array());
		}
		else
		{
			// Set pagination
			$this->data->pagination = create_pagination('produkhukum/category/'.intval($category), count($data['entries']), $this->limit, 4);
			$this->data->entries = $this->listings->get_category_listings(intval($category), array('limit' => $this->data->pagination['limit']));
		}
		
		$this->data->categories	= $this->listings->get_all_categories();
		$this->data->listingsbyyear = $this->listings->get_entries_by_year();
		$this->layout->create('listings/listings', $this->data);
    }
	
	function hit()
	{
	//print "rama"; exit;
		$this->data->pagination = create_pagination('produkhukum/hit/', $this->listings->count_all_entries(), $this->limit, 3);
		
		
		$this->data->categories	= $this->listings->get_all_categories();
		$this->data->listingsbyyear = $this->listings->get_entries_by_year();
		//print("<pre>");print_r($this->data->pagination);print("</pre>");
		$this->data->entries = $this->listings->get_most_hit(array('limit' => $this->data->pagination['limit']));
		$this->data->title = "Produk Hukum Dengan Hit Terbanyak";
		$this->layout->create('categories', $this->data);
	}
	
	function mostdownload()
	{
	//print "rama"; exit;
		$this->data->pagination = create_pagination('produkhukum/mostdownload/', $this->listings->count_all_entries(), $this->limit, 3);
		$this->data->categories	= $this->listings->get_all_categories();
		$this->data->listingsbyyear = $this->listings->get_entries_by_year();
		//print("<pre>");print_r($this->data->pagination);print("</pre>");
		$this->data->entries = $this->listings->get_most_download(array('limit' => $this->data->pagination['limit']));
		$this->data->title = "Produk Hukum Dengan Download Terbanyak";
		
		$this->layout->create('categories', $this->data);
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
		$this->data->pagination = array();
		$this->data->selectedyear = $year;
		
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
			$this->data->pagination = create_pagination('produkhukum/year/'.intval($year), count($data['entries']), $this->limit, 4);
			$this->data->entries = $this->listings->get_listings_by_year(intval($year), array('limit' => $this->data->pagination['limit']));
		}
		
		//print('<pre>');print_r($this->data->pagination['limit']);print('</pre>');
		$this->data->categories	= $this->listings->get_all_categories();
		$this->data->listingsbyyear = $this->listings->get_entries_by_year();
		$this->layout->create('listings/listings_by_year', $this->data);
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
		if ($this->input->post("nomor"))
		{
			$nomor = $this->input->post("nomor");
		}else{
			$nomor = $this->uri->segment(3);
		}
		if ($nomor=='')$nomor = '0';
		if ($this->input->post("tentang"))
		{
			$tentang = $this->input->post("tentang");
		}else{
			$tentang = $this->uri->segment(5);
		}
		if ($tentang=='')$tentang = 'all';
		if ($this->input->post("tahun"))
		{
			$tahun = $this->input->post("tahun");
		}else{
			$tahun = $this->uri->segment(4);
		}
		if ($tahun=='')$tahun = '0';
		// Get the entries for the requested category
		$total_rows = $this->listings->count_search_result($nomor, $tahun, $tentang, array());
		$this->data->pagination = array();
		
		$this->data->pagination = create_pagination('produkhukum/search/'.$nomor.'/'.$tahun.'/'.$tentang, $total_rows, $this->limit, 6);
		$this->data->entries = $this->listings->get_search_result($nomor, $tahun, $tentang, array('limit' => $this->data->pagination['limit']));		
		
		//print('<pre>');print_r($data['entries']);print('</pre>');
		$this->data->tentang = $tentang;
		$this->data->nomor = $nomor;
		$this->data->tahun = $tahun;
		$this->data->categories	= $this->listings->get_all_categories();
		$this->data->listingsbyyear = $this->listings->get_entries_by_year();
		$this->layout->create('listings/search', $this->data);
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
		$data['entry'] = $this->listings->get_entry( intval($entry_id) );
		
		if( count($data['entry']) == 0)
		{
			// Entry doesn't exist
			$this->session->set_flashdata('msg', 'Data produk hukum ini tidak tersedia.');
			redirect();
		}
		
		//$data['owner'] = $this->users->get_user($data['entry']->FK_user_id);
		$data['categorylistings'] = $this->listings->get_category_listings($data['entry']->FK_category_id, array('limit' => 10));
		$data['categories']	= $this->listings->get_all_categories();
		$data['listingsbyyear'] = $this->listings->get_entries_by_year();
		$this->layout->create('listings/details', $data);		
	}
	
	function download($entry_id, $file)
	{
		if ( $this->session->userdata('user_id') > 0 )
		{
			$realpath = realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? str_replace(DIRECTORY_SEPARATOR, '/', $_SERVER['DOCUMENT_ROOT']) : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.'))));
			$filedownload = $realpath.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'download'.DIRECTORY_SEPARATOR.'produkhukum'.DIRECTORY_SEPARATOR.$file;
			$this->load->helper('download');
			$this->listings->set_download_hits( intval($entry_id) );
			$entry_detail = $this->listings->get_entry(intval($entry_id));
			$entry_array = array(
								 'user_id' => $this->session->userdata('user_id')
								 ,'type' => 'Download'
								 ,'category' => 'Produk Hukum'
								 ,'title' => $entry_detail->name. ' No. ' . $entry_detail->title . ' Tahun ' . $entry_detail->regyear
								 ,'url' => 'produkhukum/listings/details/'.$entry_detail->entry_id
								 ,'file_url' => 'produkhukum/download/'.$entry_detail->entry_id.'/'.$entry_detail->url
								 ,'date' => date("Y-m-d H:i:s")
								 );
			$this->listings->set_download_log( $entry_array );
			$data = file_get_contents($filedownload); // Read the file's contents
			force_download($file, $data);
			redirect();	
		}else{
			redirect('users/login');
		}
	}
}


/* End of file listings.php */
/* Location: ./application/controllers/listings.php */