<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pharmacy_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPayment($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('pharmacy_payment', $data2);
    }

    function getPayment() {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('pharmacy_payment');
        return $query->result();
    }

    function getPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('pharmacy_payment');
        return $query->row();
    }

    function getPaymentByKey($page_number, $key) {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $data_range_1 = 50 * $page_number;
        $this->db->like('id', $key);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('pharmacy_payment', 50, $data_range_1);
        return $query->result();
    }
    
      function getPaymentByPatientId($id) {
           $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('pharmacy_payment');
        return $query->result();
    }

    function getPaymentByPageNumber($page_number) {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $data_range_1 = 50 * $page_number;
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('pharmacy_payment', 50, $data_range_1);
        return $query->result();
    }

    function updatePayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('pharmacy_payment', $data);
    }

    function deletePayment($id) {
        $this->db->where('id', $id);
        $this->db->delete('pharmacy_payment');
    }

    function insertExpense($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('pharmacy_expense', $data2);
    }

    function getExpense() {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('pharmacy_expense');
        return $query->result();
    }

    function getExpenseById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('pharmacy_expense');
        return $query->row();
    }

    function updateExpense($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('pharmacy_expense', $data);
    }

    function insertExpenseCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('pharmacy_expense_category', $data2);
    }

    function getExpenseCategory() {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_expense_category');
        return $query->result();
    }

    function getExpenseCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('pharmacy_expense_category');
        return $query->row();
    }

    function updateExpenseCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('pharmacy_expense_category', $data);
    }

    function deleteExpense($id) {
        $this->db->where('id', $id);
        $this->db->delete('pharmacy_expense');
    }

    function deleteExpenseCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('pharmacy_expense_category');
    }

    function getDiscountType() {
        $query = $this->db->get('settings');
        return $query->row()->discount;
    }

    function getPaymentByDate($date_from, $date_to) {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('pharmacy_payment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getExpenseByDate($date_from, $date_to) {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('pharmacy_expense');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function amountReceived($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('pharmacy_payment', $data);
    }

    function todaySalesAmount() {
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->getPaymentByDate($today, $today_last);

        foreach ($data['payments'] as $sales) {
            $sales_amount[] = $sales->gross_total;
        }
        if (!empty($sales_amount)) {
            return array_sum($sales_amount);
        } else {
            return 0;
        }
    }

    function todayExpensesAmount() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['payments'] = $this->getExpenseByDate($today, $today_last);

        foreach ($data['payments'] as $expenses) {
            $expenses_amount[] = $expenses->amount;
        }
        if (!empty($expenses_amount)) {
            return array_sum($expenses_amount);
        } else {
            return 0;
        }
    }

}
