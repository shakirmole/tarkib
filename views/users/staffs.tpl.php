<h2> Staffs </h2>

<div>
	<span class="place-right"> <a class="button" href="#" onclick="openWindow('?module=users&action=staff_add')"> Add </a> </span>
	<form method="GET" class='no-visible' <?=VALIDATEFORM?>>
		<input type="hidden" name="module" value="users">
		<input type="hidden" name="action" value="staffs">
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
				<th>Email</th>
				<th>Company</th>
				<th>Username</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($users as $id=>$R) { ?>
		<tr>
			<td nowrap style="width:80px">
				<a href="#" onclick="openWindow('?module=users&action=staff_edit&id=<?=$R['id']?>')"><span class="mif-pencil"></a>
				<? if (USERTYPE=='admin') { ?><a href="#" onclick="openWindow('?module=users&action=user_rights_edit&id=<?=$R['userid']?>')"><span class="mif-user"></a> <? } ?>
			</td>
			<td class="fg-white bg-<?=($R['status'])?'green':'crimson';?>" style="width:80px"><?=$id+1?></td>
			<td><?=$R['name']?></td>
			<td><?=$R['mobile']?></td>
			<td><?=$R['email']?></td>
			<td><?=$R['company']?></td>
			<td><?=$R['username']?></td>
		</tr>
	<?php } ?>
		</tbody>

	</table>
</div>