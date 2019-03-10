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

function emptySelectInput(selector){
	t = $(selector).get(0);
	t.options.length=0;
}

function getUnmaskedFloatValue(selector) {
	var cleanValue = parseFloat($(selector).inputmask('unmaskedvalue'));

	if (isNaN(cleanValue)) {
		cleanValue = 0;
	}
	return cleanValue;
}

function calculateFieldTotal(field) {
	var total = 0;
	$('.'+field).each(function(){
		total += getUnmaskedFloatValue(this);
	})
	return total;
}