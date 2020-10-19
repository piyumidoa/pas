<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonalFile_controller extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->output->enable_profiler(TRUE);
	}

	public function index()
	{        
        $authlevel = $this->session->userdata('authlevel'); 

        if (in_array("6", $authlevel)) {

            $data['page_title'] = "පුද්ගලික ලිපි ගොනු ";
            
            $this->load->model('Post_Model');
            $this->load->model('SubUnit_Model');
            $this->load->model('PersonalFile_Model');
            $branches = $this->session->userdata('branches');
            $subject_files = $this->session->userdata('subject_files');
            
            $data['sub_unit_list'] = $this->SubUnit_Model->select_all_asc_name();
            $data['post_list'] = $this->Post_Model->select_by_branch($branches); 
            
            if ( in_array("11", $authlevel)) { // can see all personal file list but more info
                $data['personal_file_list'] = $this->PersonalFile_Model->select_by_branch_subject_file($branches, NULL); 
                $in_other_institues = $this->PersonalFile_Model->select_by_other_institues($branches, NULL);
            } else {
                $data['personal_file_list'] = $this->PersonalFile_Model->select_by_branch_subject_file($branches, $subject_files);
                $in_other_institues = $this->PersonalFile_Model->select_by_other_institues($branches, $subject_files);
            }
            
            $data['personal_file_list'] = array_merge($data['personal_file_list'], $in_other_institues);
            
            $data['num_rows'] = count($data['personal_file_list']);
            $data['disabled'] = ' '; // enable form input
            $data['form_action'] = 'add';

            $this->load->view('common/header', $data);
            $this->load->view('personal_file/personal_file', $data);
        }     
    }

    
}
