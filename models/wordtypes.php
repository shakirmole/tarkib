<?php

	class WordTypes extends model 
	{ 
		var $table = "wordtypes";
		
		function search($name='') {
			$sql = "Select * from " . $this->table . " where 1 = 1";
			if ( $name ) $sql .= " and name like '%" . $name . "%'";
			
			return $this->fetchRows($sql);
		}
		
	}

?>