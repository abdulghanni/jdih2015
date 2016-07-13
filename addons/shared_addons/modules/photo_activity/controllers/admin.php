<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
class Admin extends Admin_Controller
{
	public $id = 0;

	/**
	 * Validation rules for creating a new gallery
	 *
	 * @var array
	 * @access private
	 */
	private $album_validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'lang:photos.title_label',
			'rules' => 'trim|max_length[255]|required'
		),
		array(
			'field' => 'slug',
			'label' => 'lang:photos.slug_label',
			'rules' => 'trim|max_length[255]|required|callback__check_slug'
		),
		array(
			'field' => 'category_id',
			'label' => 'Category',
			'rules' => 'trim|numeric|required'
		),
		array(
			'field' => 'description',
			'label' => 'lang:photos.description_label',
			'rules' => 'trim'
		),
		array(
			'field' => 'enable_comments',
			'label' => 'lang:photos.comments_label',
			'rules' => 'trim'
		),
		array(
			'field' => 'published',
			'label' => 'lang:photos.published_label',
			'rules' => 'trim'
		)
	);

	/**
	 * Validation rules for uploading photos
	 *
	 * @var array
	 * @access private
	 */
	private $photo_validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'lang:photos.title_label',
			'rules' => 'trim|max_length[255]|required'
		),
		array(
			'field' => 'slug',
			'label' => 'lang:photos.slug_label',
			'rules' => 'trim|max_length[255]|required|callback__check_slug'
		),
		array(
			'field' => 'album_id',
			'label' => 'lang:photos.album_label',
			'rules' => 'trim|integer|required'
		),
		array(
			'field' => 'category_id',
			'label' => 'lang:photos.category_label',
			'rules' => 'trim|integer|required'
		),
		array(
			'field' => 'caption',
			'label' => 'lang:photos.caption_label',
			'rules' => 'trim'
		),
		array(
			'field' => 'enable_comments',
			'label' => 'lang:photos.comments_label',
			'rules' => 'trim'
		),
		array(
			'field' => 'published',
			'label' => 'lang:photos.published_label',
			'rules' => 'trim'
		)
	);

   /**
	 * Validation rules for categories
	 *
	 * @var array
	 * @access private
	 */
	private $category_validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'lang:gallery_images.title_label',
			'rules' => 'trim|max_length[255]|required'
		),
		array(
			'field' => 'slug',
			'label' => 'lang:galleries.slug_label',
			'rules' => 'trim|max_length[255]|required|callback__check_slug'
		),
		array(
			'field' => 'thumbnail_id',
			'label' => 'lang:gallery_images.gallery_label',
			'rules' => 'trim|integer|required'
		),
		array(
			'field' => 'order',
			'label' => 'lang:gallery_images.gallery_label',
			'rules' => 'trim|integer'
		)
	);
		
	protected $section = 'album';

	/**
	 * Constructor method
	 *
	 * @author Yorick Peterse - PyroCMS Dev Team
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('photo_activity_m');
		$this->load->model('photo_activity_album_m');
		$this->load->model('photo_activity_category_m');
		$this->load->library('form_validation');
		$this->lang->load('photo_activity');
		$this->lang->load('photo_activity_images');
		$this->load->helper('html');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
      $this->config->load('photo_activity_config');
	}

	/**
	 * List all existing albums
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		// Get all the galleries
		$allalbums = $this->photo_activity_album_m->get_all();
		$albums	= array();
		foreach ($allalbums as $album)
		{
			$album->total_photo = $this->photo_activity_m->count_by(array('album'=>$album->id));
			$albums[] = $album;
		}
		// Load the view
		$this->template
			->title($this->module_details['name'])
			->append_js('module::functions.js')
			->set('albums', $albums)
			->build('admin/index');
	}
	
	/**
	 * List all existing albums
	 *
	 * @access public
	 * @return void
	 */
	public function categories()
	{
		// Get all the galleries
		$allcategories = $this->photo_activity_category_m->get_all();
		$categories	= array();
		foreach ($allcategories as $category)
		{
			$category->total_album = $this->photo_activity_album_m->count_by(array('category_id'=>$category->id));
			$category->total_photo = $this->photo_activity_m->count_by(array('category'=>$category->id));
			$categories[] = $category;
		}
		// Load the view
		$this->template
			->title($this->module_details['name'])
			->append_js('module::functions.js')
			->set('categories', $categories)
			->build('admin/categories');
	}
	
	/**
	 * Create a new gallery
	 *
	 * @access public
	 * @return void
	 */
	public function createalbum()
	{
		$album = new stdClass();
		$categories = $this->photo_activity_category_m->get_all();

		// Set the validation rules
		$this->form_validation->set_rules($this->album_validation_rules);

		if ($this->form_validation->run() )
		{
			$data = array(
				'category_id'		=> $this->input->post('category_id'),
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
                'description'		=>  $this->input->post('description'),
				'created_on'	    => time(),
				'created_by'		=> $this->session->userdata('user_id'),
				'enable_comments'	=> $this->input->post('enable_comments'),
				'published'			=> $this->input->post('published')
			);
			if (!empty($_FILES['thumbnail']['name']))
			{
				$realpath = realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? $_SERVER['DOCUMENT_ROOT'] : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.'))));
				$upload_cfg['upload_path'] = $realpath.'/uploads/default/photos/';
				$upload_cfg['allowed_types'] = 'gif|jpg|png|pdf';
				$upload_cfg['encrypt_name'] = TRUE;
				$this->load->library('upload');
				$this->upload->initialize($upload_cfg);
				
				$myatt = array();
				if ($this->upload->do_upload("thumbnail"))
				{
					$myatt = $this->upload->data();
					$data['thumbnail'] = $myatt['file_name'];
				}else{
				  die($this->upload->display_errors());
				}
			}
			
			if ($this->photo_activity_album_m->insert($data))
			{
				// Everything went ok..
				$this->session->set_flashdata('success', lang('photos.create_success'));
				redirect('admin/photo_activity');
			}
			
			// Something went wrong..
			else
			{
				$this->session->set_flashdata('error', lang('photos.create_error'));
				redirect('admin/photo_activity/createalbum');
			}
		}

		// Required for validation
		foreach ($this->album_validation_rules as $rule)
		{
			$album->{$rule['field']} = $this->input->post($rule['field']);
		}

		$this->template
			->append_js('module::form.js')
			->append_js('module::functions.js')
			->title($this->module_details['name'], lang('photos.new_gallery_label'))
			->set('album', $album)
			->set('categories', $categories)
			->build('admin/form_album');
	}

   	/**
	 * Create a new gallery
	 *
	 * @access public
	 * @return void
	 */
	public function editalbum($id)
	{
		$categories = $this->photo_activity_category_m->get_all();

		// Set the validation rules
		$this->form_validation->set_rules($this->album_validation_rules);

		if ($this->form_validation->run() )
		{
			$data = array(
				'category_id'		=> $this->input->post('category_id'),
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
                'description'		=>  $this->input->post('description'),
				'updated_on'	    => time(),
				'updated_by'		=> $this->session->userdata('user_id'),
				'enable_comments'	=> $this->input->post('enable_comments'),
				'published'			=> $this->input->post('published')
			);
			$realpath = realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? $_SERVER['DOCUMENT_ROOT'] : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.'))));
			$upload_cfg['upload_path'] = $realpath.'/uploads/default/photos/';
			$upload_cfg['allowed_types'] = 'gif|jpg|png';
			$upload_cfg['encrypt_name'] = TRUE;
			$this->load->library('upload');
			$this->upload->initialize($upload_cfg);
						
			$myatt = array();
			if ($this->upload->do_upload("thumbnail"))
			{
				$myatt = $this->upload->data();
				$data['thumbnail'] = $myatt['file_name'];
			}
			
			
			if ($this->photo_activity_album_m->update($id, $data))
			{
				// Everything went ok..
				$this->session->set_flashdata('success', lang('photos.create_success'));
				redirect('admin/photo_activity');
			}

			// Something went wrong..
			else
			{
				$this->session->set_flashdata('error', lang('photos.create_error'));
				redirect('admin/photo_activity/createalbum');
			}
		}

		// Required for validation
		foreach ($this->album_validation_rules as $rule)
		{
			$album->{$rule['field']} = $this->input->post($rule['field']);
		}

      $album = $this->photo_activity_album_m->get($id);

		$this->template
			->append_js('module::form.js')
			->append_js('module::functions.js')
			->title($this->module_details['name'], lang('photos.new_gallery_label'))
			->set('album', $album)
			->set('categories', $categories)
			->build('admin/form_album');
	}

	/**
	 * Create a new photo
	 *
	 * @access public
	 * @return void
	 */
	public function create($albumid=FALSE)
	{
      	$categories = $this->photo_activity_category_m->get_all();
      	$albums = $this->photo_activity_album_m->get_all();

		// Set the validation rules
		$this->form_validation->set_rules($this->photo_validation_rules);

		if ($this->form_validation->run() )
		{
			$data = array(
				'category_id'		=> $this->input->post('category_id'),
				'album_id'			=> $albumid,
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
                'caption'			=>  $this->input->post('caption'),
				'created_on'	    => time(),
				'created_by'		=> $this->session->userdata('user_id'),
				'enable_comments'	=> $this->input->post('enable_comments'),
				'published'			=> $this->input->post('published')
			);
			if (!empty($_FILES['photo']['name']))
			{
				$realpath = realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? $_SERVER['DOCUMENT_ROOT'] : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.'))));
				$upload_cfg['upload_path'] = $realpath.'/uploads/default/photos/';
				$upload_cfg['allowed_types'] = 'gif|jpg|png';
				$upload_cfg['encrypt_name'] = TRUE;
				$this->load->library('upload');
				$this->upload->initialize($upload_cfg);
				
				$myatt = array();
				if ($this->upload->do_upload("photo"))
				{
					$myatt = $this->upload->data();
					$data['photo'] = $myatt['file_name'];
				}else{
				  die($this->upload->display_errors());
				}
			}
			if ($this->photo_activity_m->insert($data))
			{
				$this->session->set_flashdata('success', lang('photos.create_success'));
				redirect('admin/photo_activity');
			}
			
			// Something went wrong..
			else
			{
				$this->session->set_flashdata('error', lang('photos.create_error'));
				redirect('admin/photo_activity/create');
			}
		}

		// Required for validation
		foreach ($this->photo_validation_rules as $rule)
		{
			$photo->{$rule['field']} = $this->input->post($rule['field']);
		}

		$this->template
			->append_js('module::form.js')
			->append_js('module::functions.js')
			->append_css('module::photo_activity.css')
			->title($this->module_details['name'], lang('photos.new_gallery_label'))
         	->set('categories', $categories)
			->set('albums', $albums)
			->set('photo', $photo)
			->build('admin/form_photo');
	}
	
		/**
	 * Edit a photo
	 *
	 * @access public
	 * @return void
	 */
	public function edit($id=FALSE)
	{
		$albumid = FALSE;
      	$categories = $this->photo_activity_category_m->get_all();
      	$albums = $this->photo_activity_album_m->get_all();
		
		if ($id)
		{
			$photo = $this->photo_activity_m->get($id);
         	$photo->category = $this->photo_activity_category_m->get($photo->category_id);
		}

		// Set the validation rules
		$this->photo_validation_rules[1] = array(
			'field' => 'slug',
			'label' => 'lang:photos.slug_label',
			'rules' => 'trim|max_length[255]|required'
		);
		$this->form_validation->set_rules($this->photo_validation_rules);

		if ($this->form_validation->run() )
		{
			$data = array(
				'category_id'		=> $this->input->post('category_id'),
				'album_id'			=> $this->input->post('album_id'),
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
                'caption'			=>  $this->input->post('caption'),
				'created_on'	    => time(),
				'created_by'		=> $this->session->userdata('user_id'),
				'enable_comments'	=> $this->input->post('enable_comments'),
				'published'			=> $this->input->post('published')
			);
			if (!empty($_FILES['foto']['name']))
			{
				$realpath = realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? $_SERVER['DOCUMENT_ROOT'] : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.'))));
				$upload_cfg['upload_path'] = $realpath.'/uploads/default/photos';
				$upload_cfg['allowed_types'] = 'gif|jpg|png';
				$upload_cfg['encrypt_name'] = TRUE;
				$this->load->library('upload');
				$this->upload->initialize($upload_cfg);
				
				$myatt = array();
				if ($this->upload->do_upload("photo"))
				{
					$myatt = $this->upload->data();
					$data['photo'] = $myatt['file_name'];
				}
			}
			if ($this->photo_activity_m->update($id, $data))
			{
				// Everything went ok..
				$this->session->set_flashdata('success', lang('photos.create_success'));
				redirect('admin/photo_activity/photos');
			}
			
			// Something went wrong..
			else
			{
				$this->session->set_flashdata('error', lang('photos.create_error'));
				redirect('admin/photo_activity/edit/'.$id);
			}
		}

		$this->template
			->append_js('module::form.js')
			->append_js('module::functions.js')
			->append_css('module::photo_activity.css')
			->title($this->module_details['name'], lang('photos.new_gallery_label'))
        	 ->set('albumid', $albumid)
			->set('categories', $categories)
			->set('albums', $albums)
			->set('photo', $photo)
			->build('admin/form_photo');
	}

		/**
	 * Create thumbnail of a photo
	 *
	 * @access public
	 * @return void
	 */
	public function thumbnailing($id=FALSE)
	{
		$albumid = FALSE;
      $categories = $this->photo_activity_category_m->get_all();
      $albums = $this->photo_activity_album_m->get_all();
		$this->file_folders_m->folder_tree();

		if ($id)
		{
			$photo = $this->photo_activity_m->get($id);
			$photo->file = $this->file_m->get($photo->file_id);
         	$photo->folder = $this->file_folders_m->get($photo->file->folder_id);
         	$photo->category = $this->photo_activity_category_m->get($photo->category_id);
		}

      // Set the validation rules
		$valrule = array(
            array(
               'field' => 'thumb_width',
               'label' => 'lang:photos.thumb_width_label',
               'rules' => 'trim|required'
            ),
            array(
               'field' => 'thumb_height',
               'label' => 'lang:photos.thumb_height_label',
               'rules' => 'trim|required'
            )
		);
		$this->form_validation->set_rules($valrule);

		if ($this->form_validation->run() )
		{
			//print_r($this->config->item('image_thumb_width'));exit;
         $file_name = str_replace($photo->file->extension, '', $photo->file->filename);
         $rootpath = realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? str_replace(DIRECTORY_SEPARATOR, '/', $_SERVER['DOCUMENT_ROOT']) : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.'))));
         $full_path 	= $rootpath.'/uploads/files/' . $file_name . $photo->file->extension;
         $crop_path = $rootpath.'/uploads/files/thumbs/' . $file_name . '_thumb' . $photo->file->extension;
         $thumb_path = $rootpath.'/uploads/files/thumbs/' . $file_name . $photo->file->extension;
         if ( $this->input->post('thumb_width') && $this->input->post('thumb_height') > '1')
         {
            // Get the required values for cropping the thumbnail
            $size_array = getimagesize($full_path);
            $width 		= $size_array[0];
            $height     = $size_array[1];
            $scaled_height             = $this->input->post('scaled_height');
            $scaled_percent            = $scaled_height/$height;
            $options['width'] 			= $this->input->post('thumb_width')/$scaled_percent;
            $options['height']			= $this->input->post('thumb_height')/$scaled_percent;
            $options['x_axis']			= $this->input->post('thumb_x')/$scaled_percent;
            $options['y_axis']			= $this->input->post('thumb_y')/$scaled_percent;
            $options['create_thumb']	= FALSE;
            $options['maintain_ratio']	= $this->input->post('ratio');

            // Crop the fullsize image first

            if ($this->resize('crop', $full_path, $crop_path, $options) !== TRUE)
            {
               return FALSE;
               $this->session->set_flashdata('error', lang('photos.create_error'));
               redirect('admin/photo_activity/thumbnailing/'.$id);
            }

            //Create a new thumbnail from the newly cropped image
            // Is the current size larger? If so, resize to a width/height of X pixels (determined by the config file)
            if ( $options['width'] > $this->config->item('image_thumb_width'))
            {
               $options['width'] = $this->config->item('image_thumb_width');
            }
            if ( $options['height'] > $this->config->item('image_thumb_height'))
            {
               $options['height'] = $this->config->item('image_thumb_height');
            }

            // Set the thumbnail option
            $options['create_thumb'] = TRUE;
            $options['maintain_ratio'] = TRUE;

            //create the thumbnail
            if ( $this->resize('resize', $crop_path, 'uploads/files/thumbs/', $options) !== TRUE )
            {
               return FALSE;
               $this->session->set_flashdata('error', lang('photos.create_error'));
               redirect('admin/photo_activity/thumbnailing/'.$id);
            }else{
               $this->session->set_flashdata('success', lang('photos.create_success'));
               redirect('admin/photo_activity/photos');
            }
         }
		}

		$this->template
			->append_js('module::form.js')
			->append_js('module::functions.js')
			->append_css('module::photo_activity.css')
			->append_js('module::functions.js')
			->append_js('module::jcrop.js')
			->append_js('module::jcrop_init.js')
			->title($this->module_details['name'], lang('photos.new_gallery_label'))
        	 ->set('albumid', $albumid)
			->set('photo', $photo)
        	 ->set('categories', $categories)
         	->set('albums', $albums)
			->build('admin/form_thumbnailing');
	}

	/**
	 * Manage an existing gallery
	 *
	 * @author Yorick Peterse - PyroCMS Dev Team
	 * @access public
	 * @param int $id The ID of the gallery to manage
	 * @return void
	 */
	public function manage($id)
	{
		// Get the gallery and all images
		$album         = $this->photo_activity_album_m->get($id);
		$album_photos  = $this->photo_activity_m->get_many_by(array('album'=>$id));

		$this->id = $id;

		$this->template
			->title($this->module_details['name'], lang('photos.manage_gallery_label'))
			->append_css('module::photo_activity.css')
			->append_js('module::functions.js')
			->append_js('module::form.js')
			->set('album', $album)
			->set('album_photos', $album_photos)
			->build('admin/photos');
	}

   public function photos()
	{
		// Get the gallery and all images
		$album         = null;
		$album_photos  = $this->photo_activity_m->get_many_by();

      //print('<pre>');print_r($album_photos);print('</pre>');

		$this->template
			->title($this->module_details['name'], lang('photos.manage_gallery_label'))
			->append_css('module::photo_activity.css')
			->append_js('module::functions.js')
			->append_js('module::form.js')
			->set('album', $album)
			->set('album_photos', $album_photos)
			->build('admin/photos');
	}

	/**
	 * Delete an existing gallery
	 *
	 * @author Yorick Peterse - PyroCMS Dev Team
	 * @access public
	 * @param int $id The ID of the gallery to delete
	 * @return void
	 */
	public function deletealbum($id = NULL)
	{
		$id_array = array();

		// Multiple IDs or just a single one?
		if ($_POST )
		{
			$id_array = $_POST['action_to'];
		}
		else
		{
			if ($id !== NULL )
			{
				$id_array[0] = $id;
			}
		}

		if ( empty($id_array) )
		{
			$this->session->set_flashdata('error', lang('photos.id_error'));
			redirect('admin/photo_activity');
		}

		// Loop through each ID
		foreach ( $id_array as $id)
		{
			// Get the gallery
			$gallery = $this->photo_activity_album_m->get($id);
			// Does the gallery exist?
			if ( !empty($gallery) )
			{
				
				// Delete the gallery along with all the images from the database
				if ($this->photo_activity_album_m->delete($id))
				{
					$this->session->set_flashdata('error', sprintf( lang('photos.folder_error'), $gallery->title));
					redirect('admin/photo_activity');
				}
				else
				{
					$this->session->set_flashdata('error', sprintf( lang('photos.delete_error'), $gallery->title));
					redirect('admin/photo_activity');
				}
			}
		}

		$this->session->set_flashdata('success', lang('photos.delete_success'));
		redirect('admin/photo_activity');
	}

	/**
	 * Upload a new image
	 *
	 * @author PyroCMS Dev Team
	 * @access public
	 * @return void
	 */
	public function upload()
	{
		// Set the validation rules
		$this->form_validation->set_rules($this->image_validation_rules);

		// Get all available galleries
		$galleries = $this->photo_activity_m->get_all();

		// Are there any galleries at all?
		if ( empty($galleries) )
		{
			$this->session->set_flashdata('error', lang('photos.no_galleries_error'));
			redirect('admin/photo_activity');
		}
		
		//lets put the gallery id into flashdata.  We be usin' this later
		$this->session->set_flashdata('gallery_id', $this->input->post('gallery_id'));
		
		if ($this->form_validation->run() )
		{
			
			if ($this->photo_activity_category_m->upload_image($_POST) === TRUE )
			{
				$this->session->set_flashdata('success', lang('gallery_images.upload_success'));
				redirect('admin/photo_activity/upload');
			}
			else
			{
				$this->session->set_flashdata('error', lang('gallery_images.upload_error'));
				redirect('admin/photo_activity/upload');
			}
		}

		foreach ($this->image_validation_rules as $rule)
		{
			$gallery_image->{$rule['field']} = $this->input->post($rule['field']);
		}

		// Set the view data
		$this->data->galleries		=& $galleries;
		$this->data->gallery_image 	=& $gallery_image;

		// Load the views
		$this->template
			->set_layout('modal', 'admin')
			->append_js('module::functions.js')
			->title($this->module_details['name'], lang('photos.upload_label'))
			->build('admin/upload', $this->data);
	}

	/**
	 * Sort images in an existing gallery
	 *
	 * @author Jerel Unruh - PyroCMS Dev Team
	 * @access public
	 */
	public function ajax_update_order()
	{
		$ids = explode(',', $this->input->post('order'));

		$i = 1;
		foreach ($ids as $id)
		{
			$this->photo_activity_category_m->update($id, array(
				'order' => $i
			));

			if ($i === 1)
			{
				$preview = $this->photo_activity_category_m->get($id);

				if ($preview)
				{
					$this->db->where('id', $preview->gallery_id);
					$this->db->update('galleries', array(
						'preview' => $preview->filename
					));
				}
			}
			++$i;
		}
	}

	/**
	 * Sort images in an existing gallery
	 *
	 * @author Phil Sturgeon - PyroCMS Dev Team
	 * @access public
	 */
	public function ajax_select_folder($folder_id)
	{
		$folder = $this->file_folders_m->get($folder_id);

		echo json_encode($folder);
	}
	
		/**
	 * Sort images in an existing gallery
	 *
	 * @author Phil Sturgeon - PyroCMS Dev Team
	 * @access public
	 */
	public function ajax_select_album($category_id)
	{
		$albums = $this->photo_activity_album_m->get_forselect_by_category($category_id);
		echo json_encode($albums);
	}

	/**
	 * Callback method that checks the slug of the gallery
	 * @access public
	 * @param string title The slug to check
	 * @return bool
	 */
	public function _check_slug($slug = '')
	{
		if ( ! $this->photo_activity_m->check_slug($slug, $this->id))
		{
			return TRUE;
		}

		$this->form_validation->set_message('_check_slug', sprintf(lang('photos.already_exist_error'), $slug));

		return FALSE;
	}

	/**
	 * Callback method that checks the file folder of the gallery
	 * @access public
	 * @param int id The id to check if file folder exists or prep to create new folder
	 * @return bool
	 */
	public function _check_folder($id = 0)
	{
		// Is not creating or folder exist.. Nothing to do.
		if ($this->method !== 'create')
		{
			return $id;
		}
		elseif ($this->file_folders_m->exists($id))
		{
			if ($this->photo_activity_m->count_by('folder_id', $id) > 0)
			{
				$this->form_validation->set_message('_check_folder', lang('photos.folder_duplicated_error'));

				return FALSE;
			}

			return $id;
		}

		$folder_name = $this->input->post('title');
		$folder_slug = url_title(strtolower($folder_name));

		// Check if folder already exist, rename if necessary.
		$i = 0;
		$counter = '';
		while ( ((int) $this->file_folders_m->count_by('slug', $folder_slug . $counter) > 0))
		{
			$counter = '-' . ++$i;
		}

		// Return data to create a new folder to this gallery.
		return array(
			'name' => $folder_name . ($i > 0 ? ' (' . $i . ')' : ''),
			'slug' => $folder_slug . $counter
		);
	}

   public function resize($mode, $source, $destination, $options = array())
	{
		// Time to resize the image
		$image_conf['image_library'] 	= 'gd2';
		$image_conf['source_image']  	= $source;

		// Save a new image somewhere else?
		if ( !empty($destination) )
		{
			$image_conf['new_image']	= $destination;
		}

		//$image_conf['thumb_marker']	= '_thumb';
		$image_conf['create_thumb']  	= TRUE;
		$image_conf['quality']			= '100';

		// Optional parameters set?
		if ( !empty($options) )
		{
			// Loop through each option and add it to the $image_conf array
			foreach ( $options as $key => $option )
			{
				$image_conf[$key] = $option;
			}
		}
      
		$this->image_lib->initialize($image_conf);

		if ( $mode == 'resize' )
		{
			return $this->image_lib->resize();
		}
		else if ( $mode == 'crop' )
		{
			return $this->image_lib->crop();
		}

		return FALSE;
	}
}
