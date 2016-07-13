<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Show RSS feeds in your site
 * 
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Widgets
 */
class Widget_Prokum_search extends Widgets
{

	/**
	 * The translations for the widget title
	 *
	 * @var array
	 */
	public $title = array(
		'en' => 'Search law products',
		'id' => 'Cari Produk hukum',
	);

	/**
	 * The translations for the widget description
	 *
	 * @var array
	 */
	public $description = array(
		'en' => 'Law products search form using widget',
		'id' => 'Form pencarian produk Hukum',
	);

	/**
	 * The author of the widget
	 *
	 * @var string
	 */
	public $author = 'Agus Sugiharto';

	/**
	 * The author's website.
	 * 
	 * @var string 
	 */
	public $website = 'http://philsturgeon.co.uk/';

	/**
	 * The version of the widget
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * The fields for customizing the options of the widget.
	 *
	 * @var array 
	 */


	/**
	 * The main function of the widget.
	 *
	 * @param array $options The options for the AddThis widget.
	 * @return array 
	 */
	public function run($options)
	{
		!empty($options['mode']) OR $options['mode'] = 'default';

		return $options;
	}

}