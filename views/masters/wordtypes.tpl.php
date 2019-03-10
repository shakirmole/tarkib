<h2> Word Types </h2>

<div>
	<span class="place-right"> <a class="button" href="#" onclick="openWindow('?module=masters&action=wordtype_add')"> Add </a> </span>
	<form method="GET" class='no-visible' <?=createValidator()?>>
		<input type="hidden" name="module" value="masters">
		<input type="hidden" name="action" value="wordtypes">
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
				<th>Color</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($wordtypes as $id=>$R) { ?>
		<tr>
			<td nowrap style="width:80px">
				<a href="#" onclick="openWindow('?module=masters&action=wordtype_edit&id=<?=$R['id']?>')"><span class="mif-pencil"></a>
			</td>
			<td style="width:80px"><?=$id+1?></td>
			<td><?=$R['name']?></td>
			<td class='bg-<?=$R['color']?> fg-white'><?=$R['color']?></td>
		</tr>
	<?php } ?>
		</tbody>

	</table>
</div>