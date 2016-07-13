<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The admin controller for the Contact module.
 *
 * @author PyroCMS Dev Team
 * @package	 PyroCMS\Core\Modules\Contact\Controllers
 */
class Admin extends Admin_Controller
{
/**
	 * Shows the contact messages list.
	 */
	public function index()
	{
		$this->load->language('contact');
		$this->load->model('contact_m');
		$contact_log = $this->contact_m->get_log();
				
		$this->template
			->set('icon', 'iconfa-envelope')
			->set('title', 'Pesan dari Kontak')
			->set('contact_log', $contact_log)
			->build('admin/index');
	}
	
	public function view($id=0)
	{
		$this->load->language('contact');
		$this->load->model('contact_m');
		$this->contact_m->set_read($id);
		$contact_log = $this->contact_m->get($id);
		
		$rules = array(
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			),
			array(
				'field' => 'subject',
				'label' => 'Subyek',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'body',
				'label' => 'Isi Pesan',
				'rules' => 'trim|required'
			)
		);
		
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run())
		{
			$this->load->library('email');
			$this->email->from('adminpmd@kemendagri.go.id', 'Admin PMD Kemendagri');
			$this->email->to($this->input->post('email'));			
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('body'));
			
			if ($this->email->send())
			{
			  $extra = array(
				'contact_id' => $id,
				'subject' => $this->input->post('subject'),
				'body' => $this->input->post('body'),
				'status' => 'Terkirim',
				'sent_date' => time()
			  );
			  $status = 'Terkirim';
			}else{
			  $extra = array(
				'contact_id' => $id,
				'subject' => $this->input->post('subject'),
				'body' => $this->input->post('body'),
				'status' => 'Belum Terkirim',
				'sent_date' => time()
			  );
			  $status = 'Belum Terkirim';
			}
			$this->db->insert('default_contact_replies', $extra);
			$this->session->set_flashdata('success', 'Email balasan '.$status);
			redirect('admin/contact');
		}
		
		$post = new stdClass();
		
		foreach ($rules as $rule)
		{
			$post->{$rule['field']} = set_value($rule['field']);
		}
		
		$this->template
			->set('title', 'Pesan dari Kontak')
			->set('icon', 'iconfa-envelope')
			->set('contact_log', $contact_log)
			->set('post', $post)
			->build('admin/view');
	}
	
	public function delete($id)
	{
		$this->load->model('contact_m');
		$this->contact_m->delete($id);
		redirect('admin/contact');
	}

}