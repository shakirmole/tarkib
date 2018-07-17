<h2> Workers </h2>

<div>
	<span class="place-right"> <a class="button" href="?module=masters&action=worker_add"> Add </a> </span>
	<form method="GET" class='no-visible' <?=VALIDATEFORM?>>
		<input type="hidden" name="module" value="masters">
		<input type="hidden" name="action" value="locations">
		<label>Name</label> 
		<div class="input-control text">
			<input type="text" name="name" value="<?=$name?>">
		</div
		<input type="submit" value="Search">
	</form>
</div>

<div>
	<table class="table table-border cell-border row-hover" border="0" data-role="dataTable">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>No.</th>
				<th>Name</th>
				<th>Mobile</th>
				<th>Location</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($workers as $id=>$R) { ?>
		<tr>
			<td nowrap style="width:80px">
				<a href="?module=masters&action=worker_edit&id=<?=$R['id']?>"><span class="mif-pencil"></a>
			</td>
			<td style="width:80px"><?=$id+1?></td>
			<td><?=$R['name']?></td>
			<td><?=$R['mobile']?></td>
			<td><?=$R['location']?></td>
		</tr>
	<?php } ?>
		</tbody>

	</table>
</div>