<?
$folder = 'users/';

if ( $action == 'students' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['students'] = $Students->search($tData['name']);
	
	$data['content'] = loadTemplate($folder.'students.tpl.php',$tData);
}

if ( $action == 'student_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['student'] = $Students->getDetails($id);	
	
	$action = 'student_add';
}

if ( $action == 'student_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['usernames'] = $Users->getUsernames($tData['student']['userid']);
	
	$data['content'] = loadTemplate($folder.'student_edit.tpl.php',$tData);
}

if ( $action == 'ajax_student_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$userid = intval($_POST['userid']);
	$miniData = $_POST['student'];
	$uData = $_POST['user'];
	
	if (!$uData['status']) $uData['status'] = 0;
	if ($uData['password']) $uData['password'] = hash('sha256',$uData['password']);
	else unset($uData['password']);
	$uData['name'] = $miniData['name'];
	
	$utype = $UserTypes->getDetails('student');
	$uData['utypeid'] = $utype['id'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
	
		$Users->insert($uData);
		$miniData['userid'] = $Users->lastId();
		
		$Students->insert($miniData);
		
		$obj->msg='Student Added';
		$obj->status=1;
		$obj->redirect='?module=users&action=student_add';
		$obj->mainredirect='?module=users&action=students';
				
				} else {
		$miniData['modifiedby'] = USER_ID;
		
		$Students->update($id,$miniData);
		$Users->update($userid,$uData);
		
		$obj->msg='Student Updated';
		$obj->status=1;
		$obj->redirect='?module=users&action=student_edit&id='.$id;
		$obj->mainredirect='?module=users&action=students';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}

if ( $action == 'admins' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['users'] = $Admins->search($tData['name']);
	
	$data['content'] = loadTemplate($folder.'admins.tpl.php',$tData);
}

if ( $action == 'admin_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['admin'] = $Admins->getDetails($id);	
	
	$action = 'admin_add';
}

if ( $action == 'admin_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['usernames'] = $Users->getUsernames($tData['admin']['userid']);
	
	$data['content'] = loadTemplate($folder.'admin_edit.tpl.php',$tData);
}

if ( $action == 'ajax_admin_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$userid = intval($_POST['userid']);
	$miniData = $_POST['admin'];
	$uData = $_POST['user'];
	
	if (!$uData['status']) $uData['status'] = 0;
	if ($uData['password']) $uData['password'] = hash('sha256',$uData['password']);
	else unset($uData['password']);
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
	
		$Users->insert($uData);
		$miniData['userid'] = $Users->lastId();
		
		$Admins->insert($miniData);
		
		$obj->msg='Admin Added';
		$obj->status=1;
		$obj->redirect='?module=users&action=admin_add';
		$obj->mainredirect='?module=users&action=admins';
				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$Admins->update($id,$miniData);
		$Users->update($userid,$uData);
		
		$obj->msg='Admin Updated';
		$obj->status=1;
		$obj->redirect='?module=users&action=admin_edit&id='.$id;
		$obj->mainredirect='?module=users&action=admins';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}

if ( $action == 'user_rights_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['id'] = $_GET['id'];
	$rights = $UserRights->getUserRights($tData['id']);
	foreach ($rights as $r) {
		if ($r['sname']) $tData['rights'][$r['mname']]['subs'][$r['sname']] = $r;
		$tData['rights'][$r['mname']]['menuid'] = $r['menuid'];
		if ($r['ulrid']) $tData['rights'][$r['mname']]['ulrid'] = $r['ulrid'];
		if ($r['umid']) $tData['rights'][$r['mname']]['checked'] = 'checked';
		
		if ($r['usid']) $tData['rights'][$r['mname']]['indeterminate'] = 'true';
	}
	
	$data['content'] = loadTemplate($folder.'user_rights_edit.tpl.php',$tData);
}

if ( $action == 'ajax_user_rights_save' ) {
	
	$obj = null;
	
	$rights = $_POST['rights'];
	$miniData['userid'] = intval($_POST['id']);
	$UserRights->deleteWhere($miniData);
	$miniData['createdby'] = USER_ID;
	
	$user = $Users->getPerson($_POST['id']);

	foreach ($rights as $menuid=>$sids) {
		$miniData['menuid'] = $menuid;
		foreach ($sids as $sid=>$dum) {
			$miniData['submenuid'] = $sid;
			$UserRights->insert($miniData);
		}
	}
	
	$obj->msg='User Rights Modified';
	$obj->status=1;
	$obj->redirect='?module=users&action=user_rights_edit&id='.$miniData['userid'];
	$obj->mainredirect='?module=users&action='.$user['type'].'s';
					
	$response[]=$obj;
	$data['content'] = $response;
}
