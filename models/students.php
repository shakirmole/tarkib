<?php

	class Students extends model 
	{ 
		var $table = "students";
		
		function search($userid='') {
			$sql = "Select t.*, u.status, u.username from " . $this->table . " as t
					inner join users as u on u.id = t.userid
					where 1 = 1 ";
			if ( $userid ) $sql .= " and t.userid = " . $userid;
			// echo $sql;
			return $this->fetchRows($sql);
		}
		
		function getDetails($staffid='',$userid='') {
			$sql = "Select t.*, u.status, u.username from " . $this->table . " as t
					inner join users as u on u.id = t.userid
					where 1 = 1";
					if ( $staffid ) $sql .= " and t.id = " . $staffid;
			if ( $userid ) $sql .= " and t.userid = " . $userid;
			// echo $sql;
			return $this->fetchRow($sql);
		}
		
	}

?>