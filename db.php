<?php
	
function executeQueryi($sql) {	
	global $config;
	$dbi_connection = mysqli_connect($config['server'],$config['username'],$config['password'],$config['database']);
	mysqli_query($dbi_connection, "SET CHARACTER SET utf8"); 
	mysqli_query($dbi_connection, "SET NAMES 'utf8'");
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

class Model {
	
	function get($id) {
		return ORM::for_table($this->table)->find_one($id)->as_array();
	}
	
	function getAll($orderby='id') {
		$data = ORM::for_table($this->table)->order_by_asc($orderby)->find_array();
		return $data;
	}
	
	function insert($data) {
		$record = ORM::for_table($this->table)->create();
		$record->set($data);
		$record->save();
		return $record->id;
	}

	function update($id, $data) {
		$record = ORM::for_table($this->table)->find_one($id);		
		$record->set($data);
		$record->save();
		return $record->id;
	}

	function real_delete($id) {
		$record = ORM::for_table($this->table)->find_one($id);
		$record->delete();
		return $record->as_array();
	}
	
	function deleteWhere($data) {
		ORM::for_table($this->table)->where($data)->delete_many();
		return true;
	}
	
	function updateWhere($whereData, $data) {
		$records = ORM::for_table($this->table)->where($whereData)->find_many();
		foreach ($records as $record) {
			$record->set($data);
			$record->save();
		}
		return true;
	}

	function find($whereData, $orderby = 'id') {
		return ORM::for_table($this->table)->where($whereData)->order_by_asc($orderby)->find_array();
	}
	
	function lastId() {
		return ORM::get_db()->lastInsertId();
	}
	
	function nextInsertId() {
		$sql = "select IFNULL(max(id) + 1,1) as nextid from ". $this->table;
		return $this->fetchRow($sql);
	}
	
	function fetchRow($sql) {	
		return ORM::for_table($this->table)->raw_query($sql)->find_one()->as_array();
	}
	
	function fetchRows($sql) {
		return ORM::for_table($this->table)->raw_query($sql)->find_array();
	}
	
	function executeQuery($sql) {
		ORM::for_table($this->table)->raw_execute($sql);
	}
	
	function exportTable(){
		$data = $this->getAll();
		$sql = "truncate table " . $this->table . "; \r\n";
		return $this->exportSQL($data,$sql);
	}
		
	function clearTable() {
		$sql = "truncate table " . $this->table;
		return $this->executeQuery($sql);
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
		return $this->executeQuery($sql);
	}
}

?>