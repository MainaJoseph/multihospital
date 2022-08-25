<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertNotice($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('notice', $data2);
    }

    function getNotice() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('notice');
        return $query->result();
    }

    function getNoticeById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('notice');
        return $query->row();
    }

    function updateNotice($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('notice', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('notice');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
