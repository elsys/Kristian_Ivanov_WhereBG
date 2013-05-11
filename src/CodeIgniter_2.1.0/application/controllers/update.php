<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php

class Update extends MY_Controller {

//twitter checkins when inserting and updating venue
    protected $id = 1;
    protected $foursquareVenues = 0;
    protected $foursquareComments = 0;
    protected $twitter = 0;
    protected $updated = 0;
    //protected $twitterCheckinsKeywords = array('I\'m at', 'I am at', 'I am in', 'I\'m in');
    protected $twitterCheckins = 0;
    protected $places = array();

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
        $this->FSTupdate('d033');        
    }

    public function FSTupdate($param) {
        if ($param != 'd033')
            return;
        $sections = array('food', 'drinks', 'coffee');
//print_r($this->getVenues(42.693, 23.32));
        for ($i = 0; $i <= 10; $i++) {
            foreach ($sections as $k => $section) {
//            for ($lat = 42.619543; $lat <= 42.77195; $lat+=0.003) {
//                for ($lng = 23.231277; $lng <= 23.479843; $lng+=0.003) {
////print $lat.'           '.$lng;
//                    
//                }
//            }
                $lat = 42;
                $lng = 23;
                $lat_ = rand(61954, 77195);
                $lng_ = rand(23127, 47984);
                $lat+=$lat_ / 100000;
                $lng+=$lng_ / 100000;
                //print 'lat ---' . $lat . '_____lng ---' . $lng . '<br/> <br/>';
                $venues_ = $this->getVenues($lat, $lng, $section);
                $this->preAnalize($venues_);
            }
        }
    }

    protected function getVenues($lat, $lng, $section) {
        $ch = curl_init('https://api.foursquare.com/v2/venues/explore?ll=' . $lat . ',' . $lng . '&section=' . $section . '&limit=50&oauth_token=ZTXTAZ0GV00SWNTTZ14QIHPIS5OEWKTOVD0WLEYJDS0OGW5Z&v=20111101');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return json_decode($data);
    }

    protected function preAnalize($data) {

//        print_r($data);
        $response = $data->response;

        $keywords = $response->keywords;
        $groups = $response->groups;



        foreach ($groups as $group) {
//print_r($group);    
            $items = $group->items;
            foreach ($items as $item) {

                $venue = $item->venue;
//                $venue->id;
                //$this->getLinks($venue->id);
                //  print $this->id . '------';
//                $venue->name;
                $location = $venue->location;
                $category = $venue->categories;

//                $location->lat;
//                $location->lng;

                if (!empty($location->address)) {
                    $address = $location->address;
                } else {
                    $address = 'none';
                }

                $contact = $venue->contact;
                if (!empty($contact->phone)) {
                    $phone = $contact->phone;
                } else {
                    $phone = 'none';
                }

                $stats = $venue->stats;
//                $stats->checkinsCount;
//                $stats->usersCount;
//                $venue->hereNow;
                $temp = array(
                    'name' => $venue->name,
                    'address' => $address,
                );
                if (in_array($temp, $this->places)) {
                    
                } else {
                    $this->twitterCheckins = 0;
                    $this->food = 0;
                    $this->service = 0;
                    $params = array(
                        'name' => $venue->name,
                        'address' => $address,
                    );

                    array_push($this->places, $temp);
                    $res = $this->updatemodel->check($venue->name, $address);
                    if (empty($res)) {
                        $this->updatemodel->insert($venue->name, $address);
                        $id = $this->countmodel->getParam('Venues', $params, 'id');
                        if (!empty($contact->twitter))
                            $this->updatemodel->insertLink($contact->twitter, 'twitter', $id[0]->id, now(), 1);
                        if (!empty($venue->url))
                            $this->updatemodel->insertLink($venue->url, 'url', $id[0]->id, now(), 1);
                        $this->destructTips($this->getTips($venue->id), $id[0]->id);
                        $this->foursquareVenues++;

                        $this->twitterSearch($venue->name, $id[0]->id);
                        $this->twitterSearchLL($location->lat, $location->lng, $id[0]->id);
                        //$this->googleSearch($venue->name, $id[0]->id);
                        $this->updatemodel->update($venue->name, $location->lat, $location->lng, $address, $phone, $stats->checkinsCount, $this->twitterCheckins, $stats->usersCount, $this->food, $this->service, $category[0]->name, now());
                    } else {
                        $this->food = $this->countmodel->getParam('Venues', $params, 'quality');
                        $this->service = $this->countmodel->getParam('Venues', $params, 'service');
                        $this->food = $this->food[0]->quality;
                        $this->service = $this->service[0]->service;

                        $res = $this->updatemodel->getTwitterCheckins($venue->name, $address);
                        $prevChekcins = $res[0]->twitter_checkins;

                        $id = $this->countmodel->getParam('Venues', $params, 'id');
                        $this->twitterSearch($venue->name, $id[0]->id);
                        $this->twitterSearchLL($location->lat, $location->lng, $id[0]->id);
                        $this->destructTips($this->getTips($venue->id), $id[0]->id);
                        //$this->googleSearch($venue->name, $id[0]->id);
                        $this->updatemodel->update($venue->name, $location->lat, $location->lng, $address, $phone, $stats->checkinsCount, $this->twitterCheckins + $prevChekcins, $stats->usersCount, $this->food, $this->service, $category[0]->name, now());
                        $this->updated++;
                    }
                }
            }
        }
    }

    protected function getLinks($venueID) {
        $ch = curl_init('https://api.foursquare.com/v2/venues/' . $venueID . '/links?oauth_token=ZTXTAZ0GV00SWNTTZ14QIHPIS5OEWKTOVD0WLEYJDS0OGW5Z&v=20111116');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data);
        //print_r($data);
    }

    protected function getTips($venueID) {
        $ch = curl_init('https://api.foursquare.com/v2/venues/' . $venueID . '/tips?sort=recent&oauth_token=ZTXTAZ0GV00SWNTTZ14QIHPIS5OEWKTOVD0WLEYJDS0OGW5Z&v=20111116');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data);
    }

    protected function destructTips($tips, $id) {
        $response = $tips->response;
        $tips = $response->tips;
        $items = $tips->items;
        foreach ($tips->items as $k => $item) {
            $res = $this->updatemodel->checkComment($item->text, 'comments');
            if (empty($res)) {
                $this->updatemodel->insertComment($id, $item->text, 'foursquare', 1, now());
                $this->evaluateComment($item->text);
                $this->foursquareComments++;
            }
        }
    }

//@Deprecated no more need of this
//    protected function results() {
//        $data = array(
//            'test' => 'test',
//            'foursquareComments' => $this->foursquareComments,
//            'foursquareVenues' => $this->foursquareVenues,
//            'twitter' => $this->twitter,
//            'updated' => $this->updated,
//        );
//        $this->load->view('results_view', $data);
//    }
}
?>


