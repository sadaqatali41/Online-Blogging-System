<?php include 'hheader.php'; 
	
	echo link_tag('styles/css/login.css');
?>
<?php echo anchor('logincontroller/publicarticle','Show Articles',array('class'=>'btn btn-success pull-right')); ?>
	<div class="login">
		<div class="panel panel-primary">
			<div class="panel-heading text-center"><strong>Login Form</strong></div>
			<div class="panel-body">
				<?php echo form_open('receivedatacontroller/receivedata',array('class'=>'form-horizontal')); ?>
				<?php if($error = $this->session->flashdata('fail'))
				{ 
				?>
				<div class="row">
					<div class="col-sm-offset-2 col-sm-9 alert alert-danger text-center">
						<?php echo $error; ?>
					</div>
				</div>
				<?php 
				} ?>

					<div class="form-group">
						<label class="control-label col-sm-2">User Name :</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'uname','placeholder'=>'Enter User Name','class'=>'form-control','value'=>set_value('uname'))); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-offset-2 col-sm-10">
							<?php echo form_error('uname'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Password :</label>
						<div class="col-sm-10">
							<?php echo form_password(array('name'=>'pwd','placeholder'=>'Enter Password','class'=>'form-control')); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-offset-2 col-sm-10">
							<?php echo form_error('pwd'); ?>
						</div>
					</div>	
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<?php echo form_submit(array('name'=>'submit','value'=>'Login','class'=>'btn btn-success')); ?>

							<?php echo  form_reset(array('value'=>'Reset','class'=>'btn btn-danger')); ?>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
<?php include 'ffooter.php'; ?>