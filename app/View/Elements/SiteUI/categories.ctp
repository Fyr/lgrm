<ul class="nav nav-list bs-docs-sidenav">
	<li class="head">Каталог</li>
<?
	foreach($aCategories as $id => $title) {
?>
	<li class=""><a href="#"><i class="icon-chevron-right"></i> <?=$title?></a></li>
<?
	}
?>
</ul>