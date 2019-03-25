<?php 
class User_details extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		date_default_timezone_set('Asia/kolkata');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		$this->output->set_header("Pragma: no-cache");
		if(!$this->session->userdata('user_id'))
			return redirect('user-login');
	}

	public function user_registration_details()
	{
		$this->load->library('pagination');
			$config = array(
						'base_url'   		=> base_url('user-registration-details'),
						'per_page'   		=> 5,
						'total_rows' 		=> $this->db->get('login')->num_rows(),
						'uri_segment'		=>2,
						'full_tag_open'		=>"<ul class='pagination'>",
						'full_tag_close'	=>'</ul>',
						'next_tag_open'		=>'<li>',
						'next_tag_close'	=>'</li>',
						'prev_tag_open'		=>'<li>',
						'prev_tag_close'	=>'</li>',
						'num_tag_open'		=>'<li>',
						'num_tag_close'		=>'</li>',
						'cur_tag_open'		=>"<li class='active'><a>",
						'cur_tag_close'		=>'</a></li>'

			);

			$this->pagination->initialize($config);

		$this->db->limit($config['per_page'],$this->uri->segment(2));

		$data['details'] = $this->db->get('login')->result();
		$this->load->view('hheader');
		$this->load->view('user_registration_details',$data);
		$this->load->view('ffooter');
	}

	public function view_user_details($user_id)
	{
		$this->db->select('login.*, COUNT(articles.id) as article_counts');
		$this->db->from('login');
		$this->db->join('articles','login.id = articles.id','left');
		$this->db->where('login.id',$user_id);
		$data['details'] = $this->db->get()->row();

		if(count($data['details']) > 0)
		{
			$this->load->view('hheader');
			$this->load->view('view_user_details',$data);
			$this->load->view('ffooter');
		}
		else
			redirect('user-dashboard');
	}

	public function edit_user_details($user_id)
	{
		$this->db->where('id',$user_id);
		$data['details'] = $this->db->get('login')->row();

		if(count($data['details']) > 0)
		{
			$this->load->view('hheader');
			$this->load->view('edit_user_details',$data);
			$this->load->view('ffooter');
		}
		else
			redirect('user-dashboard');
	}

	public function user_details_submit($user_id)
	{
		$data = array(
				'name'			=> $this->filter_data($this->input->post('name')),
				'uname'			=> $this->filter_data($this->input->post('uname')),
				'pwd'			=> $this->filter_data($this->input->post('pwd')),
				'mobile'		=> $this->filter_data($this->input->post('mobile')),
				'email'			=> $this->filter_data($this->input->post('email')),
				'sques'			=> $this->filter_data($this->input->post('sques')),
				'answer'		=> $this->filter_data($this->input->post('answer')),
				'created_date'	=> $this->filter_data($this->input->post('created_date')).' '.date('H:i:s'),
				'updated_date'	=> date('Y-m-d H:i:s'),
		);

		$this->db->where('id',$user_id);
		$this->db->update('login',$data);
		if($this->db->affected_rows() > 0 )
		{
			echo "<script>
					alert('Records Updated Successfully.');
					window.location.href = '".base_url('edit-user-details/'.$user_id)."';
			</script>";
		}
		else
		{
			echo "<script>
					alert('Records not Updated Successfully.');
					window.location.href = '".base_url('edit-user-details/'.$user_id)."';
			</script>";
		}
	}

	public function filter_data($data)
	{
		$data = strip_tags($data);
		$data = addslashes($data);
		$data = trim($data);
		return $data;
	}

	public function change_user_profile($user_id)
	{
		$data['user_id'] = $user_id;

		$this->load->view('hheader');
		$this->load->view('change_user_profile',$data);
		$this->load->view('ffooter');
	}

	public function change_user_profile_submit($user_id)
	{
		$config = array(
				'upload_path'		=> './user-profile/',
				'allowed_types'		=> 'jpg|jpeg|png',
				'file_name'			=> $user_id.'.jpg',
				'overwrite'			=> TRUE,			
		);

		$data['updated_date'] = date('Y-m-d H:i:s');
		$this->db->where('id',$user_id);
		$this->db->update('login',$data);

		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('file'))
		{
			$error = $this->upload->display_errors();

			echo "<script>
					alert('".$error."');
					window.location.href = '".base_url('edit-user-details/'.$user_id)."';
			</script>";
		}
		else
		{
			echo "<script>
					alert('Profile Updated Successfully.');
					window.location.href = '".base_url('edit-user-details/'.$user_id)."';
			</script>";
		}

	}

	public function delete_user_details($user_id)
	{
		$array = array(1,3);
		if(in_array($user_id, $array))
		{
			echo "<script>
						alert('Sorry! You can not Delete the Admin.');
						window.location.href = '".base_url('user-registration-details')."';
				</script>";
		}
		else
		{
			$this->db->where('id',$user_id);
			$records = $this->db->get('article_ratings')->result();
			if(count($id) > 0 )
			{
				$total_ratings = 0;
				foreach($records as $row)
				{
					// deleting id and artilce_id from article_ratings
					$this->db->where(array('article_id'=>$row->article_id,'id'=>$row->id));
					$this->db->delete('article_ratings');
					// deletion is done for id and article_id

					// getting data from article_ratings by article_id

					$this->db->where('article_id',$row->article_id);
					$datas = $this->db->get('article_ratings')->result();
					foreach($datas as $data)
						$total_ratings += $data->ratings; 

					$average_rating = $total_ratings;
					$article_counts = count($datas);
					if($article_counts > 1 )
					{
						$average_rating = ($total_ratings / $article_counts);
					}
					// getting data from article_ratings is done

					// now update the article_average_ratings table by article_id
					$updated_data = array(
						'average_rating'		=> $average_rating,
						'rating_count'			=> $article_counts,
						'total_ratings'			=> $total_ratings,
					);
					$this->db->where('article_id',$row->article_id);
					$this->db->update('article_average_ratings',$updated_data);
					// ends updation here
				}
				// now delete the user from login and articles tables
					$this->db->where('id',$user_id);
					$rs = $this->db->delete(array('articles','login'));
					if($rs)
						$this->delete_success();
					else
						$this->delete_not_success();
				// end deletion from login and articles tables
			}
			else
			{
				$this->db->where('id',$user_id);
				$num_rows = $this->db->get('articles')->num_rows();
				if($num_rows > 0 )
				{
					$this->db->where('id',$user_id);
					$rs = $this->db->delete(array('articles','login'));
					if($rs)
						$this->delete_success();
					else
						$this->delete_not_success();
				}
				else
				{
					$this->db->where('id',$user_id);
					$rs = $this->db->delete('login');
					if($rs)
						$this->delete_success();
					else
						$this->delete_not_success();
				}
			}
		}
		$this->db->where('id',$user_id);
		$articles = $this->db->get('articles')->result();
		foreach($articles as $article)
		{
			$num_rows = $this->db->where('article_id',$article->article_id)->get('article_average_ratings')->num_rows();
			if($num_rows > 0)
			{
				$this->db->where('article_id',$article->article_id);
				$this->db->delete(array('article_average_ratings','article_ratings'));
			}
		}
	}
	public function delete_success()
	{
		echo "<script>
				alert('User Deleted Successfully.');
				window.location.href = '".base_url('user-registration-details')."';
			</script>";
	}
	public function delete_not_success()
	{
		echo "<script>
				alert('Sorry! User not Deleted Successfully.');
				window.location.href = '".base_url('user-registration-details')."';
			</script>";
	}

	public function view_user_articles($user_id)
	{
		$data['user_id'] = $user_id;
		$this->load->library('pagination');
			$config = array(
						'base_url'   		=> base_url('view-user-articles/'.$user_id),
						'per_page'   		=> 5,
						'total_rows' 		=> $this->db->where('id',$user_id)->get('articles')->num_rows(),
						'uri_segment'		=>3,
						'full_tag_open'		=>"<ul class='pagination'>",
						'full_tag_close'	=>'</ul>',
						'next_tag_open'		=>'<li>',
						'next_tag_close'	=>'</li>',
						'prev_tag_open'		=>'<li>',
						'prev_tag_close'	=>'</li>',
						'num_tag_open'		=>'<li>',
						'num_tag_close'		=>'</li>',
						'cur_tag_open'		=>"<li class='active'><a>",
						'cur_tag_close'		=>'</a></li>'

			);
			$this->pagination->initialize($config);
			
		$this->db->where('id',$user_id);
		$this->db->limit($config['per_page'],$this->uri->segment(3));
		$data['details'] = $this->db->get('articles')->result();

		$this->load->view('hheader');
		$this->load->view('view_user_articles',$data);
		$this->load->view('ffooter');
	}

	public function edit_user_article($article_id)
	{
		$this->db->where('article_id',$article_id);
		$data['details'] = $this->db->get('articles')->row();

		if(count($data['details']) > 0 )
		{
			$this->load->view('hheader');
			$this->load->view('admin_edit_user_articles',$data);
			$this->load->view('ffooter');
		}
		else
			redirect('user-dashboard');
	}

	public function edit_article_submit($article_id)
	{
		$user_id = $this->input->post('user_id');
		$data = array(
			'title'			=> $this->input->post('title'),
			'body'			=> $this->input->post('body'),
			'created_date'	=> date('Y-m-d H:i:s')
		);

		if(!empty($_FILES['file']['name']))
		{
			$config = array(
				'upload_path'		=> './uploads/',
				'allowed_types'		=> 'jpg|jpeg|png',
				'overwrite'			=> TRUE
			);

			$this->load->library('upload',$config);
			if($this->upload->do_upload('file'))
			{
				$file = $this->upload->data();
				$data['image_path'] = base_url('uploads/'.$file['raw_name'].$file['file_ext']);
			}
			else
			{
				$error = $this->upload->display_errors();

				echo "<script>
						alert('".$error."');
						window.location.href = '".base_url('edit-user-article/'.$article_id)."';
				</script>";
			}
		}
		
		$this->db->where('article_id',$article_id);
		$this->db->where('id',$user_id);
		$this->db->update('articles',$data);
		if($this->db->affected_rows() > 0 )
		{
			echo "<script>
						alert('Article Updated Successfully.');
						window.location.href = '".base_url('edit-user-article/'.$article_id)."';
				</script>";
		}
		else
		{
			echo "<script>
						alert('Article not Updated Successfully.');
						window.location.href = '".base_url('edit-user-article/'.$article_id)."';
				</script>";
		}
	}

	public function delete_user_article($article_id,$id)
	{
		$this->db->where('article_id',$article_id);
		$num_rows = $this->db->get('article_ratings')->num_rows();
		if($num_rows > 0 )
		{
			$this->db->where('article_id',$article_id);
			$rs = $this->db->delete(array('articles','article_ratings','article_average_ratings'));
		}
		else
		{
			$this->db->where('article_id',$article_id);
			$rs = $this->db->delete('articles');
		}
		if($rs)
		{
			echo "<script>
						alert('Article Deleted Successfully.');
						window.location.href = '".base_url('view-user-articles/'.$id)."';
				</script>";
		}
		else
		{
			echo "<script>
						alert('Article not Deleted Successfully.');
						window.location.href = '".base_url('view-user-articles/'.$id)."';
				</script>";
		}
	}

	public function user_registration_chart()
	{
		$months = array(
			'January','February','March','April','May','June','July','August','September','October','November','December'
		);

		for($i = 0; $i <= 11; $i++)
		{
			$query = "SELECT COUNT(*) AS month FROM login WHERE MONTHNAME(created_date) = '".$months[$i]."' AND YEAR(created_date) = '2019'";
			$data[$months[$i]] = $this->db->query($query)->row();
		}

		$days = Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
		//$current_month = date('Y-m-d');

		for($i = 0; $i <= 30; $i++)
		{
			$query = "SELECT COUNT(*) AS day_wise FROM login WHERE DAY(created_date) = '".$days[$i]."' AND MONTH(CURRENT_DATE()) = MONTH(created_date) AND YEAR(created_date) = '2019'";
			$day[$days[$i]] = $this->db->query($query)->row();
		}
		$data['result'] = $day;
		// echo "<pre>";
		// print_r($data);die;
		$this->load->view('hheader');
		$this->load->view('user_registration_chart',$data);
		$this->load->view('ffooter');
	}

	public function user_article_chart()
	{
		$this->db->select('articles.title, login.id,login.name, COUNT(articles.id) as NOA');
		$this->db->from('articles');
		$this->db->join('login','login.id = articles.id','right');
		$this->db->group_by('login.id');
		$data['result'] = $this->db->get()->result();
		// echo "<pre>";
		// print_r($data);die;

		$this->load->view('hheader');
		$this->load->view('user_article_chart',$data);
		$this->load->view('ffooter');
	}

	public function user_article_list()
	{
		$this->load->library('pagination');
			$config = array(
						'base_url'   		=>base_url('user-article-list'),
						'per_page'   		=>6,
						'total_rows' 		=>$this->db->get('articles')->num_rows(),
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

			$this->db->limit($config['per_page'],$this->uri->segment(2));
		$data['articles'] = $this->db->get('articles')->result();
		$this->load->view('hheader');
		$this->load->view('user_article_list',$data);
		$this->load->view('ffooter');
	}

	public function article_average_rating_chart()
	{
		$this->db->select('articles.*, article_average_ratings.average_rating');
		$this->db->from('articles');
		$this->db->join('article_average_ratings','article_average_ratings.article_id = articles.article_id','left');
		$data['average_ratings'] = $this->db->get()->result();

		$this->load->view('hheader');
		$this->load->view('article_average_rating_chart',$data);
		$this->load->view('ffooter');
	}

	public function change_user_status()
	{
		$id = $this->input->post('user_id');
		$status = $this->input->post('user_status');
		if(isset($id) && isset($status))
		{
			$array = array(1,3);
			if(in_array($id, $array))
			{
				echo "not";
			}
			else
			{
				if($status == 1)
				$status = 0;
				else
					$status = 1;

				$data = array(
					'status'		=> $status,
					'updated_date'	=> date('Y-m-d H:i:s'),
				);

				$this->db->where('id',$id);
				$this->db->update('login',$data);

				if($this->db->affected_rows() > 0 )
				{
					echo "<p class='alert alert-success text-center'><strong><em>Status is Changed Successfully.</em></strong></p>";
				}
				else
				{
					echo "<p class='alert alert-danger text-center'><strong><em>Status is not Changed Successfully.</em></strong></p>";
				}
			}
		}
	}

	public function view_article_gallery($id)
	{
		$data['articles_gallery'] = $this->db->where('id',$id)->get('articles')->result();
		$this->load->view('hheader');
		$this->load->view('view_article_gallery',$data);
		$this->load->view('ffooter');
	}

	public function user_overview()
	{
		$this->load->helper('directory');
		$data['view_files'] = count(directory_map('./application/views/'));
		$data['users'] = $this->db->get('login')->num_rows();
		$data['articles'] = $this->db->get('articles')->num_rows();
		$data['user_story'] = $this->db->get('story')->num_rows();
		$this->load->view('hheader');
		$this->load->view('user_overview',$data);
		$this->load->view('ffooter');
	}

	public function all_user_story()
	{
		$this->db->select('story.*, login.id, login.name');
		$this->db->from('story');
		$this->db->join('login','login.id = story.user_id','left');
		$data['stories'] = $this->db->get()->result();
	
		$this->load->view('hheader');
		$this->load->view('all_user_story',$data);
		$this->load->view('ffooter');
	}
}