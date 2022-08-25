<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('bed_model');
        $this->load->model('patient/patient_model');
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['beds'] = $this->bed_model->getBed();
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed', $data);
        $this->load->view('home/footer'); // just the header file  
    }

    public function addBedView() {
        $data = array();
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_bed_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addBed() {
        $id = $this->input->post('id');
        $number = $this->input->post('number');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $category = $this->input->post('category');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('number', 'Bed Number', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['categories'] = $this->bed_model->getBedCategory();
                $data['bed'] = $this->bed_model->getBedById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_bed_view', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['categories'] = $this->bed_model->getBedCategory();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_bed_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $bed_id = implode('-', array($category, $number));
            $data = array();
            $data = array(
                'category' => $category,
                'number' => $number,
                'description' => $description,
                'bed_id' => $bed_id
            );
            if (empty($id)) {
                $this->bed_model->insertBed($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->bed_model->updateBed($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bed');
        }
    }

    function editBed() {
        $data = array();
        $data['categories'] = $this->bed_model->getBedCategory();
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_bed_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editBedByJason() {
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBed($id);
        redirect('bed');
    }

    public function bedCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategoryView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_category_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['bed'] = $this->bed_model->getBedCategoryById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_category_view', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_category_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->bed_model->insertBedCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->bed_model->updateBedCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bed/bedCategory');
        }
    }

    function editCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedCategoryById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editBedCategoryByJason() {
        $id = $this->input->get('id');
        $data['bedcategory'] = $this->bed_model->getBedCategoryById($id);
        echo json_encode($data);
    }

    function deleteBedCategory() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBedCategory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('bed/bedCategory');
    }

    function bedAllotment() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $data['alloted_beds'] = $this->bed_model->getAllotment();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed_allotment', $data);
        $this->load->view('home/footer'); // just 
    }

    function addAllotmentView() {
        $data = array();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_allotment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function addAllotment() {
        $id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $a_time = $this->input->post('a_time');
        $d_time = $this->input->post('d_time');
        $status = $this->input->post('status');
        $bed_id = $this->input->post('bed_id');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('bed_id', 'Bed', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Alloted Time Field
        $this->form_validation->set_rules('a_time', 'Alloted Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Discharge Time Field
        $this->form_validation->set_rules('d_time', 'Discharge Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Status Field
        $this->form_validation->set_rules('status', 'Status', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['beds'] = $this->bed_model->getBed();
            $data['patients'] = $this->patient_model->getPatient();
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_allotment_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'bed_id' => $bed_id,
                'patient' => $patient,
                'a_time' => $a_time,
                'd_time' => $d_time,
                'status' => $status
            );
            $data1 = array(
                'last_a_time' => $a_time,
                'last_d_time' => $d_time,
            );

            if (empty($id)) {
                $this->bed_model->insertAllotment($data);
                $this->bed_model->updateBedByBedId($bed_id, $data1);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->bed_model->updateAllotment($id, $data);
                $this->bed_model->updateBedByBedId($bed_id, $data1);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bed/bedAllotment');
        }
    }

    function editAllotment() {
        $data = array();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $id = $this->input->get('id');
        $data['allotment'] = $this->bed_model->getAllotmentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_allotment_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAllotmentByJason() {
        $id = $this->input->get('id');
        $data['allotment'] = $this->bed_model->getAllotmentById($id);
        echo json_encode($data);
    }

    function deleteAllotment() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBedAllotment($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('bed/bedAllotment');
    }

}

/* End of file bed.php */
/* Location: ./application/modules/bed/controllers/bed.php */
