 
<?= form_open($this->uri->uri_string()); ?>
	<table style="width:250px;border:1px solid #d2d2d2">
		<tr>
			<td>
		<label for="title">Title</label>
			</td>
			<td> 
		 : <?=$formnya=form_input('title', !empty($category->title)?$category->title:"", 'class="text"');?>
			</td>
		</tr>
	</table>
		
		
		
		 
	<?=form_hidden('user', $user->id);?>
	<? $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
<?= form_close(); ?>