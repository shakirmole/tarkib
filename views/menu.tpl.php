<?
    define('ElementHover','bg-hover-black fg-white bg-'.COLOR);
?>
<nav class="app-bar <?=TableHead?> app-bar-expand-md" data-role="appbar">
	<a href="?action=index" class="brand no-hover d-none-lg">Admin Panel</a>
	
	<ul class="app-bar-menu">
		<? foreach ($_SESSION['menus'] as $mname=>$menu) { 
			if ($menu['subs']) { ?>
			<li class="<?=ElementHover?>">
				<a class="dropdown-toggle <?=ElementHover?>" href="#">
				<?=$mname?>
				</a>
				<ul class="d-menu" data-role="dropdown">
					<? foreach ($menu['subs'] as $sname=>$sub) { ?>
						<li class="bg-<?=COLOR?>"><a class='fg-white' href='<?=url($sub['smod'],$sub['sact'])?>'><?=$sname?></a></li>
					<? } ?>
				</ul>
			</li>
			<? } else { ?>
			<li>
				<a class='<?=ElementHover?>' href="<?=url($menu['module'],$menu['action'])?>"><?=$mname?></a>
			</li>
			<? }
		} ?>
		<? if(USERTYPE == 'admin') { ?>
			<li>
				<a class='<?=ElementHover?>' href="?module=settings&action=index">Settings</a>
			</li>
		<? } ?>
	</ul>
	<ul class="app-bar-menu" style='position:absolute; right:0px;'>
		<? if ($_SESSION['member']) { ?>
		<li class='<?=ElementHover?>' style='min-width:150px'>
			<a class="dropdown-toggle <?=ElementHover?>" href="#">
			<?=USERFULLNAME?> <? if ($_SESSION['member']['class']) echo '- '. $_SESSION['member']['class']?>
			</a>
			<ul class="d-menu" data-role="dropdown">
				<li class="bg-<?=COLOR?>"><a class='fg-white' href="?module=settings&action=user_settings">My Settings</a></li>
				<li class="bg-<?=COLOR?>"><a class='fg-white' href="?module=authenticate&action=logout">Logout</a></li>
			</ul>
		</li>
		<? } else { /* ?>
		<li>
			<a class='<?=ElementHover?>' href="?module=home&action=authenticate">Login/Register</a>
		</li>
		<? */ } ?>
	</ul>
		
	<ul class="app-bar-menu place-right">		
	</ul>
</nav>