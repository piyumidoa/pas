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
    

    public function add_appraiser_and_moderator() {
        
        $result = $this->estbsession->check_session_token();
        $data['authlevel'] = $this->session->userdata('authlevel');
        
        if ($result && in_array("14", $data['authlevel']) ) {
            
            $data['page_title'] = "අගැයුම්කරු  ප්‍රමාණකරු";
            
            $moderator = $this->input->post('moderator');
            $appraiser = $this->input->post('appraiser');
            $appraisee_array = $this->input->post('appraisee');
            
            
            $this->benchmark->mark('my_mark1_start');
            
            //check nic nos have personal files in db
            $this->load->model('PersonalFile_Model');
            $data['branches'] = $this->session->userdata('branches'); // only authorized for user 
            $all_branches = branch_names_array(); // all
            
            $valid_personal_file = 0;
            // todo can be from any branch, not only from authorized branch
            $personal_file1 = $this->PersonalFile_Model->select_by_nic_no_branch( $moderator, $all_branches );
            if( is_array($personal_file1) && count($personal_file1) == 1 ) {
                
                $valid_personal_file = 1;
                $data['moderator_id'] = $personal_file1[0]->id;
                $data['moderator_name'] = $personal_file1[0]->officer_name;
            }
            
            $valid_personal_file = 0;
            // todo can be from any branch, not only from authorized branch
            $personal_file2 = $this->PersonalFile_Model->select_by_nic_no_branch( $appraiser, $all_branches );
            if( is_array($personal_file2) && count($personal_file2) == 1 ) {
                
                $valid_personal_file = 1;
                $data['appraiser_id'] = $personal_file2[0]->id;
                $data['appraiser_name'] = $personal_file2[0]->officer_name;
            }
            
            $valid_personal_file = 0;
            $insert_data = array(); // data array for batch insert
            foreach ($appraisee_array as $appraisee) {
                
                $valid_personal_file = 0;
                $personal_file3 = $this->PersonalFile_Model->select_by_nic_no_branch( $appraisee, $data['branches'] );
                if( is_array($personal_file3) && count($personal_file3) == 1 ) {
                    $valid_personal_file = 1;
                    $data['appraisee_id'] = $personal_file3[0]->id;
                    $data['appraisee_name'] = $personal_file3[0]->officer_name;
                    
                    $row = array(
                        'moderator' => $data['moderator_id'],
                        'appraiser' => $data['appraiser_id'],
                        'personal_file' => $data['appraisee_id']
                    );
                    array_push($insert_data, $row);
                } else {
                    break;
                }
            }
            // validation rules- end
            
            $this->benchmark->mark('my_mark1_end');
            
            if ($this->form_validation->run() == FALSE)
            {
                
            } else {
                
                $this->load->model('Performance_Appraisal_Model');
                $add_result = $this->Performance_Appraisal_Model->insert_appraiser_and_moderator( $insert_data );
                if( $add_result ) {
                    
                    $data['message'] = "සාර්ථකයි";
                }
                else {
                    $data['message'] = "අසාර්ථකයි";
                }
            }
            $data['form_action'] = "appraiser_and_moderator/add";
            $data['appraiser_and_moderator_list'] = $this->appraiser_and_moderator_list();
            $data['num_rows'] = count($data['appraiser_and_moderator_list']);
            
            $this->load->view('common/header', $data);
            $this->load->view('dashboard/appraiser_and_moderator');
        }
    }
    
    public function delete_appraiser_and_moderator() {
        
        $result = $this->estbsession->check_session_token();
        $data['authlevel'] = $this->session->userdata('authlevel');
        
        if ($result && in_array("14", $data['authlevel']) ) {
            
            $data['page_title'] = "අගැයුම්කරු  ප්‍රමාණකරු";
            $branches = $this->session->userdata('branches');
            
            $id = $this->uri->segment('4');
            $appraisee_id = $this->uri->segment('5');
            $personal_file_div = substr($appraisee_id, 0, 1);
            
            if( array_key_exists($personal_file_div, $branches)) {
                
                $this->load->model('Performance_Appraisal_Model');
                $result = $this->Performance_Appraisal_Model->delete_appraiser_and_moderator($id);
                if( $result ) {
                    
                    $data['message'] = "සාර්ථකයි";
                }
                else {
                    $data['message'] = "අසාර්ථකයි";
                }
            } else {
                $data['message'] = "appraisee not in authorized branch";
            }
            
            $data['form_action'] = "appraiser_and_moderator/add";
            $data['appraiser_and_moderator_list'] = $this->appraiser_and_moderator_list();
            $data['num_rows'] = count($data['appraiser_and_moderator_list']);
            
            $this->load->view('common/header', $data);
            $this->load->view('dashboard/appraiser_and_moderator');
        }
    }
    
    /*
     * all assigned appraiser and moderator of all personal files
     * in authorized branch of logged subject officer
     * */
    public function appraiser_and_moderator_list() {
        
        $branches = $this->session->userdata('branches');
        $all_branches = branch_names_array();
        
        $this->load->model('Performance_Appraisal_Model');
        $this->load->model('PersonalFile_Model');
        $appraiser_and_moderator_list = $this->Performance_Appraisal_Model->appraiser_and_moderator_list( $branches );
        
        $personal_file_list = array();
        foreach ($appraiser_and_moderator_list as $object) {
            
            // select only from authorized branch
            $personal_file = $this->PersonalFile_Model->select_by_id_branch( $object->personal_file, $branches, NULL );
            if( is_array($personal_file) && count($personal_file) == 1 ) {
                
                $object->personal_file_officer_name = $personal_file[0]->officer_name;
                $object->personal_file_nic_no = $personal_file[0]->nic_no;
                $object->personal_file_post_name = $personal_file[0]->post_name;
            }
            
            if (array_key_exists( $object->appraiser, $personal_file_list)) {
                
                $object->appraiser_officer_name = $personal_file_list[$object->appraiser]->officer_name;
                $object->appraiser_nic_no = $personal_file_list[$object->appraiser]->nic_no;
                $object->appraiser_post_name = $personal_file_list[$object->appraiser]->post_name;
                
            } else {
                
                // appraiser can be from any branch
                $personal_file = $this->PersonalFile_Model->select_by_id_branch( $object->appraiser, $all_branches, NULL );
                if( is_array($personal_file) && count($personal_file) == 1 ) {
                    
                    $object_new = new stdClass();
                    $object_new->officer_name = $object->appraiser_officer_name = $personal_file[0]->officer_name;
                    $object_new->nic_no = $object->appraiser_nic_no = $personal_file[0]->nic_no;
                    $object_new->post_name = $object->appraiser_post_name = $personal_file[0]->post_name;
                    $personal_file_list[$object->appraiser] = $object_new;
                }
            }
            
            if (array_key_exists($object->moderator, $personal_file_list)) {
                
                $object->moderator_officer_name = $personal_file_list[$object->moderator]->officer_name;
                $object->moderator_nic_no = $personal_file_list[$object->moderator]->nic_no;
                $object->moderator_post_name = $personal_file_list[$object->moderator]->post_name;
                
            } else {
                
                // moderator can be from any branch
                $personal_file = $this->PersonalFile_Model->select_by_id_branch( $object->moderator, $all_branches, NULL );
                if( is_array($personal_file) && count($personal_file) == 1 ) {
                    
                    $object_new = new stdClass();
                    $object_new->officer_name = $object->moderator_officer_name = $personal_file[0]->officer_name;
                    $object_new->nic_no = $object->moderator_nic_no = $personal_file[0]->nic_no;
                    $object_new->post_name = $object->moderator_post_name = $personal_file[0]->post_name;
                    $personal_file_list[$object->moderator] = $object_new;
                }
            }
        }
        return $appraiser_and_moderator_list;
    }
    
}
