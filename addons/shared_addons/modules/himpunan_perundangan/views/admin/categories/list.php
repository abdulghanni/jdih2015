<?php echo  form_open_multipart($this->uri->uri_string()); ?>
<?php $BASEURL = BASE_URL.'admin/himpunan_perundangan'; ?>
	<div style="margin: 10px 7px 10px 7px">
    <table cellpadding="5" cellspacing="0" style="border: 0px; ">
    	<tr>
        	<td style="padding: 3px 7px 3px 7px; text-align: left; width: 50%">
    			<strong>Kategori | 
                <?php echo  anchor('admin/produkhukum/statistics', 'Statistik');?></strong>
           	</td>
        	<td style="padding: 3px 7px 3px 7px; text-align: right; width: 50%">
    			<strong><?php echo  anchor('admin/himpunan_perundangan/createcategory', 'Tambah Kategori');?> | 
                <?php echo  anchor('admin/himpunan_perundangan/updateorder', 'Update Order');?></strong>
           	</td>
        </tr>
    </table>
    </div>
	
	<table border="0" class="listTable">    
		<thead>
			<tr>
				<th class="first"><div></div></th>
				<th><a href="#">Category Name</a></th>
                <th><a href="#">Description</a></th>
				<th><a href="#">Order</a></th>
				<th class="last width-10"><span>Action</span></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="4">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		
		
		<tbody>
		<?php foreach($categories as $category): ?>
		<tr>
			<td style="text-align:center"><input type="checkbox" name="action_to[]" value="<?php echo  $category->category_id;?>" /></td>
			<td><?php echo $category->name?></td>
			<td><?php echo $category->description?></td>
			<td style="text-align:center"><input type="text" name="entry_order[]" style="width:30px;text-align:center" value="<?php echo $category->entry_order?>" /></td>
			<td style="text-align:center">
				<?php echo anchor('admin/himpunan_perundangan/category/'.$category->category_id, 'Entries', array('class' => 'icon detail tip', 'title' => 'Show Entries'))?>
				<?php echo anchor('admin/himpunan_perundangan/editcategory/'.$category->category_id, 'Edit', array('class' => 'icon edit tip', 'title' => 'Edit'))?>	
				<?php echo anchor('admin/himpunan_perundangan/categories/remove/'.$category->category_id, 'Delete', array('class' => 'confirm icon delete tip', 'title' => 'Delete'))?>
			</td>
		</tr>
		<?php endforeach ?>
		</tbody>
		
	</table>
<?php echo  form_close(); ?>
