<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Photo_activity extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Photo Activity',
				'ar' => '����������������'
			),
			'description' => array(
				'en' => 'Post photo activity entries.',
				'nl' => 'Post nieuwsartikelen en blog op uw site.', #update translation
				'es' => 'Escribe entradas para los art��culos y blog (web log).', #update translation
				'fr' => 'Envoyez de nouveaux posts et messages de blog.', #update translation
				'de' => 'Ver��ffentliche neue Artikel und Blog-Eintr��ge', #update translation
				'pl' => 'Postuj nowe artyku��y oraz wpisy w blogu', #update translation
				'pt' => 'Escrever publica����es de blog',
				'zh' => '���������������������������������������', #update translation
				'it' => 'Pubblica notizie e post per il blog.', #update translation
				'ru' => '�������������������� �������������������� ���������������� �� ���������������� ����������.', #update translation
				'ar' => '�������� ������������ �������������� ����������������������.', #update translation
				'cs' => 'Publikujte nov�� ��l��nky a p����sp��vky na blog.', #update translation
				'fi' => 'Kirjoita uutisartikkeleita tai blogi artikkeleita.' #update translation
			),
			'frontend' => true,
			'backend' => true,
			'skip_xss' => true,
			'menu' => 'content',
			'roles' => array(
				'put_live', 'edit_live', 'delete_live'
			),

			'sections' => array(
				'album' => array(
					'name' => 'photos.list_album_label',
					'uri' => 'admin/photo_activity',
					'shortcuts' => array(
						array(
							'name' => 'photos.new_album_label',
							'uri' => 'admin/photo_activity/createalbum',
							'class' => 'add',
						),
					),
				),
				'photos' => array(
					'name' => 'photos.list_label',
					'uri' => 'admin/photo_activity/photos',
					'shortcuts' => array(
						array(
							'name' => 'photos.new_photo_label',
							'uri' => 'admin/photo_activity/photos/create',
							'class' => 'add',
						),
					),
				),
				'categories' => array(
					'name' => 'photos.list_categories_label',
					'uri' => 'admin/photo_activity/categories',
					'shortcuts' => array(
						array(
							'name' => 'cat:create_title',
							'uri' => 'admin/photo_activity/categories/create',
							'class' => 'add',
						),
					),
				),
			)
		);
	}

	public function install()
	{
		return TRUE;
	}

	public function uninstall()
	{		
		return TRUE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		return TRUE;
	}
}

/* End of file details.php */
