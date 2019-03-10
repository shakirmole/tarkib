<html>
	<head>
		<title><?=$title?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="author" content="Ahadith" />
		
		<link rel="stylesheet" href="css/metro.css">
		<link rel="stylesheet" href="css/style.css">
		<link href="css/datatables.css" media="screen" rel="stylesheet" type="text/css"/>
		<link href="css/select2.main.css" media="screen" rel="stylesheet" type="text/css"/>
		<link href="css/select2.css" media="screen" rel="stylesheet" type="text/css"/>
		
		<!-- Metro UI CSS JavaScript plugins -->
		<script src="js/jquery.js"></script>
		<script src="js/towords.js"></script>
		<script src="js/metro.js"></script>
		<script src="js/maskinput.js"></script>
		<script src="js/custom.js"></script>
		
		<style>
			.table th { padding: 0.5rem !important; }
			.table td { padding: 0rem 0.3rem !important; }
			.input-control input { border:  !important}
			.row { margin: 0 !important}
			@media print{
				.d-print-none{
					display:none;
				}
				div.footer {
					position: fixed;
					bottom: 0;
				}
			}
			@media screen {
				div.footer {
					display: none;
				}
			}
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