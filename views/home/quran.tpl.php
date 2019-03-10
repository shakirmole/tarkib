<div class='shifted-content'> 
	<h1> قرآن </h2>
	<br>

	<form enctype="multipart/form-data" <?=createValidator()?> action="?module=home&action=index" method="get">	
		<div class="grid">
			<div class="row">
				<div class="cell-5">
					<?=insertSelect('سورة','suraid','suraid','Select your sura',1,'',$suras,'name|id','id|'.$suraid)?><br>
				</div>
				<div class="cell-5">
					<?=insertSelect('آیة','verseid','verseid','Select your verse',0,'',$verses,'verseno|id','id|'.$verseid)?><br>
				</div>
				<div class="cell-2">
					<br>
					<?=insertSaveButton('جستجو')?>
				</div>
			</div>
			<div class="row">
				<div class="cell" dir="rtl">
					<? foreach ($words as $v=>$word) { ?>
					<a href="#" class="button sp_button outline">
						<?=insertRadioInput($word,'word[]',$word,'','Use this','','1|')?>
					</a>
					<? } ?>
				</div>
			</div>
		</div>
	</form>
	<div class="">
		<button class="button square pos-absolute pos-top-left" id="sidebar-toggle">
			<span class="mif-pencil sp_icon"></span>
		</button>
	</div>
</div>

	<aside class="sidebar pos-absolute z-2" data-role="sidebar" data-toggle="#sidebar-toggle" data-shift=".shifted-content">
		<div class='p-5'>
			<? foreach ($tarkibTypes as $tarkibType) { ?>
				<a href="#" class="button sp_button outline">
					<?=insertRadioInput($tarkibType['name'],'tt[]',$tarkibType['name'],'','Use this','','1|')?>
				</a>
			<? } ?>
		</div>
	</aside>


<script>
	function getVerses(obj) {
		var suraid = $(obj).val();						
		
		if (suraid) {
			$.get('?module=home&action=getVerses&format=json&suraid='+suraid,null,function(d){
				CC = JSON.parse(d);
				$('.verseid').get(0).options.length = 0;
				$('.verseid').val(1);
				for(i=0;i<CC.length;i++) {
					$('.verseid').append($('<option>', {value:CC[i].id, text:CC[i].verseno}));
				}
				$('.verseid').select2(); //reinitialize
			});
		}
	}
	
	$( function() {
		$('.verseid').select2();
		$(document).on('change', '.suraid', function(){    
			getVerses(this);
		});
	});
</script>