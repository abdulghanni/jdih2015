<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * RSS Class
 *
 * @author		Derek Allard - modified to work with CI-Directory
 * @link		http://www.derekallard.com/blog/post/building-an-rss-feed-in-code-igniter/
 */

class Feed extends MY_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Feed()
	{
		parent::MY_Controller();
		
		$this->load->model('listings_model', 'listings');
		$this->load->helper('xml');
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Default Controller Function
	 *
	 * @access	public
	 */
	function index()
	{
		$this->show_feed();
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Display Category Specific
	 *
	 * @access	public
	 * @param	int		category ID
	 */
	function category($category_id = FALSE)
	{
		$this->show_feed(intval($category_id));
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Show the feed
	 *
	 * @access	public
	 * @param	int		category ID
	 */
	function show_feed($category_id = FALSE)
	{		
		// Set common config
		$data['charset'] 			= $this->config->item('charset');		
		$data['feed_url'] 			= base_url();		
		$data['page_language'] 		= $this->config->item('feed_language');
		$data['creator_email'] 		= $this->config->item('feed_email');
		
		if($category_id)
		{
			// Get the category infos
			$category = $this->listings->get_category($category_id);
			
			$data['feed_name'] 			= $this->config->item('cat_feed_name');
			$data['page_description'] 	= 'Listings of '.$category->name;
			
			// Get new entries from the category ID
			$data['entries'] 			= $this->listings->get_new_entries($this->config->item('feed_num'), $category_id); 
		}
		else // No category, we display all listings
		{
			$data['feed_name'] 			= $this->config->item('all_feed_name');
			$data['page_description'] 	= $this->config->item('all_feed_description');
			
			// Get new entries
			$data['entries'] 			= $this->listings->get_new_entries($this->config->item('feed_num'));
		}
		
		// Output the feed
		$this->output->set_header("Content-Type: application/rss+xml");
		$this->load->view('rss', $data);
	}

}

/* End of file feed.php */
/* Location: ./application/controllers/feed.php */