<div class="one_full">
	<section class="title">
		<h4>Galeri Foto</h4>
	</section>
	<section class="item">
		<div class="content">
			<?php echo form_open('admin/photo_activity/deletealbum');?>
			
			<?php if ( ! empty($albums)): ?>
		
			<table border="0" class="table-list">
				<thead>
					<tr>
						<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
						<th><?php echo lang('photos.album_label'); ?></th>
					<th><?php echo lang('photos.category_label'); ?></th>
						<th><?php echo lang('photos.num_photos_label'); ?></th>
						<th><?php echo lang('photos.updated_label'); ?></th>
						<th><?php echo lang('photos.actions_label'); ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="6">
							<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach( $albums as $album ): ?>
					<tr>
						<td><?php echo form_checkbox('action_to[]', $album->id); ?></td>
						<td><?php echo $album->title; ?></td>
					<td><?php echo $album->category; ?></td>
						<td><?php echo $album->total_photo; ?></td>
						<td><?php echo format_date($album->updated_on); ?></td>
						<td>
							<?php echo
							anchor('photo_activity/' . $album->slug, lang('photos.view_label'), 'target="_blank"') . ' | ' .
							anchor('admin/photo_activity/manage/' . $album->id, lang('photos.manage_label')) . ' | ' .
					   anchor('admin/photo_activity/editalbum/' . $album->id, lang('photos.edit_label')) . ' | ' .
							anchor('admin/photo_activity/deletealbum/' . $album->id, lang('photos.delete_label'), array('class'=>'confirm')); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php $this->load->view('admin/partials/pagination') ?>
		
			<br>
		
			<div class="table_action_buttons">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
			</div>
	
			<?php else: ?>
				<div class="blank-slate">
					<img src="<?php echo base_url().'addons/modules/galleries/img/album.png' ?>" />
					
					<h2><?php echo lang('photos.no_galleries_error'); ?></h2>
				</div>
			<?php endif;?>
	
			<?php echo form_close(); ?>
		</div>
	</section>

</div>