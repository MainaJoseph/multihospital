<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pharmacist extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pharmacist_model');
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['pharmacists'] = $this->pharmacist_model->getPharmacist();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('pharmacist', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['pharmacist'] = $this->pharmacist_model->getPharmacistById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
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
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Pharmacist
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('pharmacist/addNewView');
                } else {
                    $dfg = 7;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->pharmacist_model->insertPharmacist($data);
                    $pharmacist_user_id = $this->db->get_where('pharmacist', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->pharmacist_model->updatePharmacist($pharmacist_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else { // Updating Pharmacist
                $ion_user_id = $this->db->get_where('pharmacist', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->pharmacist_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->pharmacist_model->updatePharmacist($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('pharmacist');
        }
    }

    function getPharmacist() {
        $data['pharmacists'] = $this->pharmacist_model->get_pharmacist();
        $this->load->view('pharmacist', $data);
    }

    function editPharmacist() {
        $data = array();
        $id = $this->input->get('id');
        $data['pharmacist'] = $this->pharmacist_model->getPharmacistById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPharmacistByJason() {
        $id = $this->input->get('id');
        $data['pharmacist'] = $this->pharmacist_model->getPharmacistById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('pharmacist', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->pharmacist_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('pharmacist');
    }

}

/* End of file pharmacist.php */
/* Location: ./application/modules/pharmacist/controllers/pharmacist.php */
