<?php
class ModelAccountReferrer extends Model {



	public function getMyBalance($customer_id) {
	  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '$customer_id'");
  	$currency = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE `currency_id` = '".(int)$this->currency->getId()."'");
    return round(($query->row['referrer_price']*$currency->row['value']),2);
  }

	public function getReferrersFromCustomerID($customer_id) {
	  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE referrer_id = '$customer_id'");
    return $query->rows;
  }
  
  
	public function getActualCurrency() {
	  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE currency_id = '".(int)$this->currency->getId()."'");
    return $query->row;
  }
  
	public function getShopURL() {
	  $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `key` = 'config_use_ssl'");
    if($query->row['value']){$ssl = 'https';}else{$ssl = 'http';}
    return $ssl.'://'.$_SERVER['HTTP_HOST'].'/';
  }
  
	public function getNumOfPurchasesFromCustomer($customer_id) {
	  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "referrer_log WHERE `customer_id` = '$customer_id'");
    return count($query->rows);
  }
  
	public function getPriceFromCustomer($customer_id) {
	
	  $return_profit = 0;
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "referrer_log WHERE `customer_id` = '$customer_id'");
    foreach($query->rows as $profit){
      $return_profit = $return_profit+$profit['price'];
    }
    
    $currency_profit = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE `currency_id` = '".(int)$this->currency->getId()."'");
  	$currency = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE `currency_id` = '".(int)$this->currency->getId()."'");

    return round(($return_profit*$currency->row['value']),2);
  }
	
}

?>