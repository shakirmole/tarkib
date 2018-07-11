<h3 class=''> Import Students </h3>

<form method='post' enctype="multipart/form-data" action='?module=users&action=import_students_file'>
	<label>Upload File</label>
	<input type='file' name='upload'>
	
	<input type='submit' value='Upload'>
</form>
<a href='?module=users&action=download_template'>Download Template</a>
<br><br>*<small>Please add the standards and divisions before uploading</small>
<? if ($students) { ?>
	<hr>
	<form method='post' enctype="multipart/form-data" action='?module=users&action=import_students_save'>
		<div>
			<table class='table table-border cell-border row-hovered'>
				<thead>
					<tr>
						<th>Name</th>
						<th>Mobile</th>
						<th>Email</th>
						<th>Regno</th>
						<th>Grade</th>
						<th>Division</th>
						<th>Username <br> <small class='place-right'>*Default pass is 123</small></th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($students as $v=>$r) { ?>
						<tr>
							<td>
								<?=insertTextInput('|Name','name[]',$r['name'],'','Enter the students\'s name','text',1,'required|Name is required')?>
							</td>
							<td>
								<?=insertTextInput('|Mobile','mobile[]',$r['mobile'],'','Enter the students\'s mobile','text',1,'|Mobile is required')?>
							</td>
							<td>
								<?=insertTextInput('|Email','email[]',$r['email'],'','Enter the students\'s email','email',1,'|Email is required')?>
							</td>
							<td>
								<?=insertTextInput('|Reg No','regno[]',$r['regno'],'','Enter the students\'s reg no','text',1,'required|Reg no is required')?>
							</td>
							<td>
								<?=insertSelect('','gradeid[]','','Select the grade',1,0,$grades,'name|id','id|')?>
							</td>
							<td>
								<?=insertSelect('','divisionid[]','','Select the division',1,0,$divisions,'name|id','id|')?>
							</td>
							<td>
								<?=insertTextInput('|Username','username[]',$r['username'],'username','Enter a unique username','text',1,'required|Username is required')?>
							</td>
						</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
		<?=insertSaveButton('Import','','','','return checkDuplicates()');?>
	</form>
<? } ?>

<script>
	var usernames = [
	<?php foreach ($usernames as $u) { ?>"<?=trim($u['username'])?>",<?php } ?>
	];
			
	function checkDuplicates() {
		var valid = true;
		$('.username').css("background-color",'white');
        $.each($('.username'), function (index1, item1) {
            $.each($('.username').not(this), function (index2, item2) {
                if ($(item1).val() == $(item2).val()) {
                    $(item1).css("background-color", "red");
					$(item1).focus();
                    valid = false;
				}
			});
		});
		
		if (!valid) triggerError('Duplicate(s) Found');
		else {
			$('.username').each(function() {
				var username = $(this).val();
				for (i=0;i<usernames.length;i++) {
					if ($.inArray( username, usernames ) >= 0 ) {
						triggerError('Username taken - new one assigned');
						var rusername =  username + (1 + Math.floor(Math.random() * 100));
						$(this).val(rusername);
						break;
					}
				}
			})
		}
        return valid;
	}
</script>