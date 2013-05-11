<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of edit
 *
 * @author kristian
 */
class Edit extends MY_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('testmodel');
    }

    public function index($id=0) {
        
    }

    public function edit_it($id=0) {

        $temp = $this->testmodel->get_one($id, $this->tdescr, $this->ctdescr);

        $data = array(
            'temp' => 'temp',
            'venue' => $temp['venue'],
            'comments'=>$temp['comments'],
            'fields' => $this->tdescr['fdescr'],
            'commentFields'=>$this->ctdescr['fdescr'],
        );
        $this->visited();
        $this->load->view('edit_view', $data);        
    }

    public function edit_action() {
        $this->testmodel->update($_POST, $this->tdescr['db_name']);        
        redirect(site_url('admin'), 'refresh');
    }
    
    public function edit_comment_action(){
        $this->testmodel->update($_POST, $this->ctdescr['db_name']);
        redirect(site_url('admin'), 'refresh');
    }

}?>