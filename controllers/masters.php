<?

$folder = 'masters/';

if ( $action == 'locations' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['locations'] = $Locations->search();
	
	$data['content'] = loadTemplate($folder.'locations.tpl.php',$tData);
}

if ( $action == 'location_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['location'] = $Locations->get($id);
	
	$action = 'location_add';
}

if ( $action == 'location_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['companies'] = $Companies->search();
	
	$data['content'] = loadTemplate($folder.'location_edit.tpl.php',$tData);
}

if ( $action == 'ajax_location_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$miniData = $_POST['location'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$Locations->insert($miniData);
		
		$obj->msg='Location Added';
		$obj->status=1;
		$obj->redirect='?module=masters&action=location_add';
		$obj->mainredirect='?module=masters&action=locations';
				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$Locations->update($id,$miniData);
		
		$obj->msg='Location Updated';
		$obj->status=1;
		$obj->redirect='?module=masters&action=location_edit&id='.$id;
		$obj->mainredirect='?module=masters&action=locations';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}

if ( $action == 'companies' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['companies'] = $Companies->search();
	
	$data['content'] = loadTemplate($folder.'companies.tpl.php',$tData);
}

if ( $action == 'company_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['company'] = $Companies->get($id);
	
	$action = 'company_add';
}

if ( $action == 'company_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['settings'] = $Settings->get(1);
	
	$data['content'] = loadTemplate($folder.'company_edit.tpl.php',$tData);
}

if ( $action == 'ajax_company_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$miniData = $_POST['company'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$Companies->insert($miniData);
		
		$obj->msg='Company Added';
		$obj->status=1;
		$obj->redirect='?module=masters&action=company_add';
		$obj->mainredirect='?module=masters&action=companies';
				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$Companies->update($id,$miniData);
		
		$obj->msg='Company Updated';
		$obj->status=1;
		$obj->redirect='?module=masters&action=company_edit&id='.$id;
		$obj->mainredirect='?module=masters&action=companies';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}

if ( $action == 'devices' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['devices'] = $Devices->search();
	
	$data['content'] = loadTemplate($folder.'devices.tpl.php',$tData);
}

if ( $action == 'device_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['device'] = $Devices->getDetails($id);
	
	$action = 'device_add';
}

if ( $action == 'device_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['companies'] = $Companies->search();
	
	$data['content'] = loadTemplate($folder.'device_edit.tpl.php',$tData);
}

if ( $action == 'ajax_device_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$miniData = $_POST['device'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$Devices->insert($miniData);
		
		$obj->msg='Device Added';
		$obj->status=1;
		$obj->redirect='?module=masters&action=device_add';
		$obj->mainredirect='?module=masters&action=devices';
				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$Devices->update($id,$miniData);
		
		$obj->msg='Device Updated';
		$obj->status=1;
		$obj->redirect='?module=masters&action=device_edit&id='.$id;
		$obj->mainredirect='?module=masters&action=devices';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}


if ( $action == 'workers' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['workers'] = $Workers->search();
	
	$data['content'] = loadTemplate($folder.'workers.tpl.php',$tData);
}

if ( $action == 'worker_edit' ) {	
	$id = $_GET['id'];
	$tData['worker'] = $Workers->getDetails($id);
	
	$action = 'worker_add';
}

if ( $action == 'worker_add') {	
	$tData['companies'] = $Companies->search();
	
	$data['content'] = loadTemplate($folder.'worker_edit.tpl.php',$tData);
}

if ( $action == 'worker_save' ) {
	
	$id = intval($_POST['id']);
	$miniData = $_POST['worker'];
	$companyId = $_POST['companyid'];
	$company = $Companies->get($companyId);
	
	$folderName = 'img/'.$companyId.'/';
	if ( !is_dir($folderName) ) mkdir($folderName);
	
	if ($_FILES['photo']['tmp_name']) {
		$miniData['photo'] = resizeAndUploadImage($folderName,$_FILES['photo'],200,200);
	}
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$Workers->insert($miniData);
		
		$_SESSION['message'] = 'Worker Added';
		redirect('masters','worker_add');				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$Workers->update($id,$miniData);
		
		$_SESSION['message'] = 'Worker Updated';
		redirect('masters','worker_edit','id='.$id);
	}
}

if ($action == 'ajax_getLocations' ) {
	$companyid = $_GET['companyid'];
	
	$locations = $Locations->search($companyid);
	
	$response = array();
	
	foreach ($locations as $r) {
		$obj=null;
		$obj->name=$r['name'];
		$obj->id=$r['id'];
		$response[]=$obj;
	}
		
	$data['content']=$response;
}