<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends Model
{
	var $table = 'pages';

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Pages_model()
	{
		parent::Model();
	}

	// --------------------------------------------------------------------

	/**
	 * Get a page
	 *
	 * @access	public
	 * @return	object	Page data as a row or as result set
	 */
    function get($url)
    {
		if(ctype_digit($url))
		{
			$this->db->where('page_id', $url);
		}
		else
		{
			$this->db->where('url', $url);
		}

		$query = $this->db->get($this->table);

		return $query->row();
    }

}

// END pages_model.php
/* Location: ./application/models/pages_model.php */