<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('request_model');
        $this->load->model('hospital/package_model');
        $this->load->model('donor/donor_model');
        $this->load->model('pgateway/pgateway_model');
        $this->load->model('sms/sms_model');
        $this->load->model('email/email_model');

        $this->db->where('hospital_id', 'superadmin');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
    }

    public function index() {
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
        $data['requests'] = $this->request_model->getRequest();
        $data['packages'] = $this->package_model->getPackage();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('request', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
        $data['packages'] = $this->package_model->getPackage();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $package = $this->input->post('package');
        $language = $this->input->post('language');
        $status = 'Pending';


        $language_array = array('english', 'arabic', 'spanish', 'french', 'italian', 'portuguese');

        if (!in_array($language, $language_array)) {
            $language = 'english';
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
        // Validating Status Field           
        $this->form_validation->set_rules('status', 'Status', 'trim|min_length[1]|max_length[50]|xss_clean');


        // Validating Language Field           
        $this->form_validation->set_rules('language', 'Language', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("request/editRequest?id=$id");
            } else {
                $data['packages'] = $this->package_model->getPackage();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'package' => $package,
                'language' => $language,
                'status' => $status,
            );

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Request               
                $this->request_model->insertRequest($data);
                $this->session->set_flashdata('feedback', 'New Request Created');
            } else { // Updating Request
                $this->request_model->updateRequest($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('frontend');
        }
    }

    function getRequest() {
        $data['requests'] = $this->request_model->getRequest();
        $this->load->view('request', $data);
    }

    function activate() {
        $request_id = $this->input->get('request_id');
        $data = array('active' => 1);
        $this->request_model->activate($request_id, $data);
        $this->session->set_flashdata('feedback', 'Activated');
        redirect('request');
    }

    function deactivate() {
        $request_id = $this->input->get('request_id');
        $data = array('active' => 0);
        $this->request_model->deactivate($request_id, $data);
        $this->session->set_flashdata('feedback', 'Deactivated');
        redirect('request');
    }

    function approve() {
        $id = $this->input->get('id');
        $request = $this->request_model->getRequestById($id);
        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $phone = $request->phone;
        $package = $request->package;
        $language = $request->language;

        if (!empty($package)) {
            $module = $this->package_model->getPackageById($package)->module;
            $p_limit = $this->package_model->getPackageById($package)->p_limit;
            $d_limit = $this->package_model->getPackageById($package)->d_limit;
        } else {
            $default_package = $this->package_model->getDefaultPackage();
            $module = $default_package->module;
            $p_limit = $default_package->p_limit;
            $d_limit = $default_package->d_limit;
        }

        $language_array = array('english', 'arabic', 'spanish', 'french', 'italian', 'portuguese');

        if (!in_array($language, $language_array)) {
            $language = 'english';
        }

        //$error = array('error' => $this->upload->display_errors());
        $data = array();
        $data = array(
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'package' => $package,
            'p_limit' => $p_limit,
            'd_limit' => $d_limit,
            'module' => $module
        );

        $username = $name;
        $password = '12345';

        // Adding New Hospital
        if ($this->ion_auth->email_check($email)) {
            $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
            redirect('hospital/addNewView');
        } else {
            $dfg = 11;
            $this->ion_auth->register($username, $password, $email, $dfg);
            $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
            $this->hospital_model->insertHospital($data);
            $hospital_user_id = $this->db->get_where('hospital', array('email' => $email))->row()->id;
            $id_info = array('ion_user_id' => $ion_user_id);
            $this->hospital_model->updateHospital($hospital_user_id, $id_info);

            $data1 = array('status' => 'Approved');
            $this->request_model->updateRequest($id, $data1);

            $hospital_settings_data = array();
            $hospital_settings_data = array('hospital_id' => $hospital_user_id,
                'title' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'language' => $language,
                'system_vendor' => 'Code Aristos | Hospital management System',
                'discount' => 'flat',
                'currency' => '$'
            );
            $this->settings_model->insertSettings($hospital_settings_data);
            $hospital_blood_bank = array();
            $hospital_blood_bank = array('A+' => '0 Bags', 'A-' => '0 Bags', 'B+' => '0 Bags', 'B-' => '0 Bags', 'AB+' => '0 Bags', 'AB-' => '0 Bags', 'O+' => '0 Bags', 'O-' => '0 Bags');
            foreach ($hospital_blood_bank as $key => $value) {
                $data_bb = array('group' => $key, 'status' => $value, 'hospital_id' => $hospital_user_id);
                $this->donor_model->insertBloodBank($data_bb);
                $data_bb = NULL;
            }

            $data_sms_clickatell = array();
            $data_sms_clickatell = array(
                'name' => 'Clickatell',
                'username' => 'Your ClickAtell Username',
                'password' => 'Your ClickAtell Password',
                'api_id' => 'Your ClickAtell Api Id',
                'user' => $this->ion_auth->get_user_id(),
                'hospital_id' => $hospital_user_id
            );

            $this->sms_model->addSmsSettings($data_sms_clickatell);

            $data_sms_msg91 = array(
                'name' => 'MSG91',
                'username' => 'Your MSG91 Username',
                'api_id' => 'Your MSG91 API ID',
                'authkey' => 'Your MSG91 Auth Key',
                'user' => $this->ion_auth->get_user_id(),
                'hospital_id' => $hospital_user_id
            );

            $this->sms_model->addSmsSettings($data_sms_msg91);

            $data_pgateway_paypal = array(
                'name' => 'PayPal', // Sandbox / testing mode option.
                'APIUsername' => 'PayPal API Username', // PayPal API username of the API caller
                'APIPassword' => 'PayPal API Password', // PayPal API password of the API caller
                'APISignature' => 'PayPal API Signature', // PayPal API signature of the API caller
                'status' => 'test',
                'hospital_id' => $hospital_user_id
            );

            $this->pgateway_model->addPaymentGatewaySettings($data_pgateway_paypal);

            $data_pgateway_payumoney = array(
                'name' => 'Pay U Money', // Sandbox / testing mode option.
                'merchant_key' => 'Merchant key', // PayPal API username of the API caller
                'salt' => 'Salt', // PayPal API password of the API caller
                'status' => 'test',
                'hospital_id' => $hospital_user_id
            );

            $this->pgateway_model->addPaymentGatewaySettings($data_pgateway_payumoney);

            $data_email_settings = array(
                'admin_email' => 'Admin Email', // Sandbox / testing mode option.
                'hospital_id' => $hospital_user_id
            );

            $this->email_model->addEmailSettings($data_email_settings);

            $this->session->set_flashdata('feedback', 'New Hospital Created');
        }

        redirect('request');
    }

    function editRequest() {
        $data = array();
        $id = $this->input->get('id');
        $data['packages'] = $this->package_model->getPackage();
        $data['request'] = $this->request_model->getRequestById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editRequestByJason() {
        $id = $this->input->get('id');
        $data['request'] = $this->request_model->getRequestById($id);
        $data['settings'] = $this->settings_model->getSettingsByHId($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('request', array('id' => $id))->row();
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->request_model->delete($id);
        redirect('request');
    }

}

/* End of file request.php */
/* Location: ./application/modules/request/controllers/request.php */
