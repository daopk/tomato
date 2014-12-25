<div class="table-responsive">
	<table class="table table-hover pure-table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($model as $key => $item): ?>
			<tr>
				<td> <?= $item['name'] ?></td>
				<td> <?= $item['value'] ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>