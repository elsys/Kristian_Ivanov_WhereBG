<?php

class Systematic_update extends MY_Controller {

//twitter checkins when inserting and updating venue   
    protected $googleMax;
    protected $googleCurr;
    protected $venue;
    protected $twitterCheckins;

//think about replacing this 
//put your code here

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->model('updatemodel');
        $this->updatemodel->init($this->tdescr['db_name']);
    }

    public function index() {
        if ($this->session->userdata('logged_in') != 1) {
            redirect(site_url('users', 'refresh'));
        }
        $this->update('d033');
    }

    protected function update($param) {
        if ($param != 'd033')
            return;
        $venueLastID = $googleStatID = $this->countmodel->getLastID('Venues');
        if (!empty($venueLastID['MAX( id )'])) {
            $numberOfVenues = $venueLastID['MAX( id )'];
        } else {
            $numberOfVenues = 0;
        }
        $googleStatID = $this->countmodel->getLastID('google_stats');
        if (empty($googleStatID['MAX( id )'])) {
            $this->googleCurr = 1;
        } else {
            $parameters = array(
                'id' => $googleStatID['MAX( id )'],
            );
            $googlePrev = $this->countmodel->getParam('google_stats', $parameters, 'update_stat');
            $this->googleCurr = $googlePrev[0]->update_stat;
        }
        if ($numberOfVenues === $this->googleCurr) {
            $this->googleCurr = 1;
        }
        $this->googleMax = $this->googleCurr + 100;
        if ($this->googleCurr + 100 >= $numberOfVenues) {
            $this->googleMax = $numberOfVenues;
        }
        while ($this->googleCurr < $this->googleMax) {
            $this->food = 0;
            $this->service = 0;
            $this->googleSearch();
            $this->commentRevissited();
            $this->facebookUpdate();
            $this->notUpdated();
            $this->googleCurr++;
        }
        $this->updatemodel->insertGoogleStats($this->googleMax);
    }

    public function googleSearch() {

        $parameters = array(
            'id' => $this->googleCurr,
        );
        $name = $this->countmodel->getParam($this->tdescr['db_name'], $parameters, 'name');
        if (!empty($name)) {
            $query = $name[0]->name;
            $key = 'AIzaSyDW0nAj8lg5G9aj1abO_Zeu35JzEEUDzAw';
//$query = 'abv.bg';
            $cxKey = '014405064511477242498:--dgj_kkenq';
            $ch = curl_init('https://www.googleapis.com/customsearch/v1?key=' . $key . '&cx=' . $cxKey . '&q=' . $query . '&alt=json');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);

            $json = json_decode($data);

            if (!is_object($json))
                return;

            $queries = $json->queries;
            $response = $json->items;
//print_r($response);
            foreach ($response as $result) {
                $result->link; //returned link
                foreach ($this->commentKeywords as $word)
                    $this->parser($result->link, $word, $result->displayLink, $this->googleCurr);
                $result->title; //name
                $result->snippet; // little quot from the result
                $result->htmlSnippet; //the same
            }
        }
    }

    public function parser($link, $class, $source, $id) {
        $parameters = array(
            'id' => $id,
        );
        $temp = $this->countmodel->getParam($this->tdescr['db_name'], $parameters, 'quality');
        $prevFood = $temp[0]->quality;
        $temp = $this->countmodel->getParam($this->tdescr['db_name'], $parameters, 'service');
        $prevServ = $temp[0]->service;

        $oldSetting = libxml_use_internal_errors(true);
        libxml_clear_errors();
        $html = new DOMDocument();
        $success = $html->loadHtmlFile($link);
        if (!$success)
            return;
        $xpath = new DOMXPath($html);
        $elements = $xpath->query("*//div[contains(concat(' ',normalize-space(@class),' '),'" . $class . "')][not(div)]");
        if (!is_null($elements)) {
            foreach ($elements as $element) {
                $comment = trim($element->nodeValue);
                $comment = $this->spaceReplacer($comment);
                $check = explode(' ', $comment);
                $res = $this->updatemodel->checkComment($comment, 'comments');
                if (empty($res)) {
                    $check = $this->evaluateComment($comment);
                    if ($check) {
                        $this->updatemodel->insertComment($id, $comment, $source . ' - via google', 1, now());
                    }
                }
            }
        }
        libxml_clear_errors();
        libxml_use_internal_errors($oldSetting);
    }

    protected function spaceReplacer($str_) {
        $str = $str_;
        while (true) {
            $string = str_replace('  ', ' ', $str);
            if (strlen($string) == strlen($str))
                break;
            $str = $string;
        }
        return $string;
    }

    protected function notUpdated() {
        $id = $this->googleCurr;
        $parameters = array(
            'id' => $id,
        );
        $this->venue = $this->countmodel->getParam($this->tdescr['db_name'], $parameters, '');
//        $this->food += $this->venue[0]->quality;
//        $this->service += $this->venue[0]->service;

        $res = $this->updatemodel->getTwitterCheckins($this->venue[0]->name, $this->venue[0]->address);
        $prevChekcins = $this->venue[0]->twitter_checkins;

        $this->twitterSearch($this->venue[0]->name, $id);
        $this->twitterSearchLL($this->venue[0]->lat, $this->venue[0]->lng, $id);
        $this->updatemodel->update($this->venue[0]->name, $this->venue[0]->lat, $this->venue[0]->lng, $this->venue[0]->address, $this->venue[0]->phone, $this->venue[0]->checkins, $this->twitterCheckins + $prevChekcins, $this->venue[0]->users_count, $this->food, $this->service, $this->venue[0]->category, now());
    }

    protected function facebookUpdate() {
        $id = $this->googleCurr;
        $ch = curl_init('https://graph.facebook.com/comments/?ids=http://localhost/data_reg_users/one/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($data);
        foreach ($json as $post) {
            foreach ($post as $data)
                foreach ($data as $messagePost) {
                    if (!is_object($messagePost))
                        return;
                    $this->evaluateComment($messagePost->message);
                }
        }
    }

    protected function commentRevissited() {
        $id = $this->googleCurr;        
        $ven = $this->testmodel->get_one($id, $this->tdescr, $this->ctdescr);
        $data = array(
            'test' => 'test',
            'venue' => $ven,
            'venueDescr' => $this->tdescr['fdescr'],
            'commentDescr' => $this->ctdescr['fdescr'],
        );
        foreach ($ven['comments']as $comment) {
            if ($comment->approved == 1)
                $this->evaluateComment($comment->comment);
        }
    }

}
?>