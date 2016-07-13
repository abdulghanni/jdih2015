<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Blog Plugin
 *
 * Create lists of posts
 *
 * @package		PyroCMS
 * @author		PyroCMS Dev Team
 * @copyright	Copyright (c) 2008 - 2011, PyroCMS
 *
 */
class Plugin_Photo_activity extends Plugin
{
	/**
	 * Blog List
	 *
	 * Creates a list of blog posts
	 *
	 * Usage:
	 * {pyro:blog:posts limit="5"}
	 *	<h2>{pyro:title}</h2>
	 *	{pyro:body}
	 * {/pyro:blog:posts}
	 *
	 * @param	array
	 * @return	array
	 */
	function posts($data = array())
	{
		$limit = $this->attribute('limit', 10);
		$category = $this->attribute('category');
		$order = $this->attribute('order');

		if ($category)
		{
			is_numeric($category)
				? $this->db->where('c.cat_id', $category)
				: $this->db->where('c.cat_name', $category);
		}
		
		return $this->db
			->select('bankdata_documents.*, c.cat_name as category_title, c.cat_name as category_slug')
			->where('document_approved', '1')
			->where('document_date <=', now())
			->join('bankdata_categories c', 'bankdata_documents.document_category_id = c.cat_id', 'LEFT')
			->order_by('bankdata_documents.document_date', $order)
			->limit($limit)
			->get('bankdata_documents')
			->result_array();
	}
}

/* End of file plugin.php */