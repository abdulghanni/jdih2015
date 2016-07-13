
	<table border="0" class="listTable">
		<thead>
		<tr>
			<th class="first"><div></div></th>
			<th>TITLE
			</th> 
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
		<? if ($banner_categories): ?>    
			<? foreach ($banner_categories as $category): ?>
			<tr>
				<td><input type="checkbox" name="delete[]" value="<?= $category->id;?>" /></td>
				<td><?=$category->title;?></td> 
				<td>
					<?=anchor('admin/banner/categories/edit/' . $category->id, 'EDIT') ; ?> 
				</td>
			</tr>
			<? endforeach; ?>                      
		<? else: ?>
			<tr>
				<td colspan="4"><?=lang('cat_no_categories');?></td>
			</tr>
		<? endif; ?>    
		</tbody>
	</table>
	 