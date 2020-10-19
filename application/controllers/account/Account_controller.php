<?php
   class Account_controller extends CI_Controller {

      function __construct() {
         parent::__construct();
         $this->load->database();
         $this->output->enable_profiler(TRUE);
      }

      public function index() {

      }

      public function login_form() {
         $data['page_title'] = "Login";
         $this->load->view('common/header', $data);
         $this->load->view('account/login_form', $data);
      }

      public function logout() {
        // session delete
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('loggedin');
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('authlevel');
        $this->session->unset_userdata('subject_files');
        $this->session->unset_userdata('csrf_session_token');

        $this->login_form();
      }

     
      // remove this method 


    public function profile() {
      
        $authlevel = $this->session->userdata('authlevel'); 

            $data['page_title'] = "පුද්ගලික ගොනුව";
            $userid = $this->session->userdata('userid');
            $branches = $this->session->userdata('branches');
            
            $this->load->model('PersonalFile_Model');
            $personal_file_div = substr($userid, 0, 1);
            $branch_name = "personal_file_e0".$personal_file_div;
            $personal_file = $this->PersonalFile_Model->select_by_id( $userid, $branch_name );
            
            if( is_array($personal_file) && !empty($personal_file) && count($personal_file) > 0 ) {

                $data['personal_file'] = $personal_file[0];
                $data['branches'] = $this->session->userdata('branches'); 
                $data['subject_files'] = $this->session->userdata('subject_files');
            }
            
            $this->load->view('common/header', $data);
            $this->load->view('personal_file/profile', $data);
        
    }



    
}
?>
