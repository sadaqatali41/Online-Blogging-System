<?php
	
	class Receivedatacontroller extends CI_Controller
	{
		
		public function receivedata()
		{
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");

			if($this->form_validation->run('admin_login'))
			{
				$uname = $this->input->post('uname');
				$pwd = $this->input->post('pwd');
				$this->load->model('validatedatamodel');
				$user_id = $this->validatedatamodel->validatedata($uname,$pwd);

				if($user_id === 'not')
				{
					$this->session->set_flashdata('fail','Your Account is De-activated, Please Contact to Admin. <em>+91-8960962290</em>');
					return redirect('user-login');
				}
				elseif($user_id === 'wrong')
				{
					$this->session->set_flashdata('fail','User Name Or Password May be Incorrect.');
					return redirect('user-login');
				}
				elseif(!empty($user_id))
				{
					$user_session = array(
								'user_id'		=> $user_id->id,
								'name'			=> $user_id->name,
								'mobile'		=> $user_id->mobile,
								'email'			=> $user_id->email
					);
					$this->session->set_userdata($user_session);
					return redirect('user-dashboard');
				}
			}
			else
			{
				$this->load->view('login_view');
			}
		}
	}

?>