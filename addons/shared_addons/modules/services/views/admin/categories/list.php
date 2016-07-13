<?= form_open_multipart($this->uri->uri_string()); ?>
<? $BASEURL = BASE_URL.'admin/produkhukum'; ?>
	<div style="margin: 10px 7px 10px 7px">
    <table cellpadding="5" cellspacing="0" style="border: 0px; ">
    	<tr>
        	<td style="padding: 3px 7px 3px 7px; text-align: left; width: 50%">
    			<strong>Kategori | 
                <?= anchor('admin/produkhukum/statistics', 'Statistik');?></strong>
           	</td>
        	<td style="padding: 3px 7px 3px 7px; text-align: right; width: 50%">
    			<strong><?= anchor('admin/produkhukum/createcategory', 'Tambah Kategori');?> | 
                <?= anchor('admin/produkhukum/updateorder', 'Update Order');?></strong>
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
					<div class="inner"><? $this->load->view('admin/fragments/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		
		
		<tbody>
		<?php foreach($categories as $category): ?>
		<tr>
			<td style="text-align:center"><input type="checkbox" name="action_to[]" value="<?=$category->category_id;?>" /></td>
			<td><?=$category->name?></td>
			<td><?=$category->description?></td>
			<td style="text-align:center"><input type="text" name="entry_order[]" style="width:30px;text-align:center" value="<?=$category->entry_order?>" /></td>
			<td style="text-align:center">
				<?=anchor('admin/produkhukum/category/'.$category->category_id, 'Entries', array('class' => 'icon detail tip', 'title' => 'Show Entries'))?>
				<?=anchor('admin/produkhukum/editcategory/'.$category->category_id, 'Edit', array('class' => 'icon edit tip', 'title' => 'Edit'))?>	
				<?=anchor('admin/produkhukum/categories/remove/'.$category->category_id, 'Delete', array('class' => 'confirm icon delete tip', 'title' => 'Delete'))?>
			</td>
		</tr>
		<?php endforeach ?>
		</tbody>
		
	</table>
<?= form_close(); ?>
