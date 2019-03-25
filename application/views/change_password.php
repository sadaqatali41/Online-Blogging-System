<?php echo link_tag('styles/css/login.css'); ?>
<style type="text/css">
	div:not(.login){
		display: block;
		padding: 10px;
	}
	label{
		padding: 14.5px;
	}
</style>
<?php echo anchor('user-dashboard',' Dashboard',array('class'=>'btn btn-info pull-left fa fa-angle-double-left')); ?>
<?php if($result->pwd_count != 0) : ?>
<h4 class="pull-right">Password Change  
	<span class="label label-success"><?php echo $result->pwd_count; ?></span> Times
</h4>
<?php endif; ?>
	<div class="login">
		<div class="panel panel-primary">
			<div class="panel-heading text-center"><strong>Change Password</strong>
			</div>
			<div class="panel-body">

				<?php if($error = $this->session->flashdata('error'))
				{ 
					$error_class = $this->session->flashdata('error_class')
				?>
				<div class="row">
					<div class="col-sm-offset-2 col-sm-10 alert <?php echo $error_class; ?> text-center">
						<strong><?php echo $error; ?></strong>
					</div>
				</div>
			<?php } ?>
				<?php echo form_open('change-password-submit'); ?>
					<div class="form-group">
						<label class="control-label col-sm-4">Old Password :</label>
						<div class="col-sm-8">
							<?php echo form_password(array('name'=>'old_pwd','placeholder'=>'Enter Old Password','id'=>'old_pwd','class'=>'form-control','value'=>set_value('old_pwd'),'required'=>'required')); ?>
							<span id="old_pwd_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">New Password :</label>
						<div class="col-sm-8">
							<?php echo form_password(array('name'=>'new_pwd','placeholder'=>'Enter New Password','id'=>'new_pwd','class'=>'form-control','required'=>'required')); ?>
							<span id="new_pwd_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Confirm Password :
						</label>
						<div class="col-sm-8">
							<?php echo form_password(array('name'=>'con_pwd','placeholder'=>'Enter Confirm Password','id'=>'con_pwd','class'=>'form-control','required'=>'required')); ?>
							<span id="con_pwd_error"></span>
						</div>
					</div>
					<br><br><br>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php echo form_submit(array('name'=>'submit','value'=>'Change Password','id'=>'submit','class'=>'btn btn-success')); ?>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){

		var patt=/["!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"]/;

			$('#old_pwd_error').hide();
			$('#new_pwd_error').hide();
			$('#con_pwd_error').hide();

			var old_pwd_error = true;
			var new_pwd_error = true;
			var con_pwd_error = true;

			$('#old_pwd').keyup(function(){
				old_password();
			});

			function old_password()
			{
				var old_pwd = $('#old_pwd').val();
				if(old_pwd == "")
				{
					$('#old_pwd_error').show();
					$('#old_pwd_error').html('Password is <b>Required</b>.');
					$('#old_pwd_error').css('color','red');
					old_pwd_error = false;
					return false;
				}
				else if(old_pwd.length < 8 || old_pwd.length > 15)
				{
					$('#old_pwd_error').show();
					$('#old_pwd_error').html('Password Should be in Between <b>8 & 15</b> Characters.');
					$('#old_pwd_error').css('color','red');
					old_pwd_error = false;
					return false;
				}
				else if(!patt.test(old_pwd))
				{
					$('#old_pwd_error').show();
					$('#old_pwd_error').html("Please use <b>One Special</b> Characters in Password.");
					$('#old_pwd_error').css('color','red');
					old_pwd_error = false;
					return false;
				}
				else if(!/[0-9]/.test(old_pwd))
				{
					$('#old_pwd_error').show();
					$('#old_pwd_error').html('Please use <b>One Number[0-9]</b> in Password.');
					$('#old_pwd_error').css('color','red');
					old_pwd_error = false;
					return false;
				}
				else if(!/[A-Z]/.test(old_pwd))
				{
					$('#old_pwd_error').show();
					$('#old_pwd_error').html("Please use <b>One UPPERCASE Letter</b> in Password.");
					$('#old_pwd_error').css('color','red');
					old_pwd_error = false;
					return false;
				}
				else if(!/[a-z]/.test(old_pwd))
				{
					$('#old_pwd_error').show();
					$('#old_pwd_error').html("Please use <b>One lowecase Letter</b> in Password.");
					$('#old_pwd_error').css('color','red');
					old_pwd_error = false;
					return false;
				}
				else
				{
					$('#old_pwd_error').hide();
				}
			}
			$('#new_pwd').keyup(function(){
				new_password();
			});

			function new_password()
			{
				var new_pwd = $('#new_pwd').val();
				if(new_pwd == "")
				{
					$('#new_pwd_error').show();
					$('#new_pwd_error').html('Password is <b>Required</b>.');
					$('#new_pwd_error').css('color','red');
					new_pwd_error = false;
					return false;
				}
				else if(new_pwd.length < 8 || new_pwd.length > 15)
				{
					$('#new_pwd_error').show();
					$('#new_pwd_error').html('Password Should be in Between <b>8 & 15</b> Characters.');
					$('#new_pwd_error').css('color','red');
					new_pwd_error = false;
					return false;
				}
				else if(!patt.test(new_pwd))
				{
					$('#new_pwd_error').show();
					$('#new_pwd_error').html("Please use <b>One Special</b> Characters in Password.");
					$('#new_pwd_error').css('color','red');
					new_pwd_error = false;
					return false;
				}
				else if(!/[0-9]/.test(new_pwd))
				{
					$('#new_pwd_error').show();
					$('#new_pwd_error').html('Please use <b>One Number[0-9]</b> in Password.');
					$('#new_pwd_error').css('color','red');
					new_pwd_error = false;
					return false;
				}
				else if(!/[A-Z]/.test(new_pwd))
				{
					$('#new_pwd_error').show();
					$('#new_pwd_error').html("Please use <b>One UPPERCASE Letter</b> in Password.");
					$('#new_pwd_error').css('color','red');
					new_pwd_error = false;
					return false;
				}
				else if(!/[a-z]/.test(new_pwd))
				{
					$('#new_pwd_error').show();
					$('#new_pwd_error').html("Please use <b>One lowecase Letter</b> in Password.");
					$('#new_pwd_error').css('color','red');
					new_pwd_error = false;
					return false;
				}
				else
				{
					$('#new_pwd_error').hide();
				}
			}

			$('#con_pwd').keyup(function(){
				confirm_password();
			});
			function confirm_password()
			{
				var new_pwd = $('#new_pwd').val();
				var con_pwd = $('#con_pwd').val();
				if(new_pwd != con_pwd)
				{
					$('#con_pwd_error').show();
					$('#con_pwd_error').html("Password <b>Not Matched.</b>");
					$('#con_pwd_error').css('color','red');
					con_pwd_error = false;
					return false;
				}
				else
				{
					$('#con_pwd_error').hide();
				}
			}

			$('#submit').click(function(event){

				old_pwd_error = true;
				new_pwd_error = true;
				con_pwd_error = true;

				old_password();
				new_password();
				confirm_password();

				if(old_pwd_error && new_pwd_error && con_pwd_error)
				{
					return true;
				}
				else
				{
					return false;
				}
			});
	});
</script>
