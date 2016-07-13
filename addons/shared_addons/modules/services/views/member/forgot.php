<?php $v =& $this->validation ?>
		
		<h2>Recover Password</h2>

		<p>Simply enter your email address and we'll send you a new password.</p>

		<div class="form_error">
			<?=$v->error_string?>
		</div>

		<?=form_open('member/forgot')?>
			<p><label for="email">* Email Address: </label><input type="text" name="email" value="<?=$v->email?>" id="email" class="focus <?=$v->email_error?>" /></p>
			<p><button type="submit">Send</button></p>
		</form>