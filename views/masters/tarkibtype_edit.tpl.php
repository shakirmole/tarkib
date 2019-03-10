<h3> Add Tarkib Type </h3>
<form enctype="multipart/form-data" method="post" <?=createValidator()?> <?=windowOnSubmit('masters','tarkibtype_save')?>>
	<?=insertHiddenInput('id',$tarkibtype['id'])?>
	
	<?=insertTextInput('Name','tarkibtype[name]',$tarkibtype['name'],'firstfocus','Enter the tarkib type\'s name','text',1,'required|Name is required')?><br>
	
	<?=insertSelect('Word Type','tarkibtype[wordtypeid]','wordtypeid','Select your word type',0,'',$wordtypes,'name|id','id|'.$tarkibtype['wordtypeid'])?><br>

	<?=insertSelect('Erab Type','tarkibtype[erabtypeid]','erabtypeid','Select your erab type',0,'',$erabtypes,'name|id','id|'.$tarkibtype['erabtypeid'])?><br>
	
	<?=insertSaveButton('Save');?>
</form>