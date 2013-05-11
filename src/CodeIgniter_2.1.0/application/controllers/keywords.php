<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Keywords extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('keywordsmodel');
    }

    public function index() {
        $this->visited();
        $data = array(
            'test' => 'test',
            'types' => $this->keywordsmodel->getTypes(),
            'pFood'=>$this->pFoodKeywods,
            'nFood'=>$this->nFoodKeywods,
            'pService'=>$this->pServiceKeywords,
            'nService'=>$this->nServiceKeywords,
        );
        $this->load->view('keywords_view', $data);
        
    }

    public function addWord() {
        $this->keywordsmodel->addWord($_POST['word']);

        $data = array(
            'word' => $_POST['word'],
        );
        $id = $this->countmodel->getParam('keywords', $data, 'id');
        for ($i = 0; $i <= $this->numberofTypes; $i++) {
            if (isset($_POST['type' . $i]))
                $res = $this->keywordsmodel->wordToType($id[0]->id, $_POST['type' . $i]);
        }        
        redirect(site_url('keywords'));
    }

    public function addType() {
        $this->keywordsmodel->addType($_POST['type']);
        redirect(site_url('keywords'));
    }   
    
    public function deleteWord($id){      
        $this->keywordsmodel->deleteWord($id);
        redirect(site_url('keywords'));
    }

}

?>
