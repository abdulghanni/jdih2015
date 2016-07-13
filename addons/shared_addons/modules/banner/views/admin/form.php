<section class="title">
   
</section>
<section class="item">
   <div class="content">
	  <?= form_open_multipart($this->uri->uri_string()); ?>
	 
	 <table cellspacing="0">
		<tr>
			<td>
				<?php echo lang('cat_title_label'); ?>
			</td>
			<td>
				: <? echo form_input('title', !empty($banner->title)?$banner->title:"", 'class="text"'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo lang('cat_category_label'); ?>
			</td>
			<td>
				: <? echo form_dropdown('txtCat',$categories,!empty($banner->category_id)?$banner->category_id:"");?>
			</td>
		</tr>
		<tr>
			<td>
				Match Page Url / Module
			</td>
			<td>
				: <? echo form_input('txtPage', !empty($banner->page)?$banner->page:"", 'class="text" size="50"'); ?>
			</td>
		</tr>
		<tr>
			<td>
				File ID
			</td>
			<td>
			: <input type="text" id="txtLinkFile" name="txtLinkFile" style="width:150px" value="<?php echo $banner->link_file; ?>" />			</td>
		</tr>
		<tr>
			<td>
				<?php echo lang('cat_linkurl_label'); ?>
			</td>
			<td>
				: <? echo form_input('txtUrl', !empty($banner->link_url)?$banner->link_url:"", 'class="text" size="50"'); ?>
			</td>
		</tr>
		<tr>
			<td>
				Link Area
			</td>
			<td>
				: <? echo form_textarea('txtLink', !empty($banner->link_text)?$banner->link_text:"", 'class="text" size="50" style="height:100px"'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo lang('cat_order_label'); ?>
			</td>
			<td>
				: <? echo form_input('txtUrut', !empty($banner->urutan)?$banner->urutan:"", 'class="text" size="5"'); ?>
			</td>
		</tr>
		<tr>
			<td>
				Publikasi
			</td>
			<td>
				: <? echo form_dropdown('txtSimpan',array('0'=>'Tidak','1'=>'Ya') ,!empty($banner->simpan)?$banner->simpan:""); ?>
			</td>
		</tr>
	  </table>
	  <?=form_hidden('user', $this->session->userdata('user_id'));?>
	  <? $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	  <?= form_close(); ?>
   </div>
</section>
<?

?>