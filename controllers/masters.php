<?

$folder = 'masters/';

if ( $action == 'tarkibtypes' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['tarkibtypes'] = $TarkibTypes->search();
	
	$data['content'] = loadTemplate($folder.'tarkibtypes.tpl.php',$tData);
}

if ( $action == 'tarkibtype_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['tarkibtype'] = $TarkibTypes->get($id);
	
	$action = 'tarkibtype_add';
}

if ( $action == 'tarkibtype_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['wordtypes'] = $WordTypes->search();
	$tData['erabtypes'] = $ErabTypes->search();
	
	$data['content'] = loadTemplate($folder.'tarkibtype_edit.tpl.php',$tData);
}

if ( $action == 'ajax_tarkibtype_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$miniData = $_POST['tarkibtype'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$TarkibTypes->insert($miniData);
		
		$obj->msg='Tarkib Type Added';
		$obj->status=1;
		$obj->redirect='?module=masters&action=tarkibtype_add';
		$obj->mainredirect='?module=masters&action=tarkibtypes';
				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$TarkibTypes->update($id,$miniData);
		
		$obj->msg='Tarkib Type Updated';
		$obj->status=1;
		$obj->redirect='?module=masters&action=tarkibtype_edit&id='.$id;
		$obj->mainredirect='?module=masters&action=tarkibtypes';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}

if ( $action == 'wordtypes' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['wordtypes'] = $WordTypes->search();
	
	$data['content'] = loadTemplate($folder.'wordtypes.tpl.php',$tData);
}

if ( $action == 'wordtype_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['wordtype'] = $WordTypes->get($id);
	
	$action = 'wordtype_add';
}

if ( $action == 'wordtype_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['colors'] = $Colors->search();
	
	$data['content'] = loadTemplate($folder.'wordtype_edit.tpl.php',$tData);
}

if ( $action == 'ajax_wordtype_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$miniData = $_POST['wordtype'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$WordTypes->insert($miniData);
		
		$obj->msg='Word Type Added';
		$obj->status=1;
		$obj->redirect='?module=masters&action=wordtype_add';
		$obj->mainredirect='?module=masters&action=wordtypes';
				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$WordTypes->update($id,$miniData);
		
		$obj->msg='Word Type Updated';
		$obj->status=1;
		$obj->redirect='?module=masters&action=wordtype_edit&id='.$id;
		$obj->mainredirect='?module=masters&action=wordtypes';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}

if ( $action == 'erabtypes' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['erabtypes'] = $ErabTypes->search();
	
	$data['content'] = loadTemplate($folder.'erabtypes.tpl.php',$tData);
}

if ( $action == 'erabtype_edit' ) {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$id = $_GET['id'];
	$tData['erabtype'] = $ErabTypes->get($id);
	
	$action = 'erabtype_add';
}

if ( $action == 'erabtype_add') {
	$data['layout'] = 'layout_iframe.tpl.php';
	
	$tData['colors'] = $Colors->search();
	
	$data['content'] = loadTemplate($folder.'erabtype_edit.tpl.php',$tData);
}

if ( $action == 'ajax_erabtype_save' ) {
	
	$obj = null;
	
	$id = intval($_POST['id']);
	$miniData = $_POST['erabtype'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$ErabTypes->insert($miniData);
		
		$obj->msg='Erab Type Added';
		$obj->status=1;
		$obj->redirect='?module=masters&action=erabtype_add';
		$obj->mainredirect='?module=masters&action=erabtypes';
				
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$ErabTypes->update($id,$miniData);
		
		$obj->msg='Erab Type Updated';
		$obj->status=1;
		$obj->redirect='?module=masters&action=erabtype_edit&id='.$id;
		$obj->mainredirect='?module=masters&action=erabtypes';
				
	}
	
	$response[]=$obj;
	$data['content'] = $response;
}