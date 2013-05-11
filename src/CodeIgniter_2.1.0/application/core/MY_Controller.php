<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test_reload
 *
 * @author kristian
 */
class MY_Controller extends CI_Controller {

    protected $ctdescr = array(
        'db_name' => 'comments',
        'fdescr' => array(
            'comment' => array(
                'type' => 'text',
                'label' => 'Коментар',
                'grid' => true,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'source' => array(
                'type' => 'input',
                'label' => 'Източник',
                'grid' => true,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'stamp' => array(
                'type' => 'input',
                'label' => 'Време на добавяне',
                'grid' => true,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'approved' => array(
                'type' => 'input',
                'label' => 'Одобрено',
                'grid' => true,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 0,
            ),
        )
    );
    protected $tdescr = array(
        'db_name' => 'Venues',
        'fdescr' => array(
            'id' => array(
                'type' => 'input',
                'label' => 'Идентификационен номер',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 0,
            ),
            'name' => array(
                'type' => 'input',
                'label' => 'Име на заведението',
                'grid' => true,
                'grid_class' => 'large',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'lat' => array(
                'type' => 'input',
                'label' => 'Широчина',
                'grid' => true,
                'grid_class' => 'large',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 0,
            ),
            'lng' => array(
                'type' => 'input',
                'label' => 'Дължина',
                'grid' => true,
                'grid_class' => 'large',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 0,
            ),
            'address' => array(
                'type' => 'text',
                'label' => 'Адрес',
                'grid' => true,
                'grid_class' => 'large',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'phone' => array(
                'type' => 'input',
                'label' => 'Телефон',
                'grid' => true,
                'grid_class' => 'large',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'checkins' => array(
                'type' => 'input',
                'label' => 'Посещения(checkins)',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'twitter_checkins' => array(
                'type' => 'input',
                'label' => 'Twitter посещения(checkins)',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'users_count' => array(
                'type' => 'input',
                'label' => 'Брой посетители',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'service' => array(
                'type' => 'input',
                'label' => 'Обслужване',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'quality' => array(
                'type' => 'input',
                'label' => 'Качество на храната',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'prices' => array(
                'type' => 'input',
                'label' => 'Цени',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'descr' => array(
                'type' => 'text',
                'label' => 'Описание',
                'grid' => true,
                'grid_class' => 'large',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'category' => array(
                'type' => 'input',
                'label' => 'Категория',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'stamp' => array(
                'type' => 'input',
                'label' => 'Време на добавянето',
                'grid' => true,
                'grid_class' => 'large',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 1,
            ),
            'status' => array(
                'type' => 'input',
                'label' => 'Одобрение',
                'grid' => true,
                'grid_class' => 'small',
                'grid_id' => false,
                'edit' => true,
                'filter' => 0,
                'format' => '',
                'validate' => '',
                'showUser' => 0,
            ),
        )
    );
    //protected $keywords = array();
    protected $food = 0;
    protected $service = 0;
    protected $twitterLLSKeywords = array('I am at', 'I\'m at', 'I am in', 'I\'m in');
    protected $commentKeywords = array('comment', 'post');
    protected $numberofTypes;
    protected $pFoodKeywods = array();
    protected $nFoodKeywods = array();
    protected $pServiceKeywords = array();
    protected $nServiceKeywords = array();
    

    function __construct() {
        parent::__construct();        
        $this->load->helper('form');

        $this->load->model('countmodel');
        $this->load->model('keywordsmodel');
        $this->load->model('testmodel');

        if ($this->countmodel->getNumberOfEntries('keyword_types') !== false) {
            $this->numberofTypes = $this->countmodel->getLastID('keyword_types');
            $this->numberofTypes = $this->numberofTypes['MAX( id )'];
        }
        $this->loadWords();
    }

    function index() {
        
    }

    public function listing($field=null, $order=null, $search=null) {
        $temp_search = $this->session->userdata('searched');
        foreach ($this->tdescr['fdescr'] as $key => $value) {
            $value['filter'] = 0;
        }
        if ($order == 'asc') {
            $this->tdescr['fdescr'][$field]['filter'] = 1;
        } else if ($order == 'desc') {
            $this->tdescr['fdescr'][$field]['filter'] = 2;
        }

        $this->visited();
        $this->call_model($temp_search);
    }

    protected function call_model($search=null) {


        $temp = $this->testmodel->get($this->tdescr, $search);

        $data = array(
            'test' => 'test',
            'datas' => $temp,
            'view' => $this->tdescr['fdescr'],
            'searched' => $search
        );
        //array keys !!
        $this->load->view('admin_view', $data);
    }

    public function search() {
        $this->visited();
        $this->load->model('testmodel');
        $temp_search;
        if (isset($_POST['searched'])) {
            $temp_search = $_POST['searched'];
            $array = array(
                'searched' => $_POST['searched'],
            );
            $this->session->set_userdata($array);
        } else {
            $temp_search = $this->session->userdata('searched');
        }
        $temp = $this->testmodel->searched($this->tdescr, $temp_search);
        $data = array(
            'test' => 'test',
            'datas' => $temp,
            'view' => $this->tdescr['fdescr'],
            'search_' => $temp_search,
        );
        //array keys !!
        $this->load->view('admin_view', $data);
    }

    public function visited() {
        $prev = $this->session->userdata('history');
        if (empty($prev))
            $prev = array();
        if (end($prev) != current_url() || empty($prev))
            array_push($prev, current_url());

        $newdata = array(
            'history' => $prev,
        );
        $this->session->set_userdata($newdata);
        $data = array(
            'test' => 'test',
            'visited' => $this->session->userdata('history'),
        );
        //print_r (get_class($this));
        //if (get_class($this) === 'Users')
        $this->load->view('back_view', $data);
        //return ;
    }

    protected function loadWords() {
        $types = $this->keywordsmodel->getTypes();
        foreach ($types as $type) {
            //$keywords [$type->type]=$type->id;
            // type of the word + id from here
            $wordsIDs = $this->keywordsmodel->getLinkedIDs($type->id);
            foreach ($wordsIDs as $linkedWord) {
                $keywords = $this->keywordsmodel->getWordByID($linkedWord->keyword_id);
                foreach ($keywords as $keyword) {

                    switch ($type->type) {
                        case 'pFood':
                            $this->pFoodKeywods[$linkedWord->keyword_id] = $keyword->word;
                            break;
                        case 'nFood':
                            $this->nFoodKeywods[$linkedWord->keyword_id] = $keyword->word;
                            break;
                        case 'pService':
                            $this->pServiceKeywords[$linkedWord->keyword_id] = $keyword->word;
                            break;
                        case 'nService':
                            $this->nServiceKeywords[$linkedWord->keyword_id] = $keyword->word;
                            break;
//                        case 'twitterLLS':
//                            array_push($this->twitterLLSKeywords, $keyword->word);
//                            break;
                    }
                    //    $this->keywords[$keyword->word] = $type->type;                    
                }
            }
        }
    }

    protected function testforEN($str) {
        $voulsEN = array(
            'a', 'e', 'o', 'u', 'y', 'i',
        );
        foreach ($voulsEN as $singleVoul)
            if (strpos($str, $singleVoul) !== false)
                return true;
        return false;
    }

    protected function testforBG($str) {
        $voulsBG = array(
            'а', 'ъ', 'о', 'у', 'е', 'и',
        );
        foreach ($voulsBG as $singleVoul)
            if (strpos($str, $singleVoul) !== false)
                return true;
        return false;
    }

    public function evaluateComment($comment, $secCall=null) {
        $keywords_ = array(
            'pFood' => $this->pFoodKeywods,
            'pService' => $this->pServiceKeywords,
            'nFood' => $this->nFoodKeywods,
            'nService' => $this->nServiceKeywords,
        );
        $real = false;
        $commentArray = explode(' ', $comment);
        foreach ($keywords_ as $type => $keywords) {
            foreach ($keywords as $keyword) {
                if (stristr($keyword, ' ') !== FALSE) {
                    if (stristr($comment, $keyword) !== FALSE) {
                        $real = true;
                        switch ($type) {
                            case 'pFood':
                                $this->food++;
                                break;
                            case 'nFood':
                                $this->food--;
                                break;
                            case 'pService':
                                $this->service++;
                                break;
                            case 'nService':
                                $this->service--;
                                break;
                        }
                    }
                } else {
                    $percent;
                    foreach ($commentArray as $word) {
                        similar_text($word, $keyword, $percent);
                        if ($percent >= 85) {
                            $real = true;
                            switch ($type) {
                                case 'pFood':
                                    $this->food++;
                                    break;
                                case 'nFood':
                                    $this->food--;
                                    break;
                                case 'pService':
                                    $this->service++;
                                    break;
                                case 'nService':
                                    $this->service--;
                                    break;
                            }
                        }
                    }
                }
            }
        }
        if ($real) {
            return true;
        } else if (!$real && $this->testforEN($comment) && $secCall == false) {
            $this->evaluateComment($this->translate($comment), true);
        } else if ($secCall == true || $this->testforEN($comment) == false) {
            return $real;
        }
    }

    protected function twitterCheckins($comment) {
        foreach ($this->twitterLLSKeywords as $keyword)
            if (stristr($comment, $keyword) !== FALSE)
                return true;
        return false;
    }

    protected function twitterSearch($name, $id) {
        if ($this->testforBG($name) == true && $this->testforEN($name) == false)
            return;
        $nameExploded = explode(" ", $name);
        $peName = implode("%20", $nameExploded);
        $ch = curl_init('http://search.twitter.com/search.json?q="' . $peName . '"&geocode=42.42%2C23.20%2C300km');
        //$ch = curl_init('https://api.twitter.com/1/geo/search.json?long=23.231277&lat=42.77195');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        //print_r(json_decode($data));
        $json = json_decode($data);
        if (empty($json))
            return;
        foreach ($json->results as $result) {
            if (strpos($result->text, $name) !== false) {
                $res = $this->updatemodel->checkComment($result->text, 'comments');
                if (empty($res)) {
                    if ($this->twitterCheckins($result->text)) {
                        $this->updatemodel->insertComment($id, $result->text, 'tweet', 2, now());
                        $this->evaluateComment($result->text);
                        $this->twitterCheckins++;
                    } else {
                        $this->updatemodel->insertComment($id, $result->text, 'tweet', 1, now());
                        $this->evaluateComment($result->text);
                    }
                    $this->twitter++;
                }
            }
        }
    }

    protected function twitterSearchLL($lat, $lng, $id) {
        $ch = curl_init('http://search.twitter.com/search.json?q=food%20OR%20place%20OR%20here%20&geocode=' . $lat . '%2C' . $lng . '%2C15m');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($data);
        if (empty($json))
            return;
        foreach ($json->results as $result) {
            $res = $this->updatemodel->checkComment($result->text, 'comments');
            if (empty($res)) {
                if ($this->twitterCheckins($result->text)) {
                    $this->updatemodel->insertComment($id, $result->text, 'tweet', 2, now());
                    $this->evaluateComment($result->text);
                    $this->twitterCheckins++;
                } else {
                    $this->updatemodel->insertComment($id, $result->text, 'tweet', 1, now());
                    $this->evaluateComment($result->text);
                }
                $this->twitter++;
            }
        }
    }

    protected function translate($text) {
        $str = $text;
        $strStrip = str_replace(' ', '', $str);
        $split = preg_split('//', $strStrip, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($split as $char) {
            $str = str_replace($char, $this->charReplace($char), $str);
        }
        $str = str_replace('иа', 'я', $str);
        $str = str_replace('сх', 'ш', $str);
        $str = str_replace('схт', 'щ', $str);
        return $str;
    }

    protected function charReplace($ch) {
        switch ($ch) {
            case 'a':
                return 'а';
            case 'b':
                return 'б';
            case 'c':
                return 'ц';
            case 'd':
                return 'д';
            case 'e':
                return 'е';
            case 'f':
                return 'ф';
            case 'g':
                return 'г';
            case 'h':
                return 'х';
            case 'i':
                return 'и';
            case 'j':
                return 'дж';
            case 'k':
                return 'к';
            case 'l':
                return 'л';
            case 'm':
                return 'м';
            case 'n':
                return 'н';
            case 'o':
                return 'о';
            case 'p':
                return 'п';
            case 'q':
                return 'я';
            case 'r':
                return 'р';
            case 's':
                return 'с';
            case 't':
                return 'т';
            case 'u':
                return 'у';
            case 'v':
                return 'в';
            case 'w':
                return 'в';
            case 'x':
                return 'кс';
            case 'y':
                return 'у';
            case 'z':
                return 'з';
//                
            case 'A':
                return 'А';
            case 'B':
                return 'Б';
            case 'C':
                return 'Ц';
            case 'D':
                return 'Д';
            case 'E':
                return 'Е';
            case 'F':
                return 'Ф';
            case 'G':
                return 'Г';
            case 'H':
                return 'Х';
            case 'I':
                return 'И';
            case 'J':
                return 'ДЖ';
            case 'K':
                return 'К';
            case 'L':
                return 'Л';
            case 'M':
                return 'М';
            case 'N':
                return 'Н';
            case 'O':
                return 'О';
            case 'P':
                return 'П';
            case 'Q':
                return 'Я';
            case 'R':
                return 'Р';
            case 'S':
                return 'С';
            case 'T':
                return 'Т';
            case 'U':
                return 'У';
            case 'V':
                return 'В';
            case 'W':
                return 'В';
            case 'X':
                return 'КС';
            case 'Y':
                return 'У';
            case 'Z':
                return 'З';
        }
    }

}

?>
