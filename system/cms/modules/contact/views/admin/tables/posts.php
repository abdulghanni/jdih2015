	<table cellspacing="0">
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
				<th><?php echo lang('banners:post_label') ?></th>
				<th class="collapse"><?php echo lang('banners:filename') ?></th>
				<th><?php echo lang('banners:status_label') ?></th>
				<th><?php echo lang('banners:order_label') ?></th>
				<th>Hits</th>
				<th width="180"><?php echo lang('global:actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($contact_log as $post) : ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $post->id) ?></td>
					<td><?php echo format_date($post->sent_at) ?></td>
					<td><?php echo $post->email ?></td>
					<td><?php echo $post->subject ?></td>
					<td><?php echo $post->message ?></td>
					<td><?php echo $post->sender_ip ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?php $this->load->view('admin/partials/pagination') ?>

	<br>

	<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish'))) ?>
	</div>