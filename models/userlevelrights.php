<?php

	class UserLevelRights extends model 
	{ 
		var $table = "userlevelrights";
		
		function getLevelRights($utypeid="",$module='',$action='') {
			$sql = "select m.name as mname, m.module as mmod, m.action as mact, m.id as menuid, ulr.menuid as umid,
						   s.name as sname, s.module as smod, s.action as sact, s.id as submenuid, ulr.submenuid as usid from userlevelrights as ulr
					inner join menus as m on ulr.menuid = m.id
					left join submenus as s on ulr.submenuid = s.id
					where 1=1
					and ulr.typeid = ".$utypeid;
			if ($module && $action) $sql .= " and (m.module = '".$module."' or (s.module = '".$module."' and s.action = '".$action."'))";
			
			$sql .= " order by m.sortno, s.sortno";
			// echo $sql;
			return fetchRows($sql);
		}
	}

?>