<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pgateway extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pgateway_model');
        $this->load->model('patient/patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('doctor/doctor_model');
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pgateways'] = $this->pgateway_model->getPaymentGateway();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('pgateway', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function settings() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->pgateway_model->getPaymentGatewaySettingsById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNewSettings() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $merchant_key = $this->input->post('merchant_key');
        $salt = $this->input->post('salt');

        $APIUsername = $this->input->post('APIUsername');
        $APIPassword = $this->input->post('APIPassword');
        $APIUSignature = $this->input->post('APISignature');

        $status = $this->input->post('status');


        $pgateway = $this->pgateway_model->getPaymentGatewaySettingsById($id);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($pgateway->name == 'Pay U Money') {
            // Validating Name Field
            $this->form_validation->set_rules('merchant_key', 'Merchant Key', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('salt', 'Salt Id', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }


        if ($pgateway->name == 'PayPal') {
            // Validating Name Field
            $this->form_validation->set_rules('APIUsername', 'API Username', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('APIPassword', 'API Password', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('APISignature', 'APISignature Signature', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['pgateway'] = $this->pgateway_model->getPaymentGatewaySettingsById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $data = array();

            if ($pgateway->name == 'Pay U Money') {
                $data = array(
                    'name' => $name,
                    'merchant_key' => $merchant_key,
                    'salt' => $salt,
                    'status' => $status
                );
            }

            if ($pgateway->name == 'PayPal') {
                $data = array(
                    'name' => $name,
                    'APIUsername' => $APIUsername,
                    'APIPassword' => $APIPassword,
                    'APISignature' => $APIUSignature,
                    'status' => $status
                );
            }

            if (empty($this->pgateway_model->getPaymentGatewaySettingsById($id)->name)) {
                $this->pgateway_model->addPaymentGatewaySettings($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->pgateway_model->updatePaymentGatewaySettings($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('pgateway');
        }
    }

    function sent() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $data['sents'] = $this->pgateway_model->getPaymentGateway();
        } else {
            $current_user_id = $this->ion_auth->user()->row()->id;
            $data['sents'] = $this->pgateway_model->getPaymentGatewayByUser($current_user_id);
        }

        $this->load->view('home/dashboard');
        $this->load->view('pgateway', $data);
        $this->load->view('home/footer');
    }

    function delete() {
        $id = $this->input->get('id');
        $this->pgateway_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('pgateway/sent');
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
