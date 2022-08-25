<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('bed/bed_model');
        $this->load->model('lab/lab_model');
        $this->load->model('finance/finance_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');
        $this->load->model('prescription/prescription_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('doctor/doctor_model');

        $this->load->module('paypal');

        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Patient', 'Doctor', 'Laboratorist', 'Accountant', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function calendar() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('calendar', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');


        if (empty($id)) {
            $limit = $this->patient_model->getLimit();
            if ($limit <= 0) {
                $this->session->set_flashdata('feedback', lang('patient_limit_exceed'));
                redirect('patient');
            }
        }



        $redirect = $this->input->get('redirect');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $sms = $this->input->post('sms');
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
            $registration_time = time();
        } else {
            $add_date = $this->patient_model->getPatientById($id)->add_date;
            $registration_time = $this->patient_model->getPatientById($id)->registration_time;
        }


        $email = $this->input->post('email');
        if (empty($email)) {
            $email = $name . '@' . $phone.'.com';
        }



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Doctor Field
        //   $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', 'Validation Error !');
                redirect("patient/editPatient?id=$id");
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['groups'] = $this->donor_model->getBloodBank();
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
                    'add_date' => $add_date,
                    'registration_time' => $registration_time
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
                    'add_date' => $add_date,
                    'registration_time' => $registration_time
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
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->patient_model->insertPatient($data);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);

                    if (!empty($sms)) {
                        $this->sms->sendSmsDuringPatientRegistration($patient_user_id);
                    }




                    $this->session->set_flashdata('feedback', 'Added');
                }
                //    }
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
            if (!empty($redirect)) {
                redirect('finance/addPaymentView');
            } else {
                redirect('patient');
            }
        }
    }

    function editPatient() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        echo json_encode($data);
    }

    function getPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);

        $doctor = $data['patient']->doctor;
        $data['doctor'] = $this->doctor_model->getDoctorById($doctor);

        if (!empty($data['patient']->birthdate)) {
            $birthDate = strtotime($data['patient']->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $data['age'] = $age . ' Year(s)';
        }

        echo json_encode($data);
    }

    function patientDetails() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function report() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report_details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addDiagnosticReport() {
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $patient = $this->input->post('patient');
        $report = $this->input->post('report');

        $date = time();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        // Validating Name Field
        $this->form_validation->set_rules('invoice', 'Invoice', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field

        $this->form_validation->set_rules('report', 'Report', 'trim|min_length[1]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect('patient/report?id=' . $invoice);
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'invoice' => $invoice,
                'date' => $date,
                'report' => $report
            );

            if (empty($id)) {     // Adding New department
                $this->patient_model->insertDiagnosticReport($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateDiagnosticReport($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('patient/report?id=' . $invoice);
        }
    }

    function patientPayments() {
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient_payments', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function caseList() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatient();
        $data['medical_histories'] = $this->patient_model->getMedicalHistory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('case_list', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function documents() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['files'] = $this->patient_model->getPatientMaterial();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('documents', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function myCaseList() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_case_list', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myDocuments() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['files'] = $this->patient_model->getPatientMaterialByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_documents', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myPrescription() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['doctors'] = $this->doctor_model->getDoctor();
            $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatientId($patient_id);
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('my_prescription', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    public function myPayment() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['settings'] = $this->settings_model->getSettings();
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_payment', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    function myPaymentHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        }

        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['payments'] = $this->finance_model->getPaymentByPatientIdByDate($patient, $date_from, $date_to);
            $data['deposits'] = $this->finance_model->getDepositByPatientIdByDate($patient, $date_from, $date_to);
        } else {
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient);
            $data['pharmacy_payments'] = $this->pharmacy_model->getPaymentByPatientId($patient);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByPatientId($patient);
            $data['deposits'] = $this->finance_model->getDepositByPatientId($patient);
        }



        $data['patient'] = $this->patient_model->getPatientByid($patient);
        $data['settings'] = $this->settings_model->getSettings();



        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('my_payments_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function deposit() {
        $id = $this->input->post('id');


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        } else {
            $this->session->set_flashdata('feedback', 'Undefined Patient Id');
            redirect('patient/myPaymentsHistory');
        }



        $payment_id = $this->input->post('payment_id');
        $date = time();

        $deposited_amount = $this->input->post('deposited_amount');

        $deposit_type = $this->input->post('deposit_type');

        if ($deposit_type != 'Card') {
            $this->session->set_flashdata('feedback', 'Undefined Payment Type');
            redirect('patient/myPaymentsHistory');
        }

        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
// Validating Patient Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
// Validating Deposited Amount Field
        $this->form_validation->set_rules('deposited_amount', 'Deposited Amount', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            redirect('patient/myPaymentsHistory');
        } else {
            $data = array();
            $data = array('patient' => $patient,
                'date' => $date,
                'payment_id' => $payment_id,
                'deposited_amount' => $deposited_amount,
                'deposit_type' => $deposit_type,
                'user' => $user
            );
            if (empty($id)) {
                if ($deposit_type == 'Card') {
                    $payment_details = $this->finance_model->getPaymentById($payment_id);
                    $gateway = $this->settings_model->getSettings()->payment_gateway;
                    if ($gateway == 'PayPal') {
                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv');

                        $all_details = array(
                            'patient' => $payment_details->patient,
                            'date' => $payment_details->date,
                            'amount' => $payment_details->amount,
                            'doctor' => $payment_details->doctor_name,
                            'discount' => $payment_details->discount,
                            'flat_discount' => $payment_details->flat_discount,
                            'gross_total' => $payment_details->gross_total,
                            'status' => 'unpaid',
                            'patient_name' => $payment_details->patient_name,
                            'patient_phone' => $payment_details->patient_phone,
                            'patient_address' => $payment_details->patient_address,
                            'deposited_amount' => $deposited_amount,
                            'payment_id' => $payment_details->id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'from' => 'patient_payment_details',
                            'user' => $user
                        );
                        $this->paypal->Do_direct_payment($all_details);
                    } elseif ($gateway == 'Pay U Money') {
                        redirect("payu/check?deposited_amount=" . "$deposited_amount" . '&payment_id=' . $payment_id);
                    } else {
                        $this->session->set_flashdata('feedback', 'Payment failed. No Gateway Selected');
                        redirect('patient/myPaymentHistory');
                    }
                } else {
                    $this->finance_model->insertDeposit($data);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else {
                $this->finance_model->updateDeposit($id, $data);

                $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
                if (!empty($amount_received_id)) {
                    $amount_received_payment_id = explode('.', $amount_received_id);
                    $payment_id = $amount_received_payment_id[0];
                    $data_amount_received = array('amount_received' => $deposited_amount);
                    $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
                }

                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('patient/myPaymentHistory');
        }
    }

    function myInvoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('myInvoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function addMedicalHistory() {
        $id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id');

        $date = $this->input->post('date');

        $title = $this->input->post('title');

        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }

        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'patient/medicalHistory?id=' . $patient_id;
        }

        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Password Field

        $this->form_validation->set_rules('description', 'Description', 'trim|min_length[5]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'date' => $date,
                'title' => $title,
                'description' => $description,
                'patient_name' => $patient_name,
                'patient_phone' => $patient_phone,
                'patient_address' => $patient_address,
            );

            if (empty($id)) {     // Adding New department
                $this->patient_model->insertMedicalHistory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateMedicalHistory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect($redirect);
        }
    }

    public function diagnosticReport() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            $current_user = $this->ion_auth->get_user_id();
            $patient_user_id = $this->patient_model->getPatientByIonUserId($current_user)->id;
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient_user_id);
        } else {
            $data['payments'] = $this->finance_model->getPayment();
        }

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function medicalHistory() {
        $data = array();
        $id = $this->input->get('id');


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        }

        $patient_hospital_id = $this->patient_model->getPatientById($id)->hospital_id;
        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }



        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['appointments'] = $this->appointment_model->getAppointmentByPatient($data['patient']->id);
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatientId($id);
        $data['labs'] = $this->lab_model->getLabByPatientId($id);
        $data['beds'] = $this->bed_model->getBedAllotmentsByPatientId($id);
        $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);



        foreach ($data['appointments'] as $appointment) {
            $doctor_details = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }
            $timeline[$appointment->date + 1] = '<div class="panel-body profile-activity" >
                <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('appointment') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $appointment->date) . '</h5>
                                            <div class="activity terques">
                                                <span>
                                                    <i class="fa fa-stethoscope"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $appointment->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <p></p>
                                                                    <i class=" fa fa-clock-o"></i>
                                                                <p>' . $appointment->s_time . ' - ' . $appointment->e_time . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['prescriptions'] as $prescription) {
            $doctor_details = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }
            $timeline[$prescription->date + 2] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('prescription') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $prescription->date) . '</h5>
                                            <div class="activity purple">
                                                <span>
                                                    <i class="fa fa-medkit"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $prescription->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <a class="btn btn-info btn-xs detailsbutton" title="View" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> View</i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['labs'] as $lab) {

            $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_details)) {
                $lab_doctor = $doctor_details->name;
            } else {
                $lab_doctor = '';
            }

            $timeline[$lab->date + 3] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('lab') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $lab->date) . '</h5>
                                            <div class="activity blue">
                                                <span>
                                                    <i class="fa fa-flask"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $lab->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-user-md"></i>
                                                                <h4>' . $lab_doctor . '</h4>
                                                                    <a class="btn btn-xs invoicebutton" title="Lab" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file-text"></i>' . lang('report') . '</a>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['medical_histories'] as $medical_history) {
            $timeline[$medical_history->date + 4] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('case_history') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $medical_history->date) . '</h5>
                                            <div class="activity greenn">
                                                <span>
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $medical_history->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-note"></i> 
                                                                <p>' . $medical_history->description . '</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['patient_materials'] as $patient_material) {
            $timeline[$patient_material->date + 5] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('documents') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $patient_material->date) . '</h5>
                                            <div class="activity purplee">
                                                <span>
                                                    <i class="fa fa-file-o"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $patient_material->date) . ' <a class="pull-right" title="' . lang('download') . '"  href="' . $patient_material->url . '" download=""> <i class=" fa fa-download"></i> </a> </h4>
                                                                
                                                                 <h4>' . $patient_material->title . '</h4>
                                                            
                                                                
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        if (!empty($timeline)) {
            $data['timeline'] = $timeline;
        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('medical_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editMedicalHistoryByJason() {
        $id = $this->input->get('id');
        $data['medical_history'] = $this->patient_model->getMedicalHistoryById($id);
        echo json_encode($data);
    }

    function getCaseDetailsByJason() {
        $id = $this->input->get('id');
        $data['case'] = $this->patient_model->getMedicalHistoryById($id);
        $patient = $data['case']->patient_id;
        $data['patient'] = $this->patient_model->getPatientById($patient);
        echo json_encode($data);
    }

    function getPatientByAppointmentByDctorId($doctor_id) {
        $data = array();
        $appointments = $this->appointment_model->getAppointmentByDoctor($doctor_id);
        foreach ($appointments as $appointment) {
            $patient_exists = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patient_exists)) {
                $patients[] = $appointment->patient;
            }
        }

        if (!empty($patients)) {
            $patients = array_unique($patients);
        } else {
            $patients = '';
        }

        return $patients;
    }

    function patientMaterial() {
        $data = array();
        $id = $this->input->get('patient');
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_material', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addPatientMaterial() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }






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
                'max_size' => "48000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "3000",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientMaterial($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }

    function deleteCaseHistory() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $case_history = $this->patient_model->getMedicalHistoryById($id);
        $this->patient_model->deleteMedicalHistory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'case') {
            redirect('patient/caseList');
        } else {
            redirect("patient/MedicalHistory?id=" . $case_history->patient_id);
        }
    }

    function deletePatientMaterial() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_material = $this->patient_model->getPatientMaterialById($id);
        $path = $patient_material->url;
        if (!empty($path)) {
            unlink($path);
        }
        $this->patient_model->deletePatientMaterial($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'documents') {
            redirect('patient/documents');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_material->patient);
        }
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');

        $patient_hospital_id = $this->patient_model->getPatientById($id)->hospital_id;
        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }

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

    function getPatient() {

        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money"></i> ' . lang('payment') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"></i> ' . lang('delete') . '</a>';
            }

            $options6 = ' <a type="button" class="btn detailsbutton inffo" title="' . lang('info') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';

            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    $options1 . ' ' . $options6 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    $options1 . ' ' . $options6 . ' ' . $options4,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Laboratorist', 'Nurse', 'Doctor'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    $options1 . ' ' . $options6 . ' ' . $options3,
                        //  $options2
                );
            }
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    function getPatientPayments() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {


            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn btn-xs green" title="' . lang('payment') . ' ' . lang('history') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money"></i> ' . lang('payment') . ' ' . lang('history') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"></i> ' . lang('delete') . '</a>';
            }

            $due = $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id);

            $info[] = array(
                $patient->id,
                $patient->name,
                $patient->phone,
                $due,
                //  $options1 . ' ' . $options2 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                $options4
            );
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    function getCaseList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getMedicalHistoryBySearch($search);
            } else {
                $data['cases'] = $this->patient_model->getMedicalHistory();
            }
        } else {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getMedicalHistoryByLimitBySearch($limit, $start, $search);
            } else {
                $data['cases'] = $this->patient_model->getMedicalHistoryByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['cases'] as $case) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-edit"> </i> </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="patient/deleteCaseHistory?id=' . $case->id . '&redirect=case" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"></i></a>';
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton case" title="' . lang('case') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($case->patient_id)) {
                $patient_info = $this->patient_model->getPatientById($case->patient_id);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $case->patient_name . '</br>' . $case->patient_address . '</br>' . $case->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-Y', $case->date),
                $patient_details,
                $case->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['cases'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medical_history')->num_rows(),
                "recordsFiltered" => $this->db->get('medical_history')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    function getDocuments() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getDocumentBySearch($search);
            } else {
                $data['documents'] = $this->patient_model->getPatientMaterial();
            }
        } else {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getDocumentByLimitBySearch($limit, $start, $search);
            } else {
                $data['documents'] = $this->patient_model->getDocumentByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['documents'] as $document) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = '<a class="btn btn-info btn-xs" href="' . $document->url . '" download> ' . lang('download') . ' </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs delete_button" href="patient/deletePatientMaterial?id=' . $document->id . '&redirect=documents"onclick="return confirm(\'You want to delete the item??\');"> X </a>';
            }

            if (!empty($document->patient)) {
                $patient_info = $this->patient_model->getPatientById($document->patient);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $document->patient_name . '</br>' . $document->patient_address . '</br>' . $document->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-y', $document->date),
                $patient_details,
                $document->title,
                '<img src="' . $document->url . '" width="100px" height="100px">',
                $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['documents'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient_material')->num_rows(),
                "recordsFiltered" => $this->db->get('patient_material')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

}

/* End of file patient.php */
    /* Location: ./application/modules/patient/controllers/patient.php */
    