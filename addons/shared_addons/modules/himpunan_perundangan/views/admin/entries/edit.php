<?= form_open_multipart($this->uri->uri_string()); ?>
<? $BASEURL = BASE_URL.'admin/produkhukum'; ?>
<div class="fieldset fieldsetBlock active tabs">
  <div class="header">
    <? if($this->uri->segment(3,'create') == 'create'): ?>
		<h3>
		  <?=lang('produkhukum_create_title');?>
		</h3>
    <? else: ?>
		<h3>
          <?
		  $thiscategory = $this->listings->get_category($entry->FK_category_id);
		  ?>
		  <?=sprintf(lang('produkhukum_edit_title'), $thiscategory->name. ' Nomor '.$entry->title.' Tahun '.$entry->regyear);?>
		</h3>
    <? endif; ?>
  </div>
	<div class="tabs">
	<fieldset id="fieldset1">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>Kategori:</td>
        <td>
        	  <select name="FK_category_id" id="FK_category_id">
				<?php foreach($categories as $category): ?>
				<?php $selected = ($category->category_id == $entry->FK_category_id) ? 'selected="selected"' : '' ?>
				<option value="<?=$category->category_id?>" <?=$selected?> ><?=$category->name?></option>
				<?php endforeach ?>
			</select>
            <input type="hidden" name="old_cat" value="<?=$entry->FK_category_id?>" />
        </td>
      </tr>
       <tr>
        <td>Jenis Perundangan:</td>
        <td>
        	  <select name="sub_category_id" id="sub_category_id">
				<?php foreach($Subcategories as $Subcategory): ?>
				<?php $selected = ($Subcategory->category_id == $entry->sub_category_id) ? 'selected="selected"' : '' ?>
				<option value="<?=$Subcategory->category_id?>" <?=$selected?> ><?=$Subcategory->name?></option>
				<?php endforeach ?>
			</select>
            <input type="hidden" name="old_Subcat" value="<?=$entry->sub_category_id?>" />
        </td>
      </tr>
      <tr>
        <td>Nomor:<?=$entry->title?></td>
        <td><input type="text" name="title" value="<?=($entry->title) ? $entry->title : ''?>" id="title" /></td>
      </tr>
      <tr>
        <td>Tahun:</td>
        <td><input type="text" name="regyear" value="<?=($entry->regyear) ? $entry->regyear : ''?>" id="regyear" /></td>
      </tr>
      <tr>
        <td>File Download:</td>
        <td><?php echo form_upload('userfile'); ?><span style="margin-left: 195px"><?=($entry->url) ? $entry->url : ''?></span></td>
      </tr>
      <tr>
        <td>Tentang:</td>
        <td><textarea name="description" id="description" rows="8" cols="40"><?=($entry->e_description) ? $entry->e_description : ''?></textarea></td>
      </tr>
    </table>
    <div><? $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?></div>
	</fieldset>
    
</div>
<?=form_close()?>