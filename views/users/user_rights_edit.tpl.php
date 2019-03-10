<h3> User Rights </h3>
<form enctype="multipart/form-data" <?=createValidator()?>>
	
	<input type="hidden" name="id" value="<?=$id?>">
	
	<ul data-role="treeview" id="tree" data-on-treeview-create=''>
		<? foreach ($rights as $mname=>$right) { 
			if ($right['subs']) { ?>
		<li>
			<input data-role="checkbox" data-caption="<?=$mname?>" <?=(!is_numeric($right['ulrid']))?'disabled':'';?> data-indeterminate='<?=$right['indeterminate']?>'>
			<ul class="">
				<? foreach ($right['subs'] as $sname=>$sub) { 
						if ($sub['usid']) $checked = 'checked';
						else $checked = '';
					?>
				<li>
					<input data-role="checkbox" name='rights[<?=$right['menuid']?>][<?=$sub['submenuid']?>]' value=1 <?=$checked?> <?=(!is_numeric($sub['ulrid']))?'disabled':'';?> data-caption="<?=$sname?>">
				</li>
				<? } ?>
			</ul>
		</li>
		<?	} else { 
			$checked = $right['checked']; ?>
		<li>
			<input data-role="checkbox" data-caption="<?=$mname?>" name='rights[<?=$right['menuid']?>][0]' value=1 <?=$checked?> <?=(!is_numeric($right['ulrid']))?'disabled':'';?> >
		</li>
		<? 	} ?>
		<? } ?>
	</ul>

	<?=insertSaveButton('Save','users','user_rights_save','place-right');?>
</form>

<script>
	$( function() {
		$('#tree li').find('.node-toggle').each( function() {
			$(this).click();
		})
	})
</script>