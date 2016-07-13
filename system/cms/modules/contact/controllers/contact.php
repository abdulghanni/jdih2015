<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Comments controller (frontend)
 *
 * @package		PyroCMS\Core\Modules\Comments\Controllers
 * @author		PyroCMS Dev Team
 * @copyright   Copyright (c) 2012, PyroCMS LLC
 */
class Contact extends Public_Controller
{
	/**
	 * An array containing the validation rules
	 * 
	 * @var array
	 */
	private $validation_rules = array(
		array(
			'field' => 'name',
			'label' => 'Nama Pengirim',
			'rules' => 'trim'
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email'
		),
		array(
			'field' => 'subject',
			'label' => 'Subyek',
			'rules' => 'trim|required|max_length[255]'
		),
		array(
			'field' => 'message',
			'label' => 'Pesan',
			'rules' => 'trim|required'
		),
	);

	/**
	 * Constructor method
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// Load the required classes
		$this->load->library('form_validation');
		$this->load->model('contact_m');
	}

	/**
	 * Create a new comment
	 *
	 * @param type $module The module that has a comment-able model.
	 * @param int $id The id for the respective comment-able model of a module.
	 */
	public function index()
	{
		// Set the validation rules
		$this->form_validation->set_rules($this->validation_rules);

		// Validate the results
		if ($this->form_validation->run())
		{
			$template = 'kontak';
			$to = Settings::get('contact_email');
			$lang = Settings::get('site_lang');
			$from = Settings::get('server_email');
			$template = 'contact';
			$autoreply_template = false;
			// maybe it's a bot?
			if ($this->input->post('d0ntf1llth1s1n') !== ' ')
			{
				$this->session->set_flashdata('error', lang('contact_submit_error'));
				redirect(current_url());
			}

			$data = $this->input->post();

			// Add in some extra details about the visitor
			$data['sender_agent'] = $this->agent->browser() . ' ' . $this->agent->version();
			$data['sender_ip']    = $this->input->ip_address();
			$data['sender_os']    = $this->agent->platform();
			$data['slug']         = $template;
			// they may have an email field in the form. If they do we'll use that for reply-to.
			$data['reply-to'] = (empty($reply_to) and isset($data['email'])) ? $data['email'] : $reply_to;
			$data['to']       = $to;
			$data['from']     = $from;

			// Try to send the email
			$results = Events::trigger('email', $data, 'array');

			// If autoreply has been enabled then send the end user an autoreply response
			if ($autoreply_template)
			{
				$data_autoreply            = $data;
				$data_autoreply['to']      = $data['email'];
				$data_autoreply['from']    = $data['from'];
				$data_autoreply['slug']    = $autoreply_template;
				$data_autoreply['name']    = $data['name'];
				$data_autoreply['sender']  = $data['name'];
				$data_autoreply['subject'] = $data['subject'];
			}
			
			// fetch the template so we can parse it to insert into the database log
			$this->load->model('templates/email_templates_m');
			$templates = $this->email_templates_m->get_templates($template);
			
			$subject = array_key_exists($lang, $templates) ? $templates[$lang]->subject : $templates['id']->subject ;
			$data['subject'] = $this->parser->parse_string($subject, $data, true);

			$body = array_key_exists($lang, $templates) ? $templates[$lang]->body : $templates['id']->body ;
			$data['body'] = $this->parser->parse_string($body, $data, true);

			// Grab userdata - we'll need this later
			$userdata = $this->session->all_userdata();
			
			// Finally, we insert the same thing into the log as what we sent
			// print_r($data);exit;
			
			$this->contact_m->insert_log($data);
		
			foreach ($results as $result)
			{
				if ( ! $result)
				{
					if (isset($userdata['flash:new:error']))
					{
						$message = (array) $userdata['flash:new:error'];

						$message[] = 'Terjadi kesalahan pada program email';
					}
					else
					{
						$message = 'Terjadi kesalahan pada program email';
					}
					
					$this->session->set_flashdata('error', $message);
					redirect(current_url());
				}
			}

			if($autoreply_template) {
				Events::trigger('email', $data_autoreply, 'array');
			}


			if (isset($userdata['flash:new:success']))
			{
				$message = (array) $userdata['flash:new:success'];

				$message[] = 'Terima kasih, telah mengirimkan pesan kepada kami';
			}
			else
			{
				$message = 'Terima kasih, telah mengirimkan pesan kepada kami';
			}

			$this->session->set_flashdata('success', $message);
			Events::trigger('contact_form_success', $_POST);
			redirect(current_url());
		}
		
		$post = new stdClass();
		
		foreach ($this->validation_rules as $rule)
		{
			$post->{$rule['field']} = set_value($rule['field']);
		}
		
		if ($this->current_user)
		{
		  $post->name = $this->current_user->display_name;
		  $post->email = $this->current_user->email;
		}
		
		$this->template
			->set('title', 'Kontak')
			->set('subtitle', '')
			->set_breadcrumb('Kontak')
			->set('post', $post)
			->build('index');
	}

}
