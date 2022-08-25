<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 *  ==============================================================================
 *  Author	: Mian Saleem
 *  Email	: saleem@tecdiary.com
 *  Web		: http://tecdiary.com
 *  ==============================================================================
 */

class Sma {

    public function __construct() {

    }

   // public function __get($var) {
    //    return get_instance()->$var;
   // }

    public function clear_tags($str) {
        return htmlentities(
            strip_tags($str,
                '<span><div><a><br><p><b><i><u><img><blockquote><small><ul><ol><li><hr><big><pre><code><strong><em><table><tr><td><th><tbody><thead><tfoot><h3><h4><h5><h6>'
            ),
            ENT_QUOTES | ENT_XHTML | ENT_HTML5,
            'UTF-8'
        );
    }

    public function decode_html($str) {
        return html_entity_decode($str, ENT_QUOTES | ENT_XHTML | ENT_HTML5, 'UTF-8');
    }

    public function unset_data($ud) {
        if($this->session->userdata($ud)) {
            $this->session->unset_userdata($ud);
            return true;
        }
        return FALSE;
    }

    public function hrsd($sdate) {
        if ($sdate) {
            return date($this->Settings->dateformat, strtotime($sdate));
        }
        return FASLE;
    }

    public function hrld($ldate) {
        if ($ldate) {
            return date('d-m-Y'.' '.'H:i:s', strtotime($ldate));
        }
        return FALSE;
    }

    public function log($type, $msg, $text = NULL) {
        $this->load->library('logs');
        $this->logs->set_date_format($this->Settings->dateformat.' '.$this->Settings->timeformat);
        if($this->logs->write($type, $msg, $text)) {
            return TRUE;
        }
        return FALSE;
    }

    public function send_email($to, $subject, $message, $from = NULL, $from_name = NULL, $attachment = NULL, $cc = NULL, $bcc = NULL) {
        $this->load->library('email');
        $config['mailtype'] = "html";

        // $config['protocol'] = ''; // mail, sendmail or smtp
        // $config['newline'] = "\r\n";
        // $config['smtp_host'] = '';
        // $config['smtp_user'] = '';
        // $config['smtp_pass'] = '';
        // $config['smtp_port'] = '';
        // $config['mailpath'] = '';

        $this->email->initialize($config);

        if ($from && $from_name) {
            $this->email->from($from, $from_name);
        } elseif($from) {
            $this->email->from($from, $this->Settings->site_name);
        }else {
            $this->email->from($this->Settings->default_email, $this->Settings->site_name);
        }

        $this->email->to($to);
        if ($cc) {
            $this->email->cc($cc);
        }
        if ($bcc) {
            $this->email->bcc($bcc);
        }
        $this->email->subject($subject);
        $this->email->message($message);
        if ($attachment) {
            if(is_array($attachment)) {
                $this->email->attach($attachment['file'], '', $attachment['name'], $attachment['mine']);
            } else {
                $this->email->attach($attachment);
            }
        }

        if ($this->email->send()) {
            //echo $this->email->print_debugger(); die();
            return TRUE;
        } else {
            //echo $this->email->print_debugger(); die();
            return FALSE;
        }
    }

    public function print_arrays() {
        $args = func_get_args();
        echo "<pre>";
        foreach($args as $arg){
            print_r($arg);
        }
        echo "</pre>";
        die();
    }

    public function logged_in() {
        return (bool) $this->session->userdata('identity');
    }

    public function in_group($check_group, $id = false) {
        $id || $id = $this->session->userdata('user_id');
        $group = $this->settings_model->getUserGroup($id);
        if($group && $group->name === $check_group) {
            return TRUE;
        }
        return FALSE;
    }

    private function _rglobRead($source, &$array = array())
    {
        if (!$source || trim($source) == "") {
            $source = ".";
        }
        foreach ((array)glob($source . "/*/") as $key => $value) {
            $this->_rglobRead(str_replace("//", "/", $value), $array);
        }
        $hidden_files = glob($source . ".*") AND $htaccess = preg_grep('/\.htaccess$/', $hidden_files);
        $files = array_merge(glob($source . "*.*"), $htaccess);
        foreach ($files as $key => $value) {
            $array[] = str_replace("//", "/", $value);
        }
    }

    private function _zip($array, $part, $destination, $output_name = 'sma')
    {
        $zip = new ZipArchive;
        @mkdir($destination, 0777, true);

        if ($zip->open(str_replace("//", "/", "{$destination}/{$output_name}" . ($part ? '_p' . $part : '') . ".zip"), ZipArchive::CREATE)) {
            foreach ((array)$array as $key => $value) {
                $zip->addFile($value, str_replace(array("../", "./"), NULL, $value));
            }
            $zip->close();
        }
    }

    public function zip($source = NULL, $destination = "./", $output_name = 'sma', $limit = 5000)
    {
        if (!$destination || trim($destination) == "") {
            $destination = "./";
        }

        $this->_rglobRead($source, $input);
        $maxinput = count($input);
        $splitinto = (($maxinput / $limit) > round($maxinput / $limit, 0)) ? round($maxinput / $limit, 0) + 1 : round($maxinput / $limit, 0);

        for ($i = 0; $i < $splitinto; $i++) {
            $this->_zip(array_slice($input, ($i * $limit), $limit, true), $i, $destination, $output_name);
        }

        unset($input);
        return;
    }

    public function unzip($source, $destination = './')
    {

        // @chmod($destination, 0777);
        $zip = new ZipArchive;
        if ($zip->open(str_replace("//", "/", $source)) === true) {
            $zip->extractTo($destination);
            $zip->close();
        }
        // @chmod($destination,0755);

        return TRUE;
    }

    public function dd()
    {
        die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . (isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : site_url('pos')) . "'; }, 10);</script>");
    }
	
}
