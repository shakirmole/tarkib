<?php
	
	class WorkerAlerts extends model {
		var $table = 'workeralerts';
		
		function search($schoolid='') {
			$sql = "Select * from " . $this->table . " where 1 = 1";
			if ( $schoolid ) $sql .= " and schoolid =" . $schoolid;
			
			$sql .= " order by name asc";
			
			return fetchRows($sql);
		}
	}