<html>
	<head>
		<title><?=$title?></title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/metro.css">
		<script src="js/jquery.min.js"></script>
	</head>
	<body class="metro">
		<? 
			define('BkgText','bg-darkCyan fg-white');
		?>
		
		<div class='container-login'>
			<form class="login-form bg-white p-6 mx-auto border bd-default win-shadow" method="post" action="<?=url('authenticate','dologin')?>">
				<h2 class="text-light">LOGIN</h2>
				<hr class="thin mt-4 mb-4 bg-white">
				<div class="form-group">
					<input type="text" name='username' data-role="input" data-prepend="<span class='mif-user'>" placeholder="Username" data-clear-button='false' data-validate="required">
				</div>
				<div class="form-group">
					<input type="password" name='password' data-role="input" data-prepend="<span class='mif-key'>" placeholder="Password" data-clear-button='false' data-validate="required">
				</div>
				<div class="form-group mt-10">
					<input type="submit" class="<?=BkgText?> button" value="Login">
				</div>
			</form>
		</div>
		
		<script type='text/javascript'>
			function triggerError(msg) {
				var notify = Metro.notify;
				notify.setup({
					timeout: 5000,
				});
				notify.create(msg, "", {
					cls: "alert"
				});
				notify.reset();
			}
			
			function triggerMessage(msg, o) {
				var notify = Metro.notify;
				notify.setup({
					timeout: 5000,
				});
				notify.create(msg, "", {
					cls: "success"
				});
				notify.reset();
			}
			
			$(function(){
				try {
					<?php if ( $error ) { echo 'triggerError("'.$error.'",null)'; } ?>;
					<?php if ( $message ) { echo 'triggerMessage("'.$message.'",null)'; } ?>;
				}
				catch (e) {}
			});
		</script>
		
		<script src="js/metro.js"></script>
	</body>
</html>