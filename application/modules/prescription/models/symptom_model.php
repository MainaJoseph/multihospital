<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Symptom_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSymptom($data) {
        $this->db->insert('symptom', $data);
    }

    function getSymptom() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('symptom');
        return $query->result();
    }

    function getSymptomById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('symptom');
        return $query->row();
    }

    function getSymptomByPatientId($patieent_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patieent_id);
        $query = $this->db->get('symptom');
        return $query->result();
    }

    function updateSymptom($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('symptom', $data);
    }

    function deleteSymptom($id) {
        $this->db->where('id', $id);
        $this->db->delete('symptom');
    }

}
