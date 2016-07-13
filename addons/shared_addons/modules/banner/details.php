<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blog module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog
 */
class Module_Banner extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Banners',
				'id' => 'Banner',
			),
			'description' => array(
				'en' => 'Post banners entries.',
				'id' => 'Post entri banner',
			),
			'frontend' => true,
			'backend' => true,
			'skip_xss' => true,
			'menu' => 'content',

			'roles' => array(
				'put_live', 'edit_live', 'delete_live'
			),

			'sections' => array(
				'posts' => array(
					'name' => 'banner:posts_title',
					'uri' => 'admin/banner',
					'shortcuts' => array(
						array(
							'name' => 'banner:create_title',
							'uri' => 'admin/banner/create',
							'class' => 'add',
						),
					),
				),
				'categories' => array(
					'name' => 'cat:list_title',
					'uri' => 'admin/banner/categories',
					'shortcuts' => array(
						array(
							'name' => 'cat:create_title',
							'uri' => 'admin/banner/categories/create',
							'class' => 'add',
						),
					),
				),
			),
		);

		if (function_exists('group_has_role'))
		{
			if(group_has_role('banner', 'admin_banner_fields'))
			{
				$info['sections']['fields'] = array(
							'name' 	=> 'global:custom_fields',
							'uri' 	=> 'admin/banner/fields',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'streams:add_field',
										'uri' 	=> 'admin/banner/fields/create',
										'class' => 'add'
										)
									)
							);
			}
		}

		return $info;
	}

	public function install()
	{
		return true;
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return false;
	}

	public function upgrade($old_version)
	{
		return true;
	}
}
