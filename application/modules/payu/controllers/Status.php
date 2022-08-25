<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('Ion_auth');
        $this->load->model('patient/patient_model');
        $this->load->model('finance/finance_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('pgateway/pgateway_model');
        $this->load->library('session');
    }

    public function index() {
        $status = $this->input->post('status');
        if (empty($status)) {
            redirect('payu');
        }

        $firstname = $this->input->post('firstname');
        $amount = $this->input->post('amount');
        $txnid = $this->input->post('txnid');
        $posted_hash = $this->input->post('hash');
        $key = $this->input->post('key');
        $productinfo = $this->input->post('productinfo');
        $email = $this->input->post('email');

        $payumoney = $this->pgateway_model->getPaymentGatewaySettingsById(1);

        $salt = $payumoney->salt; //  Your salt
        $add = $this->input->post('additionalCharges');
        If (isset($add)) {
            $additionalCharges = $this->input->post('additionalCharges');
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {

            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $data['hash'] = hash("sha512", $retHashSeq);
        $data['amount'] = $amount;
        $data['txnid'] = $txnid;
        $data['posted_hash'] = $posted_hash;
        $data['status'] = $status;

        $client_info = $this->patient_model->getpatientByEmail($email);
        $client_id = $client_info->id;


        if ($status == 'success') {

            $data = array();
            $data = array('patient' => $client_id,
                'date' => time(),
                'payment_id' => $productinfo,
                'deposited_amount' => $amount,
                'deposit_type' => 'Card',
                'gateway' => 'Pay U Money',
                'user' => $this->ion_auth->get_user_id()
            );
            $this->finance_model->insertDeposit($data);

            $this->session->set_flashdata('feedback', 'Payment Completed Successfully');

            if ($this->ion_auth->in_group(array('Patient'))) {
                redirect('patient/myPaymentHistory');
            } else {
                redirect('finance/patientPaymentHistory?patient=' . $client_id);
            }
            //  $this->load->view('success', $data);
        } else {
            $this->session->set_flashdata('feedback', 'Payment Failed!');
            redirect('finance/patientPaymentHistory?patient=' . $client_id);
        }
    }

    public function index1() {
        $status = $this->input->post('status');
        if (empty($status)) {
            redirect('payu');
        }

        $firstname = $this->input->post('firstname');
        $amount = $this->input->post('amount');
        $txnid = $this->input->post('txnid');
        $posted_hash = $this->input->post('hash');
        $key = $this->input->post('key');
        $productinfo = $this->input->post('productinfo');
        $email = $this->input->post('email');
        $payumoney = $this->pgateway_model->getPaymentGatewaySettingsById(1);

        $salt = $payumoney->salt; //  Your salt
        $add = $this->input->post('additionalCharges');
        If (isset($add)) {
            $additionalCharges = $this->input->post('additionalCharges');
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {

            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $data['hash'] = hash("sha512", $retHashSeq);
        $data['amount'] = $amount;
        $data['txnid'] = $txnid;
        $data['posted_hash'] = $posted_hash;
        $data['status'] = $status;

        $client_info = $this->patient_model->getpatientByEmail($email);
        $client_id = $client_info->id;


        if ($status == 'success') {

            $data = array();
            $data = array('patient' => $client_id,
                'date' => time(),
                'payment_id' => $productinfo,
                'deposited_amount' => $amount,
                'deposit_type' => 'Card',
                'gateway' => 'Pay U Money',
                'amount_received_id' => $productinfo . '.gp',
                'user' => $this->ion_auth->get_user_id()
            );
            $this->finance_model->insertDeposit($data);

            $data_payment = array('amount_received' => $amount, 'deposit_type' => 'Card');
            $this->finance_model->updatePayment($productinfo, $data_payment);

            $this->session->set_flashdata('feedback', 'Payment Completed Successfully');
            redirect("finance/invoice?id=" . "$productinfo");
            //  $this->load->view('success', $data);
        } else {
            $this->session->set_flashdata('feedback', 'Payment Failed!');
            redirect("finance/invoice?id=" . "$productinfo");
        }
    }

    public function index2() {
        $status = $this->input->post('status');
        if (empty($status)) {
            redirect('payu');
        }

        $firstname = $this->input->post('firstname');
        $amount = $this->input->post('amount');
        $txnid = $this->input->post('txnid');
        $posted_hash = $this->input->post('hash');
        $key = $this->input->post('key');
        $productinfo = $this->input->post('productinfo');
        $email = $this->input->post('email');
        $payumoney = $this->pgateway_model->getPaymentGatewaySettingsById(1);
        $salt = $payumoney->salt; //  Your salt
        $add = $this->input->post('additionalCharges');
        If (isset($add)) {
            $additionalCharges = $this->input->post('additionalCharges');
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {

            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $data['hash'] = hash("sha512", $retHashSeq);
        $data['amount'] = $amount;
        $data['txnid'] = $txnid;
        $data['posted_hash'] = $posted_hash;
        $data['status'] = $status;

        $client_info = $this->patient_model->getpatientByEmail($email);
        $client_id = $client_info->id;


        if ($status == 'success') {

            $previous_amount_received = $this->pharmacy_model->getPaymentById($productinfo)->amount_received;
            $data = array();
            $data = array(
                'amount_received' => $amount + $previous_amount_received,
            );
            $this->pharmacy_model->updatePayment($productinfo, $data);

            $this->session->set_flashdata('feedback', 'Amount Added Successfully');
            redirect("finance/pharmacy/invoice?id=" . "$productinfo");
            //  $this->load->view('success', $data);
        } else {
            $this->session->set_flashdata('feedback', 'Payment Failed!');
            redirect("finance/pharmacy/invoice?id=" . "$productinfo");
        }
    }

}
