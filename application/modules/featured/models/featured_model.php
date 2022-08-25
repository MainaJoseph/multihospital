<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Featured_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFeatured($data) {
        $this->db->insert('featured', $data);
    }

    function getFeatured() {
        $query = $this->db->get('featured');
        return $query->result();
    }

    function getFeaturedById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('featured');
        return $query->row();
    }

    function updateFeatured($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('featured', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('featured');
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

    function getFeaturedByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('featured');
        return $query->row();
    }

}
