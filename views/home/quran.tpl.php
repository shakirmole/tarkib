<div class=''> 
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
						<?=insertCheckboxInput($word,'word[]',$word,'word','Use this','normal','1|')?>
					</a>
					<? } ?>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="example text-center mb-20">
	<button class="button edit-tarkib">ترکیب</button>
</div>
<div data-role="charms" class='tarkib-charm bg-white' data-position="bottom">
	
	<button class="button bd-white close-tarkib place-right" style='z-index:10'><span class="mif-cross sp_icon fg-white"></span></button>	
	<ul data-cls-tabs="flex-justify-center" data-role="tabs" data-expand="true">
		<li class='bg-<?=COLOR?> fg-white'><a href="#word-type">کلمة</a></li>		
		<li class='bg-<?=COLOR?> fg-white'><a href="#erab-type">اعراب</a></li>
	</ul>
	<div class="border bd-default no-border-top p-2">
		<div id="word-type">
			<ul data-cls-tabs="flex-justify-center" data-role="tabs" data-expand="true">
				<? foreach ($wordTypes as $wordType) { ?>
				<li class='bg-<?=COLOR?> fg-white'><a href="#word-type-<?=$wordType['id']?>"><?=$wordType['name']?></a></li>
				<? } ?>
			</ul>
			<div class="border bd-default no-border-top p-2">
				<? foreach ($wordTypes as $wordType) { ?>
				<div id="word-type-<?=$wordType['id']?>" class='fg-black'>
					<? foreach ($wordTarkibTypes as $wtt) { ?>
						<span class='tally'><?=$wtt[$wordType['id']]['name']?></span>
					<? } ?>
				</div>
				<? } ?>
			</div>
		</div>
		<div id="erab-type">
			<ul data-cls-tabs="flex-justify-center" data-role="tabs" data-expand="true">
				<? foreach ($erabTypes as $erabType) { ?>
				<li class='bg-<?=COLOR?> fg-white'><a href="#erab-type-<?=$erabType['id']?>"><?=$erabType['name']?></a></li>
				<? } ?>
			</ul>
			<div class="border bd-default no-border-top p-2">
				<? foreach ($erabTypes as $erabType) { ?>
				<div id="erab-type-<?=$erabType['id']?>" class='fg-black'>
					<? foreach ($erabTarkibTypes as $ett) { ?>
						<span class='tally'><?=$ett[$erabType['id']]['name']?></span>
					<? } ?>
				</div>
				<? } ?>
			</div>
		</div>
	</div>
	
	<!--
	<div data-role="accordion">
		<div class="frame">
			<div class="heading bg-<?=COLOR?>">کلمة</div>
			<div class="content">
				<div class="fg-black p-2">
					<div data-role="accordion">
						<? foreach ($wordTypes as $wordType) { ?>
						<div class="frame">
							<div class='heading bg-<?=COLOR?> fg-white'><?=$wordType['name']?></div>
							<div class='content'>
								<? foreach ($wordTarkibTypes as $wtt) { ?>
									<?=$wtt[$wordType['id']]['name']?>
								<? } ?>
							</div>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="frame">
			<div class="heading bg-<?=COLOR?>">اعراب</div>
			<div class="content">
				<div class="fg-black p-2">
					<div data-role="accordion">
						<? foreach ($erabTypes as $erabType) { ?>
						<div class="frame">
							<div class='heading bg-<?=COLOR?> fg-white'><?=$erabType['name']?></div>
							<div class='content'>
								<? foreach ($erabTarkibTypes as $ett) { ?>
									<?=$ett[$erabType['id']]['name']?>
								<? } ?>
							</div>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
								-->
</div>

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
	});

	$(document).on('change', '.suraid', function(){    
		getVerses(this);
	});
	$(document).on('click', '.edit-tarkib', function(){    
		$('.tarkib-charm').data('charms').toggle();
	});
	$(document).on('click', '.close-tarkib', function(){    
		$('.tarkib-charm').data('charms').close();
	});
	
</script>