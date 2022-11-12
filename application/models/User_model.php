<?php
// require("a.php");
class User_model extends CI_Model {
    public function getAll()
   {
        $this->db->from("users");
        $currencies = $this->db->get();
        return $currencies->result();
    }
}

?>