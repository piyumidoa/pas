
<?php
   class PersonalFile_Model extends CI_Model {

      function __construct() {
         parent::__construct();
      }


   public function select_by_branch( $branches ) {
       
       $result_all = array();
       foreach ( $branches as $key=>$value ) {
           
           $this->db->select('*,sub_unit.name_si AS sub_unit_name, post.name_si AS post_name, '.$value.'.id AS personal_file_id');
           $this->db->from($value);
           $this->db->join('sub_unit', 'sub_unit.id = '.$value.'.sub_unit');
           $this->db->join('post', 'post.id = '.$value.'.post');
           
           $query = $this->db->get();
           $result = $query->result();
           $result_all= array_merge($result_all, $result);
       }
       return $result_all;
   }

   public function  select_by_branch_subject_file($branches, $subject_files) {

      $result_all = array();
       foreach ( $branches as $key=>$value ) {           
           
           $this->db->select('*,sub_unit.name_si AS sub_unit_name, post.name_si AS post_name, '.$value.'.id AS personal_file_id');
           $this->db->from($value);
           $this->db->join('sub_unit', 'sub_unit.id = '.$value.'.sub_unit');
           $this->db->join('post', 'post.id = '.$value.'.post');
           if( isset($subject_files[$key]) && !empty($subject_files[$key])) {
              // is the authorized branch has assigned any subject files
               $branch_subject_files = $subject_files[$key];
               $this->db->where_in($value.'.subject_file', $branch_subject_files);
           }
           
           $query = $this->db->get();
           $result = $query->result();
           $result_all= array_merge($result_all, $result);
       }
       return $result_all;
   }
   

    public function select_by_nic_no( $nic_no ) {
         
      $records = "";
      for ($i = 1; $i <= 5; $i++) { // find the user name on all personal file tables

            $this->db->select('*');
            $this->db->from('personal_file_e0'.$i.'');
            $this->db->where('nic_no', $nic_no);
            $query = $this->db->get();
            $result = $query->result();

            if( count($result) == 1 ) {
               return $result;
            }
      }
    }
    
    // todo:remove the above later
    /*
     * nic is unique for all personal file branches
     * */
    public function select_by_nic_no_branch( $nic_no, $branches ) {
        
        foreach ( $branches as $key=>$value ) {
            
            $this->db->select('*');
            $this->db->from( $value );
            $this->db->where('nic_no', $nic_no);
            $query = $this->db->get();
            $result = $query->result();
            
            if( count($result) == 1 ) {
                return $result;
            }
        }
    }

   
    public function select_by_nic_branch( $nic_no, $branch ) {
    
      $this->db->select('*');
      $this->db->from($branch);
      $this->db->where('nic_no', $nic_no);
      
      $query = $this->db->get();
      $result = $query->result();

      return $result;
   }

   public function select_by_id( $id, $branch ) {
         
      // select by selected personal file div
      $this->db->select('*');
      $this->db->select('post.name_si as post_name');
      $this->db->select('sub_unit.name_si as sub_unit_name');
      $this->db->from($branch);
      $this->db->join('post', 'post.id = '.$branch.'.post');
      $this->db->join('sub_unit', 'sub_unit.id = '.$branch.'.sub_unit');
      $this->db->where($branch.'.id', $id);
      
      $query = $this->db->get();
      $result = $query->result();

      return $result;
    }

   public function get_increment_date( $id ) {
      
      $personal_file_div = substr($id, 0, 1);
      $branch = "personal_file_e0".$personal_file_div;

      $this->db->select( 'increment_date' );
      $this->db->from($branch);
      $this->db->where('id', $id);

      $query = $this->db->get();
      $result = $query->result();

      return $result;
   }

   public function update_status( $personal_file, $branch_name, $status ) {

      $this->db->set( 'status', $status );
      $this->db->set( 'last_updated_date', date('Y-m-d H:i:s') );
      $this->db->where('id', $personal_file);
      $this->db->update($branch_name);
      if($this->db->affected_rows() > 0)
      {
          return true;
      } else {
          return false;
      }         

   }


 }
   
?> 
