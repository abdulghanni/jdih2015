<h2 id="page_title"><?php echo $photo->title; ?></h2>
<!-- Div containing all galleries -->
<div class="galleries_container" id="gallery_single">
	<div class="gallery clearfix">
		<!-- A gallery needs a description.. -->
		<div class="gallery_heading">
        	<?php echo img(array('src' => base_url() . 'uploads/files/' . $photo->file->filename, 'alt' => $photo->file->name, 'style' => 'width:600px; margin-bottom: 10px')); ?>
			<p><?php echo $photo->caption; ?></p>
		</div>
        <br style="clear: both;" />
        <h2 id="page_title">Foto Lainnya</h2>
		<!-- The list containing the gallery images -->
		<div class="galleries_container" id="gallery_index">
			<?php if ($album_photos): ?>
				<?php foreach ( $album_photos as $image): ?>
                    <div class="gallery clearfix">
                        <!-- Heading -->
                        <div class="gallery_heading">
                            <a href="<?php echo site_url('photo_activity/' . $image->slug ); ?>" class="gallery-image" rel="gallery-image" data-src="<?php echo base_url().'uploads/files/' . $image->file->filename; ?>" title="<?php echo $image->file->name; ?>">
                                <?php echo img(array('src' => base_url() . 'uploads/files/' . $image->file->filename, 'alt' => $image->file->name, 'style' => 'width:150px')); ?>
                            </a>
                         <h3><?php echo anchor('photo_activity/' . $image->slug, $image->title); ?></h3>
                         </div>
                    
                        <!-- And the body -->
                        <div class="gallery_description">
                            <p>
                                <?php echo ( ! empty($gallery->description)) ? $gallery->description : lang('photos.no_gallery_description'); ?>
                            </p>
                        </div>
                     </div>
                <?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<br style="clear: both;" />

<?php if ($photo->enable_comments == 1): ?>
	<?php echo display_comments($photo->id, 'photo'); ?>
<?php endif; ?>