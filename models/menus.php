<?php

	class Menus extends model 
	{ 
		var $table = "menus";
		
		function getAllMenus($module='',$action='') {
			$sql = "select m.name as mname, m.module as mmod, m.action as mact, s.name as sname, s.module as smod, s.action as sact from menus as m
					left join submenus as s on s.menuid = m.id and s.status = 1
					where m.status = 1 ";
			if ($module && $action) $sql .= " and (m.module = '".$module."' or (s.module = '".$module."' and s.action = '".$action."'))";
					
			$sql .= " order by m.sortno, s.sortno";
			// echo $sql;
			return fetchRows($sql);
		}
		
	}

?>