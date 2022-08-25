<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Receptionist_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertReceptionist($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('receptionist', $data2);
    }

    function getReceptionist() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('receptionist');
        return $query->result();
    }

    function getReceptionistById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('receptionist');
        return $query->row();
    }

    function getReceptionistByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('receptionist');
        return $query->row();
    }

    function updateReceptionist($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('receptionist', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('receptionist');
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
