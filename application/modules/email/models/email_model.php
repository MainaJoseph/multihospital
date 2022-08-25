<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getEmailSettingsById() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('email_settings');
        return $query->row();
    }

    function getEmailByUser($user) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('user', $user);
        $query = $this->db->get('email');
        return $query->result();
    }

    function getEmailSettings() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('email_settings');
        return $query->row();
    }

    function updateEmailSettings($data) {
        $this->db->update('email_settings', $data);
    }

    function addEmailSettings($data) {
        $this->db->insert('email_settings', $data);
    }

    function insertEmailSettings($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('email_settings', $data2);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('email');
    }

    function insertEmail($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('email', $data2);
    }

    function getEmail() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('email');
        return $query->result();
    }

}
