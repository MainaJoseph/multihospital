<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slide_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSlide($data) {
        $this->db->insert('slide', $data);
    }

    function getSlide() {
        $query = $this->db->get('slide');
        return $query->result();
    }

    function getSlideById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('slide');
        return $query->row();
    }

    function updateSlide($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('slide', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('slide');
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

    function getSlideByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('slide');
        return $query->row();
    }

}
