<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertBed($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bed', $data2);
    }

    function getBed() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('bed');
        return $query->result();
    }

    function getBedById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bed');
        return $query->row();
    }

    function updateBed($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed', $data);
    }

    function updateBedByBedId($bed_id, $data) {
        $this->db->where('bed_id', $bed_id);
        $this->db->update('bed', $data);
    }

    function insertBedCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bed_category', $data2);
    }

    function getBedCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('bed_category');
        return $query->result();
    }

    function getBedAllotmentsByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getBedCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bed_category');
        return $query->row();
    }

    function updateBedCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed_category', $data);
    }

    function deleteBed($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed');
    }

    function deleteBedCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed_category');
    }

    function insertAllotment($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('alloted_bed', $data2);
    }

    function getAllotment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getAllotmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('alloted_bed');
        return $query->row();
    }

    function updateAllotment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('alloted_bed', $data);
    }

    function deleteBedAllotment($id) {
        $this->db->where('id', $id);
        $this->db->delete('alloted_bed');
    }

}
