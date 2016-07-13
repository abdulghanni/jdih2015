<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

// @TODO: Get results only where they are set to active

class Listings_model extends Model
{
	
	var $entries_table 		= 'ph_entries'; 	// Entries table
	var $categories_table 	= 'ph_categories'; 	// Category table
	    
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Listings_model()
	{
		parent::Model();
	}
		
	// =============================
	// = ========== GET ========== =
	// =============================
	
	/**
	 * Get all Categories
	 *
	 * @access	public
	 * @return 	object	Categories
	 */
	function get_all_categories()
	{
		$this->db->order_by('entry_order asc');
		$query = $this->db->get($this->categories_table);
		return $query->result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all entries
	 *
	 * @access	public
	 * @return 	object	Entries
	 */
	function count_all_entries()
	{ 
		$this->db->select('e.entry_id');		
		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		$total_rows = $this->db->count_all_results();	
		return $total_rows;
	}
	
	function get_all_entries($params = array())
	{
		$this->db->select('c.description as c_description, e.description as e_description, ');		
		$this->db->select('e.entry_id, e.FK_category_id, e.FK_user_id, e.active, CAST(e.title as SIGNED) as title, e.regyear, e.date_added, e.url');
		$this->db->select('e.hits, e.downloaded, c.category_id, c.name, c.entry_count');

		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		
		$this->db->order_by('e.regyear desc, title desc');
		
       	if(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif(isset($params['limit'])) $this->db->limit($params['limit']);


		$query = $this->db->get();		
		return $query->result();
	}
	
	function get_most_hit($params = array())
	{
		$this->db->select('c.description as c_description, e.description as e_description, ');		
		$this->db->select('e.entry_id, e.FK_category_id, e.FK_user_id, e.active, CAST(e.title as SIGNED) as title, e.regyear, e.date_added, e.url');
		$this->db->select('e.hits, e.downloaded, c.category_id, c.name, c.entry_count');

		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		
		$this->db->order_by('e.hits desc');
		
       	if(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif(isset($params['limit'])) $this->db->limit($params['limit']);


		$query = $this->db->get();		
		return $query->result();
	}
	
	function get_most_download($params = array())
	{
		$this->db->select('c.description as c_description, e.description as e_description, ');		
		$this->db->select('e.entry_id, e.FK_category_id, e.FK_user_id, e.active, CAST(e.title as SIGNED) as title, e.regyear, e.date_added, e.url');
		$this->db->select('e.hits, e.downloaded, c.category_id, c.name, c.entry_count');

		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		
		$this->db->order_by('e.downloaded desc');
		
       	if(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif(isset($params['limit'])) $this->db->limit($params['limit']);


		$query = $this->db->get();		
		return $query->result();
	}
	
	function get_entries_by_year()
	{
		$this->db->select("entry_id, regyear, count(*) AS total");
		$this->db->group_by("regyear");
		$this->db->order_by("regyear", "desc");
		$query = $this->db->get($this->entries_table);
		return $query->result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get Category
	 *
	 * @access	public
	 * @param	integer	Category ID
	 * @return 	object	Category
	 */
	function get_category($id)
	{
		$query = $this->db->get_where($this->categories_table, array('category_id' => $id));
		return $query->row();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get a single entry by its ID
	 *
	 * @access	public
	 * @param	integer	Entry ID
	 * @return 	object	Entry
	 */
	function get_entry($id)
	{
		$this->db->select('c.description as c_description, e.description as e_description, ');		
		$this->db->select('entry_id, FK_category_id, FK_user_id, active, CAST(title as SIGNED) as title, regyear, date_added, url');
		$this->db->select('e.hits, e.downloaded, category_id, name, entry_count');

		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		$this->db->where(array('entry_id' => $id));
		$this->db->order_by('e.regyear desc, title desc');
		$query = $this->db->get();
		return $query->row();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all listing of a Category by its ID
	 *
	 * @access	public
	 * @param	integer	Category ID
	 * @return 	mixed	Category and Entries
	 */
	function get_listings_by_year($year = FALSE, $params = array())
	{
		// Ambiguous Fields, entries, categories
		$this->db->select('e.entry_id');
		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		$this->db->where('e.regyear = '.$year);
		$total_rows = $this->db->count_all_results();
	
		// Ambiguous Fields, entries, categories
		$this->db->select('c.description as c_description, e.description as e_description, ');		
		$this->db->select('entry_id, FK_category_id, FK_user_id, active, CAST(e.title as SIGNED) as title, regyear, date_added, url');
		$this->db->select('e.hits, e.downloaded, category_id, name, entry_count');

		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id');
		
		$this->db->where('e.regyear = '.$year);
		$this->db->group_by('e.entry_id');
		$this->db->order_by('e.regyear desc, title desc');
		
       	if(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif(isset($params['limit'])) $this->db->limit($params['limit']);

		$query = $this->db->get();
		
		// Convenience - they aren't really related in this way
		$result = array(
						'entries'	=> $query->result(),
						'category'	=> $query->row(),
						'total_rows'=> $total_rows
						);

		// Free results
		$query->free_result();
		
		return $result;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all listing of a Category by its ID
	 *
	 * @access	public
	 * @param	integer	Category ID
	 * @return 	mixed	Category and Entries
	 */
	function count_search_result($nomor = '', $tahun = '', $tentang = '', $params = array())
	{
		$sqlwhere = "";
		// Ambiguous Fields, entries, categories
		$this->db->select($this->entries_table.'.entry_id');
		$this->db->from($this->categories_table);
		$this->db->join($this->entries_table, $this->db->dbprefix($this->categories_table).".category_id = ".$this->db->dbprefix($this->entries_table).".FK_category_id", "left");
		
		$sqlwhere = $this->db->dbprefix($this->entries_table).".entry_id` <> 0 ";
		if ($nomor!='0') $sqlwhere .= " AND ".$this->db->dbprefix($this->entries_table).".title = '" . $nomor . "'";
		if ($tahun!='0') $sqlwhere .= " AND ".$this->db->dbprefix($this->entries_table).".regyear = " . $tahun . "";
		if ($tentang!='all') $sqlwhere .= " AND ".$this->db->dbprefix($this->entries_table).".description LIKE '%".$tentang."%'";
		if ($sqlwhere) $this->db->where($sqlwhere);
		
		$total_rows = $this->db->count_all_results();
		return $total_rows;
	}
	
	function get_search_result($nomor = FALSE, $tahun = FALSE, $tentang = FALSE, $params = array())
	{
		$sqlwhere = "";
		// Ambiguous Fields, entries, categories
		$this->db->select($this->db->dbprefix($this->entries_table).'.description as c_description, '.$this->db->dbprefix($this->entries_table).'.description as e_description, ');		
		$this->db->select('entry_id, FK_category_id, FK_user_id, active, CAST('.$this->db->dbprefix($this->entries_table).'.title as SIGNED) as title, regyear, date_added, url');
		$this->db->select('hits, downloaded, category_id, name, entry_count');

		$this->db->from($this->categories_table);
		$this->db->join($this->entries_table, $this->db->dbprefix($this->categories_table).".category_id = ".$this->db->dbprefix($this->entries_table).".FK_category_id", "left");
		
		//print_r($sqlwhere);
		$sqlwhere = $this->db->dbprefix($this->entries_table).".entry_id` <> 0 ";
		if ($nomor!='0') $sqlwhere .= " AND ".$this->db->dbprefix($this->entries_table).".title = '" . $nomor . "'";
		if ($tahun!='0') $sqlwhere .= " AND ".$this->db->dbprefix($this->entries_table).".regyear = " . $tahun . "";
		if ($tentang!='all') $sqlwhere .= " AND ".$this->db->dbprefix($this->entries_table).".description LIKE '%".$tentang."%'";
		if ($sqlwhere) $this->db->where($sqlwhere);
		
		if ($sqlwhere) $this->db->where($sqlwhere);
		$this->db->order_by('regyear DESC, title DESC');
		
       	if(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif(isset($params['limit'])) $this->db->limit($params['limit']);

		$query = $this->db->get();
		
		// Convenience - they aren't really related in this way
		$result = $query->result();

		// Free results
		$query->free_result();
		
		return $result;
	}
	
	function count_admin_search_results($params = array())
	{	
		$this->db->select('e.entry_id');
		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		if (!empty($params['keyword']))
			$this->db->where('(e.title LIKE \'%'.$params['keyword'].'%\' OR e.description LIKE \'%'.$params['keyword'].'%\')');
		if (!empty($params['catid']) && $params['catid']!='All')
			$this->db->where('c.category_id', $params['catid']);
		$total_rows = $this->db->count_all_results();	
		return $total_rows;
	}
	
	function get_admin_search_results($params = array())
	{	
		$this->db->select('c.description as c_description, e.description as e_description, ');		
		$this->db->select('e.entry_id, e.FK_category_id, e.FK_user_id, e.active, CAST(e.title as SIGNED) as title, e.regyear, e.date_added, e.url');
		$this->db->select('e.hits, e.downloaded, c.category_id, c.name, c.entry_count');
		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'left');
		if (!empty($params['keyword']))
			$this->db->where('(e.title LIKE \'%'.$params['keyword'].'%\' OR e.description LIKE \'%'.$params['keyword'].'%\' OR c.name LIKE \'%'.$params['keyword'].'%\')');
		if (!empty($params['catid']) && $params['catid']!='All')
			$this->db->where('c.category_id', $params['catid']);
		$this->db->order_by('e.regyear desc, e.title desc');
       	if(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif(isset($params['limit'])) $this->db->limit($params['limit']);

		$query = $this->db->get();		
		return $query->result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all listing of a Category by its ID
	 *
	 * @access	public
	 * @param	integer	Category ID
	 * @return 	mixed	Category and Entries
	 */
	function get_category_listings($id = FALSE, $params = array())
	{
		// Ambiguous Fields, entries, categories
		$this->db->select('e.entry_id');
		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'right');
		$this->db->where('e.FK_category_id = '.$id);
		$total_rows = $this->db->count_all_results();
		
		$this->db->select('name');
		$this->db->from($this->categories_table);
		$this->db->where('category_id = '.$id);
		$query = $this->db->get();
		$category = $query->row();
		
		$this->db->select('c.description as c_description, e.description as e_description, ');		
		$this->db->select('entry_id, FK_category_id, FK_user_id, active, CAST(e.title as SIGNED) as title, regyear, date_added, url');
		$this->db->select('e.hits, e.downloaded, category_id, name, entry_count');

		$this->db->from($this->categories_table.' AS c');
		$this->db->join($this->entries_table.' AS e', 'c.category_id = e.FK_category_id', 'right');
		
		$this->db->where('e.FK_category_id = '.$id);
		$this->db->order_by('e.regyear desc, title desc');
		
       	if(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif(isset($params['limit'])) $this->db->limit($params['limit']);

		$query = $this->db->get();
		
		// Convenience - they aren't really related in this way
		$result = array(
						'entries'	=> $query->result(),
						'category'	=> $category->name,
						'total_rows'=> $total_rows
						);

		// Free results
		$query->free_result();
		
		return $result;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get new entries
	 *
	 * @access	public
	 */
	function get_new_entries($limit = '5', $category = FALSE)
	{
		if($category)
		{
			$this->db->where('FK_category_id', $category);
		}		
		$this->db->select($this->categories_table.'.description AS cat_description, '.$this->entries_table.'.description, name, entry_id, CAST(title as SIGNED) as title, regyear');
		$this->db->join($this->categories_table, $this->entries_table.'.FK_category_id = '.$this->categories_table.'.category_id', 'left');		
		$this->db->order_by('regyear desc, title desc');
		$this->db->limit($limit);
		$query = $this->db->get($this->entries_table);
		return $query->result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all entries for a user
	 *
	 * @access	public
	 * @param	integer	user id
	 */
	function get_user_entries($nomor, $tahun, $kategori, $id,  $limit = FALSE, $offset = FALSE)
	{
		// Ambiguous Fields, entries, categories
		$this->db->select('e.entry_id');
		$this->db->from($this->categories_table);
		$this->db->join($this->entries_table, $this->categories_table.'.category_id = '.$this->entries_table.'.FK_category_id', 'left');
		
		$sql_where[$this->db->dbprefix($this->entries_table).'.FK_user_id'] = $id;
		if ($nomor!='') $sql_where[$this->db->dbprefix($this->entries_table).".title"]=$nomor;
		if ($tahun!='') $sql_where[$this->db->dbprefix($this->entries_table).".regyear"]=$tahun;
		if ($kategori!='') $sql_where[$this->db->dbprefix($this->entries_table).".FK_category_id"]=$kategori;
		
		//print_r($sql_where);
		
		$this->db->where($sql_where);
		
		$total_rows = $this->db->count_all_results();
		
		$this->db->select($this->categories_table.'.description AS cat_description, '.$this->entries_table.'.description, name, entry_id, title, regyear');
		$this->db->select('category_id, name, entry_count');
		$this->db->join($this->categories_table, $this->entries_table.'.FK_category_id = '.$this->categories_table.'.category_id', 'left');		
		$this->db->where($sql_where);
		$this->db->order_by( $this->entries_table.'.regyear desc, '.$this->entries_table.'.title desc');
		$this->db->limit($limit);
		$this->db->offset($offset);
		
		$query = $this->db->get_where($this->entries_table, array('FK_user_id' => $id));
		
		$result = array(
						'entries'	=> $query->result(),
						'category'	=> $query->row(),
						'total_rows' => $total_rows
						);
		return $result;
	}
	
	// =============================
	// = ========== ADD ========== =
	// =============================
	
	/**
	 * Add a new entry
	 *
	 * @access	public
	 */
	function add_entry($input = array())
	{		
		$fields = array(
					'FK_category_id'	=>	$input['FK_category_id'],
					'FK_user_id'		=>	$input['FK_user_id'],
					'active'			=>	$input['active'],
					'title'				=>	$input['title'],
					'regyear'			=>	$input['regyear'],
					'description'		=>	$input['description'],
					'date_added'		=>  $input['date_added'],
					'url'				=>	$input['url'],
					'hits'				=>	$input['hits'],
					'downloaded'		=>	$input['downloaded']
						);
		
		$this->db->set($fields);
		$this->db->insert($this->entries_table);
		$id = $this->db->insert_id();
		
		$this->db->set('entry_count', 'entry_count+1', FALSE);
		$this->db->where('category_id', $input['FK_category_id']);
		$this->db->update($this->categories_table);
		
		return $id;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add a new category
	 *
	 * @access	public
	 */
	function add_category()
	{
		$fields = array(
						'name'			=> $this->input->post('name'),
						'description'	=> $this->input->post('name'),
						'entry_order'	=> $this->input->post('entry_order')
						);
		
		$this->db->set($fields);
		$this->db->insert($this->categories_table);
		
		return $this->db->insert_id();
	}
	
	// ================================
	// = ========== UPDATE ========== =
	// ================================
	
	/**
	 * Update an existing entry
	 *
	 * @access	public
	 */
	function update_entry($input = array(), $id = 0)
	{	
		if ($input['url']!="")
		{
			$fields = array(
						'FK_category_id'	=>	$input['FK_category_id'],
						'title'				=>	$input['title'],
						'regyear'			=>	$input['regyear'],
						'description'		=>	$input['description'],
						'url'				=>	$input['url']
							);
		}else{
			$fields = array(
						'FK_category_id'	=>	$input['FK_category_id'],
						'title'				=>	$input['title'],
						'regyear'			=>	$input['regyear'],
						'description'		=>	$input['description']
							);
		}
		$this->db->set($fields);
		$this->db->where('entry_id', $id);
		$this->db->update($this->entries_table);
		
		// Did the category change?
		if ($input['old_cat'] != $input['FK_category_id'])
		{
			$this->db->set('entry_count', 'entry_count-1', FALSE);
			$this->db->update($this->categories_table, NULL, "category_id = ".$input['old_cat']);
			
			$this->db->set('entry_count', 'entry_count+1', FALSE);
			$this->db->update($this->categories_table, NULL, "category_id = ".$input['FK_category_id']);
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update an existing category
	 *
	 * @access	public
	 */
	function update_category($id)
	{		
		$fields = array(
					'name'				=>	$this->input->post('name'),
					'description'		=>	$this->input->post('name'),
					'entry_order'		=>  $this->input->post('entry_order')
					);
		
		$this->db->set($fields);
		$this->db->where('category_id', $id);
		$this->db->update($this->categories_table);
	}
	
	// ================================
	// = ========== DELETE ========== =
	// ================================
	
	/**
	 * Delete a Category
	 *
	 * @access	public
	 * @param	integer	entry id
	 */
	function delete_category($id)
	{
		$this->db->delete( $this->categories_table, array('category_id' => $id) );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete an Entry
	 *
	 * @access	public
	 * @param	integer	entry id
	 */
	function delete_entry($id)
	{
		$query = $this->db->get_where( $this->entries_table, array('entry_id' => $id) );
		
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			
			$this->db->trans_start();
			
			// Delete
			$this->db->delete( $this->entries_table, array('entry_id' => $id) );
			
			// Decrement Child Count
			$this->db->set('entry_count', 'entry_count-1', FALSE);
			$this->db->where('category_id', $result->FK_category_id);
			$this->db->update($this->categories_table);
			
			$this->db->trans_complete();
		}
		else
		{
			die('entry does not exist, or does not have a category - remove it manually');
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete all of a user's entries
	 *
	 * @access	public
	 * @param	integer	entry id
	 */
	function delete_user_entries($id)
	{
		$entries = $this->get_user_entries($id);

		foreach($entries as $entry)
		{
			$this->delete_entry($entry->entry_id);
		}
	}
	
	// ================================
	// = ========== OTHERS ========== =
	// ================================
		
	/**
	 * Check if a category exists
	 *
	 * @access	public
	 * @param	string	category name
	 * @return 	bool
	 */
	function check_category($name)
	{
		$query = $this->db->get_where($this->categories_table, array('name' => $name));
		return ($query->num_rows() > 0) ? TRUE : FALSE;
	}
	
	function set_detail_hits($id)
	{
		$this->db->query("update {$this->entries_table} set hits=hits+1 where entry_id=$id");
	}
	
	function set_download_hits($id)
	{
		$this->db->query("update {$this->entries_table} set downloaded=downloaded+1 where entry_id=$id");
	}
	
	function set_download_log($params = array())
	{
		$this->db->query("insert into users_activities set
						 dl_user_id='{$params['user_id']}'
						 ,dl_type='{$params['type']}'
						 ,dl_category='{$params['category']}'
						 ,dl_title='{$params['title']}'
						 ,dl_url='{$params['url']}'
						 ,dl_file_url='{$params['file_url']}'
						 ,dl_date='{$params['date']}'
						 ");
	}
}

// END listings_model.php
/* Location: ./application/models/listings_model.php */