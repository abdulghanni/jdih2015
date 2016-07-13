<div class="one_full">
	<section class="title">
		<h4>Kontak</h4>
	</section>

	<section class="item">
		<div class="content">
			<?php if ($contact_log) : ?>
				<?php echo form_open('admin/contact/action') ?>
					<div id="filter-stage">
							<table id="dataTables" cellspacing="0">
							  <thead>
								  <tr>
									  <th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
									  <th>Tanggal</th>
									  <th class="collapse">Email</th>
									  <th>Subyek</th>
									  <th>IP Pengirim</th>
									  <th width="60"><?php echo lang('global:actions') ?></th>
								  </tr>
							  </thead>
							  <tbody>
								  <?php foreach ($contact_log as $post) : ?>
									  <tr>
										  <td><?php echo form_checkbox('action_to[]', $post->id) ?></td>
										  <td><?php echo format_date($post->sent_at) ?></td>
										  <td><?php echo $post->email ?></td>
										  <td><?php echo $post->subject ?></td>
										  <td><?php echo $post->sender_ip ?></td>
										  <td>
											<a href="<?php echo site_url('admin/contact/view/'.$post->id); ?>">Lihat</a>&nbsp;
											<a href="<?php echo site_url('admin/contact/delete/'.$post->id); ?>">Hapus</a>
										  </td>
									  </tr>
								  <?php endforeach ?>
							  </tbody>
						  </table>
					  
						  <?php $this->load->view('admin/partials/pagination') ?>

					</div>
				<?php echo form_close() ?>
			<?php else : ?>
				<div class="no_data">Untuk sementara belum ada data kontak</div>
			<?php endif; ?>
		</div>
	</section>
</div>

<script type="text/javascript">
jQuery(function($) {
	$(document).ready(function(){
        // dynamic table
		$('#dataTables').uniform();
        $('#dataTables').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                $.uniform.update();
            }
        });
		/* .columnFilter({
                sPlaceHolder: "head:before",
                aoColumns: [
                    { sSelector: "#kodePilih" },
                    { sSelector: "#kodeDiklat" },
					{ sSelector: "#namaDiklat" },
					{ sSelector: "#namaBalaiFilter", type: "select" }
                ]});
		*/
    });
});
</script>