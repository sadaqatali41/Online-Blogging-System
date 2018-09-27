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
				if($user_id)
				{
					$this->session->set_userdata('user_id',$user_id);
					return redirect('welcomecontroller/welcome');
				}
				else
				{
					$this->session->set_flashdata('fail','User Name Or Password May be Incorrect.');
					return redirect('logincontroller');
				}
			}
			else
			{
				$this->load->view('login_view');
			}
		}
	}

?>