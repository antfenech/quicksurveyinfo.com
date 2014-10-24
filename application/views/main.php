<div class="jumbotron">
  <h1>QuickSurveyInfo.com</h1>
</div>

<?php if($this->session->flashdata('login') !== FALSE ) { ?>

<div class="row">
  <div class="col-xs-10 col-xs-offset-1 bg-danger">
    <h4 class="text-center"><?php echo $this->session->flashdata('login'); ?></h4>
  </div>
</div>

<?php 
  } 
  if($this->session->flashdata('error') !== FALSE ) { 
?>

<div class="row">
  <div class="col-xs-10 col-xs-offset-1 bg-danger">
    <h4 class="text-center"><?php echo $this->session->flashdata('error'); ?></h4>
  </div>
</div>

<?php } ?>

<div class="row">
  <div class="col-xs-6">
    <table class="table">
      <thead>
        <tr>
          <td>Public Surveys</td>
        </tr>
      </thead>
      <tbody>

<?php for ($i=0; $i < count($surveys) ; $i++) { ?>

        <tr>
          <td>
            <a href="<?php echo base_url('survey/id/'.$surveys[$i]['id']); ?>"><?php echo $surveys[$i]['title'];?></a>
          </td>
        </tr>

<?php } ?>

      </tbody>
    </table>
  </div>
  <div class="col-xs-6">
    <table class="table">
      <thead>
        <tr>
          <td>Public Results</td>
        </tr>
      </thead>
      <tbody>

<?php for ($i=0; $i < count($results) ; $i++) { ?>

        <tr>
          <td>

<?php echo "<a href='".base_url('survey/results/'.$results[$i]['id'])."'>{$results[$i]['title']}</a>";?>

          </td>
        </tr>

<?php } ?>

      </tbody>
    </table>
  </div>
</div>