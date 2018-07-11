<?php
	/* Ya Aba Salehul Mahdi Adrikni */
	/* BUL BAL BUL */
	session_start();
	// error_reporting(0);
	// date_default_timezone_set('Asia/Tehran');
	include 'cfg/database.php';
	include 'functions.php';	
	include 'db.php';
	
	$controllers = 'controllers/';
	$models = 'models/';
	$default_module = 'home';
	$default_action = 'index';
	$data['title'] = 'Alert System';
	$layout = 'layout.tpl.php';
	
	$module = $_GET['module'];
	$action = $_GET['action'];
	$action = str_replace ( '.html', '', $action );
	$format = $_GET['format'];
		
	
	if ( empty($module) ) $module = $default_module;
	if ( empty($action) ) $action = $default_action;
	
	// validate login of user
	$member = $_SESSION['member'];
	if ( (empty($member) && $module != 'authenticate' ) ) {		
		$module = 'authenticate';
		$action = 'login';
	}
	
	/* Include all models */
	loadDir($models);
	//Instantiate the classes;
	include 'instantiate.php';

	// --------------------------------		
	if ( !empty($member) ) {
		// Define some global constants
		define('MEMBER_LOGGEDIN',true);
		define('USER_ID',$_SESSION['member']['id']);
		define('USERFULLNAME',$_SESSION['member']['name']);
		define('USERTYPE',$_SESSION['member']['type']);
		define('COLOR',$_SESSION['member']['color']);
	}
	else {
		define('USER_ID','');
		define('COLOR','green');
	}
	$data['sidebar'] = loadTemplate('sidebar.tpl.php', $data);
	
	define('TODAY', date('Y-m-d'));
	define('NOW', date('Y-m-d H:i:s'));
	define('VALIDATEFORM','data-role="validator" data-on-error="notifyOnErrorInput" data-show-error-hint="true"');

	if ( $format == 'json' ) $action = 'ajax_' . $action;

	if(empty($data['message'])) $data['message'] = $_SESSION['message'];
	if(empty($data['error'])) $data['error'] = $_SESSION['error'];
	if(empty($data['autoopen'])) $data['autoopen'] = $_SESSION['autoopen'];
	
	if ( file_exists ( $controllers . $module . '.php' ) ) {
		include $controllers . $module . '.php';
	}
	
	$data['module'] = $module;
	$data['action'] = $action;
		
	$_SESSION['menus'] = '';
	
	if ($_SESSION['member']['utypeid']) $right = $UserLevelRights->getLevelRights($_SESSION['member']['utypeid'],$module,$action);
	else $right = $UserLevelRights->getLevelRights(0,$module,$action);
	$trace = $Menus->getAllMenus($module,$action);	
	
	if (!$right & $trace) { $_SESSION['error'] = 'Unauthorized Entry'; redirect('home','index'); }
		
	if (USERTYPE == 'admin') {
		$menus = $Menus->getAllMenus();
		// $menus = $UserLevelRights->getLevelRights(0);
		foreach ($menus as $m) {
			if ($m['sname']) $_SESSION['menus'][$m['mname']]['subs'][$m['sname']] = $m;
			$_SESSION['menus'][$m['mname']]['module'] = $m['mmod'];
			$_SESSION['menus'][$m['mname']]['action'] = $m['mact'];
		}
	} else {
		// $menus = $UserLevelRights->getLevelRights($_SESSION['member']['utypeid']);
		$menus = $UserRights->getUserRights($_SESSION['member']['id']);
		foreach ((array)$menus as $m) {
			if ($m['sname'] && $m['usid']) $_SESSION['menus'][$m['mname']]['subs'][$m['sname']] = $m;
			if ($m['umid']) {
				$_SESSION['menus'][$m['mname']]['module'] = $m['mmod'];
				$_SESSION['menus'][$m['mname']]['action'] = $m['mact'];
			}
		}
	}
		
    define('TableHead','bg-'.COLOR);
    define('TableHeadText','fg-white');
	define('ButtonBkgText','fg-white bg-'.COLOR);
	
	$data['menu'] = loadTemplate('menu.tpl.php', $data);
	
	//Validation Shortcuts
	if ( empty($data['pagetitle']) ) 	$data['pagetitle'] = $pagetitle;
	if ( empty($data['layout']) ) 	$data['layout'] = $layout;
	
	if ( $format == 'none' ) {
		$data['layout'] = 'layout_iframe.tpl.php';
		
		global $templateData;		
		$data['content'] .= '<script>window.print();</script>';
		$templateData['content'] = $data['content'];
	}
	
	if ( $format == 'json' ) echo json_encode($data['content']);
	else echo loadTemplate($data['layout'], $data);

	
	if ( $_SESSION['message'] ) $_SESSION['message'] = '';
	if ( $_SESSION['error'] ) $_SESSION['error'] = '';
	if ( $_SESSION['autoopen'] ) $_SESSION['autoopen'] = '';
	
	//AL HAMDU LILLAH;;
?>