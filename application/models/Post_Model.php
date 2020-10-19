<?php
   class Post_Model extends CI_Model {

      function __construct() {
         parent::__construct();
      }

 	  public function select_by_id( $id ) {
         
         $this->db->select('*');
         $this->db->from('post');
         $this->db->where('id', $id);
         
         $query = $this->db->get();
         $result = $query->result();

         if( is_array($result) && !empty($result) ) {

            $name_si = $result[0]->name_si;
            return $name_si;
        } else {
           return "";
        }  
      }   

      public function select_all_by_id( $id ) {
          
          $this->db->select('*');
          $this->db->from('post');
          $this->db->where('id', $id);
          
          $query = $this->db->get();
          $result = $query->result();
          
          return $result;
      }
      
   public function select_all()
   {      
      $query = $this->db->query("SELECT * FROM `post` ORDER BY `post`.`id` ASC");
      $result = $query->result();
      return $result;
   }

   public function select_all_asc_name()
   {      
      $query = $this->db->query("SELECT * FROM `post` ORDER BY `post`.`name_si` ASC");
      $result = $query->result();
      return $result;
   }
   
}
?> 
