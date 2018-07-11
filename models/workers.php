<?php
	
	class Workers extends model {
		var $table = 'workers';
		
		function search($locationid='') {
			$sql = "Select w.*, l.name as location, c.id as companyid from " . $this->table . " as w
					inner join locations as l on l.id = w.locationid
					inner join companies as c on c.id = l.companyid
					where 1 = 1";
			if ( $locationid ) $sql .= " and l.id =" . $locationid;
			
			$sql .= " order by w.name asc";
			
			return fetchRows($sql);
		}
		
		function getDetails($id='') {
			$sql = "Select w.*, l.name as location, c.id as companyid from " . $this->table . " as w
					inner join locations as l on l.id = w.locationid
					inner join companies as c on c.id = l.companyid
					where 1 = 1";
			if ( $id ) $sql .= " and w.id =" . $id;
			
			return fetchRow($sql);
		}
	}