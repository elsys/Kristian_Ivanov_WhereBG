<?php

class Users extends MY_Controller {

    //put your code here

    function __construct() {
        parent::__construct();        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usersmodel');
    }

    function index() {
//        $this->visited();
        $this->check_register();
//        $this->usersmodel->reg('admin',sha1('admin'));
        //$this->log_in();
        //$this->check_log_in();        
    }
    
    protected function check_register(){
        $res=$this->usersmodel->check_register();
        if(!empty($res)){
            $this->load->view('user_log_in');
        }else{
            $this->load->view('register_view');
        }
    }
    
    public function add_user(){
    	$this->load->view('register_view');
    }
    
    public function register(){
        $this->usersmodel->reg($_POST['username'],sha1($_POST['password']));
        $res=$this->usersmodel->check_register();
       if(count($res)===1)
	        $this->load->view('user_log_in');
	else
		redirect(site_url('admin', 'refresh'));	
    }
    
    public function log_in() {
        $passwordHash = sha1($_POST['password']);
        $username = $_POST['username'];
        $res = $this->usersmodel->check_log($username, $passwordHash);

        if (empty($res)) {
            $this->log_out();
        } else {
            $newdata = array(
                'logged_in' => 1,
                'username' => $username
            );
            $this->session->set_userdata($newdata);
            $this->check_log_in();
        }
    }

    public function log_out() {
        $newdata = array(
            'logged_in' => 0
        );
        $this->session->unset_userdata('username');
        $this->session->set_userdata($newdata);
        $this->check_log_in();
    }

    public function check_log_in() {
        if ($this->session->userdata('logged_in') == 1) {
            //$this->load->view('module_view');
            redirect(site_url('admin', 'refresh'));
        } else {
            $this->load->view('user_log_in');
        }
    }

    public function pre_change() {
        $this->load->view('userschangepass');
    }

    public function change_pass() {
        $user = $this->session->userdata('username');
        $new_pass = sha1($_POST['new_pass']);
        $passwordHash = sha1($_POST['old_pass']);
        $res = $this->usersmodel->check_log($user, $passwordHash);
        if ($res) {
            $this->usersmodel->update_pass($user, $new_pass);
            $this->log_out();
        } else {
            echo "Wrong Password";
        }
    }

    //put your code here
}

?>