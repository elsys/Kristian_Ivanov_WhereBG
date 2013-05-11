<?php

class Facebook extends MY_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    public function index() {
        print_r(get_defined_vars());
    }

}

?>