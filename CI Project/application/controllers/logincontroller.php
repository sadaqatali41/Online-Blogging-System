<?php
	
	class Logincontroller extends CI_Controller
	{
		public function index()
		{
			if($this->session->userdata('user_id'))
				return redirect('welcomecontroller/welcome');
			$this->load->helper('form');
			$this->load->view('login_view');
		}
		public function logout()
		{
			$this->session->unset_userdata('user_id');
			$this->session->sess_destroy();
		 	redirect('logincontroller','refresh');
		}
		public function publicarticle()
		{
			$this->load->model('publicarticlemodel');
			$this->load->library('pagination');
			$config = array(
						'base_url'		=>base_url('logincontroller/publicarticle'),
						'per_page'		=>5,
						'total_rows'		=>$this->publicarticlemodel->fetch_rows(),
						'full_tag_open'		=>"<ul class='pagination'>",
						'full_tag_close'	=>'</ul>',
						'next_tag_open'		=>'<li>',
						'next_tag_close'	=>'</li>',
						'prev_tag_open'		=>'<li>',
						'prec_tag_close'	=>'</li>',
						'num_tag_open'		=>'<li>',
						'num_tag_close'		=>'</li>',
						'cur_tag_open'		=>"<li class='active'><a>",
						'cur_tag_close'		=>'</a></li>',
			);
			$this->pagination->initialize($config);
			$result = $this->publicarticlemodel->fetch_article($config['per_page'],$this->uri->segment(3));
			$this->load->view('publicarticleview',array('result'=>$result));
		}
	}

?>
