<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* read a array contains the auth_level of the user
* and push only the personal file branch numbers into new array
*/
if ( ! function_exists('athorized_branches_array'))
{
	// $authlevel string sperated by comma ','
	function athorized_branches_array( $authlevel_sting )
	{
	    $authlevel = explode(',', $authlevel_sting);
	    $branches = array();
	    for ($i = 1; $i <= 5; $i++) {
	        if(in_array($i, $authlevel)) {
	            $branches[$i] = 'personal_file_e0'.$i;
	        }
	    }
	    return $branches;
	}

	/*
	* convert db result object array into 
	* multidimentional key(branch)=>value(subject_file_no) array
	*/
	function athorized_subject_files_array( $subject_files )
	{
		$subject_files_array = array();
		foreach( $subject_files as $file) {

			$branch_no = $file->branch;
			$file_no = $file->subject_file;
			$subject_files_array[$branch_no][] = $file_no;
		}
		return $subject_files_array;
	}
	
	/*
	 * Check the logged user has increment date within next 3 months
	 * */
	function check_increment_date($month_day) {
	    
	        if( !empty($month_day) ) {
	            
	            $year = date("Y");
	            $this_year_increment_date = $year."-".$month_day;
	            $next_year_increment_date = ($year+1)."-".$month_day;
	            
	            $today =  date("Y-m-d");
	            $end_date = date("Y-m-d", strtotime("+3 months", strtotime($today)));
	            
	            // only one option will be true
	            //01
	            if( strtotime($today) <=  strtotime($this_year_increment_date) && strtotime($this_year_increment_date) <=  strtotime($end_date) ) {
	                $message = "ඔබගේ මීළඟ වැටුප් වර්ධක දිනය ".$this_year_increment_date." යෙදී ඇත.";
	                return $this_year_increment_date;
	            }
	            
	            //02
	            if( strtotime($today) <=  strtotime($next_year_increment_date) && strtotime($next_year_increment_date) <=  strtotime($end_date) ) {
	                $message = "ඔබගේ මීළඟ වැටුප් වර්ධක දිනය ".$next_year_increment_date." යෙදී ඇත.";
	                return $next_year_increment_date;
	            }
	        }
	    return false;
	}
	
}

?>