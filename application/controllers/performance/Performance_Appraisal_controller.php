<?php
/**
 * Establishment Division
 * Department of Agriculture
 * 
 * */

defined('BASEPATH') OR exit('No direct script access allowed');

class Performance_Appraisal_controller extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        //auth level : 14
	}

	public function index()
	{
        $data['authlevel'] = $this->session->userdata('authlevel'); 

            $data['page_title'] = "කාර්ය සාධන ඇගයීම";
            $data['appraisee_completed'] = 0;
            $data['form_action'] = "add_appraisee_details";
            $data['btn_text'] = ' අගැයුම්කරු වෙත යවන්න ';

            $branch_name = $this->session->userdata('userbranch');
            $userid = $this->session->userdata('userid');
            $this->load->model('PersonalFile_Model');
            $this->load->model('Performance_Appraisal_Model');
            
            $this->benchmark->mark('my_mark_start');
            $personal_file = $this->PersonalFile_Model->select_by_id( $userid, $branch_name );
            
            if( is_array($personal_file) && count($personal_file) == 1 ) {
                
                $data['nic_no'] = $personal_file[0]->nic_no;
                $data['increment_month_date'] = $personal_file[0]->increment_date;
                $data['increment_date'] = check_increment_date($data['increment_month_date']); //check date within next 3 months
                
                if($data['increment_date']) {      
                    
                    $data['note'] = $this->get_title_message($data['increment_date']);
                    $data['post'] = $personal_file[0]->post;
                    $data['form_name'] = $this->get_html_form_name($data['post']);
                    $data['feedback_options'] = $this->get_feedback_options();
                    
                    //check is already completed
                    $completed = $this->Performance_Appraisal_Model->select_by_date( $userid, $data['increment_date'] );
                    if( is_array($completed) && count($completed) == 1) {
                        
                        $data['appraisee_feedback'] = $completed[0]->appraisee_feedback;
                        $data['appraisee_completed_date'] = $completed[0]->appraisee_completed_date;
                        $data['appraiser_feedback'] = $completed[0]->appraiser_feedback;
                        $data['appraiser_completed_date'] = $completed[0]->appraiser_completed_date;
                        $data['id'] = $completed[0]->id;
                        $data['form_action'] = "appraisee_details/edit/".$data['id'];
                    }
                }
            }
            $this->benchmark->mark('my_mark_end');
            $this->benchmark->mark('my_mark1_start');
            //check users appraisees list
            $data['appraisees'] = $this->Performance_Appraisal_Model->>select_appraisee_list( $userid );
            
            $this->benchmark->mark('my_mark1_end');
            
            $this->load->view('common/header', $data);
            $this->load->view('performance/performance_appraisal.php', $data);
               
    }    

    public function add_appraisee_details()
    {
        $data['authlevel'] = $this->session->userdata('authlevel');
        
            
            //form input values
            $data['nic_no'] = $this->input->post('nic_no');
            $data['increment_date'] = $this->input->post('increment_date');            
            $data['appraisee_feedback'] = $this->input->post('appraisee_feedback');
            $data['post'] = $this->input->post('post');
            $data['form_name'] = $this->input->post('form_name');
            
            $data['page_title'] = "කාර්ය සාධන ඇගයීම";
            $data['appraisee_completed'] = 0;
            $data['message'] = "අසාර්ථකයි";
            $data['form_action'] = "add_appraisee_details";
            $data['btn_text'] = ' අගැයුම්කරු වෙත යවන්න ';
            $data['feedback_options'] = $this->get_feedback_options();
            
            $branch_name = $this->session->userdata('userbranch');
            $userid = $this->session->userdata('userid');
                    
                    $data['note'] = $this->get_title_message($data['increment_date']);
                    
                    $this->set_validation_rules_insert_appraisee_details();
                    
                    if ($this->form_validation->run() == FALSE)
                    {
                        
                    } else {
                        
                        $this->load->model('Performance_Appraisal_Model');
                        $row = array(
                            'personal_file' => $userid,
                            'nic_no' => $data['nic_no'],
                            'increment_date' => $data['increment_date'],
                            'appraisee_feedback' => $data['appraisee_feedback'],
                            'appraisee_completed' => 1,
                            'appraisee_completed_date' => date('Y-m-d')
                        );
                        $add_result = $this->Performance_Appraisal_Model->insert_appraisee_details( $row );
                        if( $add_result ) {
                            
                            $data['appraisee_completed'] = 1;
                            $data['id'] = $add_result;
                            $data['form_action'] = "appraisee_details/edit/".$data['id'];
                            $data['message'] = "සාර්ථකයි";
                        }
                    }            
            $this->load->view('common/header', $data);
            $this->load->view('performance/performance_appraisal.php', $data);
        
    }
    
    public function edit_appraisee_details() {
        
        $data['authlevel'] = $this->session->userdata('authlevel');
        
            $data['id'] = $this->uri->segment('4');
            $data['appraisee_feedback'] = $this->input->post('appraisee_feedback');
            
            $data['form_action'] = "appraisee_details/edit/".$data['id'];
            $data['page_title'] = "කාර්ය සාධන ඇගයීම";
            $data['appraisee_completed'] = 1;      
            $data['btn_text'] = ' අගැයුම්කරු වෙත යවන්න ';
            $userid = $this->session->userdata('userid');
            
            $this->set_validation_rules_insert_appraisee_details();
            
            if ($this->form_validation->run() == FALSE)
            {
                
            } else {
                
                $this->load->model('Performance_Appraisal_Model');
                $row = array(
                    'appraisee_feedback' => $data['appraisee_feedback'],
                    'appraisee_completed_date' => date('Y-m-d')
                );
                $completed = $this->Performance_Appraisal_Model->edit_appraisee_details( $row, $data['id'] );
                if( $completed ) {
                    $data['message'] = "සාර්ථකයි";
                    
                } else {
                    $data['message'] = "අසාර්ථකයි";
                }
            }
            
            $data['nic_no'] = $this->input->post('nic_no');
            $data['increment_date'] = $this->input->post('increment_date');
            $data['note'] = $this->get_title_message($data['increment_date']);
            $data['post'] = $this->input->post('post');
            $data['form_name'] = $this->input->post('form_name');
            $data['feedback_options'] = $this->get_feedback_options();
            
            $this->load->view('common/header', $data);
            $this->load->view('performance/performance_appraisal.php', $data);
        
    }
    
    public function appraiser_details()
    {
        $data['authlevel'] = $this->session->userdata('authlevel');
        
            
            $data['page_title'] = "කාර්ය සාධන ඇගයීම";
            $data['appraisee_completed'] = 1;
            $data['btn_text'] = ' ප්‍රමාණකරු  වෙත යවන්න ';
            $data['feedback_options'] = $this->get_feedback_options();
            $userid = $this->session->userdata('userid');
            
            $data['appraisee_id'] = $this->uri->segment('3');
            $data['increment_date'] = $this->uri->segment('4');
            
            $branches = $this->branch_names_array();
            $personal_file_div = substr(trim($data['appraisee_id']), 0, 1);
            $branch_name = $branches[$personal_file_div];
            
            $this->benchmark->mark('my_mark_start');
            
            $this->load->model('Performance_Appraisal_Model');
            $appraisee_details = $this->Performance_Appraisal_Model->appraisee_details( $data['appraisee_id'], $data['increment_date'], $branch_name );
            
            if( is_array($appraisee_details) && count($appraisee_details) == 1 ) {
                
                $data['nic_no'] = $appraisee_details[0]->nic_no;
                $data['post'] = $appraisee_details[0]->post;
                $data['form_name'] = $this->get_html_form_name($data['post']);
                $data['appraisee_feedback'] = $appraisee_details[0]->appraisee_feedback;
                $data['appraisee_completed_date'] = $appraisee_details[0]->appraisee_completed_date;
                $data['appraiser_feedback'] = $appraisee_details[0]->appraiser_feedback;
                $data['appraiser_completed_date'] = $appraisee_details[0]->appraiser_completed_date;
                $data['id'] = $appraisee_details[0]->id;
                $data['form_action'] = "appraiser_details/update/".$data['id'];
            }
            
            $this->benchmark->mark('my_mark_end');
            
            $this->load->view('common/header', $data);
            $this->load->view('performance/performance_appraisal.php', $data);
        
    }
    
    public function update_appraiser_details()
    {
       
        $data['authlevel'] = $this->session->userdata('authlevel');
        
            $data['page_title'] = "කාර්ය සාධන ඇගයීම";
            $data['appraisee_completed'] = 1;
            $data['btn_text'] = ' ප්‍රමාණකරු  වෙත යවන්න ';
            $data['feedback_options'] = $this->get_feedback_options();
            $userid = $this->session->userdata('userid');
            
            $data['id'] = $this->uri->segment('4'); // primary key of performance_appraisal table            
            $data['form_action'] = "appraiser_details/update/".$data['id'];
            $data['nic_no'] = $this->input->post('nic_no');
            $data['appraisee_id'] = $this->input->post('appraisee_id');
            $data['increment_date'] = $this->input->post('increment_date');
            $data['appraisee_feedback'] = $this->input->post('appraisee_feedback');
            $data['appraisee_completed_date'] = $this->input->post('appraisee_completed_date');
            $data['appraiser_feedback'] = $this->input->post('appraiser_feedback');
            $data['appraiser_completed_date'] = $this->input->post('appraiser_completed_date');
            $data['post'] = $this->input->post('post');
            $data['form_name'] = $this->input->post('form_name');
            
            $this->benchmark->mark('my_mark_start');
            
            $this->set_validation_rules_update_appraiser_details();
            
            if ($this->form_validation->run() == FALSE)
            {
                
            } else {
                $this->load->model('Performance_Appraisal_Model');
                $row = array(
                    'appraiser_feedback' => $data['appraiser_feedback'],
                    'appraiser_completed_date' => date('Y-m-d')
                );
                $updated = $this->Performance_Appraisal_Model->update_appraiser_details( $data['id'], $row );
                
                if( $updated ) {
                    
                    $data['message'] = "සාර්ථකයි";
                    
                } else {
                    $data['message'] = "අසාර්ථකයි";
                }
            }
            
            $this->benchmark->mark('my_mark_end');
            
            $this->load->view('common/header', $data);
            $this->load->view('performance/performance_appraisal.php', $data);
        
    }
    
    public function set_validation_rules_insert_appraisee_details() {
        
        $this->form_validation->set_rules('appraisee_feedback', 'appraisee_feedback', 'required', array(
            'required' => '*appraisee_feedback තෝරන්න '
        ));
    }
    
    public function set_validation_rules_update_appraiser_details() {
        
        $this->form_validation->set_rules('appraiser_feedback', 'appraiser_feedback', 'required', array(
            'required' => '*appraiser_feedback තෝරන්න '
        ));
    }
    
    public function get_title_message($increment_date) {
        
        if($increment_date) {
            $note = "ඔබගේ මීළඟ වැටුප් වර්ධක දිනය ".$increment_date." යෙදී ඇත.";
            return $note;
        }
    }
    
    public function get_feedback_options() { 
        
        $string_array = array();
        $string_array[1] = 'දුර්වලයි ';
        $string_array[2] = 'හොඳයි';
        $string_array[3] = 'ඉතා හොඳයි';
        $string_array[4] = 'විශිෂ්ටයි';
        return  $string_array;
    }
    
    public function get_html_form_name( $post ) {
        
        $form_one = array("21", "22", "10");
        $form_two = array("26", "25");
        if( in_array($post, $form_one)) {
            return "form_one";
        }
        if( in_array($post, $form_two)) {
            return "form_two";
        }
        return FALSE;
    }
}
?>