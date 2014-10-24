<div class="jumbotron">
	<h1>Registration</h1>
</div>
<?php echo form_open(base_url('process_user/register'), array('role' => 'form', 'class' => 'form-horizontal'));?>
	<div class="form-group has-feedback">
		<label for="name" class="control-label col-sm-3">Username:</label>
		<div class="col-sm-7">
			<input type="text" class="form-control input-sm" name="name" id="name" class="form-control" value="<?php echo $this->session->flashdata('set_value_name'); ?>" data-min="1" data-max="60" required>
			<i class="fa fa-lg form-control-feedback"></i>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-7">
			<h6 id="name_error" class="text-right text-danger"><?php echo $this->session->flashdata('form_error_name'); ?></h6>
		</div>
	</div>
	
	<div class="form-group has-feedback">
		<label for="email" class="control-label col-sm-3">Email:</label>
		<div class="col-sm-7">
			<input type="email" class="form-control input-sm" name="email" id="email" value="<?php echo $this->session->flashdata('set_value_email'); ?>" data-min="6" data-max="60" required>
			<i class="fa fa-lg form-control-feedback"></i>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-7">
			<h6 id="email_error" class="text-right text-danger"><?php echo $this->session->flashdata('form_error_email'); ?></h6>
		</div>
	</div>

	<div class="form-group has-feedback">
		<label for="password" class="control-label col-sm-3">Password:</label>
		<div class="col-sm-7">
			<input type="password" class="form-control input-sm" name="password" id="password" data-min="6" data-max="72" value="<?php echo $this->session->flashdata('set_value_password'); ?>" required>
			<i class="fa fa-lg form-control-feedback"></i>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-7">
			<h6 id="password_error" class="text-right text-danger"><?php echo $this->session->flashdata('form_error_password'); ?></h6>
		</div>
	</div>

	<div class="form-group has-feedback user_input">
		<label for="confirm" class="control-label col-sm-3">Confirm Password:</label>
		<div class="col-sm-7">
			<input type="password" class="form-control input-sm" name="confirm" id="confirm" data-min="8" data-max="72" value="<?php echo $this->session->flashdata('set_value_confirm'); ?>" required>
			<i class="fa fa-lg form-control-feedback"></i>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-7">
			<h6 id="confirm_error" class="text-right text-danger"><?php echo $this->session->flashdata('form_error_confirm'); ?></h6>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-8 col-sm-4">
				<button class="btn btn-primary col-xs-4">Submit</button>
		</div>
	</div>
</form>