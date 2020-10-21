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
      public function select_appraisee_list($user) {
          
          $branches = branch_names_array();
          $result_all = array();
          foreach ( $branches as $key=>$value ) {
              
              $this->db->select( '*, performance_appraisal.id as performance_appraisal_id, '.$value.'.appraiser as appraiser_id, '.$value.'.moderator as moderator_id' );
              $this->db->from($value);
              $this->db->join('performance_appraisal', $value.'.id = performance_appraisal.personal_file');
              $this->db->where($value.'.appraiser', $user);
              $this->db->or_where($value.'.moderator', $user);
              $this->db->or_where($value.'.id', $user);
              
              $query = $this->db->get();
              $result = $query->result();
              $result_all= array_merge($result_all, $result);
          }
          return $result_all;
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
      
      public function appraisee_details( $performance_appraisal_id, $branch_name ) {
          
          $this->db->select( '*, '.$branch_name.'.appraiser as appraiser_id, '.$branch_name.'.moderator as moderator_id' );
          $this->db->from($branch_name);
          $this->db->join('performance_appraisal', $branch_name.'.id = performance_appraisal.personal_file');
          $this->db->where('performance_appraisal.id', $performance_appraisal_id);
          
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
      

      public function insert_appraiser_and_moderator($data) {
          
          $result = $this->db->insert_batch('appraiser_moderator', $data);
          return $result;
      }
      
      public function appraiser_and_moderator_list( $branches ){
          
          $result_all = array();
          foreach ( $branches as $key=>$value ) {
              
              $this->db->select( '*' );
              $this->db->from('appraiser_moderator');
              $this->db->like('personal_file', $key, 'after');
              
              $query = $this->db->get();
              $result = $query->result();
              $result_all= array_merge($result_all, $result);
          }
          return $result_all;
      }
      
      public function delete_appraiser_and_moderator($id) {
          
          $this->db->where('id', $id);
          $this->db->delete('appraiser_moderator');
          if($this->db->affected_rows() > 0)
          {
              return true;
          } else {
              return false;
          } 
      }

   }
?> 
