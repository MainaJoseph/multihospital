<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->model('hospital_model');
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['profile'] = $this->profile_model->getProfileById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('profile', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['profile'] = $this->profile_model->getProfileById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('profile', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {


            $previous_email = $this->ion_auth->user()->row()->email;

            if ($previous_email != $email) {
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('profile');
                }
            }


            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
            );

            $username = $this->input->post('name');
            $ion_user_id = $this->ion_auth->get_user_id();
            $group_id = $this->profile_model->getUsersGroups($ion_user_id)->row()->group_id;
            $group_name = $this->profile_model->getGroups($group_id)->row()->name;
            $group_name = strtolower($group_name);
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->profile_model->updateIonUser($username, $email, $password, $ion_user_id);
            if (!$this->ion_auth->in_group(array('superadmin'))) {
                if ($this->ion_auth->in_group(array('admin'))) {
                    $this->hospital_model->updateHospitalByIonId($ion_user_id, $data);
                } else {
                    $this->profile_model->updateProfile($ion_user_id, $data, $group_name);
                }
            }
            $this->session->set_flashdata('feedback', 'Updated');

            // Loading View
            redirect('profile');
        }
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
