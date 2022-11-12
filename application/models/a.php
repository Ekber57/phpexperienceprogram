<?php
include "a.php";
class BaseRepositoryModel extends CI_Model {
    public function getALl()
   {
        
        $query = $this->db->select('*');
        $this->db->from("currencies");
        $currencies = $this->db->get();
        return $currencies->result();
    }
}

?>