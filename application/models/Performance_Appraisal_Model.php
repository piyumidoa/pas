<?php
class Performance_Appraisal_Model extends CI_Model {

      function __construct() {
         parent::__construct();
      }

      public function insert_appraisee_details($row) {

        if ( $this->db->insert("performance_appraisal", $row)) {
            $id = $this->db->insert_id();
            return $id;
        } else {            
            return false;
        }  
      }
      
      public function select_by_date($userid, $increment_date) {
          
          $this->db->select( '*' );
          $this->db->from('performance_appraisal');
          $this->db->where('personal_file', $userid);
          $this->db->where('increment_date', $increment_date);
          
          $query = $this->db->get();
          $result = $query->result();
          return $result;
      }
      
      public function select_by_id( $id ) {
          
          $this->db->select( '*' );
          $this->db->from('performance_appraisal');
          $this->db->where('id', $id);
          
          $query = $this->db->get();
          $result = $query->result();
          return $result;
      }          
      
      public function edit_appraisee_details($row, $id) {
          
          $this->db->where('id', $id);
          $this->db->update('performance_appraisal', $row);
          if($this->db->affected_rows() > 0)
          {
              return true;
          } else {
              return false;
          } 
      }
      
      public function select_appraisees_to_appraise($appraiser) {
          
          $this->db->select( '*, appraiser_moderator.personal_file AS personal_file_id' );
          $this->db->from('appraiser_moderator');
          $this->db->join('performance_appraisal', 'appraiser_moderator.personal_file = performance_appraisal.personal_file');
          $this->db->where('appraiser', $appraiser);
          
          $query = $this->db->get();
          $result = $query->result();
          return $result;
      }
      
      public function appraisee_details( $appraisee_id, $increment_date, $branch_name ) {
          
          $this->db->select( '*' );
          $this->db->from($branch_name);
          $this->db->join('performance_appraisal', $branch_name.'.id = performance_appraisal.personal_file');
          $this->db->where($branch_name.'.id', $appraisee_id);
          $this->db->where('performance_appraisal.increment_date', $increment_date);
          
          $query = $this->db->get();
          $result = $query->result();
          return $result;
      }
      
      public function update_appraiser_details( $id, $row ) {
          
          $this->db->where('id', $id);
          $this->db->update('performance_appraisal', $row);
          if($this->db->affected_rows() > 0)
          {
              return true;
          } else {
              return false;
          } 
      }
      
      public function insert_appraiser_and_moderator($row) {
          
          $this->db->where('personal_file', $row['personal_file']);
          $this->db->update('appraiser_moderator', $row);
          if($this->db->affected_rows() > 0)
          {
              return true;
          } else {
              return false;
          } 
      }
   }
?> 
