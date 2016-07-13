<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * The galleries module enables users to create albums, upload photos and manage their existing albums.
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS
 * @subpackage 	Gallery Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Photo_activity extends Public_Controller
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
		
		// Load the required classes
		$this->load->model('photo_activity_m');
		$this->load->model('photo_activity_album_m');
		$this->load->model('photo_activity_category_m');
		$this->load->library('form_validation');
		$this->lang->load('photo_activity');
		$this->lang->load('photo_activity_images');
		$this->load->helper('html');
		$this->load->helper('html');
	}
	
	/**
	 * Index method
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$categories = $this->photo_activity_category_m->get_all();
		//print('<pre>');print_r($this->data->categories);print('</pre>');
		$latestalbum = $this->photo_activity_album_m->limit(1)->get_many_by(array('status'=>'1'));
		$photos = $this->photo_activity_m->get_many_by(array('album'=>$latestalbum[0]->id, 'status'=>'1'));
		
		$pagination = create_pagination('photo_activity/page', $this->photo_activity_album_m->count_by(array('status' => '1')), 8, 3);
		$otheralbum = $this->photo_activity_album_m->limit($pagination['limit'])->get_many_by(array('status'=>'1'));
		
		$this->template
			->set('categories', $categories)
			->set('latestalbum', $latestalbum)
			->set('photos', $photos)
			->set('pagination', $pagination)
			->set('otheralbum', $otheralbum)
			->append_css('module::basic.css')
			->append_css('module::galleriffic-3.css')
			->append_js('module::jquery.history.js')
			->append_js('module::jquery.galleriffic.js')
			->append_js('module::jquery.opacityrollover.js')
			->build('index');
	}
	
	public function album($slug)
	{
		$album = $this->photo_activity_album_m->get_by('slug', $slug);
		$categories = $this->photo_activity_category_m->get_all();
		//print('<pre>');print_r($this->data->categories);print('</pre>');
		$photos = $this->photo_activity_m->get_many_by(array('album'=>$album->id, 'status'=>'1'));
		$otheralbum = $this->photo_activity_album_m->limit(10)->get_many_by(array('status'=>'1'));
		$this->template
			->set('categories', $categories)
			->set('album', $album)
			->set('photos', $photos)
			->set('otheralbum', $otheralbum)
			->append_css('module::basic.css')
			->append_css('module::galleriffic-3.css')
			->append_js('module::jquery.history.js')
			->append_js('module::jquery.galleriffic.js')
			->append_js('module::jquery.opacityrollover.js')
			->build('album');
	}
	
	/**
	 * View a single gallery
	 *
	 * @author Yorick Peterse - PyroCMS Dev Team
	 * @access public
	 * @param string $slug The slug of the gallery
	 */
	public function photo($slug = NULL)
	{
		$slug or show_404();
		
		$photo	= $this->photo_activity_m->get_by('slug', $slug) or show_404();
		$photo->file = $this->file_m->get($photo->file_id);
		$photo->folder = $this->file_folders_m->get($photo->file->folder_id);
		$photo->album = $this->photo_activity_album_m->get($photo->album_id);
		$photo->category = $this->photo_activity_category_m->get($photo->category_id);
		
		print('<pre>');print_r($photo);print('</pre>');
		
		$album_photos	= $this->photo_activity_m->get_many_by(array('album'=>$photo->album->id));

		$this->template->build('photo', array(
			'photo'				=> $photo,
			'album_photos'		=> $album_photos
		));
	}
	
	/**
	 * View a single image
	 * 
	 * @author Yorick Peterse - PyroCMS Dev Team
	 * @access public
	 * @param 
	 */
	public function image($gallery_slug = NULL, $image_id = NULL)
	{
		// Got the required variables?
		if ( empty($gallery_slug) OR empty($image_id) )
		{
			show_404();
		}
		
		$gallery		= $this->galleries_m->get_by('slug', $gallery_slug);
		$gallery_image	= $this->gallery_images_m->get($image_id);
		
		// Do the gallery and the image ID match?
		if ($gallery->id != $gallery_image->gallery_id)
		{
			show_404();
		}
		
		$this->template->build('image', array(
			'gallery'		=> $gallery,
			'gallery_image'	=> $gallery_image
		));
	}
}