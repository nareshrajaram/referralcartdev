<?php
class ModelCatalogPromotion extends Model {

	public function checkPromotionInstalled() {
    $result=@mysql_query("SELECT * FROM " . DB_PREFIX . "promotion_log");
    if(!$result){
        return false;
    } else {
        return true;
    }
	}
	
	public function installPromotion() {
        $this->db->query("CREATE TABLE IF NOT EXISTS  ". DB_PREFIX ."promotion_log (product_id int(11) NOT NULL, customer_id int(11) NOT NULL, parent_id int(11) NOT NULL, pro_amount int(11) NOT NULL, date timestamp NOT NULL, CONSTRAINT pid_cid PRIMARY KEY (product_id, customer_id))");
		$query = $this->db->query("ALTER TABLE ". DB_PREFIX ."product  ADD promo_amount INT NOT NULL DEFAULT 500");
  }

	public function addPromotion($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "promotion_log (product_id, customer_id, parent_id, pro_amount) values (" . $data['product_id'] . "," . $data['customer_id'] . "," . $data['parent_id'] . "," .  $data['pro_amount'] . ")");	
	}
	
	public function getPromotion($customer_id, $product_id) {
        $pro_amount_available = 500;
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "promotion_log pd WHERE pd.product_id = $product_id AND pd.customer_id = $customer_id");

        $query1 = $query;
//        print_r ($query);

        $num_rows = $query->num_rows;
        if($num_rows == 0)
        {
            return NULL;
        }
        for($i = 0; $i < 5; $i++)
        {
            $pro_amount_available -= $query1->row['pro_amount'];
            if($query1->row['parent_id'] == 0)
            {
                break;
            }
            $product_id = $query1->row['product_id'];
            $customer_id = $query1->row['parent_id'];
            $query1 = $this->db->query("SELECT  * FROM " . DB_PREFIX . "promotion_log pd WHERE pd.product_id = $product_id AND pd.customer_id = $customer_id");

            $num_rows = $query1->num_rows;
            if($num_rows == 0)
            {
                break;
            }
        }
        $query->row['pro_amount_available'] = $pro_amount_available;
		return $query->row;
	}	


	public function updatePromotion($product_id, $customer_id,$amount) {
		$query = $this->db->query("UPDATE " . DB_PREFIX . "promotion_log pd SET pd.pro_amount=$amount WHERE pd.customer_id=$customer_id AND pd.product_id=$product_id") 
            or die(mysql_error());  
	}	
}
?>