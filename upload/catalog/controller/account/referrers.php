<?php
//DEAWid 
class ControllerAccountReferrers extends Controller { 
	public function index() {
		if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	} 
	
		$this->language->load('account/referrer');

		$this->document->setTitle($this->language->get('heading_title'));
  
  	$this->data['breadcrumbs'] = array();
  	$this->data['breadcrumbs'][] = array(
    	'text'      => $this->language->get('text_home'),
    	'href'      => $this->url->link('common/home'),
    	'separator' => false
  	); 
		$this->language->load('account/account');
  	$this->data['breadcrumbs'][] = array(       	
    	'text'      => $this->language->get('text_account'),
    	'href'      => $this->url->link('account/account', '', 'SSL'),
    	'separator' => $this->language->get('text_separator')
  	);
		$this->language->load('account/referrer');
  	$this->data['breadcrumbs'][] = array(       	
    	'text'      => $this->language->get('heading_title'),
    	'href'      => $this->url->link('account/referrers', '', 'SSL'),
    	'separator' => $this->language->get('text_separator')
  	);
		
		if (isset($this->session->data['success'])) {
    	$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
    	$this->data['heading_title']         = $this->language->get('heading_title');
    	$this->data['text_my_referrers']     = $this->language->get('text_my_referrers');
    	$this->data['text_referer_name']     = $this->language->get('text_referer_name');
    	$this->data['text_referer_register'] = $this->language->get('text_referer_register');
    	$this->data['text_num_of_purchases'] = $this->language->get('text_num_of_purchases');
    	$this->data['text_profit']           = $this->language->get('text_profit');
    	$this->data['text_no_referrers']     = $this->language->get('text_no_referrers');
    	$this->data['text_link_referrer']    = $this->language->get('text_link_referrer');
    	$this->data['text_your_balance']     = $this->language->get('text_your_balance');




		$this->load->model('account/referrer');
    $this->data['shop_url']         = $this->model_account_referrer->getShopURL();
    $this->data['actual_currency']  = $this->model_account_referrer->getActualCurrency();
    $this->data['my_balance']       = $this->model_account_referrer->getMyBalance($this->customer->getId());
		
    $this->data['referrers'] = $this->model_account_referrer->getReferrersFromCustomerID($this->customer->getId());
		
		foreach($this->data['referrers'] as $referrer){
		  $this->data['all_purchases'][$referrer['customer_id']] = $this->model_account_referrer->getNumOfPurchasesFromCustomer($referrer['customer_id']);
		  $this->data['all_points'][$referrer['customer_id']] = $this->model_account_referrer->getPriceFromCustomer($referrer['customer_id']);
		}

		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/referrers.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/referrers.tpl';
		} else {
			$this->template = 'default/template/account/referrers.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'		
		);
				
		$this->response->setOutput($this->render());
  	}
}
?>