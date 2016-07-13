<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blog module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog
 */
class Module_Himpunan_perundangan extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Set of Regulations',
				'id' => 'Himpunan Perundangan',
			),
			'description' => array(
				'en' => 'Post set of regulation entries.',
				'id' => 'Post entri himpunan perundangan',
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
					'name' => 'hp:posts_title',
					'uri' => 'admin/himpunan_perundangan',
					'shortcuts' => array(
						array(
							'name' => 'hp:create_title',
							'uri' => 'admin/himpunan_perundangan/create',
							'class' => 'add',
						),
					),
				),
				'categories' => array(
					'name' => 'cat:list_title',
					'uri' => 'admin/himpunan_perundangan/categories',
					'shortcuts' => array(
						array(
							'name' => 'cat:create_title',
							'uri' => 'admin/himpunan_perundangan/categories/create',
							'class' => 'add',
						),
					),
				),
			),
		);

		if (function_exists('group_has_role'))
		{
			if(group_has_role('himpunan_perundangan', 'admin_himpunan_perundangan_fields'))
			{
				$info['sections']['fields'] = array(
							'name' 	=> 'global:custom_fields',
							'uri' 	=> 'admin/himpunan_perundangan/fields',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'streams:add_field',
										'uri' 	=> 'admin/himpunan_perundangan/fields/create',
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
