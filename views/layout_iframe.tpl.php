<div style="">
	<span class="dialog-close-button" onclick="dialog.close()"></span>
	<?=$content?>
</div>

<script>
	addClasses();
	maskInputs();
	<? if ($_SESSION['main_refresh']==1) { ?> createCalenders(); <? } ?>
	firstFocus();
	// $('textarea').editable({inlineMode: false})
</script>