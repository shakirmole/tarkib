<? $maxChecks = $template['checks']+1; ?>
<h3> Add Template </h3>
<form enctype="multipart/form-data" method="post" <?=VALIDATEFORM?> action="?module=associations&action=template_save" >
	<?=insertHiddenInput('id',$template['id'])?>
	
	<?=insertTextInput('Name','template[name]',$template['name'],'firstfocus','Enter the template\'s name','text',1,'required|Name is required')?><br>
	
	<?=insertSelect('Company','template[companyid]','companyid','Select your company',1,'',$companies,'name|id','id|'.$template['companyid'])?><br>
	
	<?=insertTextInput('Checks','template[checks]',$template['checks'],'','Enter the template\'s checks','number',1,'required|Checks is required','step=4 min=0')?><br>
	
	<table class='table cell-border table-border'>
		<thead>
			<tr>
				<th width=50px>SNo</th>
				<th>Timing</th>
				<th width=50px>SNo</th>
				<th>Timing</th>
				<th width=50px>SNo</th>
				<th>Timing</th>
				<th width=50px>SNo</th>
				<th>Timing</th>
			</tr>
		</thead>
		<tbody>
			<? for ($i=1;$i<($maxChecks);$i+=4) { ?>
			<tr>
				<td><?=$i?></td>
				<td>
					<? //insertTextInput('',"timing[$i]",$timings[$i],'','Enter the template\'s name','text',1,'required|Name is required','data-role="timepicker" data-seconds="false"') ?>
					<?=insertTextInput('|23:59:00',"timing[$i]",$timings[$i-1]['timing'],'','Enter the template\'s name','text',1,'required pattern=(^[0-9]{2}:[0-9]{2}:[0-9]{2}$) |Timing is required')?>
				</td>
				<td><?=$i+1?></td>
				<td>
				<?	if ( ($i+1) < $maxChecks ) { 
						echo insertTextInput('|23:59:00',"timing[$i+1]",$timings[$i]['timing'],'','Enter the template\'s name','text',1,'required pattern=(^[0-9]{2}:[0-9]{2}:[0-9]{2}$) |Timing is required');
					} ?>
				</td>
				<td><?=$i+2?></td>
				<td>
				<?	if ( ($i+2) < $maxChecks ) { 
						echo insertTextInput('|23:59:00',"timing[$i+2]",$timings[$i+1]['timing'],'','Enter the template\'s name','text',1,'required pattern=(^[0-9]{2}:[0-9]{2}:[0-9]{2}$) |Timing is required');
					} ?>
				</td>
				<td><?=$i+3?></td>
				<td>
				<? 	if ( ($i+3) < $maxChecks ) {
						echo insertTextInput('|23:59:00',"timing[$i+3]",$timings[$i+2]['timing'],'','Enter the template\'s name','text',1,'required pattern=(^[0-9]{2}:[0-9]{2}:[0-9]{2}$) |Timing is required');
					} ?>
				</td>
			</tr>
			<? } ?>
		</tbody>
	</table>
	
	<?=insertSaveButton('Save');?>
</form>