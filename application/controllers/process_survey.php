<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process_survey extends CI_Controller {

  #create survey
  public function create_survey() {

    #check if user is logged in redirect if not
    if (!$this->session->userdata('user')){
      redirect(base_url());
    }   

    #check if survey inputs are valid
    $this->load->library("form_validation");
    $this->form_validation->set_rules("title",          "Survey Title",       "trim|required|prep_for_form|max_length[120]");
    $this->form_validation->set_rules("description",    "Survey Description", "trim|prep_for_form|max_length[1500]");
    $this->form_validation->set_rules("exit_message",   "Exit Message",       "trim|prep_for_form|max_length[1500]");
    $this->form_validation->set_rules("public",         "Public Setting",     "trim|required|prep_for_form|alpha|max_length[5]");

    #for each question
    for ($i=0; $i < count($this->input->post('question')); $i++) { 
      
      #validate question instructions if exist
      if ( isset($this->input->post('instructions')[$i]) ){
        $this->form_validation->set_rules("instructions[".$i."]", "Instructions for question ".($i+1), "trim|prep_for_form|max_length[1500]");
      }
        
      #validate question and type
      $this->form_validation->set_rules("question[".$i."]", "Survey Question ".($i+1),    "trim|required|prep_for_form|max_length[1500]");
      $this->form_validation->set_rules("select[".$i."]",   "Type for question ".($i+1),  "trim|required|prep_for_form|is_natural_no_zero|greater_than[0]|less_than[12]");
      
      $type = $this->input->post('select')[$i];

      #check if question type has a custom answer
      if ($type === 3 || $type === 4 ) {

        #validate custom answer
        for ($j=0; $j < count($this->input->post('answer')[$i]); $j++) { 
          $this->form_validation->set_rules("answer[".$i."][".$j."]", "Answer ".$j." of question ".($i+1), "trim|required|prep_for_form|max_length[300]");
        }

      }
    }
    
    #if any inputs are invalid set errors and redirect user
    if($this->form_validation->run() === FALSE) {

      $this->session->set_flashdata('errors', validation_errors());
      redirect($_SERVER['HTTP_REFERER']);
      die();

    } else {  #if inputs are valid create survey
      $this->load->model("survey_model");

      #create_survey($id, $title, $description, $exit_message, $public, $results)
      $this->survey_model->create_survey(
        $this->session->userdata['user']['id'], 
        $this->input->post('title'), 
        $this->input->post('description') == ''  ? '' :$this->input->post('description'),
        $this->input->post('exit_message') == '' ? '' :$this->input->post('exit_message'), 
        $this->input->post('public') == 'true' ? TRUE : FALSE,
        $this->input->post('results') == 'true' ? TRUE : FALSE        
      );

      #get survey id
      $survey_id = $this->db->insert_id();

      #for each question
      for ($i=0; $i < count($this->input->post('question')); $i++) { 
        if ($this->input->post('select')[$i] == 2){
          $question_type = $this->input->post('boolean')[$i];
        } elseif ($this->input->post('select')[$i] == 5) {
          $question_type = $this->input->post('range')[$i];
        } else {
          $question_type = $this->input->post('select')[$i];
        }
        
        #create_question($survey_id, $type, $instructions, $question, $position)
        $this->survey_model->create_question(
          $survey_id, 
          $question_type, 
          $this->input->post('instructions')[$i] == ''? '' : $this->input->post('instructions')[$i],
          $this->input->post('question')[$i],
          ($i+1)
        );

        #if question has a custom answer
        if ( $question_type === '3' || $question_type === '4' ) {

          #get question id
          $question_id = $this->db->insert_id();

          for ($j=0; $j < count($this->input->post('answer')[$i]); $j++) { 
        
            #create_answer($question_id, $answer, $position)
            $this->survey_model->create_answer(
              $question_id,
              $this->input->post('answer')[$i][$j],
              ($j+1)
            );
          }
        }
      }

      #inform user how to make it live and redirect to their dash
      $this->session->set_flashdata('steps', 'Almost Done, Click the offline button to make the survey avaliable.');
      redirect(base_url('/main/dash'));
      die();
    }
  }

  #after survey is submited, variable is survey id
  public function submit_survey($id) {

    $this->load->model("survey_model");
    $this->load->library("form_validation");

    #array for errors, responses, and given question id
    $errors = array();
    $response = $this->input->post('response');
    $question_id = $this->input->post('question_id');

    #array of question id and type
    $survey_question = $this->survey_model->read_all_questions($id);

    #set flag for db to form validation
    $valid = TRUE;

    for ($i=0; $i < count($survey_question); $i++){

      #for each question check if question from survey matches question in database 
      #and that there is a response
      if (($question_id[$i] !== $survey_question[$i]['id']) || isset($response[$i]) === FALSE || $response[$i] === NULL || $response[$i] === '') {

        $errors[$i] = "A response is required.";
        $valid = FALSE;

      } else { #question is valid
        
        #question type
        $type = intval($survey_question[$i]['question_type_id']);

        #validate responses of each question
        if ($type === 1) { #open ended

          $this->form_validation->set_rules("response[".$i."]", "Question ".($i+1), "trim|prep_for_form|max_length[1500]");

        } else if ($type === 3 || ($type >= 6 && $type <= 11 )) { #single resposne

          $this->form_validation->set_rules("response[".$i."]", "Question ".($i+1), "trim|required|prep_for_form|is_natural_no_zero|greater_than[0]");
          $this->form_validation->set_message("required", "Question ".($i+1)." is required.");

        } else if ($type === 4){ #multiple responses

          #count number of responses set flag to make sure there is a response
          $num_of_answers[$i] = $this->survey_model->read_answer_count($survey_question[$i]['id'], $type);
          $has_response = FALSE;

          for ($j = 0; $j<$num_of_answers[$i]; $j++){
            if(isset($response[$i][$j])){
              $has_response = TRUE; 
              $this->form_validation->set_rules("response[".$i."][".$j."]", "Question ".($i+1), "trim|required|prep_for_form|is_natural_no_zero|greater_than[0]");
              $this->form_validation->set_message("required", "Question ".($i+1)." is required.");
            }
          }

          #if there were no responses set valid to false inform user
          if ($has_response == FALSE){
            $errors[$i] = "Question ".($i+1)." is required.";
            $valid = FALSE;
          }
        }
      }
    }

    #if responses are invalid inform user & redirect
    if ($valid === FALSE || $this->form_validation->run() === FALSE) {
    
      $this->session->set_flashdata('errors', $errors);
      redirect($_SERVER['HTTP_REFERER']);
      die();
    
    } else { #responses are valid

      #create unique id for user and get id
      $this->survey_model->create_instance(md5(microtime().rand()));
      $user = $this->db->insert_id();

      #for each question get type and insert into database
      for ($i=0; $i < count($survey_question); $i++) { 
        
        $type = intval($survey_question[$i]['question_type_id']);

        if ($type == 1) { #open ended

          #create_response_text($instance_id, $question_id, $text)
          $this->survey_model->create_response_text(
            intval($user), 
            intval($survey_question[$i]['id']), 
            $response[$i]
          );

        } else if ( $type == 3 ) {

          #create_response_id($user_id, $question_id, $answer_id)
          $this->survey_model->create_response_id(
            intval($user), 
            intval($survey_question[$i]['id']), 
            intval($response[$i])
          );

        } else if ($type == 4) { #multiple choice

          for ($j=0; $j < $num_of_answers[$i]; $j++) { 

            #check if response has answer
            if( isset($response[$i][$j]) ) {

              #create_response_id($instance_id, $question_id, $answer_id)
              $this->survey_model->create_response_id(
                intval($user), 
                intval($survey_question[$i]['id']), 
                intval($response[$i][$j])
              );
            }
          }

        } else if ( $type >= 6 && $type <= 11 ) {
         
          #create_scale_response($instance_id, $question_id, $scale_id)
          $this->survey_model->create_scale_response (
            intval($user),
            intval($survey_question[$i]['id']), 
            intval($response[$i])
          );
        }
      }
    
      #increase survey response counter redirect to exit message
      $this->survey_model->inc_counter($id);
      redirect(base_url('/survey/completion/'.$id));
    }
  }

  #ajax for question results page
  public function question_results($qID, $total){

    #verify call is a function of a ajax request
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

      $this->load->model("survey_model");
      #array of question, id, & type
      $question = $this->survey_model->read_question($qID);

      #get result type based on id, type, total
      $results = $this->survey_model->read_results($qID, intval($question['question_type_id']), $total);

      #if question isn't open eneded return table and graph data
      if (intval($question['question_type_id']) !== 1 ) {
        
        $data = (object) ['table' => $results, 'question'=> $question];
        echo json_encode($data);

      } else { # question is open ended

        #retrive spam words from text file build hash array
        $spam = file(base_url('/assets/txt/stop_words.txt'), FILE_IGNORE_NEW_LINES);
        $words = array();

        #for each user answer
        for ($i=0; $i < count($results); $i++) { 

          #split up the answer by words
          $new_text = explode(' ', $results[$i]['response_text']);
          for ($j=0; $j < count($new_text); $j++) { 
  
            //get rid of non letters
            $new_text[$j] = preg_replace("/[^a-zA-Z']/", '', $new_text[$j]);

            //look for word in spam list
            if (!in_array(strtolower($new_text[$j]), $spam) ){

              //if word is already in collection increment else add to array at 1
              $words[strtolower($new_text[$j])] = (array_key_exists(strtolower($new_text[$j]), $words)) 
                ? ++$words[strtolower($new_text[$j])] 
                : 1;
            }
          } // end j for loop
        } //end i for loop

        #return word list, and top words to user
        $data = (object) ['question'=> $question, 'text' => $results, 'words' => $words];
        echo json_encode($data);
      }
    }
  }

  #function for dashboard ajax calls
  public function dash($survey_id, $state){

    #verify call is a function of a ajax request
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

      #verify user is logged in
      if (!$this->session->userdata('user')){ return; }

      $user_id = $this->session->userdata('user')['id'];
      $this->load->model("survey_model");

      #switch the state or delete survey
      switch($state){
        case "activity" : $this->survey_model->switch_activity($survey_id, $user_id); break;
        case "publicity": $this->survey_model->switch_publicity($survey_id, $user_id); break;
        case "results"  : $this->survey_model->switch_result($survey_id, $user_id); break;  
        case "delete"   : $this->survey_model->destroy_survey($survey_id, $user_id); break;
      }
    }
  }

##################################################
//I did not make the external_callbacks function//
##################################################
/*
 * external_callbacks method handles form validation callbacks that are not located
 * in the controller where the form validation was run.
 *
 * $param is a comma delimited string where the first value is the name of the model
 * where the callback lives. The second value is the method name, and any additional 
 * values are sent to the method as a one dimensional array.
 *
 * EXAMPLE RULE:
 *  callback_external_callbacks[some_model,some_method,some_string,another_string]
 */
public function external_callbacks( $postdata, $param )
{
 $param_values = explode( ',', $param ); 

 // Make sure the model is loaded
 $model = $param_values[0];
 $this->load->model( $model );

 // Rename the second element in the array for easy usage
 $method = $param_values[1];

 // Check to see if there are any additional values to send as an array
 if( count( $param_values ) > 2 )
 {
  // Remove the first two elements in the param_values array
  array_shift( $param_values );
  array_shift( $param_values );

  $argument = $param_values;
 }

 // Do the actual validation in the external callback
 if( isset( $argument ) )
 {
  $callback_result = $this->$model->$method( $postdata, $argument );
 }
 else
 {
  $callback_result = $this->$model->$method( $postdata );
 }

 return $callback_result;
}

/*******************************************************************/ 

}