<div>
  <ul>
	<?php
    //print("<pre>");print_r($terkini);print("</pre>");
    foreach($terkini as $entry): ?>
			<li><b><?=$entry->namasub.' Nomor '.$entry->title.' Tahun '.$entry->regyear?></b><br/>
            Tentang <?=character_limiter($entry->description, 200)?>
            </li>
			<li class="item-description">
			  <div class="hits-download">Hits: <?php echo $entry->hits; ?> | Download: <?php echo $entry->downloaded; ?></div>
			  <div class="view-detail">
				<a href="">{{ theme:image file="green/Download.png" }}</a>
				<a href="">{{ theme:image file="green/Arrow next.png" }}</a>
			  </div>
			</li>
	<?php endforeach; ?>
  </ul>
</div>