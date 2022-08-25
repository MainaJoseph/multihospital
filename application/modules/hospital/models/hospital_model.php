<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hospital_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function hospitalId() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $hospital_id = $this->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->id;
                return $hospital_id;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $hospital_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
                return $hospital_id;
            }
        }   
    }

    function modules() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $modules = $this->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->module;
                $module = explode(',', $modules);
                return $module;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $hospital_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
                $modules = $this->db->get_where('hospital', array('id' => $hospital_id))->row()->module;
                $module = explode(',', $modules);
                return $module;
            }
        }
    }

    function addHospitalIdToIonUser($ion_user_id, $hospital_id) {
        $hospital_ion_id = $this->db->get_where('hospital', array('id' => $hospital_id))->row()->ion_user_id;
        $uptade_ion_user = array(
            'hospital_ion_id' => $hospital_ion_id,
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function insertHospital($data) {
        $this->db->insert('hospital', $data);
    }

    function getHospital() {
        $query = $this->db->get('hospital');
        return $query->result();
    }

    function getHospitalById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('hospital');
        return $query->row();
    }

    function updateHospital($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('hospital', $data);
    }
    
    function updateHospitalByIonId($id, $data) {
        $this->db->where('ion_user_id', $id);
        $this->db->update('hospital', $data);
    }
    
    

    function activate($id, $data) {
        $this->db->where('id', $id);
        $this->db->or_where('hospital_ion_id', $id);
        $this->db->update('users', $data);
    }

    function deactivate($id, $data) {
        $this->db->where('hospital_ion_id', $id);
        $this->db->or_where('id', $id);
        $this->db->update('users', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('hospital');
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

    function getHospitalId($current_user_id) {
        $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
        $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
        $group_name = strtolower($group_name);
        $hospital_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
        return $hospital_id;
    }

}
