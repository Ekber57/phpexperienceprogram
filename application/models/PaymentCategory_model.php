<?php
// require("a.php");
class PaymentCategory_model extends CI_Model {
    public function getAll()
   {
        
        $query = $this->db->select('*');
        $this->db->from("payment_categories");
        $currencies = $this->db->get();
        return $currencies->result();
    }
}

?>