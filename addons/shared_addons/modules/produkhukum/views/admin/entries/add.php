<?= form_open_multipart($this->uri->uri_string()); ?>
<? //print_r($hasilQuery)?>
<? $BASEURL = BASE_URL.'admin/produkhukum'; ?>
<div class="fieldset fieldsetBlock active tabs">
  <div class="header">
    <? if($this->uri->segment(3,'create') == 'create'): ?>
		<h3>
		  <?=lang('produkhukum_create_title');?>
		</h3>
    <? endif; ?>
  </div>
	<div class="tabs">
	<fieldset id="fieldset1">
	
	<? if(isset($message)): ?>
		<h3>
		  <?=$message['notice'];?>
		</h3>
    <? endif; ?>
	
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>Kategori:</td>
        <td>
        	  <select name="FK_category_id" id="FK_category_id">
				<?php foreach($categories as $category): ?> 
				<?php $selected = ($category->category_id == $hasilQuery->FK_category_id) ? 'selected="selected"' : '' ?>
				<option value="<?=$category->category_id?>" <?=$selected?> ><?=$category->name?></option>
				<?php endforeach ?>
			</select>
        </td>
      </tr>
      <tr>
        <td>Nomor:</td>
        <td><input type="text" name="title" value="<?=!empty($entry->title) ? $entry->title : $hasilQuery->title?>" id="title" /></td>
      </tr>
      <tr>
        <td>Tahun:</td>
        <td><input type="text" name="regyear" value="<?=!empty($entry->regyear) ? $entry->regyear : $hasilQuery->regyear?>" id="regyear" /></td>
      </tr>
      <tr>
        <td>File Download:</td>
        <td><?php echo form_upload('userfile'); ?></td>
      </tr>
      <tr>
        <td>Tentang:</td>
        <td><textarea name="description" id="description" rows="8" cols="40"><?=!empty($entry->description) ? $entry->description : $hasilQuery->description?></textarea></td>
      </tr>
    </table>
    <div><? $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?></div>
	</fieldset>
    
</div>
<?=form_close()?>