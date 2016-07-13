<?php $v =& $this->validation ?>

	<div id="listing_detail">
		
		<h2>Mengelola Profil Anda</h2>

		<div class="form_error">
			<?=$v->error_string?>
		</div>
		
		<?=form_open('member/profile/edit')?>
	
		<h3>Informasi</h3>
	
			<p><label for="password">Nama Pengguna: </label><input type="text" name="username" value="<?=$this->user->username?>" id="username" class="readonly" readonly="readonly" /></p>
			<p><label for="password">Grup Pengguna: </label><input type="text" name="user_group" value="<?=$this->user->user_group?>" id="user_group" class="readonly" readonly="readonly" /></p>
			<p><label for="password">Tgl. Bergabung: </label><input type="text" name="joined" value="<?=date("F j, Y", $this->user->join_date)?>" id="joined" class="readonly" readonly="readonly" /></p>
			<p><label for="name">Nama: </label>
				<input type="text" name="name" value="<?=($v->name) ? $v->name : $this->user->name?>" id="name" class="small_field <?=$v->name_error?>" />
				<input type="text" name="surname" value="<?=($v->surname)? $v->surname : $this->user->surname?>" id="surname" class="small_field <?=$v->surname_error?>" />
			</p>
			<p><label for="location">Lokasi: </label><input type="text" name="location" value="<?=($v->location) ? $v->location : $this->user->location?>" id="location" class="<?=$v->location_error?>" /></p>
			
			<p><label for="email">Email: </label><input type="text" name="email" value="<?=($v->email) ? $v->email : $this->user->email?>" id="email" class="<?=$v->email_error?>" /></p>
			<h3>Kata Kunci <small>(Kosongkan jika tidak ingin mengubahnya)</small></h3>

			<p><label for="password">Kata Kunci Baru: </label><input type="password" name="password" value="" id="password" class="<?=$v->password_error?>" /></p>
			<p><label for="pass_conf">Ulangi Kata Kunci Baru: </label><input type="password" name="pass_conf" value="" id="pass_conf" class="<?=$v->pass_conf_error?>" /></p>
		
		<h3>Otentikasi <small>(Harus Diisi)</small></h3>
			<p><label for="old_password">Kata Kunci: </label><input type="password" name="old_password" value="" id="old_password" class="<?=$v->old_password_error?>" /></p>
			<p><button type="submit">Simpan</button></p>

		<?=form_close()?>

	</div>