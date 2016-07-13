<!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="row">
				<div class="col-md-12">
					<h1>Kontak</h1>
				</div>
			</div>
		</div>
		
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="<?php echo uri_string(); ?>" class="contact-form" method="post" accept-charset="utf-8">
				<div class="row">
				<div class="ten columns">Untuk menghubungi kami, silahkan isi form di bawah ini.</div>
				</div>
				
				<input type="text" name="d0ntf1llth1s1n" value=" " class="default-form" style="display:none" />
				<div class="row">
				<div class="two columns"><label for="name">Nama:</label></div>
				<div class="five columns"><input type="text" name="name" value="<?php echo $post->name; ?>" id="contact_name" class="name" style="width:75%" />
				</div>
				</div>
				<div class="row">
				<div class="two columns"><label for="email">Email:</label></div>
				<div class="five columns"><input type="text" name="email" value="<?php echo $post->email; ?>" id="contact_email" class="email" style="width:75%" />
				</div>
				</div>
				<div class="row">
				<div class="two columns"><label for="subject">Perihal:</label></div>
				<div class="five columns"><input type="text" name="subject" value="<?php echo $post->subject; ?>" style="width:75%" />
				</div>
				</div>
				<div class="row">
				<div class="two columns"><label for="message">Pesan:</label></div>
				<div class="five columns"><textarea name="message" cols="40" rows="10" id="contact_message" class="message" style="width:75%"><?php echo $post->message; ?></textarea>
				</div>
				</div>
				
				
				<div class="row">
				<div class="two columns"><label for="message">&nbsp;</label></div>
				<div class="five columns"><button class="btn" type="submit" name="contact-submit" style="float:left">KIRIM</button>
				</div>
				</div>
			
				</form>
			</div>
		</div>
	</div>
</div>