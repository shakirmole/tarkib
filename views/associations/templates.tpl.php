<h2> Templates </h2>

<div>
	<span class="place-right"> <a class="button" href="?module=associations&action=template_add"> Add </a> </span>
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
				<th>Company</th>
				<th>Checks</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($templates as $id=>$R) { ?>
		<tr>
			<td nowrap style="width:80px">
				<a href="?module=associations&action=template_edit&id=<?=$R['id']?>"><span class="mif-pencil"></a>
			</td>
			<td style="width:80px"><?=$id+1?></td>
			<td><?=$R['name']?></td>
			<td><?=$R['company']?></td>
			<td><?=$R['checks']?></td>
		</tr>
	<?php } ?>
		</tbody>

	</table>
</div>