<?php 
class Session_model extends CI_Model {

  #CONTROLLER: PROCESS_USER
    #FUNCTION: LOGIN
      #ACTION: VERIFY EMAIL AND PASSWORD     
  function log_in($email, $password){

    $query = "SELECT users.password 
              FROM users 
              WHERE email = ?
              LIMIT 1";
    $values = array($email, $password);
    $info = $this->db->query($query, $values)->row_array();

    if( count($info) != 1 ){
      return false;
    }

    #CHECK GIVEN PASSWORD AGAINST ENCRYPTED PASSWORD
    if(password_verify($password, $info['password'])){

      $query2 = "SELECT users.id, users.name
                 FROM users
                 WHERE email = ?";
      $values2 = array($email);
      $user = $this->db->query($query2, $values2)->row_array();

      return $user;
    } else {
      return false;
    }
  }

  #CONTROLLER: PROCESS_USER
    #FUNCTION: REGISTER
      #ACTION: ADD USER TO USERS DATABASE     
  function create_user($name, $email, $password){
    $query = "INSERT INTO users (name, email, password) 
              VALUES (?, ?, ?)";
    $values = array($name, $email, $password);
    $this->db->query($query, $values);
  }
}
?>