
<div class="backend clearfix">

	<h2>Daftar Semua Pengguna</h2>
	<ul class="crud clearfix">
		<li><?=anchor('admin/users/add', 'Tambah Pengguna', array('class' => 'add', 'title' => 'Tambah Pengguna'))?></li>
	</ul>

	<table class="table">

		<thead>
			<tr>
				<th>Nama Pengguna</th>
				<th>Grup</th>
				<th colspan="2"><span id="tip" class="functions text-center">&nbsp;</span></th>
			</tr>
		</thead>

		<tbody>
		<?php foreach($users as $user): ?>
		<tr>
			<td><?=$user->username?></td>
			<td><?=$user->user_group?></td>

			<?php if($user->user_group !== 'Administrators' OR $this->user->id === '1'): ?>
			<td class="functions">
				<?=anchor('member/profile/'.$user->user_id, 'Profile', array('class' => 'icon detail tip', 'title' => 'Show'))?>
				<?=anchor('admin/users/remove/'.$user->user_id, 'Delete', array('class' => 'icon delete tip', 'title' => 'Delete'))?>
			</td>
			<?php endif ?>
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	
</div>