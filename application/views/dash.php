<div class="jumbotron">
  <h2><?php echo $this->session->userdata('user')['name'];?>'s Surveys</h2>
</div>

<?php if ($this->session->flashdata('steps')) { ?>
  <div class="row">
    <div class="col-xs-offset-1 col-xs-10 bg-warning">
      <h4 class="text-center"><?php echo $this->session->flashdata('steps'); ?></h4>
    </div>
  </div>
<?php } ?>

<div class="row">
  <div class="col-xs-12">
      <a class="btn btn-primary col-xs-offset-6 col-xs-6 col-sm-offset-10 col-sm-2" href="<?php echo base_url('survey/create');?>">Create Survey</a>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">

<?php if (count($surveys) === 0) { ?>

    <h4 class="text-center">You don't have any surveys yet click Create survey to make one.</h4>

<?php } else { ?>

    <table class="table">
      <thead>
        <tr>
          <td>Results</td>
          <td class="text-center col-xs-1">URL</td>
          <td class="text-center col-xs-1">Visable</td>
          <td class="text-center col-xs-1">Results</td>
          <td class="text-center col-xs-1">Live</td>
          <td class="text-center col-xs-1">Delete</td>
        </tr>
      </thead>
      <tbody>

<?php for ($i=0; $i < count($surveys) ; $i++) { ?>

        <tr data-id="<?php echo $surveys[$i]['id'];?>">

          <td><a href="<?php echo base_url('survey/results/'.$surveys[$i]['id']);?>"><?php echo $surveys[$i]['title'];?></a></td>

          <td class="text-center"><a href="#" class="link_btn">Link</a></td>

          <td class="text-center">
            <button type="button" class="public btn btn-xs <?php echo ($surveys[$i]['public'] === '1' ? 'btn-primary' : 'btn-info')?>">
              <?php echo ($surveys[$i]['public'] === '1' ? 'Public' : 'Private')?>
            </button>
          </td>

          <td class="text-center">
            <button type="button" class="results btn btn-xs <?php echo ($surveys[$i]['results'] === '1' ? 'btn-primary' : 'btn-info')?>">
              <?php echo ($surveys[$i]['results'] === '1' ? 'Public' : 'Private')?>
            </button>
          </td>

          <td class="text-center">
            <button type="button" class="online btn btn-xs <?php echo ($surveys[$i]['active'] === '1' ? 'btn-success' : 'btn-warning')?>">
              <?php echo ($surveys[$i]['active'] === '1' ? 'Online' : 'Offline')?>
            </button>
          </td>

          <td class="text-center"><button class="btn btn-xs btn-danger dlt_button">Delete</button></td>

        </tr>

<?php     } ?>

      </tbody>
    </table>

<?php } ?>

  </div>
</div>