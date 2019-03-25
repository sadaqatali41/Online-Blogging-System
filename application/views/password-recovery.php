<?php echo anchor('user-login','Login',array('class'=>'btn btn-info pull-right')); ?>
	<div class="login">
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				<strong>Paasword Recovery Form</strong>
			</div>
			<div class="panel-body">
				<?php echo form_open('password-recovery-submit',array('class'=>'form-horizontal')); ?>

					<div class="form-group">
						<label class="control-label col-sm-3">New Password :</label>
						<div class="col-sm-9">
							<?php echo form_password(array('name'=>'pwd','id'=>'pwd','placeholder'=>'Enter New Password','class'=>'form-control','value'=>set_value('pwd'))); ?>
							<span id="pwd_error"></span>
						</div>
					</div>
					<input type="hidden" name="email" value="<?php echo $email; ?>">
					<div class="form-group">
						<label class="control-label col-sm-3">Confirm Password :</label>
						<div class="col-sm-9">
							<?php echo form_password(array('name'=>'cpwd','id'=>'cpwd','placeholder'=>'Enter Confirm Password','class'=>'form-control')); ?>
							<span id="cpwd_error"></span>
						</div>
					</div>	
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<?php echo form_submit(array('name'=>'submit','id'=>'submit','value'=>'Submit','class'=>'btn btn-success disabled')); ?>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){

		var patt=/["!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"]/;

			$('#pwd_error').hide();
			$('#cpwd_error').hide();

			var pwd_error = true;
			var cpwd_error = true;

			$('#pwd').keyup(function(){
				new_password();
			});

			function new_password()
			{
				var pwd = $('#pwd').val();
				if(pwd == "")
				{
					$('#pwd_error').show();
					$('#pwd_error').html('Password is <b>Required</b>.');
					$('#pwd_error').css('color','red');
					pwd_error = false;
					return false;
				}
				else if(pwd.length < 8 || pwd.length > 15)
				{
					$('#pwd_error').show();
					$('#pwd_error').html('Password Should be in Between <b>8 & 15</b> Characters.');
					$('#pwd_error').css('color','red');
					pwd_error = false;
					return false;
				}
				else if(!patt.test(pwd))
				{
					$('#pwd_error').show();
					$('#pwd_error').html("Please use <b>One Special</b> Characters in Password.");
					$('#pwd_error').css('color','red');
					pwd_error = false;
					return false;
				}
				else if(!/[0-9]/.test(pwd))
				{
					$('#pwd_error').show();
					$('#pwd_error').html('Please use <b>One Number[0-9]</b> in Password.');
					$('#pwd_error').css('color','red');
					pwd_error = false;
					return false;
				}
				else if(!/[A-Z]/.test(pwd))
				{
					$('#pwd_error').show();
					$('#pwd_error').html("Please use <b>One UPPERCASE Letter</b> in Password.");
					$('#pwd_error').css('color','red');
					pwd_error = false;
					return false;
				}
				else if(!/[a-z]/.test(pwd))
				{
					$('#pwd_error').show();
					$('#pwd_error').html("Please use <b>One lowecase Letter</b> in Password.");
					$('#pwd_error').css('color','red');
					pwd_error = false;
					return false;
				}
				else
				{
					$('#pwd_error').hide();
				}
			}

			$('#cpwd').keyup(function(){
				confirm_password();
			});
			function confirm_password()
			{
				var pwd = $('#pwd').val();
				var cpwd = $('#cpwd').val();
				if(cpwd != "" && pwd != "")
				{
					if(pwd != cpwd)
					{
						$('#cpwd_error').show();
						$('#cpwd_error').html("Password <b>Not Matched.</b>");
						$('#cpwd_error').css('color','red');
						$('#submit').addClass('disabled');
						cpwd_error = false;
						return false;
					}
					else
					{
						$('#cpwd_error').hide();
						$('#submit').removeClass('disabled');
					}
				}
				else
				{
					$('#submit').addClass('disabled');
				}
			}

			$('#submit').click(function(event){

				pwd_error = true;
				cpwd_error = true;

				new_password();
				confirm_password();

				if(pwd_error && cpwd_error)
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