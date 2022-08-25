<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAppointment($data) {
        $this->db->insert('appointment', $data);
    }



    function getSettings() {
        $query = $this->db->get('website_settings');
        return $query->row();
    }

    function updateSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('website_settings', $data);
    }

}
