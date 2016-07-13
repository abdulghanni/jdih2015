<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Blog module controller
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\questions\Controllers
 */
class Search extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function result()
	{
	  $keyword = $this->input->post('keyword');
	  $arrResult = array();
	  
	  // Berita
	  $sql = "SELECT id,title,slug,body,created_on FROM default_blog WHERE title LIKE '%".$keyword."%' OR body LIKE '%".$keyword."%'";
	  $tempRes = $this->db->query($sql)->result();
	  foreach($tempRes as $row)
	  {
		$stdTemp = new stdClass();
		$stdTemp->section = 'Berita';
		$stdTemp->title = $row->title;
		$stdTemp->body = $this->stripHTMLtags($row->body);
		$stdTemp->url = site_url('blog/'.date('Y', $row->created_on).'/'.date('m', $row->created_on).'/'.$row->slug);
		$arrResult[] = $stdTemp;
	  }
	  
	  // Pages
	  $sql = "SELECT default_pages.title as title, default_pages.uri as uri, default_def_page_fields.body as body FROM default_pages INNER JOIN
	  default_def_page_fields ON default_def_page_fields.id=default_pages.id
	  WHERE default_pages.title LIKE '%".$keyword."%' OR default_def_page_fields.body LIKE '%".$keyword."%'";
	  $tempRes = $this->db->query($sql)->result();
	  foreach($tempRes as $row)
	  {
		$stdTemp = new stdClass();
		$stdTemp->section = 'Halaman';
		$stdTemp->title = $row->title;
		$stdTemp->body = $this->stripHTMLtags($row->body);
		$stdTemp->url = site_url($row->uri);
		$arrResult[] = $stdTemp;
	  }
	  
	  // Himpunan Perundangan
	  $sql = "SELECT e.*, c.name AS namacat, c.description AS ketcat  FROM default_ph_entries AS e LEFT JOIN default_ph_categories AS c ON e.FK_category_id=c.category_id  WHERE e.description LIKE '%".$keyword."%' OR c.name LIKE '%".$keyword."%' OR c.description LIKE '%".$keyword."%'";
	  $tempRes = $this->db->query($sql)->result();
	  foreach($tempRes as $row)
	  {
		$stdTemp = new stdClass();
		$stdTemp->section = 'Himpunan Perundangan';
		$stdTemp->title = $row->namacat . ' No. ' . $row->title . ' ' . $row->regyear;
		$stdTemp->body = 'Tentang ' . $row->description;
		$stdTemp->url = site_url('himpunan_perundangan/details/'.$row->entry_id);
		$arrResult[] = $stdTemp;
	  }
	  
	  if (count($arrResult)>0)
	  {
		foreach($arrResult as $result)
		{
		  echo '<div class="label label-primary">'.$result->section.'</div>';
		  echo '<h3><a href="'.$result->url.'">'.$result->title.'</a></h3>';
		  echo '<p>'.word_limiter($result->body, 20).'</p>';
		}
	  }else{
		echo 'There are no results found!';
	  }
	  
	}
	
	private function stripHTMLtags($str)
	{
		$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
		$t = htmlentities($t, ENT_QUOTES, "UTF-8");
		return $t;
	}
}