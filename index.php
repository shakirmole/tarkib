<?php
	/* Ya Aba Salehul Mahdi Adrikni */
	/* BUL BAL BUL */
	session_start();
	error_reporting(0);
	// date_default_timezone_set('Asia/Tehran');
	require_once 'idiorm.php';
	require_once 'functions.php';	
	require_once 'db.php';
	require_once 'cfg/database.php';
	
	$controllers = 'controllers/';
	
	$default_module = 'home';
	$default_action = 'index';
	$data['title'] = 'Tarkib System';
	$layout = 'layout.tpl.php';
	
	$module = $_GET['module'];
	$action = $_GET['action'];
	$action = str_replace ( '.html', '', $action );
	$format = $_GET['format'];
		
	if ( empty($module) ) $module = $default_module;
	if ( empty($action) ) $action = $default_action;
	if ( is_numeric($_GET['main_refresh']) ) {
		$_SESSION['main_refresh'] = $_GET['main_refresh'];
	}
	else $_SESSION['main_refresh'] = 1;
	
	$member = $_SESSION['member'];
	if ( (empty($member) && $module != 'authenticate' ) ) {		
		$module = 'authenticate';
		$action = 'login';
	}
	
	spl_autoload_register( function ($class_name) {
		$file = 'models/'. strtolower($class_name) . '.php';
		if( file_exists( $file ) ) require $file;
	} );
	require_once 'instantiate.php';
	
	if ( !empty($member) ) {
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

	$settings = $Settings->get(1);
	define('LOGO',$settings['logo']);
	define('TODAY', date('Y-m-d'));
	define('NOW', date('Y-m-d H:i:s'));

	if ( $format == 'json' ) $action = 'ajax_' . $action;

	if(empty($data['message'])) $data['message'] = $_SESSION['message'];
	if(empty($data['error'])) $data['error'] = $_SESSION['error'];
	if(empty($data['autoopen'])) $data['autoopen'] = $_SESSION['autoopen'];
	
	if ( file_exists ( $controllers . $module . '.php' ) ) {
		require $controllers . $module . '.php';
	}
	
	$data['module'] = $module;
	$data['action'] = $action;
		
	$_SESSION['menus'] = array();

	if (USERTYPE == 'admin') {
		$menus = $UserLevelRights->getLevelRights(1);
		foreach ($menus as $m) {
			if ($m['sname']) $_SESSION['menus'][$m['mname']]['subs'][$m['sname']] = $m;
			$_SESSION['menus'][$m['mname']]['module'] = $m['mmod'];
			$_SESSION['menus'][$m['mname']]['action'] = $m['mact'];
		}
	} else if ($_SESSION['member']['id']) {		
		if ($_SESSION['member']['utypeid']) $right = $UserRights->getUserRights($_SESSION['member']['id'],$module,$action);
		$trace = $Menus->getAllMenus($module,$action);	
		
		if (!$right[0]['umid'] & $trace) { 
			if ($module != 'home') {
				$_SESSION['error'] = 'Unauthorized Entry';
				redirect('home','index'); 
			}
		}

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