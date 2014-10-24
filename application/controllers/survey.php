<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends CI_Controller {

  #page to take survey, variable is survey id
  public function id($id){
    $this->load->model("survey_model");

    #get survey title, description, & check if it's active
    $data['survey'] = $this->survey_model->read_survey($id);
    $data['survey_id'] = $id;

    #check for if survey is active if inactive redirect user
    if ($data['survey']['active'] == '0'){
      $this->session->set_flashdata('error', 'The survey is no longer active');
      redirect(base_url());
    }

    #get survey question types, question instructions, question & position
    $data['question'] = $this->survey_model->read_all_questions($id);

    #check for errors
    $data['error'] = $this->session->flashdata('errors');

    #filter down questions into types and responses
    for ( $i=0; $i < count($data['question']); $i++ ) { 
      $data['type'][$i] = intval($data['question'][$i]['question_type_id']);
      $data['answer'][$i] = $this->survey_model->read_answers($data['question'][$i]['id'], $data['type'][$i]);
    }

    #required files and title for page
    $header['user']  = $this->session->userdata('user');
    $header['title'] = 'Show Survey';
    $header['js']    = array('jquery', 'bootstrap.min', 'input', 'show');
    $header['css']   = array('reset', 'bootstrap.min', 'index');

    #load views
    $this->load->view('header', $header);
    $this->load->view('show', $data);
    $this->load->view('footer');    
  }

  # Page for users to create surveys 
  public function create() {

    #check if user is logged in
    if (!$this->session->userdata('user')){
      redirect(base_url());
    }

    #load assets and css & js files
    $header['user']  = $this->session->userdata('user');
    $header['title'] = 'Create Survey';
    $header['js']    = array('jquery', 'bootstrap.min', 'create');
    $header['css']   = array('reset', 'bootstrap.min', 'index');

    #load views
    $this->load->view('header', $header);
    $this->load->view('create');
    $this->load->view('footer');
  }

  #results of survey, variable is survey id
  public function results($id) {
    $this->load->model("survey_model");

    #get survey title, description, num of survey takers
    #check if it's active, and if results are public    
    $data['survey'] = $this->survey_model->read_result_info($id);
    $data['survey_id'] = $id;

    #check if user is creator
    if (isset($this->session->userdata('user')['id'])) {
      $data['creator'] = ($data['survey']['user_id'] === $this->session->userdata('user')['id']);
    } else {
      $data['creator'] = FALSE;
    }

    #check if results are private or if user is the creator
    $data['access'] = ($data['survey']['results'] === '1' || $data['creator'] === TRUE );

    #if access is true get question type, instructions, question, position
    if ($data['access']){
      $data['question'] = $this->survey_model->read_all_questions($id);
    }

    #load assets and css & js files
    $header['user']  = $this->session->userdata('user');
    $header['title'] = 'results';
    $header['js']    = array('jquery', 'googjsapi', 'bootstrap.min', 'jquery.jqplot', 'jqplot.barRenderer.min', 'jqplot.categoryAxisRenderer.min', 'jqplot.pointLabels.min','results');
    $header['css']   = array('reset', 'bootstrap.min', 'index');

    #load views
    $this->load->view('header', $header);
    $this->load->view('result', $data);   
    $this->load->view('footer');
  }

  #page used after user completes survey
  public function completion($id){
    $this->load->model("survey_model");

    #get id, title, exit_message, results status
    $data['survey'] = $this->survey_model->read_exit_info($id);
    $data['survey_id'] = $id;

    #load assets and css & js files
    $header['user']  = $this->session->userdata('user');
    $header['title'] = 'Thank You';
    $header['js']    = array('jquery', 'bootstrap.min');
    $header['css']   = array('reset', 'bootstrap.min', 'index');

    #load views
    $this->load->view('header', $header);
    $this->load->view('exit', $data);   
    $this->load->view('footer');
  }
}