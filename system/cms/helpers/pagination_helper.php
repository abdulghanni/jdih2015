<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * PyroCMS Pagination Helpers
 *  
 * @package PyroCMS\Core\Helpers
 * @author      PyroCMS Dev Team
 * @copyright   Copyright (c) 2012, PyroCMS LLC
 */
if ( ! function_exists('create_pagination'))
{

	/**
	 * The Pagination helper cuts out some of the bumf of normal pagination
	 *
	 * @param string $uri The current URI.
	 * @param int $total_rows The total of the items to paginate.
	 * @param int|null $limit How many to show at a time.
	 * @param int $uri_segment The current page.
	 * @param boolean $full_tag_wrap Option for the Pagination::create_links()
	 * @return array The pagination array. 
	 * @see Pagination::create_links()
	 */
	function create_pagination($uri, $total_rows, $limit = null, $uri_segment = 4, $full_tag_wrap = true)
	{
		$ci = & get_instance();
		$ci->load->library('pagination');

		$current_page = $ci->uri->segment($uri_segment, 0);
		$suffix = $ci->config->item('url_suffix');

		$limit = $limit === null ? Settings::get('records_per_page') : $limit;
		
		// Initialize pagination
		$config['suffix']				= $suffix;
		$config['base_url']				= ( ! $suffix) ? rtrim(site_url($uri), $suffix) : site_url($uri);
		$config['total_rows']			= $total_rows; // count all records
		$config['per_page']				= $limit;
		$config['uri_segment']			= $uri_segment;
		$config['use_page_numbers']		= TRUE;
		$config['reuse_query_string']	= TRUE;
		
		$config['num_links'] = 4;
		
		$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = '&lt;&lt;';
		$config['first_tag_open'] = '<li class="first">';
		$config['first_tag_close'] = '</li>';
		
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		
		$config['last_link'] = '&gt;&gt;';
		$config['last_tag_open'] = '<li class="last">';
		$config['last_tag_close'] = '</li>';

		// Initialize pagination
		$ci->pagination->initialize($config);

		$offset = $limit * ($current_page - 1);
		
		//avoid having a negative offset
		if ($offset < 0) $offset = 0;

		return array(
			'current_page' => $current_page,
			'per_page' => $limit,
			'limit' => $limit,
			'offset' => $offset,
			'links' => $ci->pagination->create_links($full_tag_wrap)
		);
	}
}