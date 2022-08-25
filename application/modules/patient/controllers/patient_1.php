<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_1 extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('patient_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('donor/donor_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('settings/settings_model');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Doctor', 'Laboratorist', 'im', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $doctor = $this->input->post('doctor');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $patient_id = $this->input->post('p_id');
        if (empty($patient_id)) {
            $patient_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('patient', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[5]|max_length[100]|xss_clean');
        // Validating Doctor Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editPatient?id=$id");
            } else {
                $data = array();
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['groups'] = $this->donor_model->getBloodBank();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
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
                    'patient_id' => $patient_id,
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'doctor' => $doctor,
                    'phone' => $phone,
                    'sex' => $sex,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'patient_id' => $patient_id,
                    'name' => $name,
                    'email' => $email,
                    'doctor' => $doctor,
                    'address' => $address,
                    'phone' => $phone,
                    'sex' => $sex,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date
                );
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Patient
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('patient/addNewView');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $user_id = $this->db->insert_id();
                    $ion_user_id = $this->db->get_where('users_groups', array('id' => $user_id))->row()->user_id;
                    $this->patient_model->insertPatient($data);
                    $patient_user_id = $this->db->insert_id();
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else { // Updating Patient
                $ion_user_id = $this->db->get_where('patient', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->patient_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->patient_model->updatePatient($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('patient');
        }
    }

    function getPatient() {
        $data['patient'] = $this->patient_model->get_patient();
        $this->load->view('patient', $data);
    }

    function editPatient() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        echo json_encode($data);
    }

    function patientDetails() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addMedicalHistory() {
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id');
        $date = $this->input->post('date');
        $img_url = $this->input->post('img_url');

        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field

        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[1000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('medical_history');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            $files = $_FILES;
            $cpt = count($_FILES['img_url']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['img_url']['name'] = $files['img_url']['name'][$i];
                $_FILES['img_url']['type'] = $files['img_url']['type'][$i];
                $_FILES['img_url']['tmp_name'] = $files['img_url']['tmp_name'][$i];
                $_FILES['img_url']['error'] = $files['img_url']['error'][$i];
                $_FILES['img_url']['size'] = $files['img_url']['size'][$i];

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
                $this->upload->do_upload('img_url');
                $path = $this->upload->data();
                $img_url[] = "uploads/" . $path['file_name'];
            }

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                if (!empty($id)) {
                    $previous_img_url_array = array();
                    $previous_img_url = $this->db->get_where('medical_history', array('id' => $id))->row()->img_url;
                    $previous_img_url_array = explode(',', $previous_img_url);
                    $img_url = implode(',', array_merge($img_url, $previous_img_url_array));
                } else {
                    $img_url = implode(',', $img_url);
                }
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'patient_id' => $patient_id,
                    'date' => $date,
                    'description' => $description,
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'patient_id' => $patient_id,
                    'date' => $date,
                    'description' => $description
                );
            }



            if (empty($id)) {     // Adding New department
                $this->patient_model->insertMedicalHistory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateMedicalHistory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('patient/medicalHistory?id=' . $patient_id);
        }
    }

    function medicalHistory() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medical_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editMedicalHistoryByJason() {
        $id = $this->input->get('id');
        $data['medical_history'] = $this->patient_model->getMedicalHistoryById($id);
        echo json_encode($data);
    }

    function getMedicalHistoryByPatientByJason() {
        $id = $this->input->get('id');
        $data['medical_history'] = $this->patient_model->getMedicalHistoryById($id);
        echo json_encode($data);
    }

    function myMedicalHistory() {
        $data = array();
        $user_id = $this->ion_auth->user()->row()->id;
        $id = $this->db->get_where('patient', array('ion_user_id' => $user_id))->row()->id;
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medical_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function delete_medical_history() {
        $id = $this->input->get('id');
        $patient_id = $this->input->get('p_id');
        $this->patient_model->delete_medical_history($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('patient/medicalHistory?id=' . $patient_id);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('patient', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->patient_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('patient');
    }

}

/* End of file patient.php */
    /* Location: ./application/modules/patient/controllers/patient.php */
    