	<h2>Produk Hukum Terbaru</h2>
	<ul class="sideoptions">
	<?php foreach($newlistings as $listing): ?>
		<li>
			<a href="<?=base_url()?>index.php/listings/details/<?=$listing->entry_id;?>" style="font-weight:bold;font-size:14px"><?=$listing->name;?> No. <?=$listing->title;?> Tahun <?=$listing->regyear;?></a>
			<br/>
			<?=$listing->description;?>
		</li>
	<?php endforeach ?>	
	</ul>
	<h2>Produk Hukum per Tahun</h2>
	<ul class="sideoptions">
	<?php foreach($listingsbyyear as $listing): ?>
		<li style="float:left; width:45%">
			<a href="<?=base_url()?>index.php/listings/year/<?=$listing->regyear;?>" style="font-weight:bold;font-size:14px"><?=$listing->regyear;?> (<?=$listing->total;?>)</a>
		</li>
	<?php endforeach ?>	
	</ul>
	<br clear="all"/>
	<ul class="sideoptions">
		<li><?=anchor('feed', 'Tampilkan RSS Feed', array('class' => 'side_button rss_latest'))?></li>
	</ul>
