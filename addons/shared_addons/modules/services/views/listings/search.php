<link href="<?=base_url()?>application/modules/produkhukum/views/css/styles.css" rel="stylesheet" type="text/css" media="all" />
<h3></h3>
<table style="width:100%" border="0" cellspacing="1" cellpadding="0">
	<tr>
		<td valign="top" style="width:250px;padding-left:10px; padding-right:10px;;border-right:1px solid #efefef">		
			<TABLE width="100%" style="margin-bottom: 10px">
				<tr>
				<td align="left" valign="bottom" nowrap="nowrap"><span class="section-title">Produk Hukum per Kategori</span></td>
				<td valign="bottom" class="section-middle" width="100%">&nbsp;</td>
				</tr>
			</table>
			<? $this->load->view('navigation'); ?>
			<br/>
			<? $this->load->view('years_box'); ?>
			
		</td>
		<td valign="top" style="padding-left:10px; padding-right:10px;">
			<form name="formSearch" method="post" style="margin:0px;padding:5px 10px 5px 10px; margin-bottom:10px">
			  <table align="center" style="margin-top: 0px;">
				<tr>
				  <td style="padding:2px 2px 2px 2px" nowrap><strong>Cari Produk Hukum : </strong></td>
				  <td style="padding:2px 2px 2px 2px">Nomor</td>
				  <td style="padding:1px 2px 2px 2px"><input name="nomor" type="text" value="<?=($nomor=='0'?'':$nomor)?>" style="width:50px;font-size:11px" /></td>
				  <td style="padding:2px 2px 2px 2px">Tahun</td>
				  <td style="padding:1px 2px 2px 2px"><input name="tahun" type="text" value="<?=($tahun=='0'?'':$tahun)?>" style="width:50px;font-size:11px" /></td>
				  <td style="padding:2px 2px 2px 2px">Tentang</td>
				  <td style="padding:1px 2px 2px 2px"><input name="tentang" type="text" value="<?=($tentang=='all'?'':$tentang)?>" style="width:150px;font-size:11px" /></td>
				  <td style="padding:1px 2px 2px 2px"><input name="Submit" type="submit" style="width:60px; height:24px;font-size:11px" value="Submit" /></td>
				</tr>
			  </table>
			</form>
			<TABLE width="100%" style="margin-bottom: 10px">
				<tr>
				<td align="left" valign="bottom" nowrap="nowrap"><span class="section-title">Hasil Pencarian</span></td>
				<td valign="bottom" class="section-middle" width="100%">&nbsp;</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
			<?php
			if ($entries) :
				foreach($entries as $row => $entry):
				//print("<pre>");print_r($entry);print("</pre>");
			?>
			<tr>
				<td colspan="2" style="background: #FBF8F3; border-top: 1px solid #9C0606; padding: 1px 5px 2px 5px"><b><?=$entry->name.' Nomor '.$entry->title.' Tahun '.$entry->regyear?></b></td>
			</tr>
			<tr>
				<td colspan="2" style="padding: 1px 5px 2px 5px"><?=character_limiter($entry->e_description, 200)?></td>
			</tr>
			<tr>
					<td style="padding: 1px 5px 2px 5px; text-align:left; font-size: 10px">
					Hits: <?=$entry->hits?> | Download: <?=$entry->downloaded?>
					</td>
					<td style="padding: 1px 5px 2px 5px; text-align: right; font-size: 10px">
						<a href="<?=base_url()?>produkhukum/listings/details/<?=$entry->entry_id?>"> detail</a> 
						<img src="<?=base_url()?>application/modules/produkhukum/views/images/icon_detail.gif"/>
						<a href="<?=base_url()?>produkhukum/download/<?=$entry->entry_id?>/<?=$entry->url?>"> download</a> 
						<img src="<?=base_url()?>application/modules/produkhukum/views/images/icon_download.gif"/>
					</td>
			</tr>
			<tr><td style="height: 9px; background: transparent url(<?php echo base_url(); ?>/application/modules/produkhukum/views/images/dot.gif) top left repeat-x"></td></tr>
			<?php
				endforeach;
			endif;
			?>
			</table>
			<div class="clearfix">
				<?=(isset($pagination['links']) ? $pagination['links']: "") ?>
			</div>
		</td>
	</tr>
</table>