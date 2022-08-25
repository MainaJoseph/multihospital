<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('sms_model');
        $this->load->model('patient/patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('doctor/doctor_model');
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['settings'] = $this->settings_model->getSettings();
        $data['sgateways'] = $this->sms_model->getSmsSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('sgateway', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function sendView() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['patients'] = $this->patient_model->getPatient();
        $data['sms'] = $this->sms_model->getSmsSettingsById($id);
        $data['teams'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('sendview', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function settings() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->sms_model->getSmsSettingsById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNewSettings() {

        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $api_id = $this->input->post('api_id');
        $auth_key = $this->input->post('authkey');
        $sender = $this->input->post('sender');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('username', 'Username', 'trim|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('api_id', 'Api Id', 'trim|min_length[5]|max_length[100]|xss_clean');

        // Validating Email Field
        $this->form_validation->set_rules('authkey', 'Auth Key', 'trim|min_length[5]|max_length[100]|xss_clean');

        // Validating Email Field
        $this->form_validation->set_rules('sender', 'Sender', 'trim|min_length[5]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['sms'] = $this->sms_model->getSmsSettingsById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $data = array();
            $data = array(
                'username' => $username,
                'password' => $password,
                'api_id' => $api_id,
                'authkey' => $auth_key,
                'sender' => $sender,
                'user' => $this->ion_auth->get_user_id()
            );
            if (empty($id)) {
                $this->sms_model->addSmsSettings($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->sms_model->updateSmsSettings($data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('sms');
        }
    }

    function sendSms($to, $message) {
        $sms_gateway = $this->settings_model->getSettings()->sms_gateway;
        if (!empty($sms_gateway)) {
            $smsSettings = $this->sms_model->getSmsSettingsByGatewayName($sms_gateway);
        } else {
            $this->session->set_flashdata('feedback', lang('gatewany_not_selected'));
            redirect('sms/sendView');
        }

        if ($smsSettings->name == 'Clickatell') {
            $username = $smsSettings->username;
            $password = $smsSettings->password;
            $api_id = $smsSettings->api_id;

            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '&to=' . $to . '&content=' . $message);           // file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey='.$api_id.'&to='.$to.'&content='.$message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
        }

        if ($smsSettings->name == 'MSG91') {
            $authkey = $smsSettings->authkey;
            $sender = $smsSettings->sender;
            file_get_contents('http://api.msg91.com/api/sendhttp.php?route=4&sender=TESTIN&mobiles=fdsfsdfsd&authkey=' . $authkey . '&message=' . $message . '&country=0');           // file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey='.$api_id.'&to='.$to.'&content='.$message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
        }
    }

    function send() {
        $userId = $this->ion_auth->get_user_id();
        $is_v_v = $this->input->post('radio');

        if ($is_v_v == 'allpatient') {
            $patients = $this->patient_model->getpatient();
            foreach ($patients as $patient) {
                $to[] = $patient->phone;
            }
            $recipient = 'All Patient';
        }

        if ($is_v_v == 'alldoctor') {
            $doctors = $this->doctor_model->getDoctor();
            foreach ($doctors as $doctor) {
                $to[] = $doctor->phone;
            }
            $recipient = 'All Doctor';
        }

        if ($is_v_v == 'bloodgroupwise') {
            $blood_group = $this->input->post('bloodgroup');
            $donors = $this->donor_model->getDonor();
            foreach ($donors as $donor) {
                if ($donor->group == $blood_group) {
                    $to[] = $donor->phone;
                }
            }
            $recipient = 'All Blood Donors With Blood Group ' . $blood_group;
        }


        if ($is_v_v == 'single_patient') {
            $patient = $this->input->post('patient');

            $patient_detail = $this->patient_model->getPatientById($patient);
            $single_patient_phone = $patient_detail->phone;
            $recipient = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;
        }

        if (!empty($single_patient_phone)) {
            $to = $single_patient_phone;
        } else {
            if (!empty($to)) {
                $to = implode(',', $to);
            }
        }
        // $message = urlencode("Test Message");
        if (!empty($to)) {
            $message = $this->input->post('message');
            $message1 = urlencode($message);
            $this->sendSms($to, $message1);
            $data = array();
            $date = time();
            $data = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data);
            $this->session->set_flashdata('feedback', 'Message Sent');
        } else {
            $this->session->set_flashdata('feedback', 'Not Sent');
        }
        redirect('sms/sendView');
    }

    function appointmentReminder() {
        $id = $this->input->post('id');
        $appointment_details = $this->appointment_model->getAppointmentById($id);

        $patient_detail = $this->patient_model->getPatientById($appointment_details->patient);
        $doctor_detail = $this->doctor_model->getDoctorById($appointment_details->doctor);
        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;
        $to = $patient_detail->phone;

        // $message = urlencode("Test Message");
        if (!empty($to)) {
            $message = 'Reminder: Appointment is scheduled for you With Doctor ' . $doctor_detail->name . ' Date: ' . date('d-m-Y', $appointment_details->date) . ' Time: ' . $appointment_details->s_time;
            $message1 = urlencode($message);
            $this->sendSms($to, $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data_p);
            $this->session->set_flashdata('feedback', 'Message Sent');
        }

        redirect('appointment/upcoming');
    }

    function sendSmsDuringAppointment($patient, $doctor, $date, $s_time, $e_time) {

        $patient_detail = $this->patient_model->getPatientById($patient);
        $doctor_detail = $this->doctor_model->getDoctorById($doctor);

        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;
        $recipient_d = 'Doctor Id: ' . $doctor_detail->id . '<br> Patient Name: ' . $doctor_detail->name . '<br> Doctor Phone: ' . $doctor_detail->phone;


        // $message = urlencode("Test Message");
        if (!empty($patient)) {
            $message = 'Appointment is scheduled for you With Doctor ' . $doctor_detail->name . ' Date: ' . date('d-m-Y', $date) . ' Time: ' . $s_time;
            $message1 = urlencode($message);
            $this->sendSms($patient_detail->phone, $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data_p);
        }

        if (!empty($doctor)) {
            $message = 'Appointment is scheduled for you With Patient ' . $patient_detail->name . ' Date: ' . date('d-m-Y', $date) . ' Time: ' . $s_time;
            $message1 = urlencode($message);
            $this->sendSms($doctor_detail->phone, $message1);
            $data_d = array();
            $date = time();
            $data_d = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_d,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data_d);
        }
    }

    function appointmentApproved() {
        $id = $this->input->post('id');
        $appointment_details = $this->appointment_model->getAppointmentById($id);

        $patient_detail = $this->patient_model->getPatientById($appointment_details->patient);
        $doctor_detail = $this->doctor_model->getDoctorById($appointment_details->doctor);
        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;
        $to = $patient_detail->phone;

        // $message = urlencode("Test Message");
        if (!empty($to)) {
            $message = 'Approval: Appointment is scheduled for you With Doctor ' . $doctor_detail->name . ' Date: ' . date('d-m-Y', $appointment_details->date) . ' Time: ' . $appointment_details->s_time;
            $message1 = urlencode($message);
            $this->sendSms($to, $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data_p);
        }
    }

    function sendSmsDuringPayment($patient, $amount, $date) {

        $patient_detail = $this->patient_model->getPatientById($patient);

        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;

        // $message = urlencode("Test Message");
        if (!empty($patient)) {
            $to = $patient_detail->phone;
            $message = 'Bill For Patient ' . $patient_detail->name . 'Amount: ' . $amount . ' Date: ' . date('d-m-Y', $date);
            $message1 = urlencode($message);
            $this->sendSms($to, $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data_p);
        }
    }

    function sendSmsDuringPatientRegistration($patient) {

        $patient_detail = $this->patient_model->getPatientById($patient);

        $recipient_p = 'Patient Id: ' . $patient_detail->id . '<br> Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;

        // $message = urlencode("Test Message");
        if (!empty($patient)) {
            $to = $patient_detail->phone;
            $message = 'Patient Registration' . $patient_detail->name . 'is successfully registerred';
            $message1 = urlencode($message);
            $this->sendSms($to, $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data_p);
        }
    }

    function sent() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $data['sents'] = $this->sms_model->getSms();
        } else {
            $current_user_id = $this->ion_auth->user()->row()->id;
            $data['sents'] = $this->sms_model->getSmsByUser($current_user_id);
        }

        $this->load->view('home/dashboard');
        $this->load->view('sms', $data);
        $this->load->view('home/footer');
    }

    function delete() {
        $id = $this->input->get('id');
        $this->sms_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('sms/sent');
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
