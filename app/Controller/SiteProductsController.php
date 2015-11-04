<?php
App::uses('AppController', 'Controller');
App::uses('Product', 'Model');
App::uses('Media', 'Media.Model');
App::uses('PHMediaHelper', 'Media.View/Helper');
App::uses('PHTimeHelper', 'Core.View/Helper');

class SiteProductsController extends AppController {
	public $name = 'SiteProducts';
	public $uses = array('Media.Media', 'CategoryProduct', 'Product');
	public $helpers = array('Media.PHMedia', 'Core.PHTime', 'Form.PHForm');
	
	const PER_PAGE = 2;
	
	public function beforeFilter() {
		$this->objectType = $this->getObjectType();
		$this->set('objectType', $this->objectType);
		parent::beforeFilter();
	}
	
	/*
	public function beforeRender() {
		$this->currMenu = 'Products';
		
		parent::beforeRender();
	}
	*/
	
	public function index($catSlug = '') {
		$this->paginate = array(
			'conditions' => array('Product.published' => 1),
			'limit' => self::PER_PAGE, 
			'page' => $this->request->param('page'),
			'order' => 'Product.created DESC'
		);
		if ($catSlug) {
			$this->request->data('Category.slug', $catSlug);
			$this->set('category', $this->CategoryProduct->findBySlug($catSlug));
		}
		if ($data = $this->request->data) {
			$this->paginate['conditions'] = array_merge($this->paginate['conditions'], $this->postConditions($data));
		}
		$products = $this->paginate('Product');
		$this->set('aArticles', $products);
		$this->set('objectType', 'Product');
	}
	
	public function view($slug) {
		$article = $this->Product->findBySlug($slug);
		if (!$article) {
			return $this->redirect404();
		}
		$id = $article['Product']['id'];
		$this->set('article', $article);
		$this->set('category', array('CategoryProduct' => $article['Category']));
		$aMedia = $this->Media->getObjectList('Product', $id);
		
		// for bin-file we just upload an image with the same name + _thumb
		$aThumbs = array();
		foreach($aMedia as $media) {
			if ($media['Media']['media_type'] == 'image' && strpos($media['Media']['orig_fname'], '_thumb') !== false) {
				list($fname) = explode('.', str_replace('_thumb', '', $media['Media']['orig_fname']));
				$aThumbs[$fname] = $media;
			}
		}
		$aMedia = Hash::combine($aMedia, '{n}.Media.id', '{n}', '{n}.Media.media_type');
		$this->set('aMedia', $aMedia);
		$this->set('aThumbs', $aThumbs);
	}
}
