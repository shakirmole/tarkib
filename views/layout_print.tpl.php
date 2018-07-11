<html>
	<head>
		<title><?=$title?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="author" content="Ahadith" />
		
		<link rel="stylesheet" href="css/metro.css">
		<link rel="stylesheet" href="css/metro-responsive.css">
		<link rel="stylesheet" href="css/metro-icons.css">
		<link rel="stylesheet" href="css/metro-schemes.css">
		<link rel="stylesheet" href="css/metro-rtl.css">
		<link rel="stylesheet" href="css/metro-colors.css">
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/froala_page.min.css" rel="stylesheet" type="text/css">
		<link href="css/froala_editor.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/style.css">
		<link href="css/StyleSheet.css" media="screen" rel="stylesheet" type="text/css"/>
		
		<script>
		  window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')
		</script>
		<!-- Metro UI CSS JavaScript plugins -->
		<script src="js/towords.js"></script>
		<script src="js/metro.js"></script>
		
		<style>
			.table th { padding: 0.5rem !important; }
			.table td { padding: 0rem 0.3rem !important; }
			.input-control input { border:  !important}
			.row { margin: 0 !important}
		</style>
	</head>
	<body class="">
	<div id="maincontent">
		<?=$content?>
	</div>
	
	<script>
	addClasses();
	function addClasses() {
		$('.table th').addClass('<?=TableHead.' '.TableHeadText?>');
		$('input:button,input:submit,.button').addClass('<?=ButtonBkgText?>');
		
		$('.sp_button').removeClass('<?=ButtonBkgText?>');
	}
	</script>
	</body>
</html>