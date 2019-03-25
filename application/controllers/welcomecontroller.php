<?php

	class Welcomecontroller extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
			$this->output->set_header("Pragma: no-cache");
			if(!$this->session->userdata('user_id'))
				return redirect('user-login');
		}
		
		public function welcome()
		{
			$this->load->model('fetcharticlemodel');
			$this->load->library('pagination');
			$config = array(
						'base_url'   		=> base_url('user-dashboard'),
						'per_page'   		=> 5,
						'total_rows' 		=> $this->fetcharticlemodel->fetch_rows(),
						'uri_segment'		=>2,
						'full_tag_open'		=>"<ul class='pagination'>",
						'full_tag_close'	=>'</ul>',
						'next_tag_open'		=>'<li>',
						'next_tag_close'	=>'</li>',
						'prev_tag_open'		=>'<li>',
						'prec_tag_close'	=>'</li>',
						'num_tag_open'		=>'<li>',
						'num_tag_close'		=>'</li>',
						'cur_tag_open'		=>"<li class='active'><a>",
						'cur_tag_close'		=>'</a></li>'

			);
			$this->pagination->initialize($config);
			$articles = $this->fetcharticlemodel->fetcharticles($config['per_page'],$this->uri->segment(2));

			$this->load->view('welcomeview',array('articles'=>$articles));
		}
		public function addarticles()
		{
			$this->load->helper('form');
			$this->load->view('hheader');
			$this->load->view('addarticlesview');
			$this->load->view('ffooter');
		}
		public function receiveaddarticles()
		{
			// echo "coming";
			// die;
			$config = array(
						'upload_path'	=>'./uploads',
						'allowed_types'	=>'jpg|png|jpeg'

			);
			$this->load->library('upload',$config);
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");

			if($this->form_validation->run('add_article_rules') && $this->upload->do_upload('image'))
			{
				$title = $this->input->post('title');
				$body = $this->input->post('body');
				$user_id = $this->input->post('user_id');
				$data = $this->upload->data();
				$image_path = base_url('uploads/'.$data['raw_name'].$data['file_ext']);

				$this->load->model('insertarticlemodel');
				if($this->insertarticlemodel->insertarticles($title,$body,$user_id,$image_path))
				{
					$this->session->set_flashdata('feedback',"Article Added Successfully");
					$this->session->set_flashdata('feedback_class',"alert-success");
				}
				else
				{
					$this->session->set_flashdata('feedback',"Sorry! Failed to add Articles.");
					$this->session->set_flashdata('feedback_class',"alert-danger");
				}
				return redirect('user-dashboard');
			}
			else
			{
				$upload_error = $this->upload->display_errors();
				$this->load->helper('form');
				$this->load->view('hheader');
				$this->load->view('addarticlesview',array('upload_error'=>$upload_error));
				$this->load->view('ffooter');
			}
		}
		public function edit_articles($article_id)
		{
			$this->load->model('fetcharticlemodel');
			$article = $this->fetcharticlemodel->find_article($article_id);
			$this->load->view('editarticleview',array('article'=>$article));
		}
		public function updatearticles()
		{
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
			$title = $this->input->post('title');
			$body = $this->input->post('body');
			$article_id = $this->input->post('article_id');

			if(!empty($_FILES['image']['name']))
			{
				$config = array(
						'upload_path'	=>'./uploads',
						'allowed_types'	=>'gif|jpg|png|jpeg'

					);
				$this->load->library('upload',$config);
				
				if($this->form_validation->run('add_article_rules') && $this->upload->do_upload('image'))
				{
					$data = $this->upload->data();
					$image_path = base_url('uploads/'.$data['raw_name'].$data['file_ext']);
					$this->load->model('fetcharticlemodel');
					if($this->fetcharticlemodel->update_article($title,$body,$article_id,$image_path))
					{
					$this->session->set_flashdata('update',"Article Updated Successfully.");
					$this->session->set_flashdata('feedback_class',"alert-success");
					}
					else
					{
					$this->session->set_flashdata('update',"Sorry! Failed to Update Articles.");
					$this->session->set_flashdata('feedback_class',"alert-danger");
					}
				}
				else
				{
					$upload_error = $this->upload->display_errors();
					$this->session->set_flashdata('upload_error',$upload_error);
				}
			}
			else
			{
				if($this->form_validation->run('add_article_rules'))
				{
					$this->load->model('fetcharticlemodel');
					if($this->fetcharticlemodel->update_articles($title,$body,$article_id))
					{
					$this->session->set_flashdata('update',"Article Updated Successfully.");
					$this->session->set_flashdata('feedback_class',"alert-success");
					}
					else
					{
					$this->session->set_flashdata('update',"Sorry! Failed to Update Articles.");
					$this->session->set_flashdata('feedback_class',"alert-danger");
					}
				}
			}
			return redirect('user-dashboard');
		}
		public function delete_articles($article_id)
		{
			$query = "SELECT * FROM articles WHERE article_id = '$article_id'";
			$result = $this->db->query($query)->row();
			$image_path = explode('/', $result->image_path);
			$image_name = trim($image_path[count($image_path)-1]);
			
			// unlink(FCPATH."uploads/".$image_name);

			$this->load->model('fetcharticlemodel');
			if($this->fetcharticlemodel->deletearticles($article_id))
			{
				$this->session->set_flashdata('delete',"Article Deleted Successfully.");
				$this->session->set_flashdata('feedback_class',"alert-success");
			}
			else
			{
				$this->session->set_flashdata('delete',"Sorry! Failed to Delete The Articles.");
				$this->session->set_flashdata('feedback_class',"alert-danger");
			}
			return redirect('user-dashboard');
		}
		
		public function download_photo($article_id)
		{
			$this->load->helper('download');
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

		public function your_story()
		{
			$user_id = $this->session->userdata('user_id');

			$query = "SELECT * FROM story WHERE user_id = '$user_id'";
			$res['story_data'] = $this->db->query($query)->row();

			$this->load->view('hheader');
			$this->load->view('story',$res);
			$this->load->view('ffooter');
		}

		public function story_submit()
		{
			$user_id = $this->session->userdata('user_id');

			$query = "SELECT * FROM story WHERE user_id = '$user_id'";
			$num_row = $this->db->query($query)->num_rows();

			if($num_row == 1)
			{
				$data = array(
					'story'		=> trim(strip_tags($this->input->post('story')))
				);
				$this->db->where('user_id',$user_id);
				$this->db->update('story',$data);
			}
			else
			{
				$data = array(
					'user_id'	=> $this->session->userdata('user_id'),
					'story'		=> trim(strip_tags($this->input->post('story'))),
				);
				$this->db->insert('story',$data);
			}

			if($this->db->affected_rows() > 0 )
			{
				$this->session->set_flashdata('story',"Story Updated Successfully.");
				$this->session->set_flashdata('feedback_class',"alert-success");
			}
			else
			{
				$this->session->set_flashdata('story',"Story not Updated.");
				$this->session->set_flashdata('feedback_class',"alert-danger");
			}
			redirect('your-story');
		}

		public function change_password()
		{
			$user_id = $this->session->userdata('user_id');

			$this->db->where('id',$user_id);
			$data['result'] = $this->db->get('login')->row();

			$this->load->view('hheader');
			$this->load->view('change_password',$data);
			$this->load->view('ffooter');
		}

		public function change_pwd_submit()
		{
			$pass_count = 0;

			$user_id = $this->session->userdata('user_id');
			$old_pwd = $this->input->post('old_pwd');
			$new_pwd = $this->input->post('new_pwd');
			$con_pwd = $this->input->post('con_pwd');

			$query = "SELECT * FROM login WHERE id = '$user_id'";
			$result = $this->db->query($query)->row();

			if($old_pwd != $result->pwd)
			{
				$this->session->set_flashdata('error',"Old Password is Wrong.");
				$this->session->set_flashdata('error_class',"alert-danger");
			}
			else
			{
				if($new_pwd != $con_pwd)
				{
					$this->session->set_flashdata('error',"New Password & Confirm Password is Missmatched.");
					$this->session->set_flashdata('error_class',"alert-danger");
				}
				elseif($new_pwd == $result->pwd)
				{
					$this->session->set_flashdata('error',"Old Password & New Password can't be Same.");
					$this->session->set_flashdata('error_class',"alert-danger");
				}
				else
				{
					if($result->pwd_count != 0)
						$pass_count = $result->pwd_count + 1;
					else
						$pass_count++;

					$data = array(
							'pwd'			=>$new_pwd,
							'pwd_count'		=>$pass_count,
					);
					$this->db->where('id',$user_id);
					$this->db->update('login',$data);

					if($this->db->affected_rows() > 0 )
					{
						$this->session->set_flashdata('error',"Password Updated Successfully.");
						$this->session->set_flashdata('error_class',"alert-success");
					}
					else
					{
						$this->session->set_flashdata('error',"Password not Updated Successfully.");
						$this->session->set_flashdata('error_class',"alert-danger");
					}
				}
			}
			redirect('change-password');
		}

		public function print_pdf($article_id)
		{
			$query = "SELECT * FROM articles WHERE article_id = '$article_id'";
			$data['result'] = $this->db->query($query)->row();

			$this->load->view('hheader');
			$this->load->view('pdf_view',$data);
			$this->load->view('ffooter');
		}
	}

?>