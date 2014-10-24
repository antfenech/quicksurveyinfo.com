<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process_user extends CI_Controller {

  #register user
  public function register() {

    #validate registration form
    $this->load->library("form_validation");
    $this->form_validation->set_rules("name",     "Name",         "trim|required|alpha_dash|is_unique[users.name]");
    $this->form_validation->set_rules("email",    "email",        "trim|required|valid_email|is_unique[users.email]");
    $this->form_validation->set_rules("password", "password",     "trim|required|min_length[8]|callback_external_callbacks[regex_model,password_regex]");
    $this->form_validation->set_rules("confirm",  "confirmation", "trim|required|matches[password]");

    #if invalid set errors and redirect
    if($this->form_validation->run() === FALSE) {
      $this->form_validation->set_message('alpha_dash',         'Letters, numbers and underscore only');
      $this->form_validation->set_message('is_unique',          '%s is already in use');
      $this->form_validation->set_message('valid_email',        '%s is invalid');
      $this->form_validation->set_message('external_callbacks', 'Must be at least 8 characters and contain 1 number, letter, and special character !@#$%^&*');

      #set error message
      $this->session->set_flashdata('form_error_name',     form_error('name'));
      $this->session->set_flashdata('form_error_email',    form_error('email'));
      $this->session->set_flashdata('form_error_password', form_error('password'));
      $this->session->set_flashdata('form_error_confirm',  form_error('confirm'));

      #refil input values
      $this->session->set_flashdata('set_value_name',     set_value('name'));
      $this->session->set_flashdata('set_value_email',    set_value('email'));
      $this->session->set_flashdata('set_value_password', set_value('password'));
      $this->session->set_flashdata('set_value_confirm',  set_value('confirm'));

      redirect($_SERVER['HTTP_REFERER']);
      die();
    } else { #if form is valid

      #load session model
      $this->load->model("session_model");

      #register user with name, email, encrypted password
      $this->session_model->create_user(
        $this->input->post('name'), 
        $this->input->post('email'), 
        password_hash($this->input->post('password'), PASSWORD_BCRYPT )
      );

      #set user session id & name
      $user['id']   = $this->db->insert_id();
      $user['name'] = $this->input->post('name');
      $this->session->set_userdata('user', $user);
    
      #redirect user to their dashboard
      redirect(base_url('main/dash'));
      die();
    }
  }

  #log in user
  public function login() {

    #validate login forms
    $this->load->library("form_validation");
    $this->form_validation->set_rules("email",    "email",    "trim|required|valid_email");
    $this->form_validation->set_rules("password", "password", "trim|required");

    #if input is invalid inform user and redirect them
    if($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('login', validation_errors());
      redirect($_SERVER['HTTP_REFERER']);
      die();
    } else { #input is valid
      $user = array();

      #check if email and password return a user
      $this->load->model("session_model");
      $user = $this->session_model->log_in(
        $this->input->post('email'),
        $this->input->post('password')
      );

      if ($user) { #input combo match redirect to dash
        $this->session->set_userdata('user', $user);
        redirect(base_url('/main/dash'));
        die();
      } else { #input combo don't match redirect and inform user
        $this->session->set_flashdata('login', 'Email and password do not match a user.');
        redirect($_SERVER['HTTP_REFERER']);
        die();
      }
    }
  }

  #log out user
  public function logout(){

    $this->session->sess_destroy();
    redirect(base_url());
    die();
  }
}