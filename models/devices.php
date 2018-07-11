<?php
	
	class Devices extends model {
		var $table = 'devices';
		
		function search($locationid='') {
			$sql = "Select d.*, l.name as location, c.id as companyid from " . $this->table . " as d
					inner join locations as l on l.id = d.locationid
					inner join companies as c on c.id = l.companyid
					where 1 = 1";
			if ( $locationid ) $sql .= " and l.id =" . $locationid;
			
			$sql .= " order by d.description asc";
			
			return fetchRows($sql);
		}
		
		function getDetails($id='') {
			$sql = "Select d.*, l.name as location, c.id as companyid from " . $this->table . " as d
					inner join locations as l on l.id = d.locationid
					inner join companies as c on c.id = l.companyid
					where 1 = 1";
			if ( $id ) $sql .= " and d.id =" . $id;
			
			return fetchRow($sql);
		}
	}