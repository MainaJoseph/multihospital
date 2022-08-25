<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slide extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('slide_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['slides'] = $this->slide_model->getSlide();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('slide', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $text1 = $this->input->post('text1');
        $text2 = $this->input->post('text2');
        $text3 = $this->input->post('text3');
        $position = $this->input->post('position');
        $status = $this->input->post('status');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Text 1 Field
        $this->form_validation->set_rules('text1', 'Text 1', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Text 2 Field
        $this->form_validation->set_rules('text2', 'Text 2', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Text 3 Field
        $this->form_validation->set_rules('text3', 'Text 3', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Position Field   
        $this->form_validation->set_rules('position', 'Position', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Status Field           
        $this->form_validation->set_rules('status', 'Status', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("slide/editSlide?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'title' => $title,
                    'text1' => $text1,
                    'text2' => $text2,
                    'text3' => $text3,
                    'position' => $position,
                    'status' => $status
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'title' => $title,
                    'text1' => $text1,
                    'text2' => $text2,
                    'text3' => $text3,
                    'position' => $position,
                    'status' => $status
                );
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Slide
                $this->slide_model->insertSlide($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating Slide
                $this->slide_model->updateSlide($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('slide');
        }
    }

    function getSlide() {
        $data['slides'] = $this->slide_model->getSlide();
        $this->load->view('slide', $data);
    }

    function editSlide() {
        $data = array();
        $id = $this->input->get('id');
        $data['slide'] = $this->slide_model->getSlideById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editSlideByJason() {
        $id = $this->input->get('id');
        $data['slide'] = $this->slide_model->getSlideById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('slide', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->slide_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('slide');
    }

}

/* End of file slide.php */
/* Location: ./application/modules/slide/controllers/slide.php */
