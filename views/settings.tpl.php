<h3> Settings </h3>
<form enctype="multipart/form-data" <?=createValidator()?> action="?module=settings&action=settings_save" method="post">	
	
	<?=insertTextInput('Company Name','settings[company]',$settings['company'],'','Enter the company name','text',1,'required|Company name is required')?><br>
	
	<?=insertTextArea('Company Details','settings[details]',$settings['details'],'','Enter the company details',1,200,'required|Company details is required')?><br>
	
	<? if ($settings['logo']) $logo = 'img/'.$settings['logo']; ?>
	<?=insertFileInput('Logo','upload',$logo,'','Upload a logo',1)?>
	
	<br>
	
	<?=insertSaveButton('Save')?>

</form>