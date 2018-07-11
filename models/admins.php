<?php

	class Admins extends model 
	{ 
		var $table = "admins";
		
		function search($name='') {
			$sql = "Select a.*, u.status, u.username from " . $this->table . " as a
					inner join users as u on u.id = a.userid
					where 1 = 1 ";
			if ( $name ) $sql .= " and name like '%" . $name . "%'";
			// echo $sql;
			return fetchRows($sql);
		}
		
		function getDetails($adminid='',$userid='') {
			$sql = "Select a.*, u.status, u.username from " . $this->table . " as a
					inner join users as u on u.id = a.userid
					where 1 = 1";
			if ( $adminid ) $sql .= " and a.id = " . $adminid;
			if ( $userid ) $sql .= " and a.userid = " . $userid;
			// echo $sql;
			return fetchRow($sql);
		}
		
	}

?>