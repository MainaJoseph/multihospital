<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Package_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPackage($data) {
        $this->db->insert('package', $data);
    }

    function getPackage() {
        $query = $this->db->get('package');
        return $query->result();
    }

    function getDefaultPackage() {
        $this->db->where('set_as_default', '1');
        $query = $this->db->get('package');
        return $query->row();
    }

    function getPackageById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('package');
        return $query->row();
    }

    function updatePackage($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('package', $data);
    }

    function updateSetAsDefault($module, $data) {
        $this->db->where_not_in('module', $module);
        $this->db->update('package', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('package');
    }

}
