<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pharmacist_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPharmacist($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('pharmacist', $data2);
    }

    function getPharmacist() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacist');
        return $query->result();
    }

    function getPharmacistById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('pharmacist');
        return $query->row();
    }

    function updatePharmacist($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('pharmacist', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('pharmacist');
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
