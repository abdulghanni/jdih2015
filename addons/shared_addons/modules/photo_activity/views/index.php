<!-- Div containing all galleries -->
         	<?php
	   if ( ! empty($otheralbum)):
	   $idx = 0;
	   //print('<pre>');print_r($otheralbum);print('</pre>');
	   foreach ($otheralbum as $album):
	   ?>
	   <div class="col-md-4 col-sm-6">
			<div class="portfolio-item">
				<div class="portfolio-image">
					<a href="<?php echo base_url(); ?>photo_activity/album/<?php echo $album->slug; ?>">
	                    <img class="img-responsive" src="<?php echo base_url(); ?>uploads/default/photos/<?php echo $album->thumbnail; ?>" alt="<?php echo $album->title; ?>" style="max-height: 168px; " />
	                </a>
				</div>
				<div class="portfolio-info">
					<ul>
						<li class="portfolio-project-name"><?php echo $album->title; ?></li>
						<li class="read-more"><a class="btn btn-success" href="<?php echo base_url(); ?>photo_activity/album/<?php echo $album->slug; ?>">View</a></li>
					</ul>
				</div>
			</div>
		</div>
		
            <?php
	      $idx++;
	    endforeach; endif; ?>
    
<!-- Div containing all galleries -->