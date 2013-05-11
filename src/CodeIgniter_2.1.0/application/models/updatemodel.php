<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Updatemodel extends CI_Model {

    protected $dbName;

    //put your code here
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function init($dbName_) {
        $this->dbName = $dbName_;
    }

    public function check($name, $address) {
        $this->db->where('name', $name);
        $this->db->where('address', $address);

        $query = $this->db->get($this->dbName);
        return $query->result();
    }

    public function checkComment($text, $dbName) {
        $this->db->where('comment', $text);
        $query = $this->db->get($dbName);
        return $query->result();
    }

    public function insert($name,  $address) {
        $data = array(
            'name' => $name,
//            'lat' => $lat,
//            'lng' => $lng,
            'address' => $address,
//            'phone' => $phone,
//            'checkins' => $checkins,
//            'twitter_checkins' => $twitterCheckins,
//            'users_count' => $userCount,
//            'stamp' => $stamp,
        );

//        $data2 = array(
//            'url' => $url,
//        );
//        $this->db->insert('links', $data2);

        $this->db->insert($this->dbName, $data);
    }

    public function update($name, $lat, $lng, $address, $phone, $checkins, $twitterCheckins, $userCount, $food, $service, $category, $stamp) {
        $data = array(
//            'name' => $name,
            'lat' => $lat,
            'lng' => $lng,
//            'address' => $address,
            'phone' => $phone,
            'checkins' => $checkins,
            'users_count' => $userCount,
            'service'=>$service,
            'twitter_checkins'=>$twitterCheckins,
            'quality'=>$food,
            'category'=>$category,
            'stamp' => $stamp,
        );
        $this->db->where('name', $name);
        $this->db->where('address', $address);
        $this->db->update($this->dbName, $data);
    }

    public function getTwitterCheckins($name, $address) {
        $this->db->where('name', $name);
        $this->db->where('address', $address);            
        
        $this->db->select('twitter_checkins');
        $query = $this->db->get($this->dbName);
        return $query->result();
    }



    public function insertComment($venue_id, $comment, $source, $approved, $stamp) {
        $data = array(
            'venue_id' => $venue_id,
            'comment' => $comment,
            'source' => $source,
            'approved' => $approved,
            'stamp' => $stamp,
        );
        $this->db->insert('comments', $data);
    }

    public function insertLink($link, $type, $venue_id, $stamp, $status) {
        $data = array(
            'venue_id' => $venue_id,
            'url' => $link,
            'type' => $type,
            'status' => $status,
            'stamp' => $stamp,
        );
        $this->db->insert('links', $data);
    }
    
    public function insertGoogleStats($stat){
        $data=array(
            'update_stat'=>$stat,
        );
        $this->db->insert('google_stats', $data);
    }
}

?>
