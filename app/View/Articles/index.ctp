<?
	$title = $this->ObjectType->getTitle('index', $objectType);
	echo $this->element('bread_crumbs', array('aBreadCrumbs' => array(
		__('Home') => '/',
		$title => ''
	)));
	echo $this->element('title', array('pageTitle' => $title));
	foreach($aArticles as $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '150x');
?>
<div class="media block">
<?
		if ($src) {
?>
	<a class="pull-left" href="<?=$url?>">
		<img width="150" alt="" src="<?=$src?>" class="media-object">
	</a>
<?
		}
?>
	<div class="media-body">
		<h4 class="media-heading"><a href="<?=$url?>"><?=$title?></a></h4>
		<p><?=$teaser?></p>
		<?=$this->element('more', compact('url'))?>
	</div>
</div>
<?
	}
	echo $this->element('paginate');
?>