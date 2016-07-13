<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * The galleries module enables users to create albums, upload photos and manage their existing albums.
 *
 * @author 		PyroCMS Dev Team
 * @modified	Jerel Unruh - PyroCMS Dev Team
 * @package 	PyroCMS
 * @subpackage 	Gallery Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Photo_activity_album_m extends MY_Model
{
	/**
	 * Constructor method
	 * 
	 * @author PyroCMS Dev Team
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'photo_activity_album';
	}
	
	/**
	 * Get all galleries along with the total number of photos in each gallery
	 *
	 * @author Yorick Peterse - PyroCMS Dev Team
	 * @access public
	 * @return mixed
	 */
	public function get_all() 
	{
		$this->db->select('photo_activity_album.*, photo_activity_category.title as category');
		$this->db->join('photo_activity_category', 'photo_activity_album.category_id=photo_activity_category.id', 'left');
		return $this->db->get('photo_activity_album')->result();
	}

	function get_many_by($params = array())
	{
		$this->load->helper('date');

		if (!empty($params['category']))
		{
			$this->db->where('category_id', $params['category']);
		}

		if (!empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (!empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		// Is a status set?
		if (!empty($params['status']))
		{
			// If it's all, then show whatever the status
			if ($params['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('photo_activity_album.published', $params['status']);
			}
		}

		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('photo_activity_album.published', '1');
		}

		// By default, dont show future posts
		if (!isset($params['show_future']) || (isset($params['show_future']) && $params['show_future'] == FALSE))
		{
			$this->db->where('created_on <=', now());
		}

      $this->db->order_by('created_on DESC');

		// Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		elseif (isset($params['limit']))
			$this->db->limit($params['limit']);

		return $this->get_all();
	}

	function count_by($params = array())
	{
		if (!empty($params['category']))
		{
			$this->db->where('category_id', $params['category']);
		}

		if (!empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (!empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		// Is a status set?
		if (!empty($params['status']))
		{
			// If it's all, then show whatever the status
			if ($params['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('published', $params['status']);
			}
		}

		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('published', '1');
		}

		return $this->db->count_all_results('photo_activity_album');
	}

	public function get_forselect_by_category($id) 
	{
		$this->db->select('id, title')->where('category_id', $id);
		return $this->db->get('photo_activity_album')->result();
	}

    public function insert($input = array())
    {
    	parent::insert($input);
        return $input['title'];
    }

    public function update($id, $input = array())
    {
    	parent::update($id, $input);
        return $input['title'];
    }
}