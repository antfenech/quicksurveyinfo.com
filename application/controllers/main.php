<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

  public function index() {
    $this->load->model("survey_model");

    #get active public surveys id and title
    $data['surveys'] = $this->survey_model->read_public_surveys();

    #get public results id and title where at least 1 response
    $data['results'] = $this->survey_model->read_public_results();

    #required files and title for page
    $header['user']  = $this->session->userdata('user');
    $header['title'] = 'quicksurveyinfo.com';
    $header['js']    = array('jquery', 'bootstrap.min');
    $header['css']   = array('reset', 'bootstrap.min', 'index');

    #load views
    $this->load->view('header', $header);
    $this->load->view('main', $data);
    $this->load->view('footer');
  }

  public function dash() {

    #check if user is logged in
    if (!$this->session->userdata('user')){
      redirect(base_url());
    }

    #get users surveys id, titles
    #status of survey if it's live, private, and if results are private
    $this->load->model("survey_model");
    $data['surveys'] = $this->survey_model->read_user_surveys($this->session->userdata('user')['id']);

    #required files and title for page
    $header['user']  = $this->session->userdata('user');
    $header['title'] = 'Dashboard';
    $header['js']    = array('jquery', 'bootstrap.min', 'dash');
    $header['css']   = array('reset', 'bootstrap.min', 'index');

    #load views
    $this->load->view('header', $header);
    $this->load->view('dash', $data);
    $this->load->view('footer');
  }

  public function register() {
    #required files and title for page
    $header['user']  = $this->session->userdata('user');
    $header['title'] = 'Register';
    $header['js']    = array('jquery', 'bootstrap.min', 'input', 'register');
    $header['css']   = array('reset', 'bootstrap.min', 'index');

    #load views
    $this->load->view('header', $header);
    $this->load->view('register');
    $this->load->view('footer');
  }
}