<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertMedicine($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('medicine', $data2);
    }

    function getMedicine() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getLatestMedicine() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineByPageNumber($page_number) {
        $data_range_1 = 50 * $page_number;
        $this->db->order_by('id', 'asc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByStockAlert() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('quantity <=', 20);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineByStockAlertByPageNumber($page_number) {
        $data_range_1 = 50 * $page_number;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('quantity <=', 20);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medicine');
        return $query->row();
    }

    function getMedicineByKeyByStockAlert($page_number, $key) {
        $data_range_1 = 50 * $page_number;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('quantity <=', 20);
        $this->db->or_like('name', $key);
        $this->db->or_like('company', $key);



        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByKey($page_number, $key) {
        $data_range_1 = 50 * $page_number;
        $this->db->like('name', $key);
        $this->db->or_like('company', $key);
        $this->db->order_by('id', 'asc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByKeyForPos($key) {
        $this->db->like('name', $key);
        $this->db->order_by('id', 'asc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function updateMedicine($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine', $data);
    }

    function insertMedicineCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('medicine_category', $data2);
    }

    function getMedicineCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine_category');
        return $query->result();
    }

    function getMedicineCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medicine_category');
        return $query->row();
    }

    function totalStockPrice() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine')->result();
        $stock_price = array();
        foreach ($query as $medicine) {
            $stock_price[] = $medicine->price * $medicine->quantity;
        }

        if (!empty($stock_price)) {
            return array_sum($stock_price);
        } else {
            return 0;
        }
    }

    function updateMedicineCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine_category', $data);
    }

    function deleteMedicine($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine');
    }

    function deleteMedicineCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine_category');
    }

}
