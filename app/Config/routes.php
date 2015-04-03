<?php
Router::parseExtensions('json');

Router::connect('/', array('controller' => 'Pages', 'action' => 'home'));
Router::connect('/pages/view/:slug.html', 
	array(
		'controller' => 'pages', 
		'action' => 'view',
	),
	array(
		'pass' => array('slug')
	)
);
Router::connect('/articles/:slug.html', 
	array(
		'controller' => 'Articles', 
		'action' => 'view',
		'objectType' => 'SiteArticle'
	),
	array(
		'pass' => array('slug')
	)
);
Router::connect('/articles/', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'SiteArticle'
));

Router::connect('/news/:slug.html', 
	array(
		'controller' => 'Articles', 
		'action' => 'view',
		'objectType' => 'News'
	),
	array(
		'pass' => array('slug')
	)
);
Router::connect('/news/', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'News'
));

CakePlugin::routes();

require CAKE.'Config'.DS.'routes.php';
