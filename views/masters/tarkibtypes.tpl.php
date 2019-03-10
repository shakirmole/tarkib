<h2> Tarkib Types </h2>

<div>
	<span class="place-right"> <a class="button" href="#" onclick="openWindow('?module=masters&action=tarkibtype_add')"> Add </a> </span>
	<form method="GET" class='no-visible' <?=createValidator()?>>
		<input type="hidden" name="module" value="masters">
		<input type="hidden" name="action" value="tarkibtypes">
		<label>Name</label> 
		<div class="input-control text">
			<input type="text" name="name" value="<?=$name?>">
		</div>
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
				<th>Word Type</th>
				<th>Erab Type</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($tarkibtypes as $id=>$R) { ?>
		<tr>
			<td nowrap style="width:80px">
				<a href="#" onclick="openWindow('?module=masters&action=tarkibtype_edit&id=<?=$R['id']?>')"><span class="mif-pencil"></a>
			</td>
			<td style="width:80px"><?=$id+1?></td>
			<td><?=$R['name']?></td>
			<td class='fg-white bg-<?=$R['wtcolor']?>'><?=$R['wordtype']?></td>
			<td class='fg-white bg-<?=$R['etcolor']?>'><?=$R['erabtype']?></td>
		</tr>
	<?php } ?>
		</tbody>

	</table>
</div>