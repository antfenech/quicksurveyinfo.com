<?php 
  class Survey_model extends CI_Model {

##########################
#SUBMIT_SURVEY FUNCTIONS #
##########################

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: SUBMIT_SURVEY
        #ACTION: INCREMENT SURVEY COUNTER IN SURVEY TABLE
    function inc_counter($survey_id){
      $query = "UPDATE surveys SET counter=counter+1 WHERE id= ?";
      $this->db->query($query, array($survey_id));
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: SUBMIT_SURVEY
        #ACTION: CREATE USER RESPONSE FOR A QUESTION ANSWER 
    function create_response_id($instance_id, $question_id, $answer_id){
      $query = "INSERT INTO responses (instance_id, question_id, answer_id)
                VALUES (?,?,?)";
      $values = array($instance_id, $question_id, $answer_id);
      $this->db->query($query, $values);
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: SUBMIT_SURVEY
        #ACTION: CREATE USER TEXT RESPONSE FOR A OPEN ENDED ANSWER 
    function create_response_text($instance_id, $question_id, $text){
      $query = "INSERT INTO response_text (instance_id, question_id, response_text)
                VALUES (?,?,?)";
      $values = array($instance_id, $question_id, $text);
      $this->db->query($query, $values);      
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: SUBMIT_SURVEY
        #ACTION: CREATE USER RESPONSE FOR A SCALE ANSWER 
    function create_scale_response($instance_id, $question_id, $scale_id) {
      $query = "INSERT INTO answers_predefined (instance_id, question_id, scale_id)
                VALUES (?,?,?)";
      $values = array($instance_id, $question_id, $scale_id);
      $this->db->query($query, $values);
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: SUBMIT_SURVEY
        #ACTION: COUNT NUM OF ANSWERS IN A QUESTION
    function read_answer_count($question_id, $type){
  
      if ( $type == 3 || $type <= 4 ){

        $query2 = "SELECT COUNT(answer) as 'count'
                  FROM answers_user_defined
                  WHERE question_id = ?
                  LIMIT 1";

      } else if ( $type >= 6 && $type <= 11 ) {

        $query2 = "SELECT COUNT(answer) as 'count'
                  FROM answers_predefined
                  WHERE question_id = ?
                  LIMIT 1";
      }

      $count = $this->db->query($query2, array($question_id))->row_array();
      return intval($count['count']);
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: SUBMIT_SURVEY
        #ACTION: ADD SURVEY TAKER UNIQUE ID TO INSTANCES     
    function create_instance($key){
      $query = "INSERT INTO instance (unique_instance)
                VALUES (?)";
      return $this->db->query($query, array($key));
    }

    #CONTROLLER: SURVEY / PROCESS_SURVEY
      #FUNCTION: ID, RESULTS / SUBMIT_SURVEY
        #ACTION: GET QUESTION ID, INSTRUCTIONS, QUESTION, TYPE
    function read_all_questions($survey_id){
      $query = "SELECT id, instructions, question, question_type_id
                FROM questions
                WHERE survey_id = ?
                ORDER BY position";
      return $this->db->query($query, array($survey_id))->result_array();
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: CREATE_SURVEY
        #ACTION: CREATES A SURVEY 
    function create_survey($user_id, $title, $description, $exit_message, $public, $results){
      $query = "INSERT INTO surveys (user_id, title, description, exit_message, public, results)
                VALUES (?,?,?,?,?,?)";
      $values = array($user_id, $title, $description, $exit_message, $public, $results);

      $this->db->query($query, $values);
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: CREATE_SURVEY
        #ACTION: CREATE QUESTION FOR SURVEY
    function create_question($survey_id, $type, $instructions, $question, $position){
      $query = "INSERT INTO questions (survey_id, question_type_id, instructions, question, position)
                VALUES (?,?,?,?,?)";
      $values = array($survey_id, $type, $instructions, $question, $position);
      $this->db->query($query, $values);
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: CREATE_SURVEY
        #ACTION: CREATE ANSWER FOR QUESTION
    function create_answer($question_id, $answer, $position ){
      $query = "INSERT INTO answers_user_defined (question_id, answer, position)
                VALUES (?,?,?)";
      $values = array($question_id, $answer, $position);
      $this->db->query($query, $values);
    }
    
    #CONTROLLER: MAIN
      #FUNCTION: INDEX
        #ACTION: GET ID & TITLE OF ACTIVE PUBLIC SURVEYS 
    function read_public_surveys(){
      $query = "SELECT id, title
                FROM surveys
                WHERE public = 1
                AND active = 1
                ORDER BY created_at";
      return $this->db->query($query)->result_array();
    }

    #CONTROLLER: MAIN
      #FUNCTION: INDEX
        #ACTION: GET ID & TITLE OF SURVEY RESULTS THAT ARE PUBLIC AND HAVE A RESPONSE     
    function read_public_results(){
      $query = "SELECT id, title
                FROM surveys
                WHERE results = 1
                AND counter > 0
                ORDER BY counter";
      return $this->db->query($query)->result_array();
    }

    #CONTROLLER: SURVEY
      #FUNCTION: ID
        #ACTION: GET CREATOR ID, TITLE, DESCRIPTION, & STATUS OF ACTIVITY
    function read_survey($survey_id){
      $query = "SELECT user_id, title, description, active
                FROM surveys 
                WHERE id = ?";
      return $this->db->query($query, array($survey_id))->row_array();
    }

    #CONTROLLER: SURVEY
      #FUNCTION: ID
        #ACTION: GET ANSWERS & ID
    function read_answers($question_id, $type){
      if ( $type >= 1 && $type <= 4 ){

        $query = "SELECT id, answer
                  FROM answers_user_defined 
                  WHERE question_id = ?";
        return $this->db->query($query, array($question_id))->result_array();

      } else if ( $type >= 6 && $type <= 11 ) {

        $query = "SELECT id, answer
                  FROM scale
                  WHERE question_type_id = ?
                  ORDER BY position";
        return $this->db->query($query, array($type))->result_array();
      }     
    }

    #CONTROLLER: SURVEY
      #FUNCTION: COMPLETION
        #ACTION: GET SURVEY TITLE, EXIT MESSAGE, STATUS OF RESULTS     
    function read_exit_info($survey_id){
      $query = "SELECT title, exit_message, results
                FROM surveys
                WHERE id = ?
                LIMIT 1";
      return $this->db->query($query, array($survey_id))->row_array();
    }

##########################
#  FUNCTIONS FOR RESULTS #
##########################

    #CONTROLLER: SURVEY
      #FUNCTION: RESULTS
        #ACTION: GET CREATOR ID, TITLE, COUNTER, AND STATUS OF RESULTS AND ACTIVITY     
    function read_result_info($survey_id){
      $query = "SELECT user_id, title, counter, results, active
                FROM surveys
                WHERE id = ?
                LIMIT 1";
      return $this->db->query($query, array($survey_id))->row_array();      
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: QUESTION_RESULTS
        #ACTION: GET QUESTION, INSTRUCTIONS, AND TYPE
    function read_question($question_id){
      $query1 = "SELECT survey_id AS 'survey_id'
                FROM questions
                WHERE questions.id = ?
                LIMIT 1";
      $survey_id = $this->db->query($query1,array($question_id))->row_array();


      $query2 = "SELECT questions.question, questions.instructions, questions.question_type_id
                FROM questions
                WHERE questions.id = ?
                AND questions.survey_id = ?";
      $values = array($question_id, $survey_id['survey_id']);
      return $this->db->query($query2, $values)->row_array();
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: QUESTION_RESULTS
        #ACTION: GET DATA FOR RESULTS TABLES AND GRAPHS
    function read_results($question_id, $type, $total){

      if ( $type == 1 ) {

        $query2 = "SELECT response_text 
                   FROM response_text
                   WHERE question_id = ?";

        return $this->db->query($query2, array($question_id))->result_array();

      } else if ( $type == 3 || $type == 4 ){
      
        //GET ANSWERS, COUNT, AND PERCANTAGE OF A QUESTION
        $query3 = "SELECT answer, 
                          COUNT(responses.answer_id) AS 'count',
                          (SELECT ROUND( (COUNT(responses.answer_id)/? * 100), 1))  AS 'percentage'
                  FROM answers_user_defined 
                  LEFT JOIN responses ON answers_user_defined.id = responses.answer_id
                  WHERE answers_user_defined.question_id = ?
                  GROUP BY answers_user_defined.answer";

        return $this->db->query($query3, array($total, $question_id))->result_array();

      } else if ( $type >= 6 && $type <= 11 ) {
      
        //GET QUESTION_TYPE_ID OF A QUESTION
        $query4 = "SELECT question_type_id AS 'type'
                   FROM scale 
                   LEFT JOIN answers_predefined on scale.id = answers_predefined.scale_id 
                   WHERE answers_predefined.question_id = ?
                   LIMIT 1";

        //GET ANSWERS, COUNT, AND PERCENTAGE OF A QUESTION
        $query5 = "SELECT scale.answer,
                          COUNT(answers_predefined.scale_id) AS 'count',
                          (SELECT ROUND( (COUNT(answers_predefined.scale_id)/ ? * 100), 1)) AS 'percentage'
                  FROM scale
                  LEFT JOIN answers_predefined on scale.id = answers_predefined.scale_id
                  AND answers_predefined.question_id = ?
                  WHERE question_type_id = ?
                  GROUP BY scale.answer ORDER BY position";

        $values = array($total, $question_id, $type);

        return $this->db->query($query5, $values)->result_array();
      }     
    }

    #CONTROLLER: MAIN
      #FUNCTION: DASH
        #ACTION: GET ID, TITLE, & STATUS OF PUBLIC, ACTIVE, & RESULTS 
    function read_user_surveys($user_id){
      $query = "SELECT id, title, public, active, results
                FROM surveys
                WHERE user_id = ?";
      return $this->db->query($query, array($user_id))->result_array();
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: DASH
        #ACTION: SWITCH SURVEY BETWEEN ACTIVE & INACTIVE
    function switch_activity($survey_id, $user_id){
      $query1 = "SELECT active
                 FROM surveys
                 WHERE id = ?
                 LIMIT 1";

      $online = $this->db->query($query1, array($survey_id))->row_array();
      $status = ($online['active'] === '1' ? 0 : 1);
    
      $query2 =  "UPDATE surveys
                  SET active = ?
                  WHERE id = ?
                  AND user_id = ?";
      $values = array($status, $survey_id, $user_id);
      $this->db->query($query2, $values); 
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: DASH
        #ACTION: SWITCH BETWEEN PUBLIC AND PRIVATE
    function switch_publicity($survey_id, $user_id){
      $query1 = "SELECT public
                 FROM surveys
                 WHERE id = ?
                 LIMIT 1";

      $public = $this->db->query($query1, array($survey_id))->row_array();
      $status = ($public['public'] === '1' ? 0 : 1);
    
      $query2 =  "UPDATE surveys
                  SET public = ?
                  WHERE id = ?
                  AND user_id = ?";
      $values = array($status, $survey_id, $user_id);
      $this->db->query($query2, $values); 
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: DASH
        #ACTION: SWITCH RESULTS BETWEEN PUBLIC AND PRIVATE
    function switch_result($survey_id, $user_id){
      $query1 = "SELECT results
                 FROM surveys
                 WHERE id = ?
                 LIMIT 1";
      $results = $this->db->query($query1, array($survey_id))->row_array();
      $status  = ($results['results'] === '1' ? 0 : 1);

      $query2 =  "UPDATE surveys
                  SET results = ?
                  WHERE id = ?
                  AND user_id = ?";
      $values = array($status, $survey_id, $user_id);
      $this->db->query($query2, $values);
    }

    #CONTROLLER: PROCESS_SURVEY
      #FUNCTION: DASH
        #ACTION: DELETE SURVEY
    function destroy_survey($survey_id, $user_id){
      $query = "DELETE FROM surveys
                WHERE user_id = ?
                AND id = ?";
      $values = array($user_id, $survey_id);
      $this->db->query($query, $values);
    }

  }
?>