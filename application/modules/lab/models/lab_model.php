<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lab_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertLab($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('lab', $data2);
    }

    function getLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabBySearch($search) {
        
        $this->db->order_by('id', 'desc');

        /*
          $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
          $this->db->like('id', $search);
          $this->db->or_like('patient_name', $search);
          $this->db->or_like('patient_phone', $search);
          $this->db->or_like('patient_address', $search);
          $this->db->or_like('doctor_name', $search);
          $this->db->or_like('date_string', $search);
          $query = $this->db->get('lab');
         * 
         */

        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getLabByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabByLimitBySearch($limit, $start, $search) {
       
        $this->db->order_by('id', 'desc');
        
        /*
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);
        $this->db->or_like('doctor_name', $search);
        $this->db->or_like('date_string', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
         * 
         */
        
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        
        
        return $query->result();
    }

    function getLabById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('lab');
        return $query->row();
    }

    function getLabByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabByPatientIdByDate($id, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabByUserId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('user', $id);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getOtLabByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('ot_lab');
        return $query->result();
    }

    function getLabByPatientIdByStatus($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'unpaid');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function updateLab($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('lab', $data);
    }

    function insertLabCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('lab_category', $data2);
    }

    function getLabCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('lab_category');
        return $query->result();
    }

    function getLabCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('lab_category');
        return $query->row();
    }

    function updateLabCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('lab_category', $data);
    }

    function deleteLab($id) {
        $this->db->where('id', $id);
        $this->db->delete('lab');
    }

    function deleteLabCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('lab_category');
    }

    function getLabByDoctor($doctor) {
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get();
        return $query->result();
    }

    function getLabByDate($date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getLabByDoctorDate($doctor, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('doctor', $doctor);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getLabByUserIdByDate($user, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('user', $user);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function insertTemplate($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('template', $data2);
    }

    function getTemplate() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('template');
        return $query->result();
    }

    function updateTemplate($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('template', $data);
    }

    function getTemplateById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('template');
        return $query->row();
    }

    function deletetemplate($id) {
        $this->db->where('id', $id);
        $this->db->delete('template');
    }

}
