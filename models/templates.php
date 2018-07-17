<?php
	
	class Templates extends model {
		var $table = 'templates';
		
		function search($companyid='') {
			$sql = "Select t.*, c.name as company from " . $this->table . " as t 
					inner join companies as c on c.id = t.companyid
					where 1 = 1";
			if ( $companyid ) $sql .= " and t.companyid =" . $companyid;
			
			$sql .= " order by t.name asc";
			
			return fetchRows($sql);
		}
	}