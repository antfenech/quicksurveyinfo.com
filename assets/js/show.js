$(function(){


	//////////////////////////////////////////////////////////////////////////////
	//check if user response is present and less than 1000 characters
	/////////////////////////////////////////////////////////////////
	function valid_textarea(qnum){

		var text_len = $('#response_'+qnum).val().length;

		return ( text_len <= 1000 && text_len > 0 );
	}

	//////////////////////////////////////////////////////////////////////////////
	//check if question has a checked responses
	///////////////////////////////////////////
	function valid_selection(qnum){

		//get number of answers set error flag to false
		var num_inputs = $('#radio_'+qnum).data('count');
		var checked = false;

		//for each answer if there is a checked response change error flag
		for (var j = 0; j < num_inputs; j++) {
			if ($('#response_'+qnum+'_'+j).is(':checked')){
				empty = true;
			}
		};

		//return flag
		return empty;
	}

	//////////////////////////////////////////////////////////////////////////////
	//check all questions have answers
	//////////////////////////////////
	function check_form(){

		//set error flag
		var valid = true;
		
		//for each question
		for (var i = 0; i < $('.question').length; i++) {

			//get type
			var type = $('#question_'+i).data('type');
			if (type === 1){
				//check for user input less than 1000 characters change flag if needed
				if (!valid_textarea(i)){
					valid = false;
				}

			//if question already has answers check answers for a checked response
			} else if (type === 3 || type === 4 || type >= 6 && type <= 11 ){

				//if no checked response change error flag
				if ( !valid_selection(i) ){
					valid = false;
				} 
			}

			//if error is found inform user on question
			if (!valid) {
				$('#error_'+i).text("A Response is required.");				
			}
		};

		//return flag results
		return valid;
	}

	//////////////////////////////////////////////////////////////////////////////
	//check input does not go over max length
	/////////////////////////////////////////
	function check_input(loc){

    var max = loc.data('max'); // get max character length
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
							return false;
						} else if (loc.val().length > max ) {
				      loc.val(loc.val().substring(0, max));
						}
			    }, 1) == false) {
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
	}


	//////////////////////////////////////////////////////////////////////////////
	//prevent submit event unless form is complete
	////////////////////////////////////////
	$('#submit').on('click', function(event){		
		if (!check_form()){
			event.preventDefault();
		}
	});

	//////////////////////////////////////////////////////////////////////////////
	//remove error notification when the question is answered
	/////////////////////////////////////////////////////////
	$('.choice').on('change', function(){
		var qNum = $(this).closest('.question').data('num');
		$('#error_'+qNum).text('');
	});

	//////////////////////////////////////////////////////////////////////////////
	//check text input on keypress
	//////////////////////////////
	$('textarea').on('keyup keydown paste', function(event){
		check_input($(this));

		var qNum = $(this).closest('.question').data('num');
		var len = $(this).val().length

		$('#letter_count_'+qNum).text(len);
		if(this.value.length > 0){
			$('#error_'+qNum).text('');
		}
	});

});