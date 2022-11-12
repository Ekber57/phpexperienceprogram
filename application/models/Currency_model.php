<?php
// require("a.php");
class Currency_model extends CI_Model {
    public function getAll()
   {
        
        $query = $this->db->select('*');
        $this->db->from("currencies");
        $currencies = $this->db->get();
        return $currencies->result();
    }
}

?>