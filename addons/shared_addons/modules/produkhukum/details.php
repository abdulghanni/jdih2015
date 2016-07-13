<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blog module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog
 */
class Module_Produkhukum extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Law Products',
				'id' => 'Produk Hukum',
			),
			'description' => array(
				'en' => 'Post law product entries.',
				'id' => 'Post entri produk hukum',
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
					'name' => 'produkhukum_all_documents_label',
					'uri' => 'admin/produkhukum',
					'shortcuts' => array(
						array(
							'name' => 'produkhukum_create_title',
							'uri' => 'admin/produkhukum/create',
							'class' => 'add',
						),
					),
				),
				'categories' => array(
					'name' => 'produkhukum_category_label',
					'uri' => 'admin/produkhukum/categories',
					'shortcuts' => array(
						array(
							'name' => 'cat:create_title',
							'uri' => 'admin/produkhukum/categories/create',
							'class' => 'add',
						),
					),
				),
			),
		);

		if (function_exists('group_has_role'))
		{
			if(group_has_role('produkhukum', 'admin_produkhukum_fields'))
			{
				$info['sections']['fields'] = array(
							'name' 	=> 'global:custom_fields',
							'uri' 	=> 'admin/produkhukum/fields',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'streams:add_field',
										'uri' 	=> 'admin/produkhukum/fields/create',
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
