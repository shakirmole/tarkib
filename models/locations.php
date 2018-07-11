<?php

	class Locations extends model {
		var $table = 'locations';
		
		function search($companyid='') {
			$sql = "Select l.*, c.name as company from " . $this->table . " as l 
					inner join companies as c on c.id = l.companyid
					where 1 = 1";
			if ( $companyid ) $sql .= " and l.companyid =" . $companyid;
			
			$sql .= " order by l.name asc";
			
			return fetchRows($sql);
		}
	}