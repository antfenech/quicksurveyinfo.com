<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<?php 
	if (isset($css)) {
		foreach ($css as $file ) {
			echo "<link rel='stylesheet' type='text/css' href='". base_url()."/assets/css/".$file.".css'>";
		}
	}
	if (isset($js)) {
		foreach ($js as $file ) {
			echo "<script type='text/javascript' src='". base_url() . "/assets/js/" . $file . ".js'></script>";
		}
	}	
?>
	<title><?php echo $title;?></title>
</head>
<body>

<nav class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
	<div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-items'>
        <span class='sr-only'>Toggle navigation</span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      <a class='navbar-brand' href='/'>QuickSurveyInfo.<small>com</small></a>
    </div>
    <div class='collapse navbar-collapse' id='navbar-items'>
      <ul class='nav navbar-nav navbar-right'>

<?php  if ($user == false ) { ?>

				<li>
					<div class='navbar-form navbar-right'>

<?php   		echo form_open(base_url('process_user/login'), array('role' => 'form'));?>

						  <div class='form-group'>
						    <input 	type='text' class='form-control col-xs-3' name='email' placeholder='Email'>
						  </div>
						  <div class='form-group'>
						    <input  type='password' class='form-control col-xs-3' name='password' placeholder='Password'>
						  </div>
						  <div class='form-group'>
						  	<button type="submit" class='btn btn-danger'>Submit</button>
						  </div>
						</form>
					</div>
				</li>
        <li>
						<a href='/main/register'>Sign-up</a>
				</li>

<?php } else { ?>

				<li><a href="<?php echo base_url('/main/dash'); ?>">Dashboard</a></li>
				<li><a href="<?php echo base_url('/process_user/logout'); ?>">Logout</a></li>

<?php } ?>

      </ul>
    </div>
  </div>
</nav>
<div class="container" id="container">