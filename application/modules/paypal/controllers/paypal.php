<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paypal extends MX_Controller {

    function __construct() {
        parent::__construct();

        // Load helpers
        $this->load->helper('url');

        $this->load->model('finance/finance_model');
        $this->load->model('pgateway/pgateway_model');

        // Load PayPal library
        $this->config->load('paypal');

        $pgateway = $this->pgateway_model->getPaymentGatewaySettingsByName('PayPal');
        if ($pgateway->status == 'test') {
            $status = TRUE;
        } else {
            $status = FALSE;
        }

        $config = array(
            'Sandbox' => $status, // Sandbox / testing mode option.
            'APIUsername' => $pgateway->APIUsername, // PayPal API username of the API caller
            'APIPassword' => $pgateway->APIPassword, // PayPal API password of the API caller
            'APISignature' => $pgateway->APISignature, // PayPal API signature of the API caller
            'APISubject' => '', // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
            'APIVersion' => $this->config->item('APIVersion')  // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
        );

        /*
          $config = array(
          'Sandbox' => $this->config->item('Sandbox'), // Sandbox / testing mode option.
          'APIUsername' => $this->config->item('APIUsername'), // PayPal API username of the API caller
          'APIPassword' => $this->config->item('APIPassword'), // PayPal API password of the API caller
          'APISignature' => $this->config->item('APISignature'), // PayPal API signature of the API caller
          'APISubject' => '', // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
          'APIVersion' => $this->config->item('APIVersion')  // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
          );
         */

        // Show Errors
        if ($config['Sandbox']) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }

        $this->load->library('paypal/Paypal_pro', $config);
    }

    function index() {
        $this->load->view('paypal/samples/payments_pro');
    }

    function Do_direct_payment($all_details) {
        $DPFields = array(
            'paymentaction' => 'Sale', // How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
            'ipaddress' => $_SERVER['REMOTE_ADDR'], // Required.  IP address of the payer's browser.
            'returnfmfdetails' => '1'      // Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
        );

        $CCDetails = array(
            'creditcardtype' => $all_details['card_type'], // Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
            'acct' => $all_details['card_number'], // Required.  Credit card number.  No spaces or punctuation.  
            'expdate' => $all_details['expire_date'], // Required.  Credit card expiration date.  Format is MMYYYY
            'cvv2' => $all_details['cvv'], // Requirements determined by your PayPal account settings.  Security digits for credit card.
            'startdate' => '', // Month and year that Maestro or Solo card was issued.  MMYYYY
            'issuenumber' => ''       // Issue number of Maestro or Solo card.  Two numeric digits max.
        );

        $PayerInfo = array(
            'email' => $all_details['patient_name'], // Email address of payer.
            'payerid' => '', // Unique PayPal customer ID for payer.
            'payerstatus' => '', // Status of payer.  Values are verified or unverified
            'business' => 'Testers, LLC'        // Payer's business name.
        );

        $PayerName = array(
            'salutation' => 'Mr.', // Payer's salutation.  20 char max.
            'firstname' => $all_details['patient_name'], // Payer's first name.  25 char max.
            'middlename' => '', // Payer's middle name.  25 char max.
            'lastname' => '', // Payer's last name.  25 char max.
            'suffix' => ''        // Payer's suffix.  12 char max.
        );

        $BillingAddress = array(
            'street' => '', // Required.  First street address.
            'street2' => '', // Second street address.
            'city' => '', // Required.  Name of City.
            'state' => '', // Required. Name of State or Province.
            'countrycode' => '', // Required.  Country code.
            'zip' => '', // Required.  Postal code of payer.
            'phonenum' => ''       // Phone Number of payer.  20 char max.
        );

        $ShippingAddress = array(
            'shiptoname' => '', // Required if shipping is included.  Person's name associated with this address.  32 char max.
            'shiptostreet' => '', // Required if shipping is included.  First street address.  100 char max.
            'shiptostreet2' => '', // Second street address.  100 char max.
            'shiptocity' => '', // Required if shipping is included.  Name of city.  40 char max.
            'shiptostate' => '', // Required if shipping is included.  Name of state or province.  40 char max.
            'shiptozip' => '', // Required if shipping is included.  Postal code of shipping address.  20 char max.
            'shiptocountry' => '', // Required if shipping is included.  Country code of shipping address.  2 char max.
            'shiptophonenum' => ''     // Phone number for shipping address.  20 char max.
        );

        $PaymentDetails = array(
            'amt' => $all_details['deposited_amount'], // Required.  Total amount of order, including shipping, handling, and tax.  
            'currencycode' => 'GBP', // Required.  Three-letter currency code.  Default is USD.
            'itemamt' => $all_details['deposited_amount'], // Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
            'shippingamt' => '0.00', // Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
            'shipdiscamt' => '', // Shipping discount for the order, specified as a negative number.  
            'handlingamt' => '', // Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
            'taxamt' => '', // Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
            'desc' => 'Web Order', // Description of the order the customer is purchasing.  127 char max.
            'custom' => '', // Free-form field for your own use.  256 char max.
            'invnum' => '', // Your own invoice or tracking number
            'notifyurl' => ''      // URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
        );

        $OrderItems = array();
        $Item = array(
            'l_name' => '', // Item Name.  127 char max.
            'l_desc' => '', // Item description.  127 char max.
            'l_amt' => '', // Cost of individual item.
            'l_number' => '', // Item Number.  127 char max.
            'l_qty' => '', // Item quantity.  Must be any positive integer.  
            'l_taxamt' => '', // Item's sales tax amount.
            'l_ebayitemnumber' => '', // eBay auction number of item.
            'l_ebayitemauctiontxnid' => '', // eBay transaction ID of purchased item.
            'l_ebayitemorderid' => ''     // eBay order ID for the item.
        );
        array_push($OrderItems, $Item);

        $Secure3D = array(
            'authstatus3d' => '',
            'mpivendor3ds' => '',
            'cavv' => '',
            'eci3ds' => '',
            'xid' => ''
        );

        $PayPalRequestData = array(
            'DPFields' => $DPFields,
            'CCDetails' => $CCDetails,
            'PayerInfo' => $PayerInfo,
            'PayerName' => $PayerName,
            'BillingAddress' => $BillingAddress,
            'ShippingAddress' => $ShippingAddress,
            'PaymentDetails' => $PaymentDetails,
            'OrderItems' => $OrderItems,
            'Secure3D' => $Secure3D
        );

        $PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);

        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {

            $this->session->set_flashdata('feedback', 'Payment Failed!');
            redirect('finance/patientPaymentHistory?patient=' . $all_details['patient']);

            //  $errors = array('Errors' => $PayPalResult['ERRORS']);
            //  $this->load->view('paypal/samples/error', $errors);
        } else {

            // Successful call.  Load view or whatever you need to do here.



            $data = array();
            if ($all_details['from'] == 'pos') {
                $data = array('patient' => $all_details['patient'],
                    'date' => time(),
                    'payment_id' => $all_details['payment_id'],
                    'deposited_amount' => $all_details['deposited_amount'],
                    'amount_received_id' => $all_details['payment_id'] . '.' . 'gp',
                    'deposit_type' => 'Card',
                    'gateway' => 'PayPal',
                    'user' => $this->ion_auth->get_user_id()
                );

                $data_payment = array('amount_received' => $all_details['deposited_amount'], 'deposit_type' => 'Card');
                $this->finance_model->updatePayment($all_details['payment_id'], $data_payment);
            } else {
                $data = array('patient' => $all_details['patient'],
                    'date' => time(),
                    'payment_id' => $all_details['payment_id'],
                    'deposited_amount' => $all_details['deposited_amount'],
                    'deposit_type' => 'Card',
                    'gateway' => 'PayPal',
                    'user' => $this->ion_auth->get_user_id()
                );
            }
            $this->finance_model->insertDeposit($data);

            $this->session->set_flashdata('feedback', 'Payment Completed Successfully');
            
            if ($this->ion_auth->in_group(array('Patient'))) {
                redirect('patient/myPaymentHistory');
            } else {
                redirect('finance/patientPaymentHistory?patient=' . $all_details['patient']);
            }
            
            
            

            //  $data = array('PayPalResult' => $PayPalResult);
            //   $this->load->view('paypal/samples/do_direct_payment', $data);
            // Successful call.  Load view or whatever you need to do here.
            //	$data = array('PayPalResult'=>$PayPalResult);
            //	$this->load->view('paypal/samples/do_direct_payment',$data);
        }
    }

    function Get_balance() {
        $GBFields = array('returnallcurrencies' => '1');
        $PayPalRequestData = array('GBFields' => $GBFields);
        $PayPalResult = $this->paypal_pro->GetBalance($PayPalRequestData);

        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            $errors = array('Errors' => $PayPalResult['ERRORS']);
            $this->load->view('paypal/samples/error', $errors);
        } else {
            // Successful call.  Load view or whatever you need to do here.
            $data = array('PayPalResult' => $PayPalResult);
            $this->load->view('paypal/samples/get_balance', $data);
        }
    }

}

/* End of file Payments_pro.php */
/* Location: ./system/application/controllers/paypal/samples/Payments_pro.php */