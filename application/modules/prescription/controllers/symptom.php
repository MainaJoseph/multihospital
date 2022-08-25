<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Symptom extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('symptom_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Patient', 'Doctor'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['symptoms'] = $this->symptom_model->getSymptom();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('symptom', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addSymptomView() {
        $data = array();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_symptom_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewSymptom() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $patient = $this->input->post('patient');
        $date = time();
        $for_case = $this->input->post('for_case');
        $doctor_id = $this->input->post('doctor');
        $page = $this->input->post('page');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[10000]|xss_clean');
        // Validating Category Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[2]|max_length[100]|xss_clean');




        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['patients'] = $this->patient_model->getPatient();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_symptom_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('name' => $name,
                'patient' => $patient,
                'date' => $date,
            );
            if (empty($id)) {
                $this->symptom_model->insertSymptom($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->symptom_model->updateSymptom($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            if (!empty($for_case)) {
                redirect('patient/caseHistory?patient_id=' . $patient);
            } elseif ($page == 'patient') {
                redirect("patient/activity?doctor_id=" . $doctor_id);
            } elseif ($page == 'doctor') {
                redirect("doctor/activity?patient_id=" . $patient);
            }
        }
    }

    function editSymptom() {
        $data = array();
        $id = $this->input->get('id');
        $data['patients'] = $this->patient_model->getPatient();
        $data['symptom'] = $this->symptom_model->getSymptomById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_symptom_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editSymptomByJason() {
        $id = $this->input->get('id');
        $data['symptom'] = $this->symptom_model->getSymptomById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->symptom_model->deleteSymptom($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('symptom');
    }

}

/* End of file symptom.php */
/* Location: ./application/modules/symptom/controllers/symptom.php */
