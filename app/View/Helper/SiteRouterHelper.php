<?php
App::uses('AppHelper', 'View/Helper');
class SiteRouterHelper extends AppHelper {

	public function url($article) {
		$objectType = $this->getObjectType($article);
		
		$url = array('controller' => 'Articles', 'action' => 'view');
		if ($slug = $article[$objectType]['slug']) {
			$url['objectType'] = $objectType;
			$url['slug'] = $slug;
		} else {
			$url[] = $article[$objectType]['id'];
		}
		
		return Router::url($url);
	}
	
}
