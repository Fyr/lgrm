<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?=$this->Html->charset()?>
	<title><?=$title_for_layout?></title>
<?
	echo $this->Html->meta('icon');

	echo $this->Html->css(array('bootstrap.min', 'bootstrap-responsive.min', 'style', 'extra'));
	
	$aScripts = array(
		'vendor/jquery/jquery-1.10.2.min',
		'vendor/jquery/jquery.cookie',
		'vendor/bootstrap.min',
	);
	echo $this->Html->script($aScripts);

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
		<!--[if lt IE 9]>
			<script src="/js/vendor/html5shiv.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="/"><?=DOMAIN_TITLE?></a>
					<div class="nav-collapse collapse">
						<?=$this->element('/SiteUI/main_menu')?>
						<?=$this->element('/SiteUI/alphabet')?>
						<form class="form-search pull-right">
							<div class="input-append">
								<input type="text" class="span2 search-query" placeholder="Поиск логотипа..." />
								<button type="submit" class="btn"><i class="icon icon-search"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<div id="wrap">
			<div class="container">
				<div class="row mainLayout">
					<div class="span3 leftSidebar">
						<?=$this->element('/SiteUI/categories')?>
						<div class="block">
							<div class="head">Heading</h4></div>
							<div class="description">
								<h4><a href="#">Title</a></h4>
								<img alt="" src="http://img.tyt.by/620x620s/n/10/0/delta2.jpg">
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
								<p class="text-right"><a class="btn btn-mini" href="#">Подробнее »</a></p>
							</div>
						</div>
					</div>
					<div class="span9">
<?
	if ($aBreadCrumbs) {
		echo $this->element('bread_crumbs');
	}
	if ($pageTitle) {
		echo $this->element('title');
	}
	echo $this->fetch('content');
?>
					</div>
				</div>
			</div>
			<div id="push"></div>
		</div>
		
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="span3">
						<a href="/"><?=DOMAIN_TITLE?></a>
					</div>
					<div class="span6">
						<?=$this->element('SiteUI/bottom_links')?>
					</div>
					<div class="span3"></div>
				</div>
				<div class="row">
					<small>Кауой-то маленький текст</small>
				</div>
			</div>
		</div>
<?=$this->element('sql_dump')?>
  </body>
</html>