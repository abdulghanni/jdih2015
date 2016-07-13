<?php $v =& $this->validation ?>

	<h2>Registration</h2>
	
	<div class="form_error">
		<?=$v->error_string?>
	</div>
	
	<?=form_open('member/register')?>
	
	<div>
		<input type="hidden" name="token" value="<?=$token?>" id="token" />
	</div>
	
	<h3>Account Information <small>(All fields required)</small></h3>
		<p><label for="email">Email:</label></p>
		<p><input type="text" name="email" value="<?=$v->email?>" id="email" class="focus <?=$v->email_error?>" /></p>
		<p><label for="username">Username:</label></p>
		<p><input type="text" name="username" value="<?=$v->username?>" id="username" class="<?=$v->username_error?>" /></p>
		<p><label for="password">Password:</label></p>
		<p><input type="password" name="password" value="<?=$v->password?>" id="password" class="<?=$v->password_error?>" /></p>
		<p><label for="p_confirm">Confirm Password:</label></p>
		<p><input type="password" name="p_confirm" value="<?=$v->p_confirm?>" id="p_confirm" class="<?=$v->p_confirm_error?>" /></p>

	<div id="optional" class="js_hide">
	<h3>Personal Information <small>(Optional)</small></h3>
		<p><label for="name">Name: </label></p>
		<p><input type="text" name="name" value="<?=$v->name?>" id="name" class="<?=$v->name_error?>" /></p>
		<p><label for="f_name">First Name: </label></p>
		<p><input type="text" name="f_name" value="<?=$v->f_name?>" id="f_name" class="<?=$v->f_name_error?>" /></p>
		<p><label for="location">Location: </label></p>
		<p><input type="text" name="location" value="<?=$v->location?>" id="location" class="<?=$v->location_error?>" /></p>
	</div>
	<p><small><a href="#" id="show_optional" class="hidden js_show more">Show Optional Fields</a></small></p>

	<h3>Agreements</h3>
		<p>
			<input type="checkbox" name="terms" value="1" id="terms" class="checkbox" <?=$v->set_checkbox('terms', '1')?> />
			<label for="terms" class="checkbox <?=$v->terms_error?>">
				I have read and agree to the <?=anchor('page/tos', 'Terms of Use')?> and <?=anchor('page/privacy', 'Privacy Policy')?>. <sup>(Required)</sup>
			</label>
		</p>
		<p>
			<input type="checkbox" name="newsletter" value="1" id="newsletter" class="checkbox" <?=$v->set_checkbox('newsletter', '1')?> />
			<label for="newsletter" class="checkbox">
				Yes, I want to be contacted with news and updates.
			</label>
		</p>
		
		<p><button type="submit">Register</button></p>
	<?=form_close()?>
	