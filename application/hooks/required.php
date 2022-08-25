<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function required() {
    $CI = & get_instance();

    $CI->load->library('Ion_auth');
    $CI->load->library('session');
    $CI->load->library('form_validation');
    $CI->load->library('upload');

    $CI->load->config('paypal');



    $RTR = & load_class('Router');


    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth") {
        if (!$CI->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }


    $CI->load->model('settings/settings_model');
    $CI->load->model('ion_auth_model');


    $CI->load->model('hospital/hospital_model');



    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            if ($CI->ion_auth->in_group(array('admin'))) {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $CI->hospital_id = $CI->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->id;

                if (!empty($CI->hospital_id)) {
                    $newdata = array(
                        'hospital_id' => $CI->hospital_id,
                    );
                    $CI->session->set_userdata($newdata);
                }
            } else {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $group_id = $CI->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $CI->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $CI->hospital_id = $CI->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
                if (!empty($CI->hospital_id)) {
                    $newdata = array(
                        'hospital_id' => $CI->hospital_id,
                    );
                    $CI->session->set_userdata($newdata);
                }
            }
        }
    }


    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            $CI->db->where('hospital_id', $CI->hospital_id);
            $CI->language = $CI->db->get('settings')->row()->language;
            $CI->lang->load('system_syntax', $CI->language);
        } else {
            $CI->db->where('hospital_id', 'superadmin');
            $CI->language = $CI->db->get('settings')->row()->language;
            $CI->lang->load('system_syntax', $CI->language);
        }
    }

    if ($RTR->class == "frontend") {
        $CI->db->where('hospital_id', 'superadmin');
        $CI->language = $CI->db->get('settings')->row()->language;
        $CI->lang->load('system_syntax', $CI->language);
    }

    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            if ($CI->ion_auth->in_group(array('admin'))) {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $modules = $CI->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->module;
                $CI->modules = explode(',', $modules);
            } else {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $group_id = $CI->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $CI->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $hospital_id = $CI->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
                $modules = $CI->db->get_where('hospital', array('id' => $hospital_id))->row()->module;
                $CI->modules = explode(',', $modules);
            }
        }
    }


    $common = array('auth', 'frontend', 'settings', 'home', 'profile', 'request');

    if (!in_array($RTR->class, $common)) {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            if ($RTR->class != "schedule") {
                if ($RTR->class != "pgateway") {
                    if (!in_array($RTR->class, $CI->modules)) {
                        redirect('home');
                    }
                } elseif (!in_array('finance', $CI->modules)) {
                    redirect('home');
                }
            } elseif (!in_array('appointment', $CI->modules)) {
                redirect('home');
            }
        }
    }
}
