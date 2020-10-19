<?php
/**
 * Establishment Division
 * Department of Agriculture
 * 
 * */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        //auth level : 9
	}

	public function index()
	{            $data['page_title'] = "සැකසුම් ";
            $data['authlevel'] = $authlevel;

            $this->load->view('common/header', $data);
            $this->load->view('dashboard/dashboard', $data);
                
    }
        
    public function appraiser_and_moderator() {
        
        
        $data['authlevel'] = $this->session->userdata('authlevel');
        
        if ( in_array("14", $data['authlevel']) ) {
            
            $data['page_title'] = "අගැයුම්කරු  ප්‍රමාණකරු";
            $data['form_action'] = "appraiser_and_moderator/add";
            
            $this->load->view('common/header', $data);
            $this->load->view('dashboard/appraiser_and_moderator');
        }
    }
    
    public function add_appraiser_and_moderator() {
        
        $data['authlevel'] = $this->session->userdata('authlevel');
        
        if ( in_array("14", $data['authlevel']) ) {
            
            $data['page_title'] = "අගැයුම්කරු  ප්‍රමාණකරු";
            
            $moderator = $this->input->post('moderator');
            $appraiser = $this->input->post('appraiser');
            $appraisee_array = $this->input->post('appraisee');
            
            //validation rules
            $this->form_validation->set_rules('moderator', 'moderator', 'required', array(
                'required' => '*required'
            ));            
            $this->form_validation->set_rules('appraiser', 'appraiser', 'required', array(
                'required' => '*required'
            ));
            $this->form_validation->set_rules('appraisee', 'appraisee', 'required', array(
                'required' => '*required'
            ));
            
            //check nic nos have personal files in db
            $this->load->model('PersonalFile_Model');
            $data['branches'] = $this->session->userdata('branches');
            
            $valid_personal_file = 0;
            $personal_file1 = $this->PersonalFile_Model->select_by_nic_no_branch( $moderator, $data['branches'] );
            if( is_array($personal_file1) && !empty($personal_file1) && count($personal_file1) > 0 ) {
                $valid_personal_file = 1;
                $data['moderator_id'] = $personal_file1[0]->id;
                $data['moderator_name'] = $personal_file1[0]->officer_name;
            }
            
            $valid_personal_file = 0;
            $personal_file2 = $this->PersonalFile_Model->select_by_nic_no_branch( $appraiser, $data['branches'] );
            if( is_array($personal_file2) && !empty($personal_file2) && count($personal_file2) > 0 ) {
                $valid_personal_file = 1;
                $data['appraiser_id'] = $personal_file2[0]->id;
                $data['appraiser_name'] = $personal_file2[0]->officer_name;
            }
            
            $valid_personal_file = 0;
            foreach ($appraisee_array as $appraisee) {
                $valid_personal_file = 0;
                $personal_file3 = $this->PersonalFile_Model->select_by_nic_no_branch( $appraisee, $data['branches'] );
                if( is_array($personal_file3) && !empty($personal_file3) && count($personal_file3) > 0 ) {
                    $valid_personal_file = 1;
                    $data['appraiser_id'] = $personal_file2[0]->id;
                    $data['appraiser_name'] = $personal_file2[0]->officer_name;
                } else {
                    break;
                }
            }
            
            //$this->set_validation_rules_add_appraiser_moderator();
            
            if ($this->form_validation->run() == FALSE)
            {
                
            } else {
                $this->load->model('Performance_Appraisal_Model');
                foreach ($appraisee_array as $appraisee) {
                    
                    $row = array(
                        'moderator' => $moderator,
                        'appraiser' => $appraiser,
                        'personal_file' => $appraisee
                    );
                }
                $add_result = $this->Performance_Appraisal_Model->insert_appraiser_and_moderator( $row );
                if( $add_result ) {
                    
                    $data['message'] = "සාර්ථකයි";
                }
                else {
                    $data['message'] = "අසාර්ථකයි";
                }
            }
            $data['form_action'] = "appraiser_and_moderator/add";
            
            $this->load->view('common/header', $data);
            $this->load->view('dashboard/appraiser_and_moderator');
        }
    }
    
    
}
