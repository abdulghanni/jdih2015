<div class="one_full">
	<section class="title">
		<h4>Foto</h4>
	</section>
	<section class="item">
		<div class="content">
			<?php echo form_open('admin/photo_activity/delete');?>
			<?php if ( ! empty($album)): ?>
			   <h3 style="margin-bottom:0px">Album: <?php echo $album->title; ?></h3>
			   <p style="margin-bottom:0px"><?php echo $album->description; ?></p>
			   <p><?php echo anchor('admin/photo_activity/create/'.$album->id, lang('photos.new_photo_label'), 'class="add"') ?></p>
			<?php endif;?>
			<?php if ( ! empty($album_photos)): ?>
		
			<table border="0" class="table-list">
				<thead>
					<tr>
						<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
					<th><?php echo lang('photos.photo_label'); ?></th>
					<th><?php echo lang('photos.thumbnail_label'); ?></th>
						<th><?php echo lang('photos.title_label'); ?></th>
					<th><?php echo lang('photos.category_label'); ?></th>
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
					<?php foreach( $album_photos as $photo ): ?>
					<tr>
						<td><?php echo form_checkbox('action_to[]', $photo->id); ?></td>
					<td><img class="pyro-image" src="<?php echo base_url(); ?>uploads/default/photos/<?php echo $photo->photo; ?>" alt="<?php echo $photo->photo; ?>" width="50" /></td>
					<td><img class="pyro-image" src="<?php echo base_url(); ?>uploads/default/photos/<?php echo $photo->photo; ?>" alt="<?php echo $photo->photo; ?>" width="50" /></td>
						<td><?php echo $photo->title; ?></td>
					<td><?php echo $photo->category->title; ?></td>
						<td><?php echo format_date($photo->updated_on); ?></td>
						<td>
							<?php echo
					   anchor('admin/photo_activity/thumbnailing/' . $photo->id, lang('photos.thumbnailing_label')) . ' | ' .
							anchor('admin/photo_activity/edit/' . $photo->id, lang('photos.edit_label')) . ' | ' .
							anchor('admin/photo_activity/delete/' . $photo->id, lang('photos.delete_label'), array('class'=>'confirm')); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		
			<div class="table_action_buttons">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
			</div>
		
		<?php else: ?>
			<div class="blank-slate">
				<img src="<?php echo base_url().'addons/modules/galleries/img/album.png' ?>" />
		
				<h2><?php echo lang('photos.no_photos_error'); ?></h2>
			</div>
		<?php endif;?>
		
		<?php echo form_close(); ?>
		</div>
	</section>
</div>