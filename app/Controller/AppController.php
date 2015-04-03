<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
	public $paginate;
	public $aNavBar = array(), $aBottomLinks = array(), $currMenu = '', $currLink = '', $pageTitle = '', $aBreadCrumbs = array();
	
	public function __construct($request = null, $response = null) {
		$this->_beforeInit();
		parent::__construct($request, $response);
		$this->_afterInit();
	}
	
	protected function _beforeInit() {
	    $this->helpers = array_merge(array('Html', 'Form', 'Paginator', 'Media', 'ArticleVars'), $this->helpers);
	}

	protected function _afterInit() {
	    // after construct actions here
	}
	
	public function isAuthorized($user) {
    	$this->set('currUser', $user);
		return Hash::get($user, 'active');
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->beforeFilterLayout();
	}
	
	protected function beforeFilterLayout() {
		$this->aNavBar = array(
			'Home' => array('label' => __('Home'), 'href' => array('controller' => 'Pages', 'action' => 'home')),
			'News' => array('label' => __('News'), 'href' => array('controller' => 'Articles', 'action' => 'index', 'objectType' => 'News')),
			'Products' => array('label' => __('Products catalogue'), 'href' => array('controller' => 'SiteProducts', 'action' => 'index')),
			'Articles' => array('label' => __('Articles'), 'href' => array('controller' => 'Articles', 'action' => 'index', 'objectType' => 'SiteArticle')),
			'o-proekte' => array('label' => __('About us'), 'href' => array('controller' => 'pages', 'action' => 'view', 'o-proekte.html')),
			'Contacts' => array('label' => __('Contacts'), 'href' => array('controller' => 'SiteContacts', 'action' => 'index'))
		);
		$this->aBottomLinks = $this->aNavBar;
		
		$this->currMenu = $this->_getCurrMenu();
	    $this->currLink = $this->currMenu;
	}
	
	protected function _getCurrMenu() {
		$curr_menu = strtolower(str_ireplace('Site', '', $this->request->controller)); // By default curr.menu is the same as controller name
		/*
		foreach($this->aNavBar as $currMenu => $item) {
			if (isset($item['submenu'])) {
				foreach($item['submenu'] as $_currMenu => $_item) {
					if (strtolower($_currMenu) === $curr_menu) {
						return $currMenu;
					}
				}
			}
		}
		*/
		return $curr_menu;
	}
	
	public function beforeRender() {
		$this->set('aNavBar', $this->aNavBar);
		$this->set('currMenu', $this->currMenu);
		$this->set('aBottomLinks', $this->aBottomLinks);
		$this->set('currLink', $this->currLink);
		$this->set('pageTitle', $this->pageTitle);
		$this->set('aBreadCrumbs', $this->aBreadCrumbs);
		
		$this->beforeRenderLayout();
	}
	
	protected function beforeRenderLayout() {
		$this->loadModel('Media.Media');
		$this->set('aSlider', $this->Media->getObjectList('Slider'));
		
		$this->loadModel('CategoryProduct');
		$aCategories = $this->CategoryProduct->find('list'); //getObjectOptions();
		$this->set('aCategories', $aCategories);
		/*
		$this->loadModel('CategoryProduct');
		$aCategories = $this->CategoryProduct->find('list'); //getObjectOptions();
		$this->set('aCategories', $aCategories);
		*/
	}
	
	protected function getObjectType() {
		$objectType = $this->request->param('objectType');
		return ($objectType && in_array($objectType, array('SiteArticle', 'News'))) ? $objectType : 'SiteArticle';
	}
}
