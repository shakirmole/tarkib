<?

$folder = 'associations/';

if ( $action == 'templates' ) {
	
	$tData['name'] = $_GET['name'];
	
	$tData['templates'] = $Templates->search();
	
	$data['content'] = loadTemplate($folder.'templates.tpl.php',$tData);
}

if ( $action == 'template_edit' ) {
	$id = $_GET['id'];
	$tData['template'] = $Templates->get($id);
	$tData['timings'] = $TemplateTimings->search($id);
	
	$action = 'template_add';
}

if ( $action == 'template_add') {
	
	$tData['companies'] = $Companies->search();
	
	$data['content'] = loadTemplate($folder.'template_edit.tpl.php',$tData);
}

if ( $action == 'template_save' ) {	
	$id = intval($_POST['id']);
	$miniData = $_POST['template'];
	$timing = $_POST['timing'];
	
	if ( empty($id) )  {
		$miniData['createdby'] = USER_ID;
		$Templates->insert($miniData);
		$id = $Templates->lastId();
		
		$_SESSION['message'] = 'Template Added';
	} else {
		$miniData['modifiedby'] = USER_ID;
		
		$Templates->update($id,$miniData);
		
		$timeData['templateid'] = $id;
		$TemplateTimings->deleteWhere($timeData);
		
		$timeData['createdby'] = USER_ID;
		foreach ($timing as $time) {
			$timeData['timing'] = $time;
			$TemplateTimings->insert($timeData);
		}
		
		$_SESSION['message'] = 'Template Updated';
	}
	
	redirect('associations','template_edit','id='.$id);
}
