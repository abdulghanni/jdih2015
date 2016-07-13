<!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="row">
				<div class="col-md-12">
					<h1><?php echo $page->title; ?></h1>
				</div>
			</div>
		</div>
        
        <!-- Posts List -->
        <div class="section blog-posts-wrapper">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-8">
						<?php echo $page->layout->body; ?>
					</div>
					<div class="col-md-4">
						{{ theme:partial name="sidebar" }}
					</div>
	    		</div>
			</div>
	    </div>
	    <!-- End Posts List -->



