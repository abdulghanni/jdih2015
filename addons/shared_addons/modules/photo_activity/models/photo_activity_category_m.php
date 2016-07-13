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
class Photo_activity_category_m extends MY_Model
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
		$this->_table = 'photo_activity_category';
	}
	
	public function insert($input = array())
    {
    	$this->load->helper('text');
    	parent::insert(array(
        	'title'=>$input['title'],
        	'slug'=>url_title(strtolower(convert_accented_characters($input['title'])))
        ));
        
        return $input['title'];
    }
	
    public function update($id, $input)
	{
		return parent::update($id, array(
            'title'	=> $input['title'],
            'slug'	=> url_title(strtolower(convert_accented_characters($input['title'])))
		));
    }

	public function check_title($title = '')
	{
		return parent::count_by('slug', url_title($title)) > 0;
	}

	public function insert_ajax($input = array())
	{
		$this->load->helper('text');
		return parent::insert(array(
				'title'=>$input['title'],
				//is something wrong with convert_accented_characters?
				//'slug'=>url_title(strtolower(convert_accented_characters($input['title'])))
				'slug' => url_title(strtolower($input['title']))
				));
	}
}