<h3> Add Worker </h3>

<form enctype="multipart/form-data" method="post" <?=VALIDATEFORM?> action="?module=masters&action=worker_save" >
	<?=insertHiddenInput('id',$worker['id'])?>
	
	<?=insertTextInput('Name','worker[name]',$worker['name'],'firstfocus','Enter the worker\'s name','text',1,'required|Name is required')?><br>
	
	<?=insertTextInput('Mobile <small> +255 0XXX XXXXXX </small>|Mobile','worker[mobile]',$worker['mobile'],'','Enter the worker\'s mobile','text',1,'required pattern=(^[0-9]{9}$)| Enter 9 digits only')?><br>
	
	<?=insertSelect('Company','companyid','companyid','Select your company',0,1,$companies,'name|id','id|'.$worker['companyid'])?><br>
	
	<?=insertSelect('Location','worker[locationid]','locationid','Select your location',0,0,$locations,'name|id','id|'.$worker['locationid'])?><br>
	
	<? if ($worker['photo']) $imagepath = 'img/'.$worker['companyid'].'/'.$worker['photo']; ?>
	<?=insertFileInput('Photo','photo',$imagepath,'','Upload an Image')?> <br>
	
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
				<? if ($worker) { ?> $('.locationid').val(<?=$worker['locationid']?>);	<? } ?>
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
		<? if ($worker) { ?>
			disableDropdown($('.companyid'));
			getLocations($('.companyid'));
		<? } ?>
		$(document).on('change', '.companyid', function(){    
			disableDropdown($('.companyid'));
			getLocations(this);
		});
	});
</script>