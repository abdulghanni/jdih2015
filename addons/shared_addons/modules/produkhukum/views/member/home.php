	
	<h2>Area Member</h2>
	
	<ul class="crud clearfix">
		<li><?=anchor('member/listings', 'Edit entrian Anda', array('class' => 'entries', 'title' => 'Edit entrian Anda'))?></li>
		<li><?=anchor('member/profile/edit', 'Edit profil Anda', array('class' => 'profile', 'title' => 'Edit profil Anda'))?></li>
	</ul>

	<div id="listing_detail">

	<h3>Profil Anda &nbsp;<small>[<?=anchor('member/profile/'.$this->user->id, 'show')?>]</small></h3>
	
		<ul class="details">
			<li class="clearfix">
				<dl>
					<dt>Nama Pengguna:</dt>
					<dd><?=$this->user->username?></dd>
				</dl>
			</li>
			<li class="clearfix">
				<dl>
					<dt>Grup Pengguna:</dt>
					<dd><?=$this->user->user_group?></dd>
				</dl>
			</li>
			<li class="clearfix">
				<dl>
					<dt>Tgl. Bergabung:</dt>
					<dd><?=date("F j, Y", $this->user->join_date)?></dd>
				</dl>
			</li>
			<li class="clearfix">
				<dl>
					<dt>Lokasi:</dt>
					<dd><?=$this->user->location?></dd>
				</dl>
			</li>
		</ul>

	</div>