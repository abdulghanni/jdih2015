<?= form_open('admin/banner/delete'); ?>
<?=$total_rows?> Data Found
	<table border="0" class="listTable">
		<thead>
		<tr>
			<th class="first"><div></div></th>
			<th><?php echo lang('cat_title_label'); ?></th>
			<th>Kategori</th> 
			<th>Link Url</th>
			<th class="last width-10"><span><?=lang('cat_actions_label');?></span></th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<div class="inner"><? $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<? 
		 
		if ($banners): ?>    
			<? foreach ($banners as $banner):
			?>
			<tr>
				<td><input type="checkbox" name="delete[]" value="<?= $banner->id;?>" /></td>
				<td><?=$banner->title;?></td>
				<td><?=$banner->category;?></td>
				<td><?=$banner->link_url;?></td>
				<td>
					<?=anchor('admin/banner/edit/' . $banner->id, lang('cat_edit_label'))  ; ?> 
					<?//=anchor('admin/banner/delete/' . $banner->id, lang('cat_delete_label'), array('class'=>'confirm'));?>
				</td>
			</tr>
			<? endforeach; ?>                      
		<? else: ?>
			<tr>
				<td colspan="5"><?=lang('cat_no_categories');?></td>
			</tr>
		<? endif; ?>    
		</tbody>
	</table>
	<? $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
<?=form_close(); ?>