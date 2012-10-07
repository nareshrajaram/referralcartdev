<?php
class ControllerModulePromotion extends Controller {
	private $error = array(); 
	
	public function index(){
		$this->load->language('module/promotion');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/promotion');
		if(!$this->model_user_promotion->checkInstall()){
            echo "Promotion installed ";
    } else 
        {
            $this->model_user_promotion->installPromotion();
            echo "promotion installed ";
        }

	}
}
?>