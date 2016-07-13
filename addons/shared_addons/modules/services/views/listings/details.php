<link href="<?=base_url()?>application/modules/produkhukum/views/css/styles.css" rel="stylesheet" type="text/css" media="all" />
<h3></h3>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
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
			<div style="border: 1px solid #a4483c; background: #fefae2; margin:0px 0px 20px 0px;padding:5px 10px 5px 10px;">
			<table width="100%" style="margin-bottom: 10px">
				<tr>
				<td align="left" valign="bottom" nowrap="nowrap"><span class="section-title">Detail Produk Hukum</span></td>
				<td valign="bottom" class="section-middle" width="100%">&nbsp;</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
				<tr>
					<td style="width: 80px;padding: 1px 5px 2px 5px" valign="top" nowrap>
						<b>Produk Hukum</b>
					</td>
					<td style="width: 5px;padding: 1px 5px 2px 5px" valign="top" nowrap>:</td>
					<td style="padding: 1px 5px 2px 5px" valign="top">
						<b><?=$entry->name?> No. <?=$entry->title?> Tahun <?=$entry->regyear?></b>
					</td>
				</tr>
				<tr>
					<td style="width: 80px;padding: 1px 5px 2px 5px" valign="top" nowrap>
						<b>Tentang</b>
					</td>
					<td style="width: 5px;padding: 1px 5px 2px 5px" valign="top" nowrap>:</td>
					<td style="padding: 1px 5px 2px 5px" valign="top">
						<?=$entry->e_description?>
					</td>
				</tr>
				<tr>
					<td style="width: 80px;padding: 1px 5px 2px 5px" valign="top" nowrap>
						<b>Download</b>
					</td>
					<td style="width: 5px;padding: 1px 5px 2px 5px" valign="top" nowrap>:</td>
					<td style="padding: 1px 5px 2px 5px" valign="top">
						<?=anchor(base_url().'produkhukum/download/'.$entry->entry_id.'/'.$entry->url, '<img src="'.base_url().'application/public/img/icons/pdf.gif"/>', array('border' => '0', 'title' => 'Download '.$entry->title))?>
					</td>
				</tr>
			</table>
			</div>
			<table width="100%" style="margin-bottom: 10px">
				<tr>
				<td align="left" valign="bottom" nowrap="nowrap"><span class="section-title">Produk Hukum Lainnya dalam Kategori Ini</span></td>
				<td valign="bottom" class="section-middle" width="100%">&nbsp;</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
			<?php foreach($categorylistings['entries'] as $listing): ?>
				<tr>
					<td colspan="2" style="background: #FBF8F3; border-top: 1px solid #9C0606; padding: 1px 5px 2px 5px"><b><?=$listing->name.' Nomor '.$listing->title.' Tahun '.$listing->regyear?></b></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 1px 5px 2px 5px"><?=character_limiter($listing->e_description, 200)?></td>
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
			<?php endforeach ?>	
			</table>
			&laquo; <?=anchor('produkhukum/category/'.$entry->FK_category_id, 'Kembali ke Kategori')?>
		</td>
	</tr>
</table>
