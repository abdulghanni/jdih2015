
	<?php if($this->access->logged_in()): ?>
	<ul class="side_nav">
		<li><h2><?=anchor('member', 'Member')?></h2></li>
		<li><?=anchor('member/listings', 'Daftar Entrian Produk Hukum')?></li>
		<li><?=anchor('member/profile/edit', 'Profil Anda')?></li>
	</ul>
		
	<?php if($this->user->is_admin): ?>
	<ul class="side_nav">
		<li><h2><?=anchor('admin', 'Administrasi')?></h2></li>
		<li><?=anchor('admin/users', 'Pengelolaan Pengguna')?></li>
		<li><?=anchor('admin/categories', 'Pengelolaan Kategori')?></li>
		<!--<li><?=anchor('admin/pages', 'Pengelolaan Halaman')?></li>-->
	</ul>
	<?php endif ?>
	
	<ul class="side_nav">
		<?php if ($this->user->confirm_logout): ?>
		<li><?=anchor('member/logout', 'Keluar', array('class' => 'confirm'))?></li>
		<?php else: ?>
		<li><?=anchor('member/logout', 'Keluar')?></li>
		<? endif; ?>
	</ul>
	
	<?php else: ?>			
	<h2>Belum Jadi Member?</h2>
	<p>Jika anda belum jadi member, silahkan <?=anchor('member/register', 'Bergabung!')?></p>
	<?php endif ?>
	
