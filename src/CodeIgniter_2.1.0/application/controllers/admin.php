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
class Admin extends MY_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->session->userdata('logged_in') == 1) {
            //$this->load->view('user_logged');
            $this->listing();
        } else {
            redirect(site_url('users'), 'refresh');
        }
    }     

}
?>