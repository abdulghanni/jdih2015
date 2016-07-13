<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		WYSIWYG
 * @author			Phil Sturgeon, Stephen Cozart
 *
 * Manages image selection and insertion for WYSIWYG editors
 */
class Admin_image extends ImageSelector_Controller
{
	function __construct()
	{
		parent::ImageSelector_Controller();

	}
	
	public function index($id = FALSE)
	{
		//list of folders for the sidebar
		$folders = $this->file_folders_m->get_many_by('parent_id', 0);
		$field_id 	= $this->input->get('id');
		$field_name = $this->input->get('name');
		$field_type = $this->input->get('type');
		
		$form_field_id = $this->input->get('form_field_id');
		$form_field_name = $this->input->get('form_field_name');

		//for dropdown list
		$sub_folders = $this->file_folders_m->get_folders();

		$active_folder = array();

		if(!empty($folders) and !$id)
		{
			$active_folder = $folders[0];
			$active_folder->items = $this->file_m->get_many_by(array('folder_id' => $active_folder->id, 'type' => 'i'));
      }
		elseif(!empty($folders) and $id)
		{
			$active_folder = $this->file_folders_m->get($id);
			$active_folder->items = $this->file_m->get_many_by(array('folder_id' => $id, 'type' => 'i'));
		}
		
		$folder_options = array();
		
		if(!empty($sub_folders))
		{
			foreach($sub_folders as $row)
			{
				if ($row['name'] != '-') //$id OR $row['parent_id'] > 0)
				{
					$indent = ($row['parent_id'] != 0 && isset($row['depth'])) ? repeater('&nbsp;&raquo;&nbsp;', $row['depth']) : '';
					$folder_options[$row['id']] = $indent.$row['name'];
				}
			}
		}
		
		$this->template
         ->append_metadata( js('imageselector.js', 'banner') )
		 	->set('field_id', $field_id)
			->set('field_name', $field_name)
			->set('field_type', $field_type)
			->set('form_field_id', $form_field_id)
			->set('form_field_name', $form_field_name)
			->set('folders', $folders)
			->set('folder_options', $folder_options)
			->set('active_folder', $active_folder)
			->title('Images')
			->build('admin/image');
	}

}