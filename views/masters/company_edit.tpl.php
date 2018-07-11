<? if (!$company) $company['maxworkers'] = $settings['maxworkers']; ?>

<h3> Add Company </h3>

<form enctype="multipart/form-data" method="post" <?=VALIDATEFORM?> <?=windowOnSubmit('masters','company_save')?>>
	<?=insertHiddenInput('id',$company['id'])?>
	
	<?=insertTextInput('Name','company[name]',$company['name'],'firstfocus','Enter the company\'s name','text',1,'required|Name is required')?><br>
	
	<?=insertTextArea('Description','company[description]',$company['description'],'','Enter the company description',1,200,'required|Company details is required')?><br>
	
	<?=insertTextInput('Max Workers','company[maxworkers]',$company['maxworkers'],'','Enter the company\'s max workers','number',1,'required|Name is required')?><br>
	
	<?=insertSaveButton('Save');?>
</form>