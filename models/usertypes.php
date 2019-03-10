<?php

	class UserTypes extends model 
	{ 
		var $table = "usertypes";
		
		function search($name='') {
			$sql = "Select * from " . $this->table . " where 1 = 1";
			if ( $name ) $sql .= " and name like '%" . $name . "%'";
			
			return $this->fetchRows($sql);
		}
		
		function getDetails($name='') {
			$sql = "Select * from " . $this->table . " where 1 = 1";
			if ( $name ) $sql .= " and name = '" . $name . "'";
			
			return $this->fetchRow($sql);
		}
	}

?>