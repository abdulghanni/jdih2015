<h2>Produk Hukum</h2>
<div>
	<?php
    //print("<pre>");print_r($terkini);print("</pre>");
    foreach($terkini as $entry): ?>
  		<div class="mainpost">
			<h4><a href="<?=site_url('produkhukum/listings/details')?>/<?=$entry->entry_id?>"><?=$entry->cat_description.' Nomor '.$entry->title.' Tahun '.$entry->regyear?></a></h4>
            <p>Tentang <?=character_limiter($entry->description, 200)?></p>
            <div class="metapost">Hits: <?php echo $entry->hits; ?> | Diunduh: <?php echo $entry->downloaded; ?> | <a href="<?=site_url('produkhukum/download')?>/<?=$entry->entry_id?>"><span aria-hidden="true" class="glyphicon glyphicon-circle-arrow-down"></span></div>
  		</div>
	<?php endforeach; ?>
</div>