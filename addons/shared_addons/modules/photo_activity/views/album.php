<div class="col-md-8">
   <?php
   if ( ! empty($photos)):
   echo '<h4>Foto Album: '.$album->title.'</h4>';
   endif;
   ?>
   <?php 
            if ( ! empty($photos)): 
            $idx = 1;
            	foreach ($photos as $photo): 
            ?>
				<?php if ( ! empty($photo->photo) && $idx==1): ?>
				<div class="portfolio-item">
					<div class="portfolio-image">
                		<img src="<?php echo base_url() . 'uploads/default/photos/' . $photo->photo; ?>" alt="<?php echo $photo->title; ?>" style="max-width:100%"/>
                	</div>
                </div>
                <?php endif; ?>
			<?php $idx++; endforeach; else: ?>
            <p><?php echo lang('photos.no_galleries_error'); ?></p>
            <?php endif; ?>
</div>
<div class="col-md-4">
            <?php 
            if ( ! empty($photos)): 
            $idx = 1;
            foreach ($photos as $photo): 
            ?>
				<?php if ( ! empty($photo->photo) && $idx>1): ?>
				
				<?php if ($idx%2==0) echo '<div class="row">'; ?>
				<div class="col-md-6 col-sm-6">
                <a class="thumb detail-thumb" name="<?php echo $photo->photo; ?>" href="<?php echo base_url() . 'uploads/default/photos/' . $photo->photo; ?>" title="<?php echo $photo->title; ?>">
                    <img src="<?php echo base_url() . 'uploads/default/photos/' . $photo->photo; ?>" alt="<?php echo $photo->title; ?>" style="max-width:100%"/>
                </a>
                </div>
                <?php if ($idx%2==1) echo '</div>'; ?>
                <?php endif; ?>
            
			<?php $idx++; endforeach; else: ?>
			
            <p><?php echo lang('photos.no_galleries_error'); ?></p>
            <?php endif; ?>
        </ul>
</div>
<!-- Div containing all galleries -->
<script type="text/javascript">
    $(document).ready(function(){
        $('.detail-thumb').click(function(){
            var photo = $(this).children('img').attr('src');
            $('.portfolio-image > img').attr('src', photo);
            return false;
        });
    })
</script>