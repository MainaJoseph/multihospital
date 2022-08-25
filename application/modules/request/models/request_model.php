<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function requestId() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $request_id = $this->db->get_where('request', array('ion_user_id' => $current_user_id))->row()->id;
                return $request_id;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $request_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->request_id;
                return $request_id;
            }
        }   
    }

    function modules() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $modules = $this->db->get_where('request', array('ion_user_id' => $current_user_id))->row()->module;
                $module = explode(',', $modules);
                return $module;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $request_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->request_id;
                $modules = $this->db->get_where('request', array('id' => $request_id))->row()->module;
                $module = explode(',', $modules);
                return $module;
            }
        }
    }

    function addRequestIdToIonUser($ion_user_id, $request_id) {
        $request_ion_id = $this->db->get_where('request', array('id' => $request_id))->row()->ion_user_id;
        $uptade_ion_user = array(
            'request_ion_id' => $request_ion_id,
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function insertRequest($data) {
        $this->db->insert('request', $data);
    }

    function getRequest() {
        $query = $this->db->get('request');
        return $query->result();
    }

    function getRequestById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('request');
        return $query->row();
    }

    function updateRequest($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('request', $data);
    }

    function activate($id, $data) {
        $this->db->where('id', $id);
        $this->db->or_where('request_ion_id', $id);
        $this->db->update('users', $data);
    }

    function deactivate($id, $data) {
        $this->db->where('request_ion_id', $id);
        $this->db->or_where('id', $id);
        $this->db->update('users', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('request');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getRequestId($current_user_id) {
        $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
        $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
        $group_name = strtolower($group_name);
        $request_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->request_id;
        return $request_id;
    }

}
