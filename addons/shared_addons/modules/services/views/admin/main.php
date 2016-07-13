<div class="backend clearfix">

	<h2>Area Administrasi</h2>

	<table class="table">

		<thead>
			<tr>
				<th colspan="2">Version Information</th>
			</tr>
		</thead>

		<tbody>
		<tr>
			<td>Current Version:</td>
			<td><?=APP_VERSION?></td>
		</tr>
		<tr>
			<td>Newest Version:</td>
			<td><?=$new_version ? anchor('http://www.assembla.com/spaces/files/linkster', 'New version available: '.$new_version) : 'You have the latest version'?></td>
		</tr>
		</tbody>
	</table>

</div>