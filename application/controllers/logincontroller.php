<?php
	
	class Logincontroller extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			date_default_timezone_set('Asia/kolkata');
			$this->load->database();
		}
		public function index()
		{
			if($this->session->userdata('user_id'))
				return redirect('user-dashboard');

			$this->load->helper('form');
			$this->load->view('login_view');
		}
		public function logout()
		{
			$user_session = array('user_id','name','mobile','email');
			$this->session->unset_userdata($user_session);
			$this->session->sess_destroy();
		 	redirect('user-login','refresh');
		}
		public function publicarticle()
		{
			if($this->session->userdata('user_id'))
				return redirect('user-dashboard');
			
			$this->load->model('publicarticlemodel');
			$this->load->library('pagination');
			$config = array(
						'base_url'			=>base_url('public-articles'),
						'per_page'			=>5,
						'total_rows'		=>$this->publicarticlemodel->fetch_rows(),
						'uri_segment'		=>2,
						'full_tag_open'		=>"<ul class='pagination'>",
						'full_tag_close'	=>'</ul>',
						'first_link'		=>'First',
						'first_tag_open'	=>'<li>',
						'first_tag_close'	=>'</li>',
						'last_link'			=>'Last',
						'last_tag_open'		=>'<li>',
						'last_tag_close'	=>'</li>',
						'next_tag_open'		=>'<li>',
						'next_tag_close'	=>'</li>',
						'prev_tag_open'		=>'<li>',
						'prev_tag_close'	=>'</li>',
						'num_tag_open'		=>'<li>',
						'num_tag_close'		=>'</li>',
						'cur_tag_open'		=>"<li class='active'><a>",
						'cur_tag_close'		=>'</a></li>',
			);
			$this->pagination->initialize($config);
			$result = $this->publicarticlemodel->fetch_article($config['per_page'],$this->uri->segment(2));
			$this->load->view('publicarticleview',array('result'=>$result));

		}

		public function get_single_data($article_id)
		{
			$this->load->model('publicarticlemodel');
			$data = $this->publicarticlemodel->get_details($article_id);
			
			$this->load->view('single_data',compact('data'));
		}
		public function user_registration()
		{
			$this->load->helper('form');
			$this->load->view('user_registration');
		}
		public function receive_data()
		{
			$data = array(

				'name'			=> $this->filter_data($this->input->post('name')),
				'uname'			=> $this->filter_data($this->input->post('uname')),
				'pwd'			=> $this->filter_data($this->input->post('pwd')),
				'mobile'		=> $this->filter_data($this->input->post('mobile')),
				'email'			=> $this->filter_data($this->input->post('email')),
				'sques'			=> $this->filter_data($this->input->post('sques')),
				'answer'		=> $this->filter_data($this->input->post('answer')),
				'created_date'	=> date('Y-m-d H:i:s') 
			);

			$this->load->model('registration');
			$insert_id = $this->registration->user_registration($data);

			if($insert_id > 0)
			{
				$this->session->set_flashdata('user_created','Registration Successfully Done.');
				$this->session->set_flashdata('created','alert alert-success');
			}
			else
			{
				$this->session->set_flashdata('user_created','Sorry! Registration is not Successfully Done. Please Try again');
				$this->session->set_flashdata('created','alert alert-danger');
			}

			$config = array(
					'upload_path'		=> './user-profile/',
					'allowed_types'		=> 'jpg|png|jpeg',
					'file_name'			=> $insert_id.'.jpg',
					'max_size'			=> 0
			);
			$this->load->library('upload',$config);
			if ( !$this->upload->do_upload('file'))
            {
                $error = $this->upload->display_errors();
                echo "<script>
                		alert('".$error."');
                		window.location.href = '".base_url('user-registration')."';
                </script>";

                $this->db->where('id',$insert_id);
                $this->db->delete('login');
                exit;
            }
			return redirect('user-login');
		}

		public function filter_data($data)
		{
			$data = strip_tags($data);
			$data = addslashes($data);
			$data = trim($data);
			return $data;
		}

		public function download($article_id)
		{
			$this->load->helper('download');
			$this->load->database();
			$count = 0;
			$query = "SELECT * FROM articles WHERE article_id = '$article_id'";
			$result = $this->db->query($query)->row();

			if($result->img_count != 0)
				$count = $result->img_count + 1;
			else
				$count++;
			$data = array(
							'img_count'		=>$count,
					);

					$this->db->where('article_id',$article_id);
					$this->db->update('articles',$data);

			$image_name = explode('/', $result->image_path);
			$image_name = trim($image_name[count($image_name)-1]);
			$image_data = file_get_contents('uploads/'.$image_name);
			force_download($image_name,$image_data);
		}

		public function user_name_check()
		{
			$uname = $this->input->post('uname');
						$this->db->where('uname',$uname);
			$num_rows = $this->db->get('login')->num_rows();
			if($num_rows == 1)
				echo 'ok';
			else
				echo "not";
		}

		public function mobile_number_check()
		{
			$mobile = $this->input->post('mobile');
						$this->db->where('mobile',$mobile);
			$num_rows = $this->db->get('login')->num_rows();
			if($num_rows == 1)
				echo 'ok';
			else
				echo "not";
		}

		public function email_addr_check()
		{
			$email = $this->input->post('email');
						$this->db->where('email',$email);
			$num_rows = $this->db->get('login')->num_rows();
			if($num_rows == 1)
				echo 'ok';
			else
				echo "not";
		}

		public function forget_password()
		{
			$this->load->view('hheader');
			$this->load->view('forget-password');
			$this->load->view('ffooter');
		}

		public function forget_password_submit()
		{
			$email = $this->input->post('email');
			$sques = $this->input->post('sques');
			$answer = $this->input->post('answer');
			if(!empty($email) && !empty($sques) && !empty($answer))
			{
				$this->load->view('hheader');
				$this->load->view('password-recovery',array('email'=>$email));
				$this->load->view('ffooter');
			}
			else
				redirect('user-login');
		}

		public function password_recovery_submit()
		{
			$email = $this->input->post('email');
			$data = array(
					'pwd'			=> $this->input->post('pwd'),
					'updated_date'	=> date('Y-m-d H:i:s'),
			);

			$this->db->where('email',$email);
			$this->db->update('login',$data);
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('user_created','<strong>Password Reset Successfully.</strong>');
				$this->session->set_flashdata('created','alert alert-success');
			}
			else
			{
				$this->session->set_flashdata('user_created','<strong>Password not Reset Successfully.</strong>');
				$this->session->set_flashdata('created','alert alert-danger');
			}
			redirect('user-login');
		}

		public function email_check_for_forget_password()
		{
			$email = $this->input->post('email');
			$this->db->where('email',$email);
			$email_count = $this->db->get('login')->num_rows();
			if($email_count == 1)
				echo "ok";
			else
				echo "not";
		}

		public function check_security_question()
		{
			$email = $this->input->post('email');
			$sques = $this->input->post('sques');
			
			$this->db->where('email',$email);
			$this->db->where('sques',$sques);
			$num_rows = $this->db->get('login')->num_rows();
			
			if($num_rows == 1)
				echo "ok";
			else
				echo "not";
		}

		public function check_answer()
		{
			$email = $this->input->post('email');
			$sques = $this->input->post('sques');
			$answer = $this->input->post('answer');

			$this->db->where('email',$email);
			$this->db->where('sques',$sques);
			$this->db->where('answer',$answer);
			$num_rows = $this->db->get('login')->num_rows();

			if($num_rows == 1)
				echo "ok";
			else
				echo "not";
		}
	}

