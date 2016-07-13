<!-- Homepage Slider -->
        <div class="homepage-slider">
        	<div id="sequence">
				<ul class="sequence-canvas">
				
	<?php
	$idx = 1;
	//print_r($blog_widget);
	foreach($blog_widget as $post_widget):
	?>
					<!-- Slide <?php echo $idx; ?> -->
					<li class="bg4">
						<!-- Slide Title -->
						<h2 class="title"><?php echo anchor('blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug, $post_widget->title) ?></h2>
						<!-- Slide Text -->
						<h3 class="subtitle"><?php echo $post_widget->intro; ?></h3>
						<!-- Slide Image -->
						<img class="slide-img" src="<?php echo site_url('files/large'); ?>/<?php echo $post_widget->blog_image; ?>" alt="Slide 1" />
					</li>
					<!-- End Slide <?php echo $idx; ?> -->
	<?php
		$idx++;
	endforeach;
	?>
				</ul>
				<div class="sequence-pagination-wrapper">
					<ul class="sequence-pagination">
					<?php $idx = 1; foreach($blog_widget as $post_widget): ?>
						<li><?php echo $idx; ?></li>
					<?php
						$idx++;
					endforeach;
					?>
					</ul>
				</div>
			</div>
        </div>
<!-- End Homepage Slider -->