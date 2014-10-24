$(function(){

  /////////////////////////////////////////////////////////////////////////////////
  //switch button state of survey status
  //////////////////////////////////////
  function switch_state(loc){

    if (loc.hasClass('public') || loc.hasClass('results')) {
      ($.trim(loc.text()) === 'Public' ? loc.text('Private') : loc.text('Public'));
      loc.toggleClass('btn-primary')
      loc.toggleClass('btn-info');
    } else if (loc.hasClass('online')) {
      ($.trim(loc.text()) === 'Online' ? loc.text('Offline') : loc.text('Online'));
      loc.toggleClass('btn-warning');       
      loc.toggleClass('btn-success');
    }
  }

  /////////////////////////////////////////////////////////////////////////////////
  //preform ajax call on toggle switch click event
  ////////////////////////////////////////////////
  $('.public, .online, .results').click(function(){

    //get survey id and button location
    var survey_id = $(this).closest('tr').data('id');
    var button = $(this);

    //set ajax location based on button class
    if (button.hasClass('public')){
      var location = "/process_survey/dash/"+survey_id+"/publicity";
    } else if (button.hasClass('online')){
      var location = "/process_survey/dash/"+survey_id+"/activity";
    } else if (button.hasClass('results')){
      var location = "/process_survey/dash/"+survey_id+"/results";
    }

    //switch state on success
    $.ajax({
      url: location,
      success: switch_state(button)
    });   
  });

  /////////////////////////////////////////////////////////////////////////////////
  //create url modal on link button click event
  /////////////////////////////////////////////
  $('.link_btn').click(function(){

    //get title and survey id number
    var title = $(this).closest('tr').children('td').first().text();
    var survey_id = $(this).closest('tr').data('id');

    $('#container').append("<div class='modal fade' id='modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>"
                          +  "<div class='modal-dialog'>"
                          +    "<div class='modal-content'>"
                          +      "<div class='modal-header'>"
                          +        "<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"
                          +        "<h4 class='modal-title' id='myModalLabel'>Survey URL's</h4>"
                          +      "</div>"
                          +      "<div class='modal-body'>"
                          +        "<p>To copy to your clipboard highlight the text and press: Ctrl+C</p>"
                          +       "<div class='row'>"
                          +        "<div class='col-sm-2'>"
                          +         "<h4>Survey:</h4>"
                          +        "</div>"
                          +        "<div class='col-sm-10'>"
                          +         "<p>asimplesurvey.com/survey/id/"+survey_id+"</p>"
                          +        "</div>"
                          +       "</div>"
                          +       "<div class='row'>"
                          +        "<div class='col-sm-2'>"
                          +         "<h4>Results:</h4>"
                          +        "</div>"
                          +        "<div class='col-sm-10'>"
                          +         "<p>asimplesurvey.com/survey/results/"+survey_id+"</p>"
                          +        "</div>"
                          +       "</div>"
                          +       "<div class='row'>"
                          +         "<div class='col-sm-3'>"
                          +          "<h4>Share on:</h4>"
                          +         "</div>"
                          +        "<div class='col-xs-2 col-sm-1'>"
                          +         "<a href='https://www.facebook.com/sharer/sharer.php?u=asimplesurvey.com/survey/id/"+survey_id+ " "
                          +           "onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\">"
                          +           "<i class='fa fa-facebook-square fa-3x'></i>"
                          +         "</a>"
                          +       "</div>"
                          +       "<div class='col-xs-2 col-sm-1'>"
                          +         "<a href='https://plus.google.com/share?url=asimplesurvey.com/survey/id/"+survey_id+" "
                          +           "onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\">"
                          +            "<i class='fa fa-google-plus-square fa-3x'></i>"
                          +         "</a>"
                          +       "</div>"
                          +       "<div class='col-xs-2 col-sm-1'>"
                          +         "<a href='https://twitter.com/share' " 
                          +           "class='twitter-share-button' data-lang='en' "
                          +           "onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\">"
                          +           "<i class='fa fa-twitter-square fa-3x'></i>"
                          +         "</a>"
                          +       "</div>"
                          +       "<div class='col-xs-2 col-sm-1'>"
                          +         "<a href='https://www.linkedin.com/shareArticle?mini=true&url=asimplesurvey.com/survey/id/"+survey_id+"&title=" +title+" on asimplesurvey.com&summary=&source='"
                          +           "onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\">"
                          +           "<i class='fa fa-linkedin-square fa-3x'></i>"
                          +         "</a>"
                          +       "</div>"
                          +      "</div>"                                 
                          +    "</div>"
                          +  "</div>"
                          +"</div>");

    //show modal
    $('#modal').modal('show');

  });

  /////////////////////////////////////////////////////////////////////////////////
  //remove modal from html when modal dissappears
  ///////////////////////////////////////////////
  $(document).on('hidden.bs.modal', '#modal', function() {
    $('#modal').remove();
  });

  /////////////////////////////////////////////////////////////////////////////////
  //show confirmation modal on delete survey click event
  //////////////////////////////////////////////////////
  $(document).on('click', '.dlt_button', function(){

    //get survey title and id
    var title = $(this).closest('tr').children('td').first().text();
    var survey_id = $(this).closest('tr').data('id');

    $('#container').append("<div class='modal fade' id='modal' data-id='"+survey_id+"'>"
                          +  "<div class='modal-dialog'>"
                          +    "<div class='modal-content'>"
                          +      "<div class='modal-header'>"
                          +        "<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"
                          +        "<h4 class='modal-title'>Delete the Survey?</h4>"
                          +      "</div>"
                          +      "<div class='modal-body'>"
                          +        "<p>Are you sure you want to delete the survey \""+ title +"\"?</p>"
                          +        "<p>All questions and results will be deleted forever.</p>"
                          +        "<p>Note: Switching to offline and private will prevent others from seeing the survey</p>"
                          +      "</div>"
                          +      "<div class='modal-footer'>"
                          +        "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"
                          +        "<button type='button' id='confirm' class='btn btn-danger'>Delete Survey</button>"
                          +      "</div>"
                          +    "</div>"
                          +  "</div>"
                          +"</div>");

    //show modal
    $('#modal').modal('show');

  });

  /////////////////////////////////////////////////////////////////////////////////
  //delete survey on delete survey confirmation button click event 
  ////////////////////////////////////////////////////////////////
  $(document).on('click','#confirm', function(){
  
    var survey_id = $('#modal').data('id');
    $.ajax({
      url: "/process_survey/dash/"+survey_id+"/delete",
      success: function(){
        $('#modal').modal('toggle');
        $('tr').filter('[data-id='+survey_id+']').remove();
      }
    });
  
  });

});