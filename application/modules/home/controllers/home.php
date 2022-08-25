<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('hospital/hospital_model');
        $this->load->model('notice/notice_model');
        $this->load->model('home_model');
    }

    public function index() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
            $data['payments'] = $this->finance_model->getPayment();
            $data['notices'] = $this->notice_model->getNotice();
            $data['this_month'] = $this->finance_model->getThisMonth();
            $data['expenses'] = $this->finance_model->getExpense();
            if ($this->ion_auth->in_group(array('Doctor'))) {
                redirect('doctor/details');
            } else {
                $data['appointments'] = $this->appointment_model->getAppointment();
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                redirect('finance/addPaymentView');
            }

            if ($this->ion_auth->in_group(array('Pharmacist'))) {
                redirect('finance/pharmacy/home');
            }

            if ($this->ion_auth->in_group(array('Patient'))) {
                redirect('patient/medicalHistory');
            }



            $data['this_month']['payment'] = $this->finance_model->thisMonthPayment();
            $data['this_month']['expense'] = $this->finance_model->thisMonthExpense();
            $data['this_month']['appointment'] = $this->finance_model->thisMonthAppointment();

            $data['this_day']['payment'] = $this->finance_model->thisDayPayment();
            $data['this_day']['expense'] = $this->finance_model->thisDayExpense();
            $data['this_day']['appointment'] = $this->finance_model->thisDayAppointment();

            $data['this_year']['payment'] = $this->finance_model->thisYearPayment();
            $data['this_year']['expense'] = $this->finance_model->thisYearExpense();
            $data['this_year']['appointment'] = $this->finance_model->thisYearAppointment();

            $data['this_month']['appointment'] = $this->finance_model->thisMonthAppointment();
            $data['this_month']['appointment_treated'] = $this->finance_model->thisMonthAppointmentTreated();
            $data['this_month']['appointment_cancelled'] = $this->finance_model->thisMonthAppointmentCancelled();

            $data['this_year']['payment_per_month'] = $this->finance_model->getPaymentPerMonthThisYear();


            $data['this_year']['expense_per_month'] = $this->finance_model->getExpensePerMonthThisYear();



            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer', $data);
        } else {
            $data['hospitals'] = $this->hospital_model->getHospital();
            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer');
        }
    }

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
