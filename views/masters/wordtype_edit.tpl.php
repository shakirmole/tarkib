<h3> Add Word Type </h3>
<form enctype="multipart/form-data" method="post" <?=createValidator()?> <?=windowOnSubmit('masters','wordtype_save')?>>
	<?=insertHiddenInput('id',$wordtype['id'])?>
	
	<?=insertTextInput('Name','wordtype[name]',$wordtype['name'],'firstfocus','Enter the erab type\'s name','text',1,'required|Name is required')?><br>
	
	<?=insertSelect('Color','wordtype[color]','color','Select your color',0,'',$colors,'name|name','name|'.$wordtype['color'])?><br>
	
	<?=insertSaveButton('Save');?>
</form>

<script>
	$( function() {
		$('.color > option').each( function() {
			var color = $(this).val();
			$(this).addClass('fg-white bg-'+color);
		})
	})
</script>