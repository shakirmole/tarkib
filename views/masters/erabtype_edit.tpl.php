<h3> Add Erab Type </h3>
<form enctype="multipart/form-data" method="post" <?=createValidator()?> <?=windowOnSubmit('masters','erabtype_save')?>>
	<?=insertHiddenInput('id',$erabtype['id'])?>
	
	<?=insertTextInput('Name','erabtype[name]',$erabtype['name'],'firstfocus','Enter the erab type\'s name','text',1,'required|Name is required')?><br>
	
	<?=insertSelect('Color','erabtype[color]','color','Select your color',0,'',$colors,'name|name','name|'.$erabtype['color'])?><br>
	
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