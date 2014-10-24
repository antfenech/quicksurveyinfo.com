google.load("visualization", "1", {packages:["corechart", "table"]});
$(function(){

  //////////////////////////////////////////////////////////////////////////////
  //use google api to create bar graph
  ////////////////////////////////////
  function drawChart(results) {

    var data = new google.visualization.DataTable();
    data.addColumn('string','Answer');
    data.addColumn('number','Count');
    data.addColumn({type:'string', role:'annotation'});

    for (var i = 0; i < results.length; i++) {
      data.addRows([
        ['response '+Number(i+1), Number(results[i]['count']), Number(results[i]['percentage'])+'%']
      ]);
    };    

    var options = {
      bar: {groupWidth: "95%"},
      legend: { position: "none" }
    }

    var chart = new google.visualization.BarChart(document.getElementById('chart'));
    chart.draw(data, options);
  }

  //////////////////////////////////////////////////////////////////////////////
  //on question click event display survey results
  ////////////////////////////////////////////////
  $('.btn-default').click(function(event){

    //clear results text
    $('#results').text('');

    //get survey total users, set question id, question number and question type
    var survey_total = $('#total').val();
    var qID = $(this).data('qid');
    var qNum = $(this).data('qnum');
    var type = $(this).data('type');

    //display question type
    switch(type){
      case 1:  var type_text = 'Open Ended'; break;
      case 3:  var type_text = 'Single Choice'; break;
      case 4:  var type_text = 'Multiple Choice'; break;
      case 6:  var type_text = 'True or False'; break;
      case 7:  var type_text = 'Yes or No'; break;
      case 8:  var type_text = 'Agree or Disagree'; break;
      case 9:  var type_text = 'Range 1 to 5'; break;
      case 10: var type_text = 'Range Likely to Unlikely'; break;
      case 11: var type_text = 'Range Agree to Disagree'; break;
    }

    //make ajax call to get question and answer information
    $.ajax({
      url: '/process_survey/question_results/' + qID + '/' + survey_total,
      success: function(data){ 
        $('#question_title').text(data.question['question']);
        $('#question_num').text('Question '+ Number(1+qNum));
        $('#question_type').text(type_text);
        $('#question_instructions').text('Instructions for Question '+ Number(1+qNum) + ': ' + data.question['instructions']);
        if (type == 1){
          create_words_table(data.text, data.words);
        } else {
          table_and_chart(data.table, survey_total);
          drawChart(data.table);
        }
      },
      dataType: "json"
    });
  });

  //////////////////////////////////////////////////////////////////////////////
  //create table and chart for result information
  ///////////////////////////////////////////////
  function table_and_chart(array, survey_total){

     var table  = "<div class='row'>"
                + "<div class='col-md-12'>"
                +  "<table class='table'>"
                +   "<thead>"
                +      "<tr>"
                +        "<th class='text-center col-sm-2'>Response</th>"
                +        "<th>Answer</th>"
                +        "<th class='text-center col-xs-1'>#</th>"
                +        "<th class='text-center col-xs-1'>%</th>"
                +      "</tr>"
                +    "</thead>"
                +  "<tbody>";

              for (var i = 0; i < array.length; i++) {
                table += "<tr>"
                      +    "<td class='text-center'>Response "+(i+1)+"</td>"
                      +    "<td>"+array[i]['answer']+"</td><td class='text-center'>"+array[i]['count']+"</td>"
                      +    "<td class='text-center'>"+array[i]['percentage']+"</td>"
                      +  "</tr>";
              };
        table += "</tbody>"
              +  "</table>"
              + "</div>"
              + "</div>"
              + "<div class='row'>"
              +   "<div id='chart'></div>"
              + "</div>";
    $('#results').append(table);

  }

  //////////////////////////////////////////////////////////////////////////////
  //create response text table and important word table
  /////////////////////////////////////////////////////
  function create_words_table(array1, array2){

    //create array for common words
    var sortable = [];
    for (var word in array2) {
      sortable.push([word, array2[word]])
    }
    //organize important words
    sortable.sort(function(a, b) {return b[1] - a[1]})

    //choose length of list at max 10
    var size = (sortable.length <= 10 ? sortable.length : 10 );

     var table1 = "<div class='col-sm-6'>"
                +  "<h4>Responses</h4>"  
                +  "<table class='table'>"
                +   "<thead>"
                +      "<tr>"
                +        "<th>User</th>"
                +        "<th>Response</th>"
                +      "</tr>"
                +    "</thead>"
                +  "<tbody>";
              for (var i = 0; i < array1.length; i++) {
                table1 += '<tr><td>'+(i+1)+'</td><td>'+array1[i]['response_text']+'</td></tr>';
              };

     table1 += "</tbody>"
            +  "</table>"
            + "</div>";

      var table2 = "<div class='col-sm-offset-1 col-sm-4'>"
                 +  "<h4>Top "+size+" Important Words</h4>"  
                 +   "<table class='table'>" 
                 +    "<thead>"
                 +      "<tr>"
                 +        "<th class='text-center'>Word</th>"
                 +        "<th class='text-center'>Count</th>"
                 +      "</tr>"
                 +     "</thead>"
                 +    "<tbody>";

        for (var i = 0; i < size; i++) {
          table2 += "<tr><td class='text-center'>"+sortable[i][0]+"</td><td class='text-center'>"+sortable[i][1]+"</td></tr>";
        };

       table2 +=  "</tbody>"
              +  "</table>"
              +"</div>";

    //attach tables
    $('#results').append(table1);
    $('#results').append(table2);
  }

  //on page load click on the first question
  $('#question_1').click();
});