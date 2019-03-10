
<h3> Login </h3>
<form enctype="multipart/form-data" <?=createValidator()?> action="?module=authenticate&action=dologin" method="post">	
	<?=insertTextInput('Username','username',$student['username'],'username firstfocus','Enter your username','text',1,'required|Username is required')?><br>
	
	<?=insertTextInput('Password','password','','','Enter your password','password',1,'required|Password is required')?><br>
	
	<?=insertSaveButton('Login');?>
</form>
