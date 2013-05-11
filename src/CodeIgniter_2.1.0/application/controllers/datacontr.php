
<?php

class Datacontr extends MY_Controller {

    function __construct() {
        parent::__construct();
        
    }

    function index() {        
        
        $temp = $this->testmodel->get($this->tdescr, $search);

        $data = array(
            'test' => 'test',
            'datas' => $temp,
        );

        $this->load->view('mainview', $datas);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
