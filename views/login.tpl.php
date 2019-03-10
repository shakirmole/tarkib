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
	<br>
	
</div>