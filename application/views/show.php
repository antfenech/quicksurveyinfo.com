<div class="jumbotron">
	<h2><?php echo $survey['title']; ?></h2>
</div>

<div class="row">

<?php echo form_open(base_url('process_survey/submit_survey/'.$survey_id), array('role' => 'form', 'class' => 'form-horizontal'));?>

		<div class="col-sm-offset-1 col-sm-10">

<?php if ($survey['description'] !== '' ) { ?>

			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<h3>Survey Instructions: <small><?php echo $survey['description']; ?></small></h3>
				</div>
			</div>

<?php } ?> 
<?php	for ($i=0; $i < count($question); $i++) { ?>

				<div class="row question" id="question_<?php echo $i;?>" data-type="<?php echo $type[$i]; ?>" data-num="<?php echo $i; ?>">
					<div class="row">
						<div class="col-xs-6 col-xs-offset-1">
							<h3>Question <?php echo ($i+1) ?></h3>
						</div>
						<div class="col-xs-5">
							<h3 class="text-right">
								<small class="text-danger" id="error_<?php echo $i;?>"><?php echo isset($error[$i]) ? $error[$i] : '' ?></small>
							</h3>
						</div>
					</div>

<?php 	if ($question[$i]['instructions'] !== '' ) { ?>

					<div class="row">
						<div class="col-xs-10 col-xs-offset-1">
							<h4>Instructions: <small><?php echo $question[$i]['instructions']; ?></small></h4>
						</div>
					</div>

<?php 	} ?>

					<div class="row">
						<div class="col-xs-10 col-xs-offset-1">
							<h4>Question: <small><?php echo $question[$i]['question']; ?></small></h4>						
						</div>
					</div>

<?php 	if ($type[$i] == 1) { ?>

					<div class="row">
						<div class="col-xs-offset-1 col-xs-10">

<?php echo 				form_hidden( 'question_id['.$i.']', $question[$i]['id']);?>

							<textarea class="form-control" id="response_<?php echo $i;?>" name="<?php echo "response[${i}]"; ?>" data-min="1" data-max="1000"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-11">
							<p class="text-right"><small>(<span id="letter_count_<?php echo $i;?>">0</span>/1000)</small></p>
						</div>
					</div>

<?php		} else if ( $type[$i] == 3 || $type[$i] == 4 || ($type[$i] >= 6 && $type[$i] <= 11) ) { ?>

					<div class="row" id="radio_<?php echo $i;?>" data-count="<?php echo count($answer[$i]);?>">

<?php				for ($j=0; $j < count($answer[$i]); $j++) { ?>

							<div class="row">
								<div class="col-xs-offset-2 col-sm-offset-1 col-xs-1 text-center">

<?php echo 				form_hidden( 'question_id['.$i.']', $question[$i]['id']);?>

					  			<input type="hidden" name="<?php echo "question_id[{$i}]";?>" value="<?php echo $question[$i]['id'];?>">

<?php echo 				"<input type='" . ( $type[$i] == 4 ? 'checkbox' : 'radio' ) . "' 
												  name='" . ( $type[$i] == 4 ? "response[{$i}][{$j}]" : "response[{$i}]" ) . "' 
												 class='choice'
													  id='response_{$i}_{$j}' 
												 value='{$answer[$i][$j]['id']}'>";
?>

								</div>
								<div class="col-xs-9">
									<label for="<?php echo "response_${i}_${j}";?>"><?php echo $answer[$i][$j]['answer']; ?></label>
								</div>
							</div>

<?php 			} #end of answer for loop ?>

					</div>

<?php 	} # end of else ?>

				</div>

<?php } #end of question for loop ?>

			<div class="row">
				<button type="submit" id="submit" class="btn btn-primary col-xs-offset-8 col-xs-3 col-sm-offset-9 col-sm-2">Submit</button>			
			</div>
		</div>
	</form>
</div>