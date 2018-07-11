<?php

	class Settings extends model 
	{ 
		var $table = "settings";
		
		function search($name='') {
			$sql = "Select * from " . $this->table . " where 1 = 1";
			if ( $name ) $sql .= " and name like '%" . $name . "%'";
			
			return fetchRows($sql);
		}
		
	}

?>