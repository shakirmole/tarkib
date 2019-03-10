<?php

	$data['layout'] = 'layout_authenticate.tpl.php';

	if ( $action == 'login' ) {
		$tData['username'] = $_GET['username'];
	
		$data['content'] = loadTemplate('login.tpl.php',$tData);
	}
	
	if ( $action == 'dologin' ) {
		$d['username'] = cleanInput($_POST['username']);
		$d['password'] = cleanInput($_POST['password']);

		if ( empty($d['username']) or empty($d['password']) ) {
				$_SESSION['error'] = 'Invalid Username/Password';
				$data['content'] = loadTemplate('admin/login.tpl.php', $d);
				redirect('authenticate','login');
		} else {
			
			$d['password'] = hash('sha256', $d['password']);
			$userInfo = $Users->find($d);
			
			if ( empty($userInfo) or $userInfo[0]['password'] != $d['password'] ) {
				$_SESSION['error'] = 'Invalid Username/Password';
				$data['content'] = loadTemplate('admin/login.tpl.php', $d);
				
				redirect('authenticate','login','username='.$d['username']);
			} else {
				
				if ($userInfo[0]['status']) {
					$person = $Users->getPerson($userInfo[0]['id']);
					
					$_SESSION['member'] = $userInfo[0];
					$_SESSION['member']['name'] = $person['name'];
					$_SESSION['member']['type'] = $person['type'];
					$_SESSION['member']['sysid'] = $person['id'];
					
					$_SESSION['message'] = 'Successfully Logged In';
					
					redirect('home','index');
				} else {
					$_SESSION['error'] = 'Your account has been deactivated';
					
					redirectBack();
				}
			}
		}
	}
	
	if ( $action == 'logout' ) {
	
		session_destroy();
		$_SESSION['message'] = 'You have successfully logged out';
		redirect('home','index');
	}
?>