<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Keywordsmodel extends CI_Model {

    private $dbTypes = 'keyword_types';
    private $dbWords = 'keywords';
    private $dbLink = 'keywords_to_types';

    //put your code here
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function addWord($word) {
        $data = array(
            'word' => $word
        );

        $this->db->insert($this->dbWords, $data);
    }

    public function wordToType($wordID, $typeID) {
        $data = array(
            'keyword_id' => $wordID,
            'type_id' => $typeID,
        );
        $this->db->insert($this->dbLink, $data);
    }

    public function addType($word) {
        $data = array(
            'type' => $word
        );

        $this->db->insert($this->dbTypes, $data);
    }

    public function getTypes() {
        $query = $this->db->get($this->dbTypes);
        return $query->result();
    }

    public function getLinkedIDs($typeID) {
        $this->db->where('type_id', $typeID);
        $this->db->select('keyword_id');
        $query = $this->db->get($this->dbLink);
        return $query->result();
    }

    public function getWordByID($id){
        $this->db->where('id', $id);
        $this->db->select('word');
        $query = $this->db->get($this->dbWords);
        return $query->result();
    }
//@Deprecated
//no longer needed    
//    public function getIDByWord($word){
//        $this->db->where('word', $word);
//        $this->db->select('id');
//        $query = $this->db->get($this->dbWords);
//        return $query->result();
//    }
    
    public function deleteWord($id){
        $this->db->where('id', $id);
        $this->db->delete($this->dbWords); 
        
        $this->db->where('keyword_id',$id);
        $this->db->delete($this->dbLink); 
    }
    


}

?>
