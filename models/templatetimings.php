<?php
	
	class TemplateTimings extends model {
		var $table = 'templatetimings';
		
		function search($templateid='') {
			$sql = "Select tt.* from " . $this->table . " as tt where 1 = 1";
			if ( $templateid ) $sql .= " and tt.templateid =" . $templateid;
			
			// $sql .= " order by name asc";
			
			return fetchRows($sql);
		}
	}