$(document).ready(function(){

	var patt=/["!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"]/;

			$('#name_error').hide();
			$('#uname_error').hide();
			$('#password_error').hide();
			$('#mobile_error').hide();
			$('#email_error').hide();

			var name_error = true;
			var uname_error = true;
			var password_error = true;
			var mobile_error = true;
			var email_error = true;

			$('#name').keyup(function(){

				check_name();
			});
			function check_name()
			{
				var name = $('#name').val();
				if(name =="")
				{
					$('#name_error').show();
					$('#name_error').html('Name is <b>Required</b>.');
					$('#name_error').css('color','red');
					name_error = false;
					return false;
				}
				else if(name.length < 5 || name.length > 20)
				{
					$('#name_error').show();
					$('#name_error').html('Name Should be in Between <b>5 & 20</b> Characters.');
					$('#name_error').css('color','red');
					name_error = false;
					return false;
				}
				else
				{
					$('#name_error').hide();
				}
			}
			$('#uname').keyup(function(){

				check_uname();
			});
			function check_uname()
			{
				var uname = $('#uname').val();
				if(uname =="")
				{
					$('#uname_error').show();
					$('#uname_error').html('User Name is <b>Required</b>.');
					$('#uname_error').css('color','red');
					uname_error = false;
					return false;
				}
				else if(uname.length < 6 || name.length > 15)
				{
					$('#uname_error').show();
					$('#uname_error').html('User Name Should be in Between <b>6 & 15</b> Characters.');
					$('#uname_error').css('color','red');
					uname_error = false;
					return false;
				}
				else if(!/[0-9]/.test(uname))
				{
					$('#uname_error').show();
					$('#uname_error').html('Please use <b>One Number[0-9]</b> in User Name.');
					$('#uname_error').css('color','red');
					uname_error = false;
					return false;
				}
				else
				{
					$('#uname_error').hide();
				}
			}
			$('#pwd').keyup(function(){

				check_password();
			});
			function check_password()
			{
				var pwd = $('#pwd').val();
				if(pwd =="")
				{
					$('#password_error').show();
					$('#password_error').html('Password is <b>Required</b>.');
					$('#password_error').css('color','red');
					password_error = false;
					return false;
				}
				else if(pwd.length < 8 || pwd.length > 15)
				{
					$('#password_error').show();
					$('#password_error').html('Password Should be in Between <b>8 & 15</b> Characters.');
					$('#password_error').css('color','red');
					password_error = false;
					return false;
				}
				else if(!patt.test(pwd))
				{
					$('#password_error').show();
					$('#password_error').html("Please use <b>One Special</b> Characters in Password.");
					$('#password_error').css('color','red');
					password_error = false;
					return false;
				}
				else if(!/[0-9]/.test(pwd))
				{
					$('#password_error').show();
					$('#password_error').html('Please use <b>One Number[0-9]</b> in Password.');
					$('#password_error').css('color','red');
					password_error = false;
					return false;
				}
				else if(!/[A-Z]/.test(pwd))
				{
					$('#password_error').show();
					$('#password_error').html("Please use <b>One UPPERCASE Letter</b> in Password.");
					$('#password_error').css('color','red');
					password_error = false;
					return false;
				}
				else if(!/[a-z]/.test(pwd))
				{
					$('#password_error').show();
					$('#password_error').html("Please use <b>One lowecase Letter</b> in Password.");
					$('#password_error').css('color','red');
					password_error = false;
					return false;
				}
				else
				{
					$('#password_error').hide();
				}
			}
			$('#mobile').keyup(function(){

				check_mobile();
			});
			function check_mobile()
			{
				var mobile = $('#mobile').val();
				if(mobile == '')
				{
					$('#mobile_error').show();
					$('#mobile_error').html("Mobile <b>Number</b> is Required.");
					$('#mobile_error').focus();
					$('#mobile_error').css("color","red");
					mobile_error = false;
					return false;
				}
				else if(mobile.length<10 || mobile.length>10)
				{
					$('#mobile_error').show();
					$('#mobile_error').html("Enter Exact <b>10 Digits</b> Mobile Number.");
					$('#mobile_error').focus();
					$('#mobile_error').css("color","red");
					mobile_error = false;
					return false;
				}
				else if(!/[7-9]{1}[0-9]{9}/.test(mobile))
				{
					$('#mobile_error').show();
					$('#mobile_error').html("Invalid <b>Mobile Number</b>.");
					$('#mobile_error').focus();
					$('#mobile_error').css("color","red");
					mobile_error = false;
					return false;
				}
				else
				{
					$('#mobile_error').hide();
				}
			}

			$('#email').keyup(function(){

				check_email();
			});
			function check_email()
			{
				var email_patt = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
				var email = $('#email').val();
				if(email == '')
				{
					$('#email_error').show();
					$('#email_error').html("Email Address is <b>Required</b>.");
					$('#email_error').css("color","red");
					email_error = false;
					return false;
				}
				else if(!email_patt.test(email))
				{
					$('#email_error').show();
					$('#email_error').html("Invalid <b>Email</b> Address");
					$('#email_error').css("color","red");
					email_error = false;
					return false;
				}
				else if(email.length > 40)
				{
					$('#email_error').show();
					$('#email_error').html("Email Address Should Less Than <b>40</b> Characters.");
					$('#email_error').focus();
					$('#email_error').css("color","red");
					email_error = false;
					return false;
				}
				else
				{
					$('#email_error').hide();
				}
			}


			$('#submit').click(function(){

				name_error = true;
				uname_error = true;
				password_error = true;
				mobile_error = true;
				email_error = true;

				check_name();
				check_uname();
				check_password();
				check_mobile();
				check_email();

				if(name_error && uname_error && password_error && mobile_error && email_error)
				{
					return true;
				}
				else
				{
					return false;
				}
			});

});