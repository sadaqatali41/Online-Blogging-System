<?php

	class Welcomecontroller extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
			$this->output->set_header("Pragma: no-cache");
			if(!$this->session->userdata('user_id'))
				return redirect('logincontroller');
		}	
		public function welcome()
		{
			$this->load->model('fetcharticlemodel');
			$this->load->library('pagination');
			$config = array(
						'base_url'   		=> base_url('welcomecontroller/welcome'),
						'per_page'   		=> 5,
						'total_rows' 		=> $this->fetcharticlemodel->fetch_rows(),
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
			$articles = $this->fetcharticlemodel->fetcharticles($config['per_page'],$this->uri->segment(3));
			$this->load->view('welcomeview',array('articles'=>$articles));
		}
		public function addarticles()
		{
			$this->load->helper('form');
			$this->load->view('addarticlesview');
		}
		public function receiveaddarticles()
		{
			$config = array(
						'upload_path'	=>'./uploads/',
						'allowed_types'	=>'gif|jpg|png|jpeg'

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
				return redirect('welcomecontroller/welcome');
			}
			else
			{
				$upload_error = $this->upload->display_errors();
				$this->load->view('addarticlesview',array('upload_error'=>$upload_error));
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
			$config = array(
						'upload_path'	=>'./uploads',
						'allowed_types'	=>'gif|jpg|png|jpeg'

			);
			$this->load->library('upload',$config);
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
			if($this->form_validation->run('add_article_rules') && $this->upload->do_upload('image'))
			{
				$title = $this->input->post('title');
				$body = $this->input->post('body');
				$article_id = $this->input->post('article_id');
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
				return redirect('welcomecontroller/welcome');
			}
			else
			{
				$upload_error = $this->upload->display_errors();
				$this->session->set_flashdata('upload_error',$upload_error);
				return redirect('welcomecontroller/welcome');
			}
		}
		public function delete_articles($article_id)
		{
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
			return redirect('welcomecontroller/welcome');
		}
		
	}

?>
