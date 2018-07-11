<h3> Add Location </h3>
<form enctype="multipart/form-data" method="post" <?=VALIDATEFORM?> <?=windowOnSubmit('masters','location_save')?>>
	<?=insertHiddenInput('id',$location['id'])?>
	
	<?=insertTextInput('Name','location[name]',$location['name'],'firstfocus','Enter the location\'s name','text',1,'required|Name is required')?><br>
	
	<?=insertSelect('Company','location[companyid]','companyid','Select your company',1,'',$companies,'name|id','id|'.$location['companyid'])?><br>
	
	<?=insertSaveButton('Save');?>
</form>