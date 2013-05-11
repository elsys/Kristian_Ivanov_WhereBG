<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author kristian
 */
class Data_reg_users extends MY_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function index() {
        $temp = $this->testmodel->get($this->tdescr, null);
        $data = array(
            'test' => 'test',
            'datas' => json_encode($temp),
            'userUrl' => site_url('get_reg_users/one/'),
        );
        $this->load->view('mainusers_view', $data);
    }

    public function about() { 
        $this->load->view('about_view');
    }
    
    public function one($id) {
        $ven = $this->testmodel->get_one($id, $this->tdescr, $this->ctdescr);
        $data = array(
            'test' => 'test',
            'venue' => $ven,
            'venueDescr' => $this->tdescr['fdescr'],
            'commentDescr' => $this->ctdescr['fdescr'],
        );
        $this->load->view('venue_details_view', $data);
    }

    
}
?>