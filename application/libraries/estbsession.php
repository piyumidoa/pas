<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * EstbSession Class
 *
 * check session and cookie values are equals 
 * to prevent csrf
 */
class EstbSession {
    
    protected $CI;

    public function __construct()
    {
            $this->CI =& get_instance();
    }

    public function check_session_token()
    {
        $this->CI->load->library('session');
        $csrf_session_token = $this->CI->session->userdata('csrf_session_token');
        $csrf_session_token_cookie_value =  get_cookie('csrf_session_token');
        $loggedin = $this->CI->session->userdata('loggedin'); 

        if ($loggedin && ( $csrf_session_token == $csrf_session_token_cookie_value)) {
          
                return TRUE;
                
        } else {
          $data['page_title'] = "Login";
          $this->CI->load->view('common/header', $data);
          $this->CI->load->view('account/login_form', $data);
        }
    }

    public function check_branch_subject_file( $id, $subject_file )
    {       

        $this->CI->load->library('session');
        $branches = $this->CI->session->userdata('branches');
        $subject_files = $this->CI->session->userdata('subject_files');

        $branch_no = $id[0]; // first char of the array id
        if( isset($branches[$branch_no]) && !isset($subject_files[$branch_no]) ) {

            return true;
        }        
        else if( isset($branches[$branch_no]) && isset($subject_files[$branch_no]) && in_array($subject_file, $subject_files[$branch_no]) ) {
            
            return true;

        } else {
            return false;
        }
    }
}
?>