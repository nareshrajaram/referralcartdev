<?php
class ControllerModuleReferrer extends Controller {
	private $error = array(); 
	
	public function index(){
		$this->load->language('module/referrer');
		$this->document->setTitle($this->language->get('heading_title'));

	//if news tables don't exist
		$this->load->model('user/referrer');
		if(!$this->model_user_referrer->checkInstall()){
            echo "Referrer installed ";
      $this->model_user_referrer->installReferrer();
    } else 
        {
            $this->model_user_referrer->installReferrer();
            echo "referrer installed ";
        }

		$this->data['primary_currency'] = $this->model_user_referrer->getDefaultCurrency();

		$this->load->model('setting/setting');
		
		if(($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_setting_setting->editSetting('referrer', $this->request->post);		
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title']              = $this->language->get('heading_title');
		$this->data['text_status']                = $this->language->get('text_status');
		$this->data['text_module']                = $this->language->get('text_module');
		$this->data['text_enable']                = $this->language->get('text_enable');
		$this->data['text_disable']               = $this->language->get('text_disable');
		$this->data['button_save']                = $this->language->get('button_save');
		$this->data['button_cancel']              = $this->language->get('button_cancel');
		$this->data['text_profit']                = $this->language->get('text_profit');
		$this->data['text_profit_type']           = $this->language->get('text_profit_type');
		$this->data['text_percentage']            = $this->language->get('text_percentage');
		$this->data['text_fixed']                 = $this->language->get('text_fixed');
		$this->data['text_higher_total']          = $this->language->get('text_higher_total');
		$this->data['text_yes']                   = $this->language->get('text_yes');
		$this->data['text_no']                    = $this->language->get('text_no');
		$this->data['text_min_order_total']       = $this->language->get('text_min_order_total');
		$this->data['text_ref_level']             = $this->language->get('text_ref_level');
		$this->data['text_ref_profit']            = $this->language->get('text_ref_profit');
		$this->data['text_ref_level']             = $this->language->get('text_ref_level');
		$this->data['text_ref_info']              = $this->language->get('text_ref_info');
		$this->data['text_you']                   = $this->language->get('text_you');
		$this->data['text_this_ref']              = $this->language->get('text_this_ref');
		$this->data['text_referrer']              = $this->language->get('text_referrer');
		$this->data['text_ref_percentage_profit'] = $this->language->get('text_ref_percentage_profit');
		$this->data['text_ref_fixed_profit']      = $this->language->get('text_ref_fixed_profit');

		$this->data['value_referrer'] = $this->model_setting_setting->getSetting('referrer');	

		$this->load->model('user/referrer');
 		if (isset($this->error['warning'])) {$this->data['error_warning'] = $this->error['warning'];}
    else{$this->data['error_warning'] = '';}

		$this->data['breadcrumbs'] = array();
 		$this->data['breadcrumbs'][] = array(
    	'text'      => $this->language->get('text_home'),
    	'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => false
 		);
 		$this->data['breadcrumbs'][] = array(
      'text'      => $this->language->get('text_module'),
      'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      'separator' => ' :: '
 		);
 		$this->data['breadcrumbs'][] = array(
      'text'      => $this->language->get('heading_title'),
      'href'      => $this->url->link('module/referrer', 'token=' . $this->session->data['token'], 'SSL'),
      'separator' => ' :: '
 		);
		
		$this->data['action'] = $this->url->link('module/referrer', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['referrer_module'])) {
			$modules = explode(',', $this->request->post['referrer_module']);
		} elseif ($this->config->get('referrer_module') != '') {
			$modules = explode(',', $this->config->get('referrer_module'));
		} else {
			$modules = array();
		}		

		$this->data['modules'] = $modules;
		
		if(isset($this->request->post['referrer_module'])){$this->data['referrer_module'] = $this->request->post['referrer_module'];}
    else{$this->data['referrer_module'] = $this->config->get('referrer_module');}

		$this->template = 'module/referrer.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
	}
}
?>