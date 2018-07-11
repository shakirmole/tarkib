<?php

	class Users extends model 
	{ 
		var $table = "users";
	
		function search($name='') {
			$sql = "Select * from " . $this->table . " where 1 = 1";
			if ( $name ) $sql .= " and name like '%" . $name . "%'";
			
			return fetchRows($sql);
		}
		
		function getUsernames($id="") {
			$sql = 'select username from ' . $this->table . ' where 1=1 ';
			
			if ($id) $sql .= " and id <> ".$id;
			// echo $sql;
			return fetchRows($sql);
		}
		
		function getPerson($userid='') {
			$sql = "select x.*, u.utypeid, ut.name as type from (
						select name, userid, id from admins
						UNION ALL
						select name, userid, id from staffs
					) as x
					INNER JOIN users as u on x.userid = u.id
					INNER JOIN usertypes as ut on ut.id = u.utypeid
					where 1=1 ";
					
			if ($userid) $sql .= " and x.userid = ".$userid;
			// echo $sql;
			return fetchRow($sql);
		}
	}

?>