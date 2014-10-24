$(function(){

  function check_input(loc){

    var min = loc.data('min'); // get min character length
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
});