		
		<div id="listing_detail">
				
			<ul class="details">
				<li class="clearfix">
					<dl>
						<dt>Nama Pengguna:</dt>
						<dd><?=$user->username?></dd>
					</dl>
				</li>
				<li class="clearfix">
					<dl>
						<dt>Grup Pengguna:</dt>
						<dd><?=$user->user_group?></dd>
					</dl>
				</li>
				<li class="clearfix">
					<dl>
						<dt>Tgl. Bergabung:</dt>
						<dd><?=date("F j, Y", $user->join_date)?></dd>
					</dl>
				</li>
				<li class="clearfix">
					<dl>
						<dt>Lokasi:</dt>
						<dd><?=$user->location?></dd>
					</dl>
				</li>
			</ul>
	
		</div>
	
		<?php if($this->user->id == $user->user_id): ?>
		<ul class="crud clearfix">
			<li><?=anchor('member/profile/edit', 'Edit Profil Anda', array('class' => 'profile', 'title' => 'Edit Profil Anda'))?></li>
		</ul>
		<?php endif ?>
		