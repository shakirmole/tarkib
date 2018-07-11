<h2> Admins </h2>

<div>
	<span class="place-right"> <a class="button" href="#" onclick="openWindow('?module=users&action=admin_add')"> Add </a> </span>
	<form method="GET" class='no-visible' <?=VALIDATEFORM?>>
		<input type="hidden" name="module" value="users">
		<input type="hidden" name="action" value="Admins">
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
				<th>Username</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($users as $id=>$R) { ?>
		<tr>
			<td nowrap style="width:120px">
				<a href="#" onclick="openWindow('?module=users&action=admin_edit&id=<?=$R['id']?>')"><span class="mif-pencil"></a>
				<? if ($R['admin']) { ?><a href="#" onclick="openWindow('?module=users&action=user_rights_edit&id=<?=$R['id']?>')"><span class="mif-user"></a> <? } ?>
			</td>
			<td class="fg-white bg-<?=($R['status'])?'green':'crimson';?>" style="width:80px"><?=$id+1?></td>
			<td><?=$R['name']?></td>
			<td><?=$R['username']?></td>
		</tr>
	<?php } ?>
		</tbody>

	</table>
</div>