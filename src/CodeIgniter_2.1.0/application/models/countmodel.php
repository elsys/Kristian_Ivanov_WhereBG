<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Countmodel extends CI_Model {
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
        public function getLastID($dbName) {
        $query = 'SELECT MAX( id )
FROM ' . $dbName;
        $result = mysql_query($query);
        return mysql_fetch_assoc($result);
    }

    public function getNumberOfEntries($dbName) {
        $query = 'select count(id) from ' . $dbName;
        $result = mysql_query($query);
        return $result;
    }
    public function getParam($dbName, $parameters, $param){
        foreach($parameters as $column=>$value)
            $this->db->where($column, $value);
        $this->db->select($param);        
        $query = $this->db->get($dbName);
        return $query->result();        
    }
}
?>
