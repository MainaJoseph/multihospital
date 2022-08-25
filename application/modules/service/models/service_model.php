<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertService($data) {
        $this->db->insert('service', $data);
    }

    function getService() {
        $query = $this->db->get('service');
        return $query->result();
    }

    function getServiceById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('service');
        return $query->row();
    }

    function updateService($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('service', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('service');
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

    function getServiceByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('service');
        return $query->row();
    }

}
