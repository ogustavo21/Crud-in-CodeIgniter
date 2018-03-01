<?php
class User_model extends CI_model{




public function login_user($email,$pass){

  $this->db->select('*');
  $this->db->from('usuario');
  $this->db->where('email',$email);
  $this->db->where('contraseña',$pass);

  if($query=$this->db->get())
  {
      return $query->row_array();
  }
  else{
    return false;
  }


}


}


?>