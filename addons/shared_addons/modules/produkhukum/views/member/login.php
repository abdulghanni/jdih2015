<?php $v =& $this->validation ?>
		
		<h2>Member Area</h2>
		
		<h3>Please Login</h3>
		
		<div class="form_error">
			<?=$v->error_string?>
		</div>
		
		<?=form_open('member/login')?>
			<div><input type="hidden" name="token" value="<?=$token?>" id="token" /></div>
			
			<p><label for="username">Username: </label></p>
			<p><input type="text" name="username" value="<?=$v->username?>" id="username" class="focus <?=$v->username_error?>" /></p>
			<p><label for="password">Password: </label></p>
			<p><input type="password" name="password" id="password" class="<?=$v->password_error?>" /></p>
			<p><button type="submit">Login</button></p>
		<?=form_close()?>
		
		<p>Can't remember your password? <?=anchor('member/forgot', 'Restore it.')?></p>