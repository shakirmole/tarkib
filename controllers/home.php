<?

$folder = 'home/';

if ( $action == 'index' ) {
	
	if ($_GET['suraid']) $tData['suraid']= $_GET['suraid'];
	else $tData['suraid'] = 1;
	$tData['verseid'] = $_GET['verseid'];
	
	$tData['suras'] = $Suras->search();
	$tData['verses'] = $Verses->search($tData['suraid']);
	
	if ($tData['verseid']) {
		$verse = $Verses->getDetails($tData['verseid']);
		$tData['words'] = explode(' ',$verse['text']);
		
		$tData['erabTypes'] = $ErabTypes->search();
		$tData['wordTypes'] = $WordTypes->search();

		$tarkibTypes = $TarkibTypes->search();
		foreach ($tarkibTypes as $tarkibType) {
			$tData['erabTarkibTypes'][$tarkibType['erabtypeid']][] = $tarkibType;
			$tData['wordTarkibTypes'][$tarkibType['wordtypeid']][] = $tarkibType;
		}
	}
		
	$data['content'] = loadTemplate($folder.'quran.tpl.php',$tData);
}



if ($action == 'ajax_getVerses' ) {
	$suraid = $_GET['suraid'];
	
	$verses = $Verses->search($suraid);
	
	$response = array();
	
	foreach ($verses as $r) {
		$obj=null;
		$obj->verseno=$r['verseno'];
		$obj->id=$r['id'];
		$response[]=$obj;
	}
		
	$data['content']=$response;
}


if ($action == 'import' ) {
	
	$data['content'] = loadTemplate('import.tpl.php',$tData);
}

if ($action == 'import_data') {	
	if ($_FILES['upload']['tmp_name']) {
		$qrs = file_get_contents($_FILES['upload']['tmp_name']);
		executeQueryi($qrs);
		
		$_SESSION['message'] = 'Data Imported';
	} else {
	
		$_SESSION['error'] = 'Data Failed to Upload';
	}
	redirectBack();
}
