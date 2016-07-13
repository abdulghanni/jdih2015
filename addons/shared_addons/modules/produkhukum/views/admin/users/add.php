<?php $v =& $this->validation ?>

	<h2>Tambah Pengguna</h2>
	
	<div class="form_error">
		<?=$v->error_string?>
	</div>
	
	<?=form_open('admin/users/add')?>
	
	<div>
		<input type="hidden" name="token" value="<?=$token?>" id="token" />
	</div>
	
	<h3>Informasi Akun Pengguna <small>(Semua field harus diisi)</small></h3>
		<p><label for="email">Email:</label></p>
		<p><input type="text" name="email" value="<?=$v->email?>" id="email" class="focus <?=$v->email_error?>" /></p>
		<p><label for="username">Nama Pengguna:</label></p>
		<p><input type="text" name="username" value="<?=$v->username?>" id="username" class="<?=$v->username_error?>" /></p>
		<p><label for="password">Kata Kunci:</label></p>
		<p><input type="password" name="password" value="<?=$v->password?>" id="password" class="<?=$v->password_error?>" /></p>
		<p><label for="p_confirm">Ulangi Kata Kunci:</label></p>
		<p><input type="password" name="p_confirm" value="<?=$v->p_confirm?>" id="p_confirm" class="<?=$v->p_confirm_error?>" /></p>

	<div id="optional" class="js_hide">
	<h3>Informasi Personal <small>(Optional)</small></h3>
		<p><label for="name">Nama Lengkap: </label></p>
		<p><input type="text" name="name" value="<?=$v->name?>" id="name" class="<?=$v->name_error?>" /></p>
		<p><label for="f_name">Nama Panggilan: </label></p>
		<p><input type="text" name="f_name" value="<?=$v->f_name?>" id="f_name" class="<?=$v->f_name_error?>" /></p>
		<p><label for="location">Lokasi: </label></p>
		<p><input type="text" name="location" value="<?=$v->location?>" id="location" class="<?=$v->location_error?>" /></p>
	</div>
	<p><small><a href="#" id="show_optional" class="hidden js_show more">Tampilkan field Opsional</a></small></p>

	<h3>Perjanjian Menjadi Pengguna</h3>
		<p>
			<input type="checkbox" name="terms" value="1" id="terms" class="checkbox" <?=$v->set_checkbox('terms', '1')?> />
			<label for="terms" class="checkbox <?=$v->terms_error?>">
				Saya setuju dengan <?=anchor('page/tos', 'Peraturan')?> dan <?=anchor('page/privacy', 'Kebijakan')?>. <sup>(Harus diisi)</sup>
			</label>
		</p>
		<p>
			<input type="checkbox" name="newsletter" value="1" id="newsletter" class="checkbox" <?=$v->set_checkbox('newsletter', '1')?> />
			<label for="newsletter" class="checkbox">
				Ya, saya bersedia dikirim update dan informasi.
			</label>
		</p>
		
		<p><button type="submit">Simpan</button></p>
	<?=form_close()?>
	