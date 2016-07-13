<?php
/**
 * @package 		PyroCMS
 * @subpackage 		Latest news Widget
 * @author			Erik Berman
 *
 * Show Latest news in your site with a widget. Intended for use on cms pages
 *
 * Usage : on a CMS page add {widget_area('name_of_area')}
 * where 'name_of_area' is the name of the widget area you created in the admin control panel
 */

class Widget_Latest_photos extends Widgets
{
	public $title = 'Latest photos';
	public $description = 'Display latest photos with a widget.';
	public $author = 'Agus Sugiharto';
	public $website = 'http://www.nukleo.fr';
	public $version = '1.0';

	// build form fields for the backend
	// MUST match the field name declared in the form.php file
	public $fields = array(
		array(
			'field'   => 'show_title',
			'label'   => 'Show Title'
		),
		array(
			'field'   => 'limit',
			'label'   => 'Number of photos',
		),
		array(
			'field'   => 'class',
			'label'   => 'Class'
		),
		array(
			'field'   => 'page[]',
			'label'   => 'Show on Page'
		),
		array(
			'field'   => 'module[]',
			'label'   => 'Show on Module'
		)
	);
	
	public function __construct()
	{
		parent::__construct();
	}

	public function form($options)
	{
		!empty($options['limit']) OR $options['limit'] = 5;
		
		return array(
			'options' => $options
		);
	}

	public function run($options)
	{		
		// sets default number of articles to be shown
		empty($options['limit']) AND $options['limit'] = 5;
		class_exists('Photo_activity_album_m') OR $this->load->model('photo_activity/photo_activity_album_m');
		$album = $this->photo_activity_album_m->limit($options['limit'])->get_many_by(array('status'=>'1'));
		
		// returns the variables to be used within the widget's view
		return array('photo_album' => $album);
	}
}