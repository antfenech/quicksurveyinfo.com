<div class="jumbotron">
	<h2><?php echo $survey['title'];?></h2>
</div>

<h4 class="text-center">
<?php 
	echo $survey['exit_message'] !== '' 
		? $survey['exit_message'] 
		: "Thank you for taking the survey \"{$survey['title']}\". You can find more surveys on our home page or signup to create your own.";
?>
</h4>

<div class="row">
<?php if ($survey['results'] === '1') {?>
	<a class="btn btn-info col-xs-offset-3 col-xs-2" href="<?php echo base_url();?>">Home page</a>
	<a class="btn btn-info col-xs-offset-2 col-xs-2" href="<?php echo base_url('survey/results/'.$survey_id);?>">Results</a>
<?php } else { ?>
	<a class="btn btn-info col-xs-offset-4 col-xs-4" href="<?php echo base_url();?>">Home page</a>
<?php } ?>
</div>