<h2>Berita Hukum</h2>
<div class="">
	<?php
	$idx = 1;
	foreach($blog_widget as $post_widget):
	?>
			<div class="mainpost">
				<h4><?php echo anchor('blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug, $post_widget->title) ?></h4>
				<div class="metapost">Dibaca: <?php echo $post_widget->hits; ?> kali | Komentar: {{ comments:count_string entry_id=<?php echo $post_widget->id; ?> [module="blog"] }}</div>
				<p><?php echo $post_widget->intro; ?></p>
			</div>
	<?php
		$idx++;
	endforeach;
	?>
</div>