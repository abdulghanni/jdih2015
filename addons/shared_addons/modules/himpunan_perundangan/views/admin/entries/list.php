<? $this->load->view('admin/partials/shortcuts')
?><div style="margin: 10px 7px 10px 7px">
<table cellpadding="5" cellspacing="0" style="border: 0px; ">
    <tr>
        <td style="padding: 3px 7px 3px 7px; text-align: left;">
            <?= form_open('admin/himpunan_perundangan/index/bycategory');?>
            <strong>Per Kategori</strong>
            <select id="catid" name="catid" style="width: 200px">
            <option value="All">Semua Kategori</option>
            <?php  
            foreach ($categories as $category)
            {
                if ($category->category_id==$this->uri->segment(4)) $sel = ' selected'; else $sel = '';
                echo '<option value="'.$category->category_id.'"'.$sel.'>'.$category->name.'</option>';
            }
            ?>
            </select>
            <input type="submit" name="catGo" value="Tampilkan"/>
            <?=form_close();?>
        </td>
    </tr>
</table>
</div>  
<?= form_open('admin/himpunan_perundangan/action');?>
	<table border="0" class="listTable" style="padding:2px">    
		<thead>
			<tr>
				<th class="first"><div></div></th>
				<th><a href="#"><?=lang('hp:date_label');?></a></th>
				<th><a href="#"><?=lang('hp:title_label');?></a></th>
				<th><a href="#">Jenis Perundangan</a></th>
				<th><a href="#"><?=lang('hp:about_label');?></a></th>
				<th class="last width-10"><span><?=lang('hp:actions_label');?></span></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach($entries as $entry): ?>
		<tr>
        	<td style="text-align:center"><input type="checkbox" name="action_to[]" value="<?=$entry->entry_id;?>" /></td>
        	<td nowrap="nowrap" valign="top"><?=$entry->date_added?></td>
			<td nowrap="nowrap" valign="top"><?=$entry->c_description?> <br>No. <?=$entry->title?> <br>Tahun <?=$entry->regyear?></td>
            <td><?=$entry->namasub?></td>
	    <td><?=$entry->e_description?></td>
			<td style="text-align:center" valign="top">
				<? if( $entry->active == 1 ): ?>
					<?= anchor('himpunan_perundangan/listings/details/' .$entry->entry_id, lang('hp:view_label'), 'target="_blank"') . ' | '; ?>
                <? endif; ?>
                <?= anchor('admin/himpunan_perundangan/edit/' . $entry->entry_id, lang('hp:edit_label'));?> | 
                <?= anchor('admin/himpunan_perundangan/delete/' . $entry->entry_id, lang('hp:delete_label'), array('class'=>'confirm')); ?>
            
            </td>
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<? $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish') )); ?>
<?=form_close();?>
