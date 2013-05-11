<?php

class mainmodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all() {

        //$foursquare = 'foursquare';

        $this->load->database();

        // $this->db->where('source', $foursquare);

        //$this->db->select('lat, lng');

        //$query = $this->db->get('venues');

        //return $query->result();
    }

    function get_top_ten() {
        $this->load->database();
        $query = $this->db->get('Venues', 10);
        return $query->result();
    }

}

?>