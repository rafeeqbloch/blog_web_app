<?php

class Admin_model extends CI_Model {




    public function getbyiusername($username)
    {
        $this->db->where('username', $username);
        $admin = $this->db->get('admins')->row_array();
        return $admin;
    }
    

   
}
?>