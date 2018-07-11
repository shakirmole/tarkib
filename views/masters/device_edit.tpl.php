<h3> Add Device </h3>

<form enctype="multipart/form-data" method="post" <?=VALIDATEFORM?> <?=windowOnSubmit('masters','device_save')?>>
	<?=insertHiddenInput('id',$device['id'])?>
	
	<?=insertTextInput('Description','device[description]',$device['description'],'firstfocus','Enter the device\'s description','text',1,'required|Description is required')?><br>
	
	<?=insertSelect('Company','','companyid','Select your company',0,1,$companies,'name|id','id|'.$device['companyid'])?><br>
	
	<?=insertSelect('Location','device[locationid]','locationid','Select your location',0,0,$locations,'name|id','id|'.$device['locationid'])?><br>
	
	<?=insertSaveButton('Save');?>
</form>


<script>	
	function getLocations(obj) {
		var companyid = $(obj).val();						
		
		if (companyid) {
			$.get('?module=masters&action=getLocations&format=json&companyid='+companyid,null,function(d){
				CC = JSON.parse(d);
				t = $('.locationid').get(0);
				t.options.length=0;
				for(i=0;i<CC.length;i++) {
					$('.locationid').append($('<option>', {value:CC[i].id, text:CC[i].name}));
				}
				<? if ($device) { ?> $('.locationid').val(<?=$device['locationid']?>);	<? } ?>
			});
		}
		
	}

	function disableDropdown(obj) {
		curval = $(obj).val();
		if (curval) { //if an option is selected
			$(obj).find('option').each(function(){ //loop and remove all other options
				if ($(this).val() != curval) {
					$(this).remove();
				}
			});
		}
	}
	
	$( function() {
		<? if ($device) { ?>
			disableDropdown($('.companyid'));
			getLocations($('.companyid'));
		<? } ?>
		$(document).on('change', '.companyid', function(){    
			disableDropdown($('.companyid'));
			getLocations(this);
		});
	});
</script>