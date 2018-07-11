<script>
function triggerError(msg) {
	var notify = Metro.notify;
	notify.setup({	timeout: 5000, duration: 500 });
	notify.create(msg, "", { cls: "alert" });
	notify.reset();
}

function triggerMessage(msg, o) {
	var notify = Metro.notify;
	notify.setup({ timeout: 5000, duration: 100  });
	notify.create(msg, "", { cls: "success" });
	notify.reset();
}

function addClasses() {
	$('.table th').addClass('<?=TableHead.' '.TableHeadText?>');
	$('input:button,input:submit,.button,.current').addClass('button <?=ButtonBkgText?>');
	$('[class^=mif-]').addClass('fg-<?=COLOR?>');
	$('[class^=app-bar-]').addClass('bg-<?=COLOR?>');
	$('*[data-validate-func="required"]').addClass('bd-red');
	$('fieldset').addClass('bd-lightGray p-5');
	$('.input-clear-button').remove();
	
	$('.sp_icon').removeClass('fg-<?=COLOR?>');
	$('.sp_button').removeClass('<?=ButtonBkgText?>');
}

function createCalenders() { //partly outdated
	$(".datepicker").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "fade", // none, slide, fade
		position: "bottom", // top or bottom,
	});
	
	$(".resdatepicker").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "fade", // none, slide, fade
		position: "bottom", // top or bottom,
		minDate: '<?=date('Y-m-d',strtotime('yesterday'))?>',
		minYear: '<?=date('Y',strtotime('yesterday'))?>',
	});
	
	$(".dobdatepicker").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "fade", // none, slide, fade
		position: "bottom", // top or bottom,
		maxDate: '<?=date('Y-m-d')?>'
	});
}

function openWindow(link) {
	var mDialog = Metro.dialog;
	mDialog.create({
		title: "",
		content: '<div>Loading...</div>',
		overlayClickClose: true,
		width: 900,
		height: 600,
		defaultAction: false
	});

	reloadWindowContent(link);
}

function reloadWindowContent(link) {
	$('.dialog-content').load(link);
}

function print(div) {
	var mywindow = window.open('', 'PRINT', 'height=400,width=600');
	var css = "<link rel='stylesheet' href='css/metro.css' type='text/css' />";
	
    mywindow.document.write('<!DOCTYPE html><html><head><title>' + document.title  + '</title>');
    mywindow.document.write(css);
    mywindow.document.write('</head><body>');
    mywindow.document.write(document.getElementById(div).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    // mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();

    return true;
}

function firstFocus() {
	$('.firstfocus').focus();
}

$(function(){
	try {
		<?php if ( $error ) { echo 'triggerError("'.$error.'",null)'; } ?>;
		<?php if ( $message ) { echo 'triggerMessage("'.$message.'",null)'; } ?>;
	}
	catch (e) {}
	
	addClasses();
	createCalenders();
	firstFocus();
	<? if ($autoopen) { ?>
		openWindow('<?=$autoopen?>');
	<? } ?>
	// $('textarea').editable({inlineMode: false})
});

var cmdirect = 1; var cdirect = 1;
function submitForm(form,url) {
	
	if ( FIC_checkForm(form) ) { } else {
		triggerError("Please check the highlighted fields");
		return false;
	}
	
	formdata = $(form).closest('form').serialize();	
	
	//replace submit with loading
	if ($('.submit').hasClass('place-right')) var oclass = 'place-right'; else var oclass = '';
	$('.submit').replaceWith('<button onclick="return false;" class="button '+oclass+' warning"><span class="mif-spinner2 mif-ani-spin"></span> Loading</button>');
	
	$.post(url+"&format=json", formdata,function(d){
		CC = $.parseJSON(d);				
		
		if (CC[0].status) {
			triggerMessage(CC[0]['msg']);
			if (cmdirect) {
				$('#maincontent').load(CC[0].mainredirect, function(){
					if (CC[0].redirect && cdirect) reloadWindowContent(CC[0].redirect);
				});
				} else {
				if (CC[0].redirect) reloadWindowContent(CC[0].redirect);
			}
			
			} else {
			triggerError(CC[0]['msg']);
		}
		
	});
}

function replaceSubmit(form) {
	$(form).find('.submit').replaceWith('<button onclick="return false;" class="button warning"><span class="mif-spinner2 mif-ani-spin"></span> Loading</button>');
}

$(document).on('submit','form.window-form',function(){
	return false;
})

function notifyOnErrorInput(input){
	var message = input.data('validateHint');
	triggerError(message);
	// input.focus();
}
</script>