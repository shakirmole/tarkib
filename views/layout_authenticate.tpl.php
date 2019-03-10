<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Shakir Moledina">
		
		<title><?=$title?></title>
		
		<link rel="stylesheet" href="css/metro.css">
		<link rel="stylesheet" href="css/style.css">
		<link href="css/select2.main.css" media="screen" rel="stylesheet" type="text/css"/>
		<link href="css/select2.css" media="screen" rel="stylesheet" type="text/css"/>
		<script src="js/jquery.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body class="">
		<div id="maincontent">
			<div class="bg-white mb-20">
				<div class="grid">
					<div class="row">
						<div class="cell">
							<?=$content?>
						</div>
					</div>
				</div>
				
				<div data-role="dialog" id="dialog"></div>

			</div>
			
		</div>
		<div class="bg-logo">
			
		</div>

		<span class='logo'>
			<img src='img/<?=LOGO?>' class='logo-img'>
		</span>
				
		<? include_once('js/scripts.js'); ?>
		<script src="js/custom.js"></script>
		<script src="js/select2.js"></script>
		<script src="js/maskinput.js"></script>
		
		<!-- Metro UI CSS JavaScript plugins -->
		<script src="js/metro.js"></script>
	</body>
</html>