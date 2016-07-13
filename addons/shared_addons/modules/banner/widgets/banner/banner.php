<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		RSS Feed Widget
 * @author			Phil Sturgeon - PyroCMS Development Team
 * 
 * Show RSS feeds in your site
 */

class Widget_Banner extends Widgets
{
	public $title = 'Banner';
	public $description = 'Show banner on page';
	public $author = 'Agus Sugiharto';
	public $website = 'http://www.siagoes.com/';
	public $version = '1.0';
	public $fields = array(
		 
		array(
			'field'   => 'txtCat',
			'label'   => 'Category',
			'rules'   => 'required'
		),
		array(
			'field'   => 'txtLimit',
			'label'   => 'Limit',
			'rules'   => 'required'
		),
		array(
			'field'   => 'class',
			'label'   => 'Class'
		)
	);
	
	public function __construct()
	{
		// Load models
		$this->load->model('navigation/navigation_m');
		$this->load->model('modules/module_m');
		$this->load->model('banner/banner_categories_m');
		$this->load->model('banner/banner_m');
		$this->load->model('files/file_m');
	}
	
	public function form()
	{
		$dataCat = $this->banner_categories_m->getCategories();
		$cat = array();
		foreach($dataCat as $data)
		{
			$cat[$data->id] = $data->title;
		}
		
		 $style=array('vertical'=>'Vertical','horizontal' => 'Horizontal');
		 $rotator=array('yes'=>'Yes','no' => 'No');
		
		 return array(
			'category' => $cat,
			'style' => $style,
			'rotator' => $rotator
		);
	}
	
	public function run($options)
	{
		
		$params=array('simpan'=>1, 'limit' => $options['txtLimit'],'category_id'=>$options['txtCat']);
		$banners = $this->banner_m->getBanners($params);
		$results = array();
		
		if ($banners) {
			foreach ($banners as $banner)
			{
				if (!empty($banner->link_file))
				{
					$banner->file = $this->file_m->get($banner->link_file);
				}else{
					$banner->file->filename = '';
				}
				$results[] = $banner;
			}
		}
		//print('<pre>');print_r($results);print('</pre>');
		return array(
			'category' =>  $options['txtCat'],
			'banners' =>  $results
		);
	}
	
	function load_nav_group($group)
	{
		if ( ! $group = $this->navigation_m->get_group_by('abbrev', $group))
		{
			return FALSE;
		}

		$group_links = $this->navigation_m->get_link($group->id);
			
		// Assign it 
	    return $group_links;
	}
	
}