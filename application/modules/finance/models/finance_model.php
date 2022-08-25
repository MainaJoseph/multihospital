<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPayment($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('payment', $data2);
    }

    function getPayment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentBySearch($search) {

        $this->db->order_by('id', 'desc');

        /*
          $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
          $this->db->like('id', $search);
          $this->db->or_like('amount', $search);
          $this->db->or_like('gross_total', $search);
          $this->db->or_like('patient_name', $search);
          $this->db->or_like('patient_phone', $search);
          $this->db->or_like('patient_address', $search);
          $this->db->or_like('remarks', $search);
          $this->db->or_like('doctor_name', $search);
          $this->db->or_like('flat_discount', $search);
          $this->db->or_like('date_string', $search);
          $query = $this->db->get('payment');
         * 
         */

        $query = $this->db->select('*')
                ->from('payment')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR amount LIKE '%" . $search . "%' OR gross_total LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%'OR patient_phone LIKE '%" . $search . "%'OR patient_address LIKE '%" . $search . "%'OR remarks LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR flat_discount LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getPaymentByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentByLimitBySearch($limit, $start, $search) {

        $this->db->order_by('id', 'desc');

        /*
          $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
          $this->db->like('id', $search);
          $this->db->or_like('amount', $search);
          $this->db->or_like('gross_total', $search);
          $this->db->or_like('patient_name', $search);
          $this->db->or_like('patient_phone', $search);
          $this->db->or_like('patient_address', $search);
          $this->db->or_like('remarks', $search);
          $this->db->or_like('doctor_name', $search);
          $this->db->or_like('flat_discount', $search);
          $this->db->or_like('date_string', $search);
          $this->db->limit($limit, $start);
          $query = $this->db->get('payment');
         * 
         */

        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('payment')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR amount LIKE '%" . $search . "%' OR gross_total LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%'OR patient_phone LIKE '%" . $search . "%'OR patient_address LIKE '%" . $search . "%'OR remarks LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR flat_discount LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment');
        return $query->row();
    }

    function getPaymentByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentByPatientIdByDate($id, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentByUserId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('user', $id);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function thisMonthPayment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('payment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('m/Y', time()) == date('m/Y', $q->date)) {
                $total[] = $q->gross_total;
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisMonthExpense() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('expense')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('m/Y', time()) == date('m/Y', $q->date)) {
                $total[] = $q->amount;
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisMonthAppointment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('appointment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('m/Y', time()) == date('m/Y', $q->date)) {
                $total[] = '1';
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisDayPayment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('payment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('d/m/Y', time()) == date('d/m/Y', $q->date)) {
                $total[] = $q->gross_total;
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisDayExpense() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('expense')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('d/m/Y', time()) == date('d/m/Y', $q->date)) {
                $total[] = $q->amount;
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisDayAppointment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('appointment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('d/m/Y', time()) == date('d/m/Y', $q->date)) {
                $total[] = '1';
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisYearPayment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('payment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('Y', time()) == date('Y', $q->date)) {
                $total[] = $q->gross_total;
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisYearExpense() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('expense')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('Y', time()) == date('Y', $q->date)) {
                $total[] = $q->amount;
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisYearAppointment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('appointment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('Y', time()) == date('Y', $q->date)) {
                $total[] = '1';
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisMonthAppointmentTreated() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('appointment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('m/Y', time()) == date('m/Y', $q->date)) {
                if ($q->status == 'Treated') {
                    $total[] = '1';
                }
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function thisMonthAppointmentCancelled() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('appointment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('m/Y', time()) == date('m/Y', $q->date)) {
                if ($q->status == 'Cancelled') {
                    $total[] = '1';
                }
            }
        }
        if (!empty($total)) {
            return array_sum($total);
        } else {
            return 0;
        }
    }

    function getPaymentPerMonthThisYear() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('payment')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('Y', time()) == date('Y', $q->date)) {
                if (date('m', $q->date) == '01') {
                    $total['january'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '02') {
                    $total['february'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '03') {
                    $total['march'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '04') {
                    $total['april'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '05') {
                    $total['may'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '06') {
                    $total['june'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '07') {
                    $total['july'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '08') {
                    $total['august'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '09') {
                    $total['september'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '10') {
                    $total['october'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '11') {
                    $total['november'][] = $q->gross_total;
                }
                if (date('m', $q->date) == '12') {
                    $total['december'][] = $q->gross_total;
                }
            }
        }


        if (!empty($total['january'])) {
            $total['january'] = array_sum($total['january']);
        } else {
            $total['january'] = 0;
        }
        if (!empty($total['february'])) {
            $total['february'] = array_sum($total['february']);
        } else {
            $total['february'] = 0;
        }
        if (!empty($total['march'])) {
            $total['march'] = array_sum($total['march']);
        } else {
            $total['march'] = 0;
        }
        if (!empty($total['april'])) {
            $total['april'] = array_sum($total['april']);
        } else {
            $total['april'] = 0;
        }
        if (!empty($total['may'])) {
            $total['may'] = array_sum($total['may']);
        } else {
            $total['may'] = 0;
        }
        if (!empty($total['june'])) {
            $total['june'] = array_sum($total['june']);
        } else {
            $total['june'] = 0;
        }
        if (!empty($total['july'])) {
            $total['july'] = array_sum($total['july']);
        } else {
            $total['july'] = 0;
        }
        if (!empty($total['august'])) {
            $total['august'] = array_sum($total['august']);
        } else {
            $total['august'] = 0;
        }
        if (!empty($total['september'])) {
            $total['september'] = array_sum($total['september']);
        } else {
            $total['september'] = 0;
        }
        if (!empty($total['october'])) {
            $total['october'] = array_sum($total['october']);
        } else {
            $total['october'] = 0;
        }
        if (!empty($total['november'])) {
            $total['november'] = array_sum($total['november']);
        } else {
            $total['november'] = 0;
        }
        if (!empty($total['december'])) {
            $total['december'] = array_sum($total['december']);
        } else {
            $total['december'] = 0;
        }

        return $total;
    }

    function getExpensePerMonthThisYear() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('expense')->result();
        $total = array();
        foreach ($query as $q) {
            if (date('Y', time()) == date('Y', $q->date)) {
                if (date('m', $q->date) == '01') {
                    $total['january'][] = $q->amount;
                }
                if (date('m', $q->date) == '02') {
                    $total['february'][] = $q->amount;
                }
                if (date('m', $q->date) == '03') {
                    $total['march'][] = $q->amount;
                }
                if (date('m', $q->date) == '04') {
                    $total['april'][] = $q->amount;
                }
                if (date('m', $q->date) == '05') {
                    $total['may'][] = $q->amount;
                }
                if (date('m', $q->date) == '06') {
                    $total['june'][] = $q->amount;
                }
                if (date('m', $q->date) == '07') {
                    $total['july'][] = $q->amount;
                }
                if (date('m', $q->date) == '08') {
                    $total['august'][] = $q->amount;
                }
                if (date('m', $q->date) == '09') {
                    $total['september'][] = $q->amount;
                }
                if (date('m', $q->date) == '10') {
                    $total['october'][] = $q->amount;
                }
                if (date('m', $q->date) == '11') {
                    $total['november'][] = $q->amount;
                }
                if (date('m', $q->date) == '12') {
                    $total['december'][] = $q->amount;
                }
            }
        }


        if (!empty($total['january'])) {
            $total['january'] = array_sum($total['january']);
        } else {
            $total['january'] = 0;
        }
        if (!empty($total['february'])) {
            $total['february'] = array_sum($total['february']);
        } else {
            $total['february'] = 0;
        }
        if (!empty($total['march'])) {
            $total['march'] = array_sum($total['march']);
        } else {
            $total['march'] = 0;
        }
        if (!empty($total['april'])) {
            $total['april'] = array_sum($total['april']);
        } else {
            $total['april'] = 0;
        }
        if (!empty($total['may'])) {
            $total['may'] = array_sum($total['may']);
        } else {
            $total['may'] = 0;
        }
        if (!empty($total['june'])) {
            $total['june'] = array_sum($total['june']);
        } else {
            $total['june'] = 0;
        }
        if (!empty($total['july'])) {
            $total['july'] = array_sum($total['july']);
        } else {
            $total['july'] = 0;
        }
        if (!empty($total['august'])) {
            $total['august'] = array_sum($total['august']);
        } else {
            $total['august'] = 0;
        }
        if (!empty($total['september'])) {
            $total['september'] = array_sum($total['september']);
        } else {
            $total['september'] = 0;
        }
        if (!empty($total['october'])) {
            $total['october'] = array_sum($total['october']);
        } else {
            $total['october'] = 0;
        }
        if (!empty($total['november'])) {
            $total['november'] = array_sum($total['november']);
        } else {
            $total['november'] = 0;
        }
        if (!empty($total['december'])) {
            $total['december'] = array_sum($total['december']);
        } else {
            $total['december'] = 0;
        }

        return $total;
    }

    function getOtPaymentByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('ot_payment');
        return $query->result();
    }

    function getOtPaymentByUserId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('user', $id);
        $query = $this->db->get('ot_payment');
        return $query->result();
    }

    function insertDeposit($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient_deposit', $data2);
    }

    function getDeposit() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('patient_deposit');
        return $query->result();
    }

    function updateDeposit($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient_deposit', $data);
    }

    function getDepositById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('patient_deposit');
        return $query->row();
    }

    function getDepositByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_deposit');
        return $query->result();
    }

    function getDepositByPatientIdByDate($id, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get('patient_deposit');
        return $query->result();
    }

    function getDepositByUserId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('user', $id);
        $query = $this->db->get('patient_deposit');
        return $query->result();
    }

    function deleteDeposit($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_deposit');
    }

    function deleteDepositByInvoiceId($id) {
        $this->db->where('payment_id', $id);
        $this->db->delete('patient_deposit');
    }

    function getPaymentByPatientIdByStatus($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'unpaid');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getOtPaymentByPatientIdByStatus($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'unpaid');
        $query = $this->db->get('ot_payment');
        return $query->result();
    }

    function updatePayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }

    function insertOtPayment($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('ot_payment', $data2);
    }

    function getOtPayment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ot_payment');
        return $query->result();
    }

    function getOtPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('ot_payment');
        return $query->row();
    }

    function updateOtPayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ot_payment', $data);
    }

    function deleteOtPayment($id) {
        $this->db->where('id', $id);
        $this->db->delete('ot_payment');
    }

    function insertPaymentCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('payment_category', $data2);
    }

    function getPaymentCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('payment_category');
        return $query->result();
    }

    function getPaymentCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment_category');
        return $query->row();
    }

    function getDoctorCommissionByCategory($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('payment_category');
        return $query->row();
    }

    function updatePaymentCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment_category', $data);
    }

    function deletePayment($id) {
        $this->db->where('id', $id);
        $this->db->delete('payment');
    }

    function deletePaymentCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('payment_category');
    }

    function insertExpense($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('expense', $data2);
    }

    function getExpense() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('expense');
        return $query->result();
    }

    function getExpenseById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense');
        return $query->row();
    }

    function updateExpense($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense', $data);
    }

    function insertExpenseCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('expense_category', $data2);
    }

    function getExpenseCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('expense_category');
        return $query->result();
    }

    function getExpenseCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense_category');
        return $query->row();
    }

    function updateExpenseCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense_category', $data);
    }

    function deleteExpense($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense');
    }

    function deleteExpenseCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense_category');
    }

    function getDiscountType() {
        $query = $this->db->get('settings');
        return $query->row()->discount;
    }

    function getPaymentByDoctor($doctor) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get();
        return $query->result();
    }

    function getDepositAmountByPaymentId($payment_id) {
        $this->db->select('*');
        $this->db->from('patient_deposit');
        $this->db->where('payment_id', $payment_id);
        $query = $this->db->get();
        $total = array();
        $deposited_total = array();
        $total = $query->result();

        foreach ($total as $deposit) {
            $deposited_total[] = $deposit->deposited_amount;
        }

        if (!empty($deposited_total)) {
            $deposited_total = array_sum($deposited_total);
        } else {
            $deposited_total = 0;
        }

        return $deposited_total;
    }

    function getPaymentByDate($date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getPaymentByDoctorDate($doctor, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('doctor', $doctor);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getDepositByPaymentId($payment_id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('patient_deposit');
        $this->db->where('payment_id', $payment_id);
        $query = $this->db->get();
        $total = array();
        $deposited_total = array();
        $total = $query->result();
        return $total;
    }

    function getOtPaymentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('ot_payment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getDepositsByDate($date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('patient_deposit');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getExpenseByDate($date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function makeStatusPaid($id, $patient_id, $data, $data1) {
        $this->db->where('patient', $patient_id);
        $this->db->where('status', 'paid-last');
        $this->db->update('payment', $data);
        $this->db->where('id', $id);
        $this->db->update('payment', $data1);
    }

    function makePaidByPatientIdByStatus($id, $data, $data1) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'paid-last');
        $this->db->update('payment', $data1);

        $this->db->where('patient', $id);
        $this->db->where('status', 'paid-last');
        $this->db->update('ot_payment', $data1);

        $this->db->where('patient', $id);
        $this->db->where('status', 'unpaid');
        $this->db->update('payment', $data);

        $this->db->where('patient', $id);
        $this->db->where('status', 'unpaid');
        $this->db->update('ot_payment', $data);
    }

    function makeOtStatusPaid($id) {
        $this->db->where('id', $id);
        $this->db->update('ot_payment', array('status' => 'paid'));
    }

    function lastPaidInvoice($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'paid-last');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function lastOtPaidInvoice($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'paid-last');
        $query = $this->db->get('ot_payment');
        return $query->result();
    }

    function amountReceived($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('payment', $data);
    }

    function otAmountReceived($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('ot_payment', $data);
    }

    function getThisMonth() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $payments = $this->db->get('payment')->result();
        foreach ($payments as $payment) {
            if (date('m/y', $payment->date) == date('m/y', time())) {
                $this_month_payment[] = $payment->gross_total;
            }
        }
        if (!empty($this_month_payment)) {
            $this_month_payment = array_sum($this_month_payment);
        } else {
            $this_month_payment = 0;
        }

        $expenses = $this->db->get('expense')->result();
        foreach ($expenses as $expense) {
            if (date('m/y', $expense->date) == date('m/y', time())) {
                $this_month_expense[] = $expense->amount;
            }
        }

        if (!empty($this_month_expense)) {
            $this_month_expense = array_sum($this_month_expense);
        } else {
            $this_month_expense = 0;
        }

        $appointments = $this->db->get('appointment')->result();
        foreach ($appointments as $appointment) {
            if (date('m/y', $appointment->date) == date('m/y', time())) {
                $this_month_appointment[] = 1;
            }
        }

        if (!empty($this_month_appointment)) {
            $this_month_appointment = array_sum($this_month_appointment);
        } else {
            $this_month_appointment = 0;
        }

        $this_month_details = array($this_month_payment, $this_month_expense, $this_month_appointment);
        return $this_month_details;
    }

    function getPaymentByUserIdByDate($user, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('user', $user);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getOtPaymentByUserIdByDate($user, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->select('*');
        $this->db->from('ot_payment');
        $this->db->where('user', $user);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getDepositByUserIdByDate($user, $date_from, $date_to) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->select('*');
        $this->db->from('patient_deposit');
        $this->db->where('user', $user);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getDueBalanceByPatientId($patient) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get_where('payment', array('patient' => $patient->id))->result();
        $deposits = $this->db->get_where('patient_deposit', array('patient' => $patient->id))->result();
        $balance = array();
        $deposit_balance = array();
        foreach ($query as $gross) {
            $balance[] = $gross->gross_total;
        }
        $balance = array_sum($balance);


        foreach ($deposits as $deposit) {
            $deposit_balance[] = $deposit->deposited_amount;
        }
        $deposit_balance = array_sum($deposit_balance);



        $bill_balance = $balance;

        return $due_balance = $bill_balance - $deposit_balance;
    }

}
