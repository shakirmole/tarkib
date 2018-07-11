<?
	
	if ( $action == 'index' ) {
		
		$tData['settings'] = $Settings->get(1);
		
		$data['content'] = loadTemplate('settings.tpl.php',$tData);
	}
	
	if ( $action == 'settings_save' ) {
		
		$upload = $_FILES['upload'];
		$miniData = $_POST['settings'];
		$miniData['modifiedby'] = USER_ID;
		
		$uploaddir = 'img/';
		if ($upload['name']) {
			$extension = pathinfo($upload["name"], PATHINFO_EXTENSION);
			$filename = 'logo.' . $extension;
			
			move_uploaded_file($upload["tmp_name"], $uploaddir . '/' . $filename);
			$miniData['logo'] = $filename;
		}
		
		$_SESSION['message'] = 'Settings Saved';
		$Settings->update(1,$miniData);
		
		redirectBack();
	}
	
	if ( $action == 'user_settings' ) {
		
		$tData['user'] = $_SESSION['member'];
		$tData['colors'] = $Colors->getAll('name');
		
		$data['content'] = loadTemplate('user_settings.tpl.php',$tData);
	}
	
	if ( $action == 'user_settings_save' ) {
		
		$uData = $_POST['user'];
		
		$_SESSION['message'] = 'Settings Saved';
		$Users->update(USER_ID,$uData);
		
		$_SESSION['member']['color'] = $_POST['user']['color'];
		redirectBack();
	}
