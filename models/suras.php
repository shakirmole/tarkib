<?php
	
	class Suras extends model
	{ 
		var $table = "suras";

		function search($suraid="") {
			$sql = "select s.* from suras as s
					where 1=1 ";
					
			if ($suraid) $sql .= " and v.suraid = ".$suraid;
					
			$sql .= " order by s.surano asc";
			
			return $this->fetchRows($sql);
		}
		
	}

?>