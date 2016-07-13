<!-- Page Title -->
	<div class="section section-breadcrumbs">
		<div class="row">
			<div class="col-md-12">
				<h1>Produk Hukum</h1>
			</div>
		</div>
	</div>
<!-- Page Title -->
	
<!-- Posts List -->
    <div class="section blog-posts-wrapper">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-4">
						<h3>Kategori</h3>
						<? $this->load->view('navigation'); ?>
						<br/>
						<? $this->load->view('years_box'); ?>
					</div>
					
					<div class="col-md-8">
						<h2>Detail Produk Hukum</h2>
						<table width="100%" border="0" cellspacing="1" cellpadding="0">
							<tr>
								<td style="width: 80px;padding: 1px 5px 2px 5px" valign="top" nowrap>
									<b>Produk Hukum</b>
								</td>
								<td style="width: 5px;padding: 1px 5px 2px 5px" valign="top" nowrap>:</td>
								<td style="padding: 1px 5px 2px 5px" valign="top">
									<b><?=$entry->c_description?> No. <?=$entry->title?> Tahun <?=$entry->regyear?></b>
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
									<a href="<?=site_url('produkhukum/download').'/'.$entry->entry_id;?>"><span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span></a>
								</td>
							</tr>
						</table>
						<br/><br/>
						<h3>Perundangan Lainnya dalam Kategori Ini</h3>
						<ul>
						<?php foreach($categorylistings['entries'] as $entry): ?>
							<li><b><?=$entry->c_description.' Nomor '.$entry->title.' Tahun '.$entry->regyear?></b><br/>
								Tentang <?=character_limiter($entry->e_description, 200)?>
								</li>
								<li class="item-description">
								  <div class="hits-download">Hits: <?=$entry->hits?> | Download: <?=$entry->downloaded?></div>
								  <div class="view-detail">
									<a href="<?=site_url('produkhukum/download')?>/<?=$entry->entry_id?>">{{ theme:image file="green/Download.png" style="border:none;" }}</a>
									<a href="<?=site_url('produkhukum/listings/details')?>/<?=$entry->entry_id?>">{{ theme:image file="green/arrow_next.png" style="border:none;" }}</a>
								  </div>
								</li>
						<?php endforeach ?>
						</ul>
						&laquo; <?=anchor('produkhukum/category/'.$entry->FK_category_id, 'Kembali ke Kategori')?>
					</div>
    			</div>
			</div>
    </div>
<!-- End Posts List -->
    