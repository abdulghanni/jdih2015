<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show Latest blog in your site with a widget.
 *
 * Intended for use on cms pages. Usage :
 * on a CMS page add:
 *
 *     {widget_area('name_of_area')}
 *
 * 'name_of_area' is the name of the widget area you created in the  admin
 * control panel
 *
 * @author  Erik Berman
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Widgets
 */
class Widget_Blog_slider extends Widgets
{

	public $author = 'Erik Berman';

	public $website = 'http://www.nukleo.fr';

	public $version = '1.0.0';

	public $title = array(
		'en' => 'Blog Slider',
		'id' => 'Post Slider Terbaru',
	);

	public $description = array(
		'en' => 'Display latest blog posts with a widget slider',
		'id' => 'Menampilkan posting blog terbaru menggunakan widget slider',
	);

	// build form fields for the backend
	// MUST match the field name declared in the form.php file
	public $fields = array(
		array(
			'field' => 'limit',
			'label' => 'Number of posts',
		)
	);

	public function form($options)
	{
		$options['limit'] = ( ! empty($options['limit'])) ? $options['limit'] : 5;

		return array(
			'options' => $options
		);
	}

	public function run($options)
	{
		// load the blog module's model
		class_exists('Blog_m') OR $this->load->model('blog/blog_m');

		// sets default number of posts to be shown
		$options['limit'] = ( ! empty($options['limit'])) ? $options['limit'] : 5;

		// retrieve the records using the blog module's model
		$blog_widget = $this->blog_m
			->limit($options['limit'])
			->get_many_by(array('status' => 'live'));

		// returns the variables to be used within the widget's view
		return array('blog_widget' => $blog_widget);
	}

}
