$(function(){

	//////////////////////////////////////////////////////////////////////////////
	//chcek input doesn't exceed max character count
	////////////////////////////////////////////////
	function check_input(loc){

		var max = loc.data('max');
		var count = loc.val().length

		if (event.keyCode !== 8){ //CHECK FOR BACKSPACE
			if (event.which < 0x20){
				if (count == max){
					event.preventDefault();
				} else if (count > max ) {
		      loc.val(loc.val().substring(0, max));
				}
			} else {
				if (event.type == "paste"){
					var that = loc;
					if (setTimeout(function() { 
						if (that.val().length == max) {
							return false;
						} else if (that.val().length > max ) {
				      that.val(that.val().substring(0, max));
						}
			    }, 1) == false) {
						event.preventDefault();
					}
				} else {
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
	//highlight inputs green for complete red for incomplete
	////////////////////////////////////////////////////////
	function input_highlight(loc, valid){
		if (valid){
			loc.closest('.form-group').addClass('has-success');
			loc.siblings('i').addClass('fa-check');
			loc.closest('.form-group').removeClass('has-error');
			loc.siblings('i').removeClass('fa-exclamation');
		} else {
			loc.closest('.form-group').addClass('has-error');
			loc.siblings('i').addClass('fa-exclamation');
			loc.closest('.form-group').removeClass('has-success');
			loc.siblings('i').removeClass('fa-check');
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	//check input field against regular expression set error if needed
	//////////////////////////////////////////////////////////////////
	function check_field(name, regex, error){

		//if input has a character
		if ($('#'+name).val().length > 0){

			//test regular expression against input
			var valid = regex.test($('#'+name).val());
			//set error or remove error
			(!valid 
				? $('#'+name+'_error').text(error)
				: $('#'+name+'_error').text('') 
			);

			//highlight input field
			input_highlight($('#'+name), valid);

			//return regular expression results
			return valid;
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	//check password and confirm match
	//////////////////////////////////
	function check_confirm(){
		var valid = $('#password').val() === $('#confirm').val();
		(!valid
			? $('#confirm_error').text('Does not match password')
			: $('#confirm_error').text('')
		);
		input_highlight($('#confirm'), valid);
		return valid;
	}

	//////////////////////////////////////////////////////////////////////////////
	//check if form is complete set errors if needed
	////////////////////////////////////////////////
	function check_form(){
		return ( check_field('name', /^[a-zA-Z0-9_]*$/, 'Letters, numbers and underscore only')
			&& check_field('email', /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/, 'Email is invalid')
			&& check_field('password', /^(?=.*[\d])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[\w!@#$%^&*]{8,72}$/, 'Must be at least 8 characters and contain 1 number, letter, and special character !@#$%^&*')
 			&& check_confirm()
 		);
	}

	//////////////////////////////////////////////////////////////////////////////
	//update input counter on keypress event handler
	////////////////////////////////////////////////
	$('#name, #email, #password, #confirm').on('input paste keyup keydown', function(){
		check_input($(this));
		switch($(this).prop('id')){
			case 'name' 	  : check_field('name', /^[a-zA-Z0-9_]*$/, 'Letters, numbers and underscore only'); break;
			case 'email'		: check_field('email', /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/, 'Email is invalid'); break;
			case 'password' : check_field('password', /^(?=.*[\d])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[\w!@#$%^&*]{8,72}$/, 'Must be at least 8 characters and contain 1 number, letter, and special character !@#$%^&*'); break;
			case 'confirm'	: 		
				if ($('#confirm').val().length !== 0 || $('#confirm').val() !== ""){
					check_confirm();
				}
				break;
		}	
	});

	//////////////////////////////////////////////////////////////////////////////
	//prevent form from submiting unless it is valid an complete
	////////////////////////////////////////////////////////////
	$('form').on('submit', function(event){
		if ( check_confirm() == false ){
			event.preventDefault();
		}
	})

});