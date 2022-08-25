<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('notice_model');
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Doctor', 'Laboratorist', 'im', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['notices'] = $this->notice_model->getNotice();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('notice', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data['notices'] = $this->notice_model->getNotice();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }
        $type = $this->input->post('type');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating date Field
        $this->form_validation->set_rules('date', 'date', 'trim|required|min_length[5]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("notice/editNotice?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'title' => $title,
                'description' => $description,
                'date' => $date,
                'type' => $type
            );



            if (empty($id)) {     // Adding New Notice
                $this->notice_model->insertNotice($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating Notice
                $this->notice_model->updateNotice($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('notice');
        }
    }

    function getNotice() {
        $data['notices'] = $this->notice_model->getNotice();
        $this->load->view('notice', $data);
    }

    function editNotice() {
        $data = array();
        $id = $this->input->get('id');
        $data['notice'] = $this->notice_model->getNoticeById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editNoticeByJason() {
        $id = $this->input->get('id');
        $data['notice'] = $this->notice_model->getNoticeById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $this->notice_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('notice');
    }

}

/* End of file notice.php */
/* Location: ./application/modules/notice/controllers/notice.php */
