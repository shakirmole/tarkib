<?php
global $dbi_connection, $db_result;

$dbi_connection = false;  
$dbi_connection = mysqli_connect($config['server'],$config['username'],$config['password'],$config['database']);

mysqli_query($dbi_connection, "SET CHARACTER SET utf8"); 
mysqli_query($dbi_connection, "SET NAMES 'utf8'");
$db_result = false;

function fetchRow($sql) {
	global $dbi_connection, $db_result;
	$db_result = mysqli_query($dbi_connection,$sql);
	if ( $db_result ) return mysqli_fetch_assoc($db_result);
	else return false;
}

$total_pages = 0;

function fetchRows($sql, $paginate=false) {
	global $dbi_connection, $db_result;
	global $total_pages;
	
	$total_pages = 0;
	
	$db_result = mysqli_query($dbi_connection, $sql);
	
	if ( $db_result ) {
	
		if ( $paginate ) {
			// implement pagination
			$page = $_GET['pg'];
			$pg_size = $_GET['pg_size'];
			if(empty($page)) $page = 1;
			if(empty($pg_size)) $pg_size = 20;
			$st = ($page-1)*$pg_size;
			$total_pages = ceil(mysqli_num_rows($db_result) / $pg_size);
			$sql .= ' LIMIT ' . $st . ', ' . $pg_size;
			
			$db_result = mysqli_query($dbi_connection, $sql);
		}
	
		$results = array();
		while ($row = mysqli_fetch_assoc($db_result)) {
			$results[] = $row;
		}
		return $results;
	} else return false;
}

function totalPages() {
	global $total_pages;
	return $total_pages;
}

function executeQuery($sql) {
	global $dbi_connection, $db_result;
	$db_result = mysqli_query($dbi_connection, $sql);
	return $db_result;
}

function executeQueryi($sql) {
	global $dbi_connection, $db_result;
	$db_result = mysqli_multi_query($dbi_connection,$sql) or die(mysqli_error($dbi_connection));	
	
	do {
        if ($result = $dbi_connection->store_result()) {
            while ($row = $result->fetch_row()) {}
            $result->free();
        }
        if ($dbi_connection->more_results()) {}
    } while ($dbi_connection->next_result());
	
	return $db_result;
}

function countRows($rs=null) {
	global $dbi_connection, $db_result;
	if ( empty($rs) ) $rs = $db_result;
	return mysqli_num_rows($rs);
}

function lastInsertId() {
	global $dbi_connection;
	return mysqli_insert_id($dbi_connection);
}

class model {
	var $table;	
	var $paginate = false;
	
	function get($id) {
		$sql = 'select * from ' . $this->table . ' where id="'.$id.'"';
		return fetchRow($sql);
	}
	
	function getAll($orderby="", $limit="") {
		$sql = 'select * from ' . $this->table . '';
		if ( $orderby ) $sql .= ' order by ' . $orderby;
		if ( $limit ) $sql .= ' limit ' . $limit;
		return fetchRows($sql, $this->paginate);
	}
	
	function getAllVisible($orderby="", $limit="") {
		$sql = 'select * from ' . $this->table . ' where ' . $this->table . '.hide="N"';
		if ( $orderby ) $sql .= ' order by ' . $orderby;
		if ( $limit ) $sql .= ' limit ' . $limit;
		return fetchRows($sql, $this->paginate);
	}
	
	function getAllDeleted($orderby="", $limit="") {
		$sql = 'select * from ' . $this->table . ' where ' . $this->table . '.hide="Y"';
		if ( $orderby ) $sql .= ' order by ' . $orderby;
		if ( $limit ) $sql .= ' limit ' . $limit;
		return fetchRows($sql, $this->paginate);
	}
	
	function getHidden() {
	}

	function insert($data) {
		global $dbi_connection;
		$keys = implode(', ', array_keys($data) );
		foreach ($data as $d) {
			$cdata[] = mysqli_real_escape_string($dbi_connection, $d);
		}
		$values = '"' . implode('", "', $cdata ) . '"';		
		$sql = 'insert into ' . $this->table . ' (' . $keys . ') values (' . $values . ')';
		// echo $sql.'<br>';
		// die();
		return executeQuery($sql);
	}

