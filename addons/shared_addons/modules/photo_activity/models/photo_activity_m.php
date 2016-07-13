<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * The galleries module enables users to create albums, upload photos and manage their existing albums.
 *
 * @author 		Yorick Peterse - PyroCMS Dev Team
 * @package 	PyroCMS
 * @subpackage 	Gallery Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Photo_activity_m extends MY_Model {

	/**
	 * The class constructer, tries to guess
	 * the table name.
	 *
	 * @author Jamie Rumbelow
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'photo_activity';
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
		$photos	= parent::get_all();
		$results	= array();
	  
		// Loop through each gallery and add the count of photos to the results
		foreach ($photos as $photo)
		{
			$photo->category = $this->photo_activity_category_m->get($photo->category_id);
			$photo->album = $this->photo_activity_album_m->get($photo->album_id);
			$results[] = $photo;
		}

		// Return the results
		return $results;
	}

	function get_many_by($params = array())
	{
		$this->load->helper('date');
      $this->db->select('photo_activity.*');
		$this->db->join('photo_activity_category c', 'photo_activity.category_id = c.id', 'left');
      $this->db->join('photo_activity_album a', 'photo_activity.album_id = a.id', 'left');

      if (!empty($params['keyword']))
		{
			$this->db->where('photo_activity.title LIKE \'%'.$params['keyword'].'%\' OR photo_activity.caption LIKE \'%'.$params['keyword'].'%\'', NULL, FALSE);
		}

		if (!empty($params['category']))
		{
			if (is_numeric($params['category']))
				$this->db->where('c.id', $params['category']);
			else
				$this->db->where('c.slug', $params['category']);
		}

      if (!empty($params['album']))
		{
			if (is_numeric($params['album']))
				$this->db->where('a.id', $params['album']);
			else
				$this->db->where('a.slug', $params['album']);
		}

		if (!empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(photo_activity.created_on))', $params['month']);
		}

		if (!empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(photo_activity.created_on))', $params['year']);
		}

		// Is a status set?
		if (!empty($params['status']))
		{
			// If it's all, then show whatever the status
			if ($params['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('photo_activity.published', $params['status']);
			}
		}

		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('photo_activity.published', '1');
		}

		// By default, dont show future posts
		if (!isset($params['show_future']) || (isset($params['show_future']) && $params['show_future'] == FALSE))
		{
			$this->db->where('photo_activity.created_on <=', now());
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
		$this->db->join('photo_activity_category c', 'photo_activity.category_id = c.id', 'left');
		$this->db->join('photo_activity_album a', 'photo_activity.album_id = a.id', 'left');

      if (!empty($params['keyword']))
		{
			$this->db->where('photo_activity.title LIKE \'%'.$params['keyword'].'%\' OR photo_activity.caption LIKE \'%'.$params['keyword'].'%\'', NULL, FALSE);
		}

		if (!empty($params['category']))
		{
			if (is_numeric($params['category']))
				$this->db->where('c.id', $params['category']);
			else
				$this->db->where('c.slug', $params['category']);
		}

      if (!empty($params['album']))
		{
			if (is_numeric($params['album']))
				$this->db->where('a.id', $params['album']);
			else
				$this->db->where('a.slug', $params['album']);
		}

		if (!empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(photo_activity.created_on))', $params['month']);
		}

		if (!empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(photo_activity.created_on))', $params['year']);
		}

		// Is a status set?
		if (!empty($params['status']))
		{
			// If it's all, then show whatever the status
			if ($params['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('photo_activity.published', $params['status']);
			}
		}

		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('photo_activity.published', '1');
		}

		return $this->db->count_all_results('photo_activity');
	}

	/**
	 * Get all galleries along with the thumbnail's filename and extension
	 *
	 * @access public
	 * @return mixed
	 */
	public function get_all_with_filename($where = NULL, $value = NULL)
	{
		$this->db
			->select('g.*, f.filename, f.extension, f.id as file_id, ff.parent_id as parent')
			->from('galleries g')
			->join('gallery_images gi', 'gi.id = g.thumbnail_id', 'left')
			->join('files f', 'f.id = gi.file_id', 'left')
			->join('file_folders ff', 'ff.id = g.folder_id', 'left')
			->where('g.published', '1');

		// Where clause provided?
		if ( ! empty($where) AND ! empty($value))
		{
			$this->db->where($where, $value);
		}

		return $this->db->get()->result();
	}

	/**
	 * Insert a new gallery into the database
	 *
	 * @author PyroCMS Dev Team
	 * @access public
	 * @param array $input The data to insert (a copy of $_POST)
	 * @return bool
	 */
	public function insert($input)
	{
		return (bool) parent::insert($input);
	}

	/**
	 * Update an existing gallery
	 *
	 * @author PyroCMS Dev Team
	 * @access public
	 * @param int $id The ID of the row to update
	 * @param array $input The data to use for updating the DB record
	 * @return bool
	 */
	public function update($id, $input)
	{
        return parent::update($id, $input);
	}

	/**
	 * Callback method for validating the slug
	 * @access public
	 * @param string $slug The slug to validate
	 * @param int $id The id of gallery
	 * @return bool
	 */
	public function check_slug($slug = '', $id = 0)
	{
		return parent::count_by(array(
			'id !='	=> $id,
			'slug'	=> $slug)
		) > 0;
	}

}