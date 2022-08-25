<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('email_model');
        $this->load->model('patient/patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('ion_auth_model');
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['email'] = $this->email_model->getProfileById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('profile', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function sendView() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['patients'] = $this->patient_model->getPatient();
        $data['email'] = $this->email_model->getEmailSettingsById($id);
        $data['teams'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('sendview', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function settings() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['settings'] = $this->email_model->getEmailSettingsById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNewSettings() {

        $id = $this->input->post('id');
        $email = $this->input->post('email');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('email', 'Admin Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('api_id', 'Api Id', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['email'] = $this->email_model->getEmailSettingsById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $data = array();
            $data = array(
                'admin_email' => $email,
            );
            if (empty($this->email_model->getEmailSettingsById()->admin_email)) {
                $this->email_model->insertEmailSettings($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->email_model->updateEmailSettings($data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('email/settings');
        }
    }

    function send() {
        $userId = $this->ion_auth->get_user_id();
        $is_v_v = $this->input->post('radio');
        $emailSettings = $this->email_model->getEmailSettings();

        if ($is_v_v == 'allpatient') {
            $patients = $this->patient_model->getpatient();
            foreach ($patients as $patient) {
                $to[] = $patient->email;
            }
            $recipient = 'All Patient';
        }

        if ($is_v_v == 'alldoctor') {
            $doctors = $this->doctor_model->getDoctor();
            foreach ($doctors as $doctor) {
                $to[] = $doctor->email;
            }
            $recipient = 'All Doctor';
        }

        if ($is_v_v == 'bloodgroupwise') {
            $blood_group = $this->input->post('bloodgroup');
            $donors = $this->donor_model->getDonor();
            foreach ($donors as $donor) {
                if ($donor->group == $blood_group) {
                    $to[] = $donor->email;
                }
            }
            $recipient = 'All Blood Donors With Blood Group ' . $blood_group;
        }


        if ($is_v_v == 'single_patient') {
            $patient = $this->input->post('patient');

            $patient_detail = $this->patient_model->getPatientById($patient);
            $single_patient_email = $patient_detail->email;
            $recipient = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Email: ' . $patient_detail->email;
        }


        if ($is_v_v == 'other') {
            $other_email = $this->input->post('other_email');
            $recipient = $other_email;
        }

        if (!empty($single_patient_email)) {
            $to = $single_patient_email;
        } elseif (!empty($other_email)) {
            $to = $other_email;
        } else {
            if (!empty($to)) {
                $to = implode(',', $to);
            }
        }
        // $message = urlencode("Test Message");
        if (!empty($to)) {
            $message = $this->input->post('message');
            $subject = $this->input->post('subject');

            

            $this->email->from($emailSettings->admin_email);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);


            if ($this->email->send()) {
                $data = array();
                $date = time();
                $data = array(
                    'subject' => $subject,
                    'message' => $message,
                    'date' => $date,
                    'reciepient' => $recipient,
                    'user' => $this->ion_auth->get_user_id()
                );
                $this->email_model->insertEmail($data);
                $this->session->set_flashdata('feedback', 'Message Sent');
            } else {
                $this->session->set_flashdata('feedback', 'Email Failed');
            }
        } else {
            $this->session->set_flashdata('feedback', 'Not Sent');
        }
        redirect('email/sendView');
    }

    function appointmentReminder() {
        $id = $this->input->post('id');
        $appointment_details = $this->appointment_model->getAppointmentById($id);
        $emailSettings = $this->email_model->getEmailSettings();
        $username = $emailSettings->username;
        $password = $emailSettings->password;
        $api_id = $emailSettings->api_id;

        $patient_detail = $this->patient_model->getPatientById($appointment_details->patient);
        $doctor_detail = $this->doctor_model->getDoctorById($appointment_details->doctor);
        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Email: ' . $patient_detail->email;
        $to = $patient_detail->email;

        // $message = urlencode("Test Message");
        if (!empty($to)) {
            $message = 'Reminder: Appointment is scheduled for you With Doctor ' . $doctor_detail->name . ' Date: ' . date('d-m-Y', $appointment_details->date) . ' Time: ' . $appointment_details->s_time;
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->email_model->insertEmail($data_p);
            $this->session->set_flashdata('feedback', 'Message Sent');
        }

        redirect('appointment/upcoming');
    }

    function sendEmailDuringAppointment($patient, $doctor, $date, $s_time, $e_time) {
        $emailSettings = $this->email_model->getEmailSettings();
        $username = $emailSettings->username;
        $password = $emailSettings->password;
        $api_id = $emailSettings->api_id;

        $patient_detail = $this->patient_model->getPatientById($patient);
        $doctor_detail = $this->doctor_model->getDoctorById($doctor);

        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Email: ' . $patient_detail->email;
        $recipient_d = 'Doctor Id: ' . $doctor_detail->id . '<br> Patient Name: ' . $doctor_detail->name . '<br> Doctor Email: ' . $doctor_detail->email;


        $to = $patient_detail->email . ', ' . $doctor_detail->email;

        // $message = urlencode("Test Message");
        if (!empty($patient)) {
            $message = 'Appointment is scheduled for you With Doctor ' . $doctor_detail->name . ' Date: ' . date('d-m-Y', $date) . ' Time: ' . $s_time;
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->email_model->insertEmail($data_p);
        }

        if (!empty($doctor)) {
            $message = 'Appointment is scheduled for you With Patient ' . $patient_detail->name . ' Date: ' . date('d-m-Y', $date) . ' Time: ' . $s_time;
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
            $data_d = array();
            $date = time();
            $data_d = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_d,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->email_model->insertEmail($data_d);
        }
    }

    function appointmentApproved() {
        $id = $this->input->post('id');
        $appointment_details = $this->appointment_model->getAppointmentById($id);
        $emailSettings = $this->email_model->getEmailSettings();
        $username = $emailSettings->username;
        $password = $emailSettings->password;
        $api_id = $emailSettings->api_id;

        $patient_detail = $this->patient_model->getPatientById($appointment_details->patient);
        $doctor_detail = $this->doctor_model->getDoctorById($appointment_details->doctor);
        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Email: ' . $patient_detail->email;
        $to = $patient_detail->email;

        // $message = urlencode("Test Message");
        if (!empty($to)) {
            $message = 'Approval: Appointment is scheduled for you With Doctor ' . $doctor_detail->name . ' Date: ' . date('d-m-Y', $appointment_details->date) . ' Time: ' . $appointment_details->s_time;
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->email_model->insertEmail($data_p);
        }
    }

    function sendEmailDuringPayment($patient, $amount, $date) {
        $emailSettings = $this->email_model->getEmailSettings();
        $username = $emailSettings->username;
        $password = $emailSettings->password;
        $api_id = $emailSettings->api_id;

        $patient_detail = $this->patient_model->getPatientById($patient);

        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Email: ' . $patient_detail->email;

        // $message = urlencode("Test Message");
        if (!empty($patient)) {
            $to = $patient_detail->email;
            $message = 'Bill For Patient ' . $patient_detail->name . 'Amount: ' . $amount . ' Date: ' . date('d-m-Y', $date);
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);           // file_get_contents('http://bhashemail.com/api/sendmsg.php?user=' . $username . '&pass=' . $password . '&sender=SKESWA&email=' . $to . '&text=' . $message1 . '&priority=ndnd&stype=normal');
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->email_model->insertEmail($data_p);
        }
    }

    function sendEmailDuringPatientRegistration($patient) {
        $emailSettings = $this->email_model->getEmailSettings();
        $username = $emailSettings->username;
        $password = $emailSettings->password;
        $api_id = $emailSettings->api_id;

        $patient_detail = $this->patient_model->getPatientById($patient);

        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Email: ' . $patient_detail->email;

        // $message = urlencode("Test Message");
        if (!empty($patient)) {
            $to = $patient_detail->email;
            $message = 'Patient Registration' . $patient_detail->name . 'is successfully registerred';
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->email_model->insertEmail($data_p);
        }
    }

    function sent() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $data['sents'] = $this->email_model->getEmail();
        } else {
            $current_user_id = $this->ion_auth->user()->row()->id;
            $data['sents'] = $this->email_model->getEmailByUser($current_user_id);
        }

        $this->load->view('home/dashboard');
        $this->load->view('email', $data);
        $this->load->view('home/footer');
    }

    function delete() {
        $id = $this->input->get('id');
        $this->email_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('email/sent');
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
