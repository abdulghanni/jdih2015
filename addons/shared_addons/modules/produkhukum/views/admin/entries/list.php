<div class="one_full">
	<section class="title">
		<h4>Produk Hukum</h4>
	</section>
	<section class="item">
		<div class="content">
			<? $this->load->view('admin/partials/shortcuts')?>
			<div style="margin: 10px 7px 10px 7px">
			<table cellpadding="5" cellspacing="0" style="border: 0px; ">
				<tr>
					<td style="padding: 3px 7px 3px 7px; text-align: left; width: 50%">
						<strong><?= anchor('admin/produkhukum/categories', 'Kategori');?> | 
						<?= anchor('admin/produkhukum/statistics', 'Statistik');?></strong>
					</td>
					<td style="padding: 3px 7px 3px 7px; text-align: right; width: 50%">
						<?= form_open('admin/produkhukum/index/bycategory');?>
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
			<?= form_open('admin/produkhukum/action');?>
				<table border="0" class="listTable" style="padding:2px">    
					<thead>
						<tr>
							<th class="first"><div></div></th>
							<th><a href="#"><?=lang('produkhukum_date_label');?></a></th>
							<th><a href="#"><?=lang('produkhukum_title_label');?></a></th>
							<th><a href="#">Jenis Perundangan</a></th>
							<th><a href="#"><?=lang('produkhukum_about_label');?></a></th>
							<th class="width-5"><a href="#"><?=lang('produkhukum_status_label');?></a></th>
							<th class="last width-10"><span><?=lang('produkhukum_actions_label');?></span></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="7">
								<div class="inner"><? $this->load->view('admin/partials/pagination'); ?></div>
							</td>
						</tr>
					</tfoot>
					<tbody>
					<?php foreach($entries as $entry): ?>
					<tr>
						<td style="text-align:center"><input type="checkbox" name="action_to[]" value="<?=$entry->entry_id;?>" /></td>
						<td valign="top"><?=$entry->date_added?></td>
						<td valign="top"><?=$entry->c_description?> <br>No. <?=$entry->title?> <br>Tahun <?=$entry->regyear?></td>
						<td><?=$entry->c_description?></td>
						<td><?=$entry->e_description?></td>
						<td style="text-align:center" valign="top"><?=$entry->active?></td>
						<td style="text-align:center" valign="top">
							<? if( $entry->active == 1 ): ?>
								<?= anchor('produkhukum/listings/details/' .$entry->entry_id, lang('produkhukum_view_label'), 'target="_blank"') . ' | '; ?>
							<? endif; ?>
							<?= anchor('admin/produkhukum/edit/' . $entry->entry_id, lang('produkhukum_edit_label'));?> | 
							<?= anchor('admin/produkhukum/delete_record/' . $entry->entry_id, lang('produkhukum_delete_label'), array('class'=>'confirm')); ?>
						
						</td>
					</tr>
					<?php endforeach ?>
					</tbody>
				</table>
				<? $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish') )); ?>
			<?=form_close();?>
		</div>
	</section>
</div>
