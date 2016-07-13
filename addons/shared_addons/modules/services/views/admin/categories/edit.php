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
		  <?=sprintf(lang('produkhukum_edit_title'), $category->name);?>
		</h3>
    <? endif; ?>
  </div>
  <div class="tabs">
  
  </div>
  <fieldset id="fieldset1">
  	<input type="hidden" name="category_id" value="<?=(!empty($category->category_id)?$category->category_id:""); ?>">
	    <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="15%" nowrap>Nama Kategori</td>
            <td width="42%"><input type="text" name="name" id="name" value="<?=$category->name; ?>" size="60"/></td>
            <td>Urutan (Order)</td>
            <td><input type="text" name="entry_order" id="entry_order" value="<?=$category->entry_order; ?>" size="10"/></td>
          </tr>
        </table>
        
  </fieldset>
</div>
<? $this->load->view('admin/fragments/table_buttons', array('buttons' => array('save', 'cancel') )); ?>
<?= form_close(); ?>