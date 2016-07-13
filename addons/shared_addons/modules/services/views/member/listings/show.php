
<div class="backend clearfix">
	
	<h2>Daftar Entrian Anda</h2>
	<table style="margin:0px;">
	<tr>
	  <td><?=anchor('member/listings/add', 'Tambah Produk Hukum', array('class' => 'bigbutton add_link'))?></td>
	  </tr>
	<tr>
	<td>
	  <form name="formSearch" action="<?=base_url()?>member/listings" method="post" style="margin:0px">
	    <table align="center" style="width:50%;margin:0px">
	      <tr>
	        <td nowrap="nowrap" style="padding:3px 2px 2px 2px; font-size:12px;"><strong>Filter : </strong></td>
            <td style="padding:3px 2px 2px 2px; font-size:12px;">Nomor</td>
            <td style="padding:1px 2px 2px 2px; font-size:12px;"><input name="nomor" type="text" style="width:50px" value="<?=$adm_filter_nomor?>" /></td>
            <td style="padding:3px 2px 2px 2px; font-size:12px;">Tahun</td>
            <td style="padding:1px 2px 2px 2px; font-size:12px;"><input name="tahun" type="text" style="width:50px" value="<?=$adm_filter_tahun?>" /></td>
		    <td style="padding:3px 2px 2px 2px; font-size:12px;">Kategori</td>
		    <td style="padding:1px 2px 2px 2px; font-size:12px;">
		      <select name="category" id="category" style="width:150px; height: 24px">
		        <option value="">Pilih</option>
		        
		        <?php foreach($categories as $category): ?>
		        <?php $selected = ($category->category_id == $adm_filter_kategori) ? 'selected="selected"' : '' ?>
		        <option value="<?=$category->category_id?>" <?=$selected?>><?=$category->name?></option>
		        <?php endforeach ?>
	          </select>		  </td>
            <td style="padding:3px 2px 2px 2px; font-size:12px;"><input name="Submit" type="submit" style="width:60px; height:24px" value="Submit" /></td>
          </tr>
	      </table>
	    </form></td>
	</tr>
	</table>
	<br/>
	<table class="table">
		
		<thead>
			<tr>
				<th>Kategori</th>
				<th>Nomor</th>
				<th>Tahun</th>
				<th>Tentang</th>
				<th colspan="2"><span id="tip" class="functions text-center">&nbsp;</span></th>
			</tr>
		</thead>
		
		<tbody>	
			<?php foreach($entries as $entry): ?>
			<tr>
				<td><?=$entry->name?></td>
				<td><?=$entry->title?></td>
				<td><?=$entry->regyear?></td>
				<td><?=character_limiter($entry->description, 50)?></td>
				<td class="functions">
					<?=anchor('listings/details/'.$entry->entry_id, 'Show', array('class' => 'icon detail tip', 'title' => 'Show'))?>
					<?=anchor('member/listings/edit/'.$entry->entry_id, 'Edit', array('class' => 'icon edit tip', 'title' => 'Edit'))?>
					<?=anchor('member/listings/remove/'.$entry->entry_id, 'Delete', array('class' => 'confirm icon delete tip', 'title' => 'Delete'))?>
				</td>
			</tr>
			<?php endforeach ?>	
		</tbody>
		
	</table>
	
		<div class="clearfix">
			<?=$pagination?>
		</div>
	
</div>
	