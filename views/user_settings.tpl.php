<h3> My Settings </h3>
<form enctype="multipart/form-data" <?=VALIDATEFORM?> action="?module=settings&action=user_settings_save" method="post">	
	
	<?=insertTextInput('Your Name','',USERFULLNAME,'','Your name','text',1,'','readonly')?><br>
	
	<?=insertSelect('System Color','user[color]','color','Select your system color',0,'',$colors,'name|name','name|'.$user['color'])?><br>
	
	<? if ($_SESSION['member']['type'] == 'staff'){
		if ($school['logo']) $logo = 'img/'.$school['logo'];
		echo insertFileInput('Logo','upload',$logo,'','Upload a logo',1);
	}?>
	<?=insertSaveButton('Save')?>
</form>

<script>
	$( function() {
		$('.color > option').each( function() {
			var color = $(this).val();
			$(this).addClass('fg-white bg-'+color);
		})
	})
</script>