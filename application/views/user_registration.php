<?php include 'hheader.php'; ?>
<style type="text/css">
	.registration{
		width: 60%;
		margin: auto;
		box-shadow: 4px 5px 20px 6px gray;
	}
</style>
<?php 
	$options = array(
			' "disabled="disabled' => 'Select Security Question',
			'book'				=> 'Your Favorite Book Name',
			'mother'			=> 'Your Mother Name',
			'spouse_meet'		=> 'Where did You Meet Your Spouse?',
			'football_palyer'	=> 'Your favorite Football Player'
	);
 ?>
<div class="registration">
	<div class="panel panel-primary">
		<div class="panel-heading text-center">USER REGISTRATIONS</div>
		<div class="panel-body">
			<?php echo form_open_multipart("user-registration-submit"); ?>
			<div class="form-group">
				<?php echo form_label('Full Name:','name'), 
						form_input(array("name"=>"name","id"=>"name","class"=>"form-control","placeholder"=>"Enter Your Name","value"=>set_value('name')));

				?>
			</div>
			<div id="name_error" class="text-center"><strong><?php echo form_error('name'); ?></strong></div>
			<div class="form-group">
				<?php echo form_label('User Name:','uname'), 
						form_input(array("name"=>"uname","id"=>"uname","class"=>"form-control","placeholder"=>"Enter User Name","value"=>set_value('uname')));

				?>
				<span id="uname_jquery_error"></span>
			</div>
			<div id="uname_error" class="text-center"><strong><?php echo form_error('uname') ?></strong></div>
			<div class="form-group">
				<?php echo form_label('Password:','pwd'), 
						form_password(array("name"=>"pwd","id"=>"pwd","class"=>"form-control","placeholder"=>"Enter Password","value"=>set_value('pwd')));

				?>
			</div>
			<div id="password_error" class="text-center"><strong><?php echo form_error('pwd'); ?></strong></div>
			<div class="form-group">
				<?php echo form_label('Mobile Number:','mobile'), 
						form_input(array("name"=>"mobile","id"=>"mobile","class"=>"form-control","placeholder"=>"Enter Mobile Number","value"=>set_value('mobile')));

				?>
				<span id="mobile_jquery_error"></span>
			</div>
			<div id="mobile_error" class="text-center"><strong><?php echo form_error('mobile') ?></strong></div>
			<div class="form-group">
				<?php echo form_label('Email Address:','email'), 
						form_input(array("name"=>"email","id"=>"email","class"=>"form-control","placeholder"=>"Enter Email Address","value"=>set_value('email')));

				?>
				<span id="email_jquery_error"></span>
			</div>
			<div id="email_error" class="text-center"><strong><?php echo form_error('email') ?></strong></div>
			<div class="form-group">
				<label for="sques">Security Question:</label>
				<select class="form-control" name="sques" required>
					<option value="" selected disabled>Select Sequrity Question:-
					</option>
					<option value="book">Your Favorite Book Name</option>
					<option value="childhood">Your Childhood Name</option>
					<option value="spouse_meet">Where did You Meet Your Spouse?
					</option>
					<option value="football_palyer">Your Favorite Football Player
					</option>
					<option value="color">Your Favorite Color</option>
				</select>
				<span id="sques_jquery_error"></span>
			</div>
			<div class="form-group">
				<label for="answer">Your Answer:</label>
				<input type="text" name="answer" class="form-control" placeholder="Enter Above Choosen Answer" id="answer" required>
			</div>
			<div class="form-group">
				<?php echo form_label('Upload Avatar:','file'), 
						form_upload(array("name"=>"file","id"=>"file","class"=>"form-control","required"=>"required"));

				?>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6 col-md-6 col-xs-6">
						<?php echo form_submit(array("name"=>"submit","id"=>"submit","class"=>"btn btn-success btn-block","value"=>"Register")); ?>
					</div>
					<div class="col-sm-6 col-md-6 col-xs-6">
						<?php
							echo form_reset(array("class"=>"btn btn-danger btn-block","value"=>"Clear All","id"=>"reset")) ;?>
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
			<p class="text-center"><span><a href="<?php echo base_url('user-login') ?>">HAVE AN ACCOUNT.???</a></span></p>
		</div>
	</div>
</div>


<?php include 'ffooter.php'; ?>
<script type="text/javascript" src="<?php echo base_url("styles/js/registration.js") ?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#uname').focusout(function(){
			var uname = $(this).val();
			if(uname != "")
			{
				$.ajax({
				url: "<?php echo base_url('logincontroller/user_name_check'); ?>",
				type: "POST",
				data: {uname:uname},
					success:function(data){
						if(data === 'ok')
						{
							$('#uname_jquery_error').html('<em style="color:red;">User Name Already Exists.</em>');
							$('#submit,#reset').hide();
						}
						else
						{
							$('#uname_jquery_error').hide();
							$('#submit,#reset').show();
						}
					}
				});
			}
			else
				return false;
		});

		$('#mobile').focusout(function(){
			var mobile = $(this).val();
			if(mobile != "")
			{
				$.ajax({
				url: "<?php echo base_url('logincontroller/mobile_number_check'); ?>",
				type: "POST",
				data: {mobile:mobile},
					success:function(data){
						if(data === 'ok')
						{
							$('#mobile_jquery_error').html('<em style="color:red;">Mobile Number Already Exists.</em>');
							$('#submit,#reset').hide();
						}
						else
						{
							$('#mobile_jquery_error').hide();
							$('#submit,#reset').show();
						}
					}
				});
			}
			else
				return false;
		});

		$('#email').focusout(function(){
			var email = $(this).val();
			if(email != "")
			{
				$.ajax({
				url: "<?php echo base_url('logincontroller/email_addr_check'); ?>",
				type: "POST",
				data: {email:email},
					success:function(data){
						if(data === 'ok')
						{
							$('#email_jquery_error').html('<em style="color:red;">Email Address Already Exists.</em>');
							$('#submit,#reset').hide();
						}
						else
						{
							$('#email_jquery_error').hide();
							$('#submit,#reset').show();
						}
					}
				});
			}
			else
				return false;
		});
	});
</script>