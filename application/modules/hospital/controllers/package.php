<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Package extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('hospital_model');
        $this->load->model('hospital/package_model');
        $this->load->model('donor/donor_model');
        $this->load->model('sms/sms_model');
        $this->load->library('upload');
        $this->load->model('ion_auth_model');
        $this->db->where('hospital_id', 'superadmin');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('settings/settings_model');

        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['packages'] = $this->package_model->getPackage();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('package', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new_package');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $p_limit = $this->input->post('p_limit');
        $d_limit = $this->input->post('d_limit');
        $module = $this->input->post('module');
        $price = $this->input->post('price');

        if (!empty($module)) {
            $module = implode(',', $module);
        }

        $show_in_frontend = $this->input->post('show_in_frontend');
        $set_as_default = $this->input->post('set_as_default');




        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Limit Field
        $this->form_validation->set_rules('p_limit', 'Patient Limit', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Doctoor Limit Field
        $this->form_validation->set_rules('d_limit', 'Dooctor Limit', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Show In Frontend Field
        $this->form_validation->set_rules('show_in_frontend', 'Show In Frontend', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Doctoor Limit Field
        $this->form_validation->set_rules('set_as_default', 'Set As Default', 'trim|min_length[1]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("hospital/package/editPackage?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new_package');
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'p_limit' => $p_limit,
                'd_limit' => $d_limit,
                'module' => $module,
                'price' => $price,
                'show_in_frontend' => $show_in_frontend,
                'set_as_default' => $set_as_default
            );

            if (empty($id)) {     // Adding New Package
                $this->package_model->insertPackage($data);
                $this->session->set_flashdata('feedback', 'Added');
                redirect('hospital/package');
            } else { // Updating Package
                $this->package_model->updatePackage($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                redirect('hospital/package/editPackage?id=' . $id);
            }

            if ($set_as_default == '1') {
                $data1 = array('set_as_default' => '');
                $this->package_model->updateSetAsDefault($module, $data1);
            }




            // Loading View
        }
    }

    function getPackage() {
        $data['packages'] = $this->package_model->getPackage();
        $this->load->view('package', $data);
    }

    function editPackage() {
        $data = array();
        $id = $this->input->get('id');
        $data['package'] = $this->package_model->getPackageById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new_package', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPackageByJason() {
        $id = $this->input->get('id');
        $data['package'] = $this->package_model->getPackageById($id);
        $data['settings'] = $this->settings_model->getSettingsByHId($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $this->package_model->delete($id);
        redirect('hospital/package');
    }

}

/* End of file package.php */
/* Location: ./application/modules/package/controllers/package.php */
