	
<?php echo anchor('user-login','Login',array('class'=>'btn btn-success pull-right')); ?>
	<div class="login">
		<div class="panel panel-primary">
			<div class="panel-heading text-center"><strong>Forget Password Form
			</strong></div>
			<div class="panel-body">
				<?php echo form_open('forget-password-submit',array('class'=>'form-horizontal')); ?>
				
					<div class="form-group">
						<label class="control-label col-sm-3">Email Address :</label>
						<div class="col-sm-9">
							<?php echo form_input(array('name'=>'email','type'=>'email','placeholder'=>'Enter Email Address','required'=>'required','class'=>'form-control','id'=>'email','value'=>set_value('email'))); ?>
							<span id="email_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Security Question :
						</label>
						<div class="col-sm-9">
							<select class="form-control" name="sques" id="sques" required>
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
							<span id="sques_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Your Answer: </label>
						<div class="col-sm-9">
							<input type="text" name="answer" class="form-control" placeholder="Enter Above Choosen Answer" id="answer" required>
							<span id="answer_error"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-7">
							<?php echo form_submit(array('id'=>'submit','value'=>'Submit','class'=>'btn btn-success disabled')); ?>

							<?php echo  form_reset(array('value'=>'Reset','class'=>'btn btn-danger')); ?>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#email_error').hide();
		$('#sques_error').hide();
		$('#answer_error').hide();
		// var email_success = true;
		// var sques_success = true;
		// var answer_success = true;

		$('#email').keyup(function(){
			var email = $(this).val();
			if(email != "")
			{
				$.ajax({
					url: "<?php echo base_url('email-check-for-forget-password') ?>",
					type: "POST",
					data: {email:email},
					success: function(data)
					{
						if(data == "not")
						{
							$('#email_error').show();
							$('#email_error').html("<em style='color:red;'>Invalid Email Address.</em>");
						}
						else
						{
							$('#email_error').hide();
							$('#sques').change(function(){
								var sques = $(this).val();
								//console.log(email);
								if(sques != "")
								{
									$.ajax({
										url: "<?php echo base_url('check-security-question') ?>",
										type: "POST",
										data: {sques:sques,email:email},
										success: function(data)
										{
											if(data != "ok")
											{
												$('#sques_error').show();
												$('#sques_error').html("<em style='color:red;'>Invalid Security Question.</em>");
											}
											else
											{
												$('#sques_error').hide();
												$('#answer').keyup(function(){
												var answer = $(this).val();
												// console.log(email)+'<br>';
												// console.log(sques);
												if(answer != "")
												{
													$.ajax({
														url: "<?php echo base_url('check-answer') ?>",
														type: "POST",
														data: {answer:answer,email:email,sques:sques},
														success: function(data)
														{
															if(data == "not")
															{
																$('#answer_error').show();
																$('#answer_error').html("<em style='color:red;'>Invalid Answer.</em>");
																$('#submit').addClass('disabled');
															}
															else
															{
																$('#answer_error').hide();
																$('#submit').removeClass('disabled');
															}
														}
													});
												}
											}); 

											}
										}
									});
								}
							});
						}
					}
				});
			}
		});
	});
</script>