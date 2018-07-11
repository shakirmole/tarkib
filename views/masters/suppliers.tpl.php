<h2> Suppliers </h2>

<div>
	<span class="place-right"> <a class="button" href="#" onclick="openWindow('?module=masters&action=supplier_add')"> Add </a> </span>
	<form method="GET" class='no-visible' <?=VALIDATEFORM?>>
		<input type="hidden" name="module" value="masters">
		<input type="hidden" name="action" value="suppliers">
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
			</tr>
		</thead>
		<tbody>
	<?php foreach($suppliers as $id=>$R) { ?>
		<tr>
			<td nowrap style="width:80px">
				<a href="#" onclick="openWindow('?module=masters&action=supplier_edit&id=<?=$R['id']?>')"><span class="mif-pencil"></a>
			</td>
			<td style="width:80px"><?=$id+1?></td>
			<td><?=$R['name']?></td>
		</tr>
	<?php } ?>
		</tbody>

	</table>
</div>