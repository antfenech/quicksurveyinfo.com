<?php if ($access == FALSE){?>
	<div class="jumbotron">
		<h2>Survey Results</h2>
	</div>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<h2 class="text-center">The survey results are set to private.</h2>
		</div>
	</div>

<?php } else { ?>

	<input type="hidden" value="<?php echo $survey['counter']; ?>" id="total">
	<div class="jumbotron">
		<h2><?php echo $survey['title']; ?></h2>
	</div>

<?php if ($survey['active'] === 0 ) { ?>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h4 class="text-center">The survey is offline.</h4>
			</div>
		</div>

<?php } ?>
<?php if ($creator) {?>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<p>Send them the link: <?php echo base_url('survey/id/'. $survey_id);?></p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-offset-1 col-xs-10">
		  <p>The link to take your survey is located at <a href="<?php echo base_url('survey/id/'. $survey_id); ?>"><?php echo base_url('survey/id/'. $survey_id);?></a></p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-offset-1 col-sm-2">
      <h4>Share on:</h4>
		</div>

		<div class="col-xs-2 col-sm-1">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('survey/id/'. $survey_id);?>"
			   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
			   <i class="fa fa-facebook-square fa-3x"></i>
			</a>
		</div>

		<div class="col-xs-2 col-sm-1">
			<a href="https://plus.google.com/share?url={<?php echo base_url('survey/id/'. $survey_id);?>}" 
				 onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<i class="fa fa-google-plus-square fa-3x"></i>
			</a>
		</div>

		<div class="col-xs-2 col-sm-1">
			<a href="https://twitter.com/share" 
				 class="twitter-share-button" 
				 data-lang="en"
				 onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<i class="fa fa-twitter-square fa-3x"></i>
			</a>
		</div>

		<div class="col-xs-2 col-sm-1">
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('survey/id/'. $survey_id);?>&title=<?php echo $survey['title']; ?> on asimplesurvey.com&summary=&source="
				 onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<i class="fa fa-linkedin-square fa-3x"></i>
			</a>
		</div>
	</div>

<?php } ?>
<?php if ($survey['counter'] > 0) { ?>

	<div class="row">
		<div class="col-xs-4">
		 <h3>Questions</h3>
		</div>
		<div class="col-xs-8">
		 <h3 class="text-right"><?php echo $survey['counter'];?> Responses</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="btn-group">

<?php for ($i=0; $i < count($question); $i++) { ?>

				<button type="button" 
								id="question_<?php echo $i+1;?>"
								class="btn btn-default" 
								data-qid="<?php echo $question[$i]['id']; ?>" 
								data-qnum="<?php echo $i; ?>" 
								data-type="<?php echo $question[$i]['question_type_id'];?>"><?php echo ($i+1); ?>
				</button>

<?php } ?>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<h3><span id="question_num"></span><big> | </big><small id="question_type"></small></h3>			
		</div>
	</div>

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<h4 id='question_instructions'></h4>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<h3 id='question_title'></h3>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div id="results"></div>
		</div>
	</div>

<?php } else { ?>

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<h4 class="text-center">No one has completed the survey.</h4>
			</div>
		</div>

<?php }
	} ?>