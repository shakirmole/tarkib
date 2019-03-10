<?php

	class TarkibTypes extends model 
	{ 
		var $table = "tarkibtypes";
		
		function search($name='') {
			$sql = "Select tt.*, et.name as erabtype, et.color as etcolor, wt.name as wordtype, wt.color as wtcolor from " . $this->table . " as tt
					left join wordtypes as wt on wt.id = tt.wordtypeid
					left join erabtypes as et on et.id = tt.erabtypeid
					where 1 = 1";
			if ( $name ) $sql .= " and name like '%" . $name . "%'";
			
			return $this->fetchRows($sql);
		}
		
	}

?>