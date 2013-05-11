<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author kristian
 */
class Testmodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get($temp, $search=null) {
        if ($search==null)
            foreach ($temp['fdescr'] as $key => $value) {
                $this->db->or_where('instr( '.$key. ', \''.$search.'\' )<>0');
            }
        $this->db->select('ID');
        foreach ($temp['fdescr'] as $key => $value) {
            $this->db->select($key);
        }

        foreach ($temp['fdescr'] as $key => $value) {
            if ($value['filter'] == 1) {
                $this->db->order_by($key, 'asc');
            } else if ($value['filter'] == 2) {
                $this->db->order_by($key, 'desc');
            }
        }
        $query = $this->db->get($temp['db_name']);
        return $query->result();
    }

    function searched($temp, $search_for) {
        if (!empty($search_for))
            foreach ($temp['fdescr'] as $key => $value) {
                $this->db->or_where('instr( '.$key. ', \''.$search_for.'\' )<>0');
            }

        foreach ($temp['fdescr'] as $key => $value) {
            if ($value['filter'] == 1) {
                $this->db->order_by($key, 'asc');
            } else if ($value['filter'] == 2) {
                $this->db->order_by($key, 'desc');
            }
        }

        $query = $this->db->get($temp['db_name']);
        return $query->result();
        //print ($this->db->last_query());
    }

    function get_one($id, $descr, $cdescr) {
        $this->db->where('id', $id);
        $query = $this->db->get($descr['db_name']);
        
        
        $this->db->where('venue_id', $id);
        $query2 = $this->db->get($cdescr['db_name']);
        $data=array(
            'venue'=>$query->result(),
            'comments'=>$query2->result(),
        );

        return $data;
    }

    function update($temp, $db) {
        $data = array();
        foreach ($temp as $k => $v) {
            if ($k != 'id' && $k != 'mysubmit')
                $data[$k] = $v;
        }
        $this->db->where('id', $temp['id']);
        $this->db->update($db, $data);
    }

}
?>
