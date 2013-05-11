<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of log_in_model
 *
 * @author kristian
 */
class Usersmodel extends CI_Model {
    //put your code here
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function reg($username, $pass) {        
        $data = array(
            'username' => $username,
            'password' => $pass,
            'level' => 1
        );
        $this->db->insert('admins', $data);
    }

    public function check_log($name, $pass) {
        $this->db->where('username', $name);
        $this->db->where('password', $pass);
        $this->db->select('username, password');
        $query = $this->db->get('admins');
        return $query->result();
//        print($this->db->last_query());
//        exit;
    }

    public function update_pass($username, $new_pass) {
        $data = array(
            'password'=>$new_pass
        );
        $this->db->where('username', $username);
        $this->db->update('admins', $data);
    }
    
    public function check_register(){
        $query = $this->db->get('admins');
        return $query->result();
    }

    //put your code here

}
?>
