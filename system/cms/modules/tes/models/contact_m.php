<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Contact\Models
 */
class Contact_m extends MY_Model {
	
	var $_table = "contact_log";
	
	public function count_new_log()
	{
		return $this->db
			->where('read', 0)
			->from('contact_log')
			->count_all_results();
	}
	
	public function get_log()
	{
		return $this->db
			->order_by('sent_at', 'desc')
			->get('contact_log')
			->result();
	}
	
	public function get_recent_log($limit)
	{
		return $this->db
			->where('read', 0)
			->order_by('sent_at', 'desc')
			->limit($limit)
			->get('contact_log')
			->result();
	}
	
	public function insert_log($input)
	{		
		return $this->db->insert('contact_log', array(
			'name'			=> isset($input['name']) ? $input['name'] : '',
			'email'			=> isset($input['email']) ? $input['email'] : '',
			'subject' 		=> substr($input['subject'], 0, 255),
			'message' 		=> $input['body'],
			'sender_agent' 	=> $input['sender_agent'],
			'sender_ip' 	=> $input['sender_ip'],
			'sender_os' 	=> $input['sender_os'],	
			'sent_at' 		=> time(),
			'attachments'	=> isset($input['attach']) ? implode('|', $input['attach']) : '',
		));
	}
	
	public function set_read($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('contact_log', array('read'=>1));
	}
	
	public function set_unread($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('contact_log', array('read'=>0));
	}
}