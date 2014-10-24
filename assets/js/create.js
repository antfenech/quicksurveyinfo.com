$(function(){

  //////////////////////////////////////////////////////////////////////////////////////////
  //add a question panel at the end of question accordion
  ///////////////////////////////////////////////////////
  function add_question(){

    //get number of questions
    var qNum = $('#accordion').find('.question').length;

    var question = 
        '<div class="panel panel-primary question" id="question_'+qNum+'" data-qnum="'+qNum+'">'
      +   '<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_quesiton_'+qNum+'">'
      +     '<div class="clearfix">'
      +       '<h4 class="panel-title col-xs-11">'
      +         '<a href="#collapse_quesiton_'+qNum+'">Question '+(qNum+1)+'</a>'
      +       '</h4>'
      +       '<i class="fa text-right fa-lg col-xs-1"></i>'
      +     '</div>'
      +   '</div>'
      +   '<div id="collapse_quesiton_'+qNum+'" class="panel-collapse collapse">'
      +     '<input type="hidden" id="select_'+qNum+'" name="select['+qNum+']" value="1">'
      +     '<div class="panel-body">'
      +       '<div class="form-group">'
      +         '<div class="remove_question col-xs-offset-7 col-xs-5 col-sm-offset-10 col-sm-2"></div>'
      +       '</div>'
      +       '<div class="form-group">'
      +         '<label class="col-sm-2" for="instructions_'+qNum+'">Instructions:</label>'
      +         '<h6 class="col-sm-8 col-md-9">Optional information or instructions for this question.</h6>'
      +       '</div>'
      +       '<div class="form-group">'
      +         '<div class="col-sm-offset-2 col-sm-10">'
      +           '<textarea class="form-control" id="instructions_'+qNum+'" name="instructions['+qNum+']" placeholder="optional" data-max="1000" data-min="0"></textarea>'
      +         '</div>'
      +         '<h6 class="col-xs-12 text-right">(<span class="count">0</span>/1000)</h6>'
      +       '</div>'
      +       '<div class="form-group">'
      +         '<label class="col-sm-2" for="ask_'+qNum+'">Question:</label>'
      +         '<div class="col-sm-10">'
      +           '<textarea name="question['+qNum+']" id="ask_'+qNum+'" class="form-control" placeholder="Required" data-max="300" data-min="1"></textarea>'
      +         '</div>'
      +         '<h6 class="col-xs-12 text-right">(<span class="count">0</span>/300)</h6>'
      +       '</div>'
      +       '<div class="form-group">'
      +         '<label class="col-xs-12 col-sm-2">Type:</label>'
      +         '<div class="col-xs-12 col-sm-10">'
      +           '<div class="btn-group btn-group-justified type_group">'
      +             '<div class="btn-group type select" data-type="1">'
      +               '<button type="button" class="btn btn-primary active">User Response</button>'
      +             '</div>'
      +             '<div class="btn-group type" data-type="2">'
      +               '<button type="button" class="btn btn-primary">Custom Responses</button>'
      +             '</div>'
      +             '<div class="btn-group type" data-type="3">'
      +               '<button type="button" class="btn btn-primary">Predefined Responses</button>'
      +             '</div>'
      +           '</div>'
      +         '</div>'
      +       '</div>'
      +       '<div id="response_area_'+qNum+'"></div>'
      +     '</div>'
      +   '</div>'
      + '</div>';
    //add question panel before optional exit message
    $('#exit_pannel').before(question);
    return qNum;
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //create choice buttons for custom responses, single choice and multiple choice
  ///////////////////////////////////////////////////////////////////////////////
  function create_choice(qNum){

    //select response are of selected question
    var rArea = $('#response_area_'+qNum);
    rArea.html(
        '<div class="form-group">'
      +   '<label class="col-sm-2">Custom Type:</label>'
      +   '<div class="col-sm-10">'
      +     '<div class="btn-group btn-group-justified choice_group">'
      +       '<div class="btn-group select" data-type="3">'
      +         '<button type="button" class="btn btn-primary active">Single Choice</button>'
      +       '</div>'
      +       '<div class="btn-group select" data-type="4">'
      +         '<button type="button" class="btn btn-primary">Multiple Choice</button>'
      +       '</div>'
      +     '</div>'
      +   '</div>'
      + '</div>'
      +   '<div id="answer_area_'+qNum+'"></div>'
      +   '<button class="btn btn-success add_answer">Add Answer</button>'
    );
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //create form select for predefined answers
  ///////////////////////////////////////////
  function create_selector(qNum){

    //select response are of selected question
    var rArea = $('#response_area_'+qNum);
    rArea.html(
        '<div class="form-group">'
      +   '<label class="col-sm-2 for="predefined_'+qNum+'">Options:</label>'
      +   '<div class="col-sm-4">'
      +     '<select class="form-control" id="predefined_'+qNum+'">'
      +       '<option value="6">True or False</option>'
      +       '<option value="7">Yes or No</option>'
      +       '<option value="8">Agree or Disagree</option>'
      +       '<option value="9">Range: from 1 to 5</option>'
      +       '<option value="10">Range: Likely through Unlikely</option>'
      +       '<option value="11">Range: Agree through Disagree</option>'
      +     '</select>'
      +   '</div>'
      + '</div>'
    );
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //add another answer to custom response question at qNum
  ////////////////////////////////////////////////////////
  function add_answer(qNum){ 

    //select response area
    var answer_area = $('#answer_area_' + qNum );

    //get number of answers for that question
    var rNum = answer_area.find('input').length;
    var answer = 
        '<div class="form-group answer" data-rnum="'+rNum+'">'
      +   '<label class="col-sm-2" for="select_'+qNum+'">Answer '+(rNum+1)+'</label>'
      +   '<div class="col-sm-10">'
      +     '<div class="input-group">'
      +       '<input type="text" id="answer_'+qNum+'_'+rNum+'" name="answer['+qNum+']['+rNum+']" class="form-control given_answer" data-max="300" data-min="1">'
      +       '<span class="input-group-btn">'
      +         '<button class="btn btn-default remove_answer" type="button"><i class="fa fa-times"></i></span></button>'
      +       '</span>'
      +     '</div>'
      +   '</div>'
      +     '<h6 class="col-xs-12 text-right">(<span class="count">0</span>/300)</h6>'
      + '</div>';

    //add answer to the end of the answer area
    $(answer_area).append(answer);
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //swap value with next questions value
  //////////////////////////////////////
  function swap_next_value(qNum, varID) {
    //select value at question id
    var value = $('#'+varID+'_'+Number(qNum+1)).val();
    $('#'+varID+'_'+qNum).val(value);
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //change input green if successful, red if it has error
  ///////////////////////////////////////////////////////
  function input_highlight(loc, valid){
    if (valid){
      loc.closest('.form-group').removeClass('has-error');
      loc.closest('.form-group').addClass('has-success');
    } else {
      loc.closest('.form-group').removeClass('has-success');
      loc.closest('.form-group').addClass('has-error');
    }
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //create response type
  //////////////////////
  function select_response(qNum, type){
    //get value of the questions select
    var select = Number($('#select_'+qNum).val());

    if ( type === 1 ) {
     //if open ended delete options
      $('#response_area_'+qNum).html('');

    } else if (type === 2){ //if custom response 

      //check if it wasn't already a custom response
      if( select !== 3 && select !== 4 ){

        //change identifyer and create custom answer area
        $('#select_'+qNum).val(3);
        create_choice(qNum)
        add_answer(qNum);
        add_answer(qNum);
      }

    } else if ( type === 3 ) { //if predefined response

      //check if it wasn't already a predefined response
      if( select < 6 || select > 11 ){

        //change identifyer and create predefined selector
        $('#select_'+qNum).val(6);
        create_selector(qNum)

      }//END RANGE
    }//END ELSE
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //remove last answer from question number.
  //////////////////////////////////////////
  function remove_last_answer(qNum, rNum){

    //find last answer of the question
    var total_answers = $('#answer_area_'+qNum).find('.answer').length;

    //go though questions starting at targeted question and swap answer with next answer
    for (var i = rNum; i < total_answers; i++) {

      //select value of next answer
      var next_value = $('#answer_'+qNum+'_'+Number(1+i)).val();

      //replace answer with next answer
      $('#answer_'+qNum+'_'+i).val(next_value);

    };

    //remove last question
    $('#answer_area_'+qNum).find('.answer').last().remove();
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //remove last question
  //////////////////////
  function remove_last_question(qNum){

    //for each question starting at qNum
    for (var i = qNum; i < $('.question').length -1; i++) {

      //swap instructions and question
      swap_next_value(i, 'instructions');
      swap_next_value(i, 'ask');

      //get select identifier value
      var select = Number($('#select_'+(i+1)).val());

      //trigger click event of corresponding type button 
      if (select === 1 ){ //user response

        $('#question_'+i).find('.type_group').children('.type:nth-child(1)').click();
      
      } else if (select === 3 || select === 4 ){//custom response
      
        $('#question_'+i).find('.type_group').children('.type:nth-child(2)').click();

        //if select is multiple choice trigger click
        if (select === 4 ){
          $('#question_'+i).find('.choice_group').children('.select:nth-child(2)').click();
        }

        //find number of answers in next question
        var responses = $('#response_area_'+Number(i+1)).find('input').length;

        //for each answer
        for (var j = 0; j < responses; j++) {

          //if answer is greater than 2 add another answer
          if (j >= 2){ add_answer(i); }

          //replace answer with next questions answer
          var value = $('#answer_'+Number(i+1)+'_'+j).val();
          $('#answer_'+i+'_'+j).val(value);
        };

      } else if( select >= 6 && select <= 11 ) { // predefiend answer

        //trigger click of predefiend answer
        $('#question_'+i).find('.type_group').children('.type:nth-child(3)').click();

        //swap value of predefiened selector
        $('#predefined_'+i).val( $('#predefined_'+(i+1)).val() );

        //trigger change event handler
        $('#predefined_'+i).trigger('change');
      }
    };

    //remove last question
    $('.question').last().remove();
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //check character length in input
  /////////////////////////////////
  function check_input(loc){

    var min = loc.data('min'); // get min character length
    var max = loc.data('max'); // get max character length
    var output = loc.closest('.form-group').find('.count'); //select output counter
    var count = loc.val().length // get number of characters

    //check for backspaces and shift
    if (event.keyCode !== 8 || event.keyCode !== 16 ){ 

      //check for non letter character
      if (event.which < 0x20){

        //prevent default if character is at limit or take out extending character
        if (count == max){
          event.preventDefault();
        } else if (count > max ) {
          loc.val(loc.val().substring(0, max));
        }
      } else { // letter character

        //if paste event 
        if (event.type == "paste"){

          //delay function 1/1000 sec check character limit as done before
          if (setTimeout(function() { 
            if (loc.val().length == max) {
              return 'prevent';
            } else if (loc.val().length > max ) {
              loc.val(loc.val().substring(0, max));
            }
          }, 1) == 'prevent') {
            event.preventDefault();
          }
        } else { // not a paste event
          //check for arrow characters
          if (count == max && !(event.keyCode >= 37 && event.keyCode <= 40)) {
            event.preventDefault();
          } else if (count > max ) {
            $(loc).val(loc.val().substring(0, max));
          }
        }
      }
    }
    //OUTPUT RESULT
    output.text(count);

    //return if input is between min and max
    return ( count >= min && count <= max ? true : false );
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //check if question is complete
  ///////////////////////////////
  function valid_question(qNum){

    //set error flag, get question type, check inputs for instructions and question
    var error = true;
    var select = Number( $('#select_'+qNum).val());
    var instructions = check_input($('#instructions_'+qNum));
    var question = check_input($('#ask_'+qNum));

    //highlight instructions and question
    input_highlight($('#instructions_'+qNum), instructions);
    input_highlight($('#ask_'+qNum), question);

    //if inputs are not valid change error flag
    if ( !instructions || !question ){
      error = false;
    }

    // if question type is custom response
    if (select === 3 || select === 4) {

      //get number or answers
      var number_of_responses = $('#response_area_'+ qNum).find('input').length;

      for (var i = 0; i < number_of_responses; i++) {

        //check answer length and highlight input
        var answer = check_input($('#answer_'+qNum+'_'+i));
        input_highlight($('#answer_'+qNum+'_'+i), answer);

        //if answers are not valid change error flag
        if ( !answer ) {
          error = false;
        }
      };      

      //if question is predefined answers
    } else if ( select >= 6 && select <= 11 ) {

      //get predefiend answer
      var predefined = Number($('#predefined_'+qNum).val());

      //validate answer is within an acceptable range
      if( predefined < '6' || predefined > '11' ){
        error = false;
      }
    }

    //return error flag
    return error;
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //add check mark for complete question, add question mark for incomplete question
  /////////////////////////////////////////////////////////////////////////////////
  function panel_highlight(loc, valid){
    var panel = loc.closest('.panel');
    if (valid) {
      panel.addClass('panel-success');
      panel.find('i').addClass('fa-check');
      panel.find('i').removeClass('fa-exclamation');
      panel.removeClass('panel-primary');     
      panel.removeClass('panel-danger');      
    } else {
      panel.addClass('panel-danger');
      panel.find('i').addClass('fa-exclamation');
      panel.find('i').removeClass('fa-check');
      panel.removeClass('panel-primary');
      panel.removeClass('panel-success');     
    }
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //CONFIRM ALL REQUIRED FIELDS ARE CHECKED
  /////////////////////////////////////////
  function check_survey(){

    //get number of questions, error flag (valid), and common inputs
    var total_questions = $('#accordion').find('.question').length;
    var valid = true;
    var info = ['title', 'description', 'exit'];

    //for each input check character length and highlight panel
    for (var i = 0; i < info.length; i++) {
      var check = check_input( $('#'+info[i]) );
      input_highlight( $('#'+info[i]), check );
      panel_highlight( $('#collapse_'+info[i]), check);

      //throw flag if invalid
      if (!check) {
        valid = false;
      }
    };

    //for each question check input and highlight panel and inputs
    for (var i = 0; i < total_questions; i++) {
      var complete = valid_question(i);
      panel_highlight($('#question_'+i), complete );

      //throw flag if invalid
      if (!complete){
        valid = false;
      }
    };

    //return error flag
    return valid;
  }

  /////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////// EVENT HANDLERS ///////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////

  /////////////////////////////////////////////////////////////////////////////////////////
  //adjust button groups from justifed to layering on top of each other
  /////////////////////////////////////////////////////////////////////  
  $(window).resize(function() {
   if ($(window).width() < 751) {
    $('.btn-group-justified').addClass('btn-group-vertical col-xs-12');
    $('.btn-group-justified').removeClass('btn-group-justified');
   } else {
    $('.btn-group-vertical').addClass('btn-group-justified');
    $('.btn-group-vertical').removeClass('btn-group-vertical col-xs-12');
   }
 });

  /////////////////////////////////////////////////////////////////////////////////////////
  //prevent return/enter key from submitting survey
  /////////////////////////////////////////////////
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //question change question type on click event
  //////////////////////////////////////////////
  $(document).on('click', '.select', function(){
    var qNum = $(this).closest('.question').data('qnum')
    var id = $(this).data('type');
    $('#select_'+qNum).val(id);
    $(this).siblings().children().removeClass('active');
    $(this).children('button').addClass('active');
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //predefined response indentifier update on select change event
  ///////////////////////////////////////////////////////////////
  $(document).on('change', 'select', function(){
    var qNum = $(this).closest('.question').data('qnum')    
    $('#select_'+qNum).val($(this).val());
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //response change on question type click event
  /////////////////////////////////////////////
  $(document).on('click', '.type', function(){
    var qNum = $(this).closest('.question').data('qnum')
    var type = $(this).data('type');

    $(this).siblings().children().removeClass('active');
    $(this).children('button').addClass('active');
    
    select_response(qNum, type)
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //add answer to question on add answer button click event
  /////////////////////////////////////////////////////////
  $(document).on('click', '.add_answer', function(event){
    event.preventDefault();
    var qNum = $(this).closest('.question').data('qnum');
    add_answer(qNum);
  })

  /////////////////////////////////////////////////////////////////////////////////////////
  //remove answer on delete answer button click event
  ///////////////////////////////////////////////////
  $(document).on('click', '.remove_answer', function(){
    var qNum = $(this).closest('.question').data('qnum');
    var rNum = $(this).closest('.answer').data('rnum');
    if ( $('#answer_area_'+qNum).find('.answer').length > 2 ) {
      remove_last_answer(qNum, rNum);
    }
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //switch button state of toggle
  ///////////////////////////////
  $('.public').on('click', function(){
    $('.public').parent('label').removeClass('active');
    $(this).parent('label').addClass('active');
  })

  /////////////////////////////////////////////////////////////////////////////////////////
  //add question on add question button click event
  /////////////////////////////////////////////////
  $(document).on('click', '.add_question', function(event){
    event.preventDefault();

    //get number of questions & set error flag
    var questions = $('#accordion').find('.question').length;
    var valid = true;

    //check if questions are valid highlight panels and input accordlingly
    for (var i = 0; i < questions; i++) {
      var result = valid_question($('#question_'+i).data('qnum'));
      panel_highlight($('#question_'+i), result );

      //throw error flag if there is an invalid input
      if (!result){
        valid = false;
      }
    };

    //if questions are valid and there is more than one add the delete question button
    if (valid){
      if ( add_question() >= 1 ) {
        $('.remove_question').html(
          '<a class="btn btn-danger btn-xs col-xs-12" href="#">'
        +   '<i class="fa fa-trash-o fa-lg"></i> Delete'
        + '</a>'
        );
      }
    }
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //input counter update on key up, down and paste events
  ///////////////////////////////////////////////////////
  $(document).on('keyup keydown paste', 'textarea, .given_answer, #title', function(event){
    input_highlight($(this), check_input($(this)));   
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //show modal alert on remove question button click event
  ////////////////////////////////////////////////////////
  $(document).on('click', '.remove_question', function(){

    //get question number
    var qNum = $(this).closest('.question').data('qnum');

    //create modal
    $('#container').append("<div class='modal fade' id='modal'>"
                          +  "<div class='modal-dialog'>"
                          +    "<div class='modal-content'>"
                          +      "<div class='modal-header'>"
                          +        "<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"
                          +        "<h4 class='modal-title'>Are you sure?</h4>"
                          +      "</div>"
                          +      "<div class='modal-body'>"
                          +        "<p>Are you sure you want to delete Question "+ (qNum+1) +"?</p>"
                          +      "</div>"
                          +      "<div class='modal-footer'>"
                          +        "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>"
                          +        "<button type='button' id='confirm' data-qnum='"+qNum+"' class='btn btn-danger'>Delete Question</button>"
                          +      "</div>"
                          +    "</div>"
                          +  "</div>"
                          +"</div>");

    //display modal  
    $('#modal').modal('show');
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //remove last question on delete question confirmation
  //////////////////////////////////////////////////////
  $(document).on('click', '#confirm', function(){ 
    var qNum = $(this).data('qnum');
    $('#modal').modal('toggle');
    remove_last_question(qNum);
    if ( $('#accordion').find('.question').length <= 1 ) {
      $('.remove_question').html('');
    }
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //listen for modal to disappear and remove from html
  ////////////////////////////////////////////////////
  $(document).on('hidden.bs.modal', '#modal', function() {
    $('#modal').remove();
  });

  /////////////////////////////////////////////////////////////////////////////////////////
  //check survey before submiting
  ///////////////////////////////
  $('form').on('submit', function(event){   
    if (!check_survey()){
      event.preventDefault();
    }
  })

});