	function update($id, $data) {
		global $dbi_connection;
		$updateClause = array();
		foreach ( $data as $iid=>$val ) {
			$updateClause[] = $iid . ' = "' . mysqli_real_escape_string($dbi_connection, $val) . '"';
		}
		$updateClause = implode(', ', $updateClause);
		$sql = 'update ' . $this->table . ' set ' . $updateClause . ' where id = "' . $id . '"';
		// echo $sql;
		// die();
		return executeQuery($sql);
	}

	function real_delete($id) {
		$sql = 'delete from ' . $this->table . ' where id="'.$id.'"';
		return executeQuery($sql);
	}
	
	function delete($id) {
		$sql = 'update ' . $this->table . ' set hide="Y" where id="'.$id.'"';
		return executeQuery($sql);
	}

	function undelete($id) {
		$sql = 'update ' . $this->table . ' set hide="N" where id="'.$id.'"';
		return executeQuery($sql);
	}
	
	function deleteWhere($data) {
		$whereClause = array();
		foreach ( $data as $id=>$val ) {
			$whereClause[] = $id . ' = "' . $val . '"';
		}
		$whereClause = implode(' and ', $whereClause);
		
		$sql = 'delete from ' . $this->table . ' where '.$whereClause;
		// echo $sql;die;
		return executeQuery($sql);
	}
	
	function updateWhere($updateData, $data) {
		global $dbi_connection;
		$updateClause = array();
		$whereClause = array();
		if(is_array($data)) foreach ( $data as $iid=>$val ) {
			$updateClause[] = $iid . " = '" . mysqli_real_escape_string($dbi_connection, $val) . "'";
		}
		if(is_array($updateData)) foreach ( $updateData as $iid=>$val ) {
			$whereClause[] = $iid . " = " . $val;
		}
		$updateClause = implode(", ", $updateClause);
		$whereClause = implode(" and ", $whereClause);
		$sql = "update " . $this->table . " set " . $updateClause . " where " . $whereClause;
		// echo $sql ;
		// die();
		return executeQuery($sql);
	}

	function find($data, $sortby = 'id') {
		$whereClause = array();
		
		if ( is_array($data) ) {
			foreach ( $data as $id=>$val ) {
				$whereClause[] = $id . ' = "' . $val . '"';
			}
			$whereClause = implode(' and ', $whereClause);
		} else $whereClause = $data;
		
		$sql = 'select * from ' . $this->table . ' where ' . $whereClause . ' order by ' . $sortby;
		
		return fetchRows($sql);
	}
	
	function count($rs="") {
		return countRows($rs);
	}
	
	function lastId() {
		return lastInsertId();
	}
	
	function totalPages() {
		return totalPages();
	}
	
	function exportTable(){
		$data = $this->getAll();
		$sql = "truncate table " . $this->table . "; \r\n";
		return $this->exportSQL($data,$sql);
	}
		
	function clearTable() {
		$sql = "truncate table " . $this->table;
		return executeQuery($sql);
	}
	
	function exportSQL($data,$sql) {
		if ($data) {
			$keys = implode(', ', array_keys($data[0]) );
			$i=0;
			foreach ($data as $d) {
				$values = '"' . implode('", "', array_values($d) ) . '"';
				if ($d == $data[0]) { //first row
					$sql .= "insert into ".$this->table." (" . $keys . ") values (" . $values . ") ";
				} else {
					if ($i==10000) {
						$sql .= ";";  //break query
						$sql .= "insert into ".$this->table." (" . $keys . ") values (" . $values . ") ";
					} else {
						$sql .= ", (" . $values . ")"; //continue query
					}
				}
				$i++;
			}
			$sql .= "; \r\n";
		}
		return $sql;
	}
	
	function exportCustomSQL($data,$sql) {
		$values = implode(", ", $data[1]);	
		$sql .= "insert into ".$this->table." (" . $data[0] . ") values " . $values;
		$sql .= "; \r\n";
		return $sql;
	}
	
	function insertSQL($data){	
		$values = implode(", ", $data[1]);	
		$sql .= "insert into ".$this->table." (" . $data[0] . ") values " . $values;
		return executeQuery($sql);
	}
	
	
	function nextInsertId() {
		$sql = "select max(id) as nextid from ". $this->table;
		return fetchRow($sql);
	}
}

?>