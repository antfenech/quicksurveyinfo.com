<div class="jumbotron">
  <h1>Create Survey</h1>
</div>

<?php echo form_open(base_url('process_survey/create_survey'), array('role' => 'form', 'class' => 'form-horizontal'));?>

  <div class="panel-group" id="accordion">
    <div class="panel panel-primary">
      <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_title">
        <div class="clearfix">
          <h4 class="panel-title col-xs-11">
            <a href="#collapse_title">Survey Title</a>
          </h4>
          <i class="fa text-right fa-lg col-xs-1"></i>
        </div>
      </div>
      <div id="collapse_title" class="panel-collapse collapse in">
        <div class="panel-body">
          <div class="form-group">
            <p class="col-xs-12">A way to identify this survey from others. (5 characters minimum)</p>  
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <input type="text" name="title" class="form-control" id="title" placeholder="required - minimum of 5 characters" data-max="100" data-min="5">
            </div>
            <h6 class="col-xs-12 text-right">(<span class="count">0</span>/100)</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_description">
        <div class="clearfix">
          <h4 class="panel-title col-xs-11">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_description">Survey Description</a>
          </h4>
          <i class="fa text-right fa-lg col-xs-1"></i>
        </div>
      </div>
      <div id="collapse_description" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="form-group">

            <p class="col-xs-12">Optional Instructions or information for survey takers.</p>  

          </div>
          <div class="form-group">

            <div class="col-xs-12">
              <textarea class="form-control" name="description" id="description" data-max="1000" data-min="0"></textarea>
            </div>
            <h6 class="col-xs-12 text-right">(<span class="count">0</span>/1000)</h6>

          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-primary question" id="question_0" data-qnum="0">
      <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_quesiton_0">
        <div class="clearfix">
          <h4 class="panel-title col-xs-11">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_quesiton_0">Question 1</a>
          </h4>
          <i class="fa text-right fa-lg col-xs-1"></i>
        </div>
      </div>
      <div id="collapse_quesiton_0" class="panel-collapse collapse">
        <input type="hidden" id="select_0" name="select[0]" value="1">
        <div class="panel-body">
          <div class="form-group">

            <div class="remove_question col-xs-offset-7 col-xs-5 col-sm-offset-10 col-sm-2"></div>

          </div>
          <div class="form-group">

            <label class="col-sm-2" for="instructions_0">Instructions:</label>
            <h6 class="col-sm-8 col-md-9">Optional information or instructions for this question.</h6>

          </div>
          <div class="form-group">

            <div class="col-sm-offset-2 col-sm-10">
              <textarea class="form-control" id="instructions_0" name="instructions[0]" placeholder="optional" data-max="1000" data-min="0"></textarea>
            </div>

            <h6 class="col-xs-12 text-right">(<span class="count">0</span>/1000)</h6>
          </div>
          
          <div class="form-group">

            <label class="col-sm-2" for="ask_0">Question:</label>
            <div class="col-sm-10">
              <textarea name="question[0]" id="ask_0" class="form-control" placeholder="Required" data-max="300" data-min="1"></textarea>
            </div>

            <h6 class="col-xs-12 text-right">(<span class="count">0</span>/300)</h6>
          </div>

          <div class="form-group">
            <label class="col-xs-12 col-sm-2">Type:</label>
            <div class="col-xs-12 col-sm-10">
              <div class="btn-group btn-group-justified type_group">

                <div class="btn-group type select" data-type="1">
                  <button type="button" class="btn btn-primary active">User Response</button>
                </div>

                <div class="btn-group type" data-type="2">
                  <button type="button" class="btn btn-primary">Custom Responses</button>
                </div>

                <div class="btn-group type" data-type="3">
                  <button type="button" class="btn btn-primary">Predefined Responses</button>
                </div>

              </div>
            </div>
          </div>
          <div id="response_area_0"></div>
        </div>
      </div>
    </div>

    <div class="panel panel-primary" id="exit_pannel">
      <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_exit">
        <div class="clearfix">

          <h4 class="panel-title col-xs-11">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_exit">Exit Message - Optional</a>
          </h4>
          <i class="fa text-right fa-lg col-xs-1"></i>

        </div>
      </div>
      <div id="collapse_exit" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="form-group">

            <p class="col-xs-12">A message to thank the survey taker upon completion</p>  

          </div>
          <div class="form-group">
            <div class="col-xs-12">

              <textarea class="form-control" name="exit_message" id="exit" data-max="1000" data-min="0"></textarea>

            </div>
            <h6 class="col-xs-12 text-right">(<span class="count">0</span>/1000)</h6>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-xs-12">
      <a class="btn btn-success col-xs-5 col-sm-2 add_question">Add Question</a>    
    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-12">Allow Survey on the homepage?</label>
    <div class="btn-group col-xs-12 col-sm-6" data-toggle="buttons">

      <label class="btn btn-primary col-xs-4 col-sm-3 active">
        <input type="radio" name="public" value="true" class="public" id="public_t" checked>Yes
      </label>

      <label class="btn btn-primary col-xs-4 col-sm-3">
       <input type="radio" name="public" class="public" value="false" id="public_f">No
      </label>

    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-12">Make the Results public?</label>
    <div class="btn-group col-xs-12 col-sm-6" data-toggle="buttons">

      <label class="btn btn-primary col-xs-4 col-sm-3 active">
        <input type="radio" name="results" value="true" class="results" id="results_t" checked>Public
      </label>

      <label class="btn btn-primary col-xs-4 col-sm-3">
        <input type="radio" name="results" value="false" class="results" id="results_f">Private
      </label>

    </div>
  </div>

  <button type="submit" class="btn btn-success col-xs-4 col-sm-3 col-xs-offset-8 col-sm-offset-9" id="submit">Submit</button>
</form>