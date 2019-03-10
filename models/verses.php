<?php
	
	class Verses extends model 
	{ 
		var $table = "Verses";

		function search($suraid="") {
			$sql = "select v.id, v.verseno, v.text as text, CONCAT(s.name,' ',s.surano,':',v.verseno) as search from verses as v
					inner join suras as s on s.id = v.suraid
					where 1=1 ";
			if ($suraid) $sql .= " and s.id = ".$suraid;	
			$sql .= " order by v.id asc";
			// echo $sql;
			return $this->fetchRows($sql);
		}
		
		function getDetails($verseid="") {
			$sql = "select v.id, v.verseno, v.text as text, CONCAT(s.name,' ',s.surano,':',v.verseno) as search from verses as v
					inner join suras as s on s.id = v.suraid
					where 1=1 ";
			if ($verseid) $sql .= " and v.id = ".$verseid;	
			
			// echo $sql;
			return $this->fetchRow($sql);
		}
		
	}

?>