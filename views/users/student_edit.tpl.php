<? if (!$student) $student['status'] = 1; ?>
<h3> Add Student </h3>
<form enctype="multipart/form-data" method="post" <?=createValidator()?> <?=windowOnSubmit('users','student_save','checkUsername();')?>>
	<?=insertHiddenInput('id',$student['id'])?>
	<?=insertHiddenInput('userid',$student['userid'])?>
	
	<div class='grid'>
		<div class='row'>
			<div class='cell'>
				<?=insertTextInput('Name','student[name]',$student['name'],'firstfocus','Enter the students\'s name','text',1,'required|Name is required')?><br>
			</div>
		</div>
		<div class='row'>
		
		</div>
	</div>
		
	<?=insertCheckboxInput('Active','user[status]',1,'','Is an active user','switch',$student['status'].'|1','','place-right')?><br>

	<?=insertTextInput('Username','user[username]',$student['username'],'username','Enter a unique username','text',1,'required|Username is required')?><br>
	
	<?=insertTextInput('Password','user[password]','','','Enter a strong password','password',1,'|Password is required')?><br>
	
	<?=insertSaveButton('Save');?>
</form>

<script>
	function checkUsername() {
		var usernames = [
		<?php foreach ($usernames as $u) { ?>"<?=trim($u['username'])?>",<?php } ?>
		];
		var username = $.trim($('.username').val());
		
		if (username) {
			for (i=0;i<usernames.length;i++) {
				if ($.inArray( username, usernames ) >= 0 ) {
					triggerError('Duplicate username - new one assigned');
					var rusername =  username + (1 + Math.floor(Math.random() * 100));
					$('.username').val(rusername).focus();
					break;
					return false;
				}
			}
			return true;
		}
	}
	
	$( function(){
		$(document).on('change blur', '.username', function(){    
			checkUsername();
		})
	})
</script>