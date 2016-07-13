<!-- Page Title -->
	<div class="section section-breadcrumbs">
		<div class="row">
			<div class="col-md-12">
				<h1>Himpunan Perundangan</h1>
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
						<? $this->load->view('form_search'); ?>
						<h2>Himpunan Perundangan Tahun <?=$selectedyear?></h2>
						<?php
							//print("<pre>");print_r($entries);print("</pre>");
							if ($entries['entries']) :
							foreach($entries['entries'] as $row => $entry):
						?>
						<div class="mainpost">
							<h4><a href="<?=site_url('himpunan_perundangan/details')?>/<?=$entry->entry_id?>"><?=$entry->namasub.' Nomor '.$entry->title.' Tahun '.$entry->regyear?></a></h4>
							<p>Tentang <?=character_limiter($entry->e_description, 200)?></p>
							<div class="metapost">Hits: <?=$entry->hits?> | Diunduh: <?=$entry->downloaded?> | 
								<a href="<?=site_url('himpunan_perundangan/download')?>/<?=$entry->entry_id?>"><span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span></a>
							</div>
						</div>
						<?php
						endforeach;
						endif;
						?>
						<div class="pagination-wrapper ">
							<?=(isset($pagination['links']) ? $pagination['links']: "") ?>
						</div>
					</div>
    			</div>
			</div>
    </div>
<!-- End Posts List -->