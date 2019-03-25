<?php

class Ratingcontroller extends CI_Controller
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

		public function article_list_for_ratings()
		{
			$user_id = $this->session->userdata('user_id');

			$query = "SELECT articles.* ,article_average_ratings.average_rating,article_average_ratings.rating_count,article_average_ratings.total_ratings FROM articles LEFT JOIN article_average_ratings ON article_average_ratings.article_id = articles.article_id WHERE id != '$user_id'";

			$data['result'] = $this->db->query($query)->result();

			$this->load->view('hheader');
			$this->load->view('article_lists',$data);
			$this->load->view('ffooter');
		}

		public function article_photo_rating($article_id)
		{
			$user_id = $this->session->userdata('user_id');
			// check article_id and user_id in article_ratings table start:-
			$query1 = "SELECT * FROM article_ratings WHERE id = '".$user_id."' AND article_id = '".$article_id."'"; 
			$data['article_ratings'] = $this->db->query($query1)->row();
			// ends here

			// getting article average ratings :- start
			$article_average_rating = "SELECT * FROM article_average_ratings WHERE article_id = '$article_id'";
			$data['article_average_rating'] = $this->db->query($article_average_rating)->row();
			// ends here

			// getting particular article info :- start
			$query = "SELECT * FROM articles WHERE article_id = '$article_id'";
			$data['result'] = $this->db->query($query)->row();
			// ends here

			// getting next article information :- start
			$query = "SELECT * FROM articles WHERE article_id = (SELECT MIN(article_id) FROM articles WHERE article_id > '$article_id' AND id != '$user_id')";

			$data['next'] = $this->db->query($query)->row();
			
			$next_count = $this->db->query($query)->num_rows();

			if($next_count == 0)
			{
				$query = "SELECT * FROM articles WHERE article_id = (SELECT MIN(article_id) FROM articles WHERE id != '$user_id')";

				$data['next'] = $this->db->query($query)->row();
			}
			// ends here
			$this->load->view('hheader');
			$this->load->view('article_rating',$data);
			$this->load->view('ffooter');
		}

		public function article_rating_submit()
		{
			$user_id = $this->session->userdata('user_id');
			$article_id = $this->input->post('article_id');
			$rating = $this->input->post('rate');
			$created_date = date('Y-m-d H:i:s');

			$data = array(
				'article_id'		=> $article_id,
				'id'				=> $user_id,
				'ratings'			=> $rating,
				'created_date'		=> $created_date,
			);
			$query = "SELECT * FROM article_ratings WHERE id = '".$user_id."' AND article_id = '".$article_id."'";

			$num_rows = $this->db->query($query)->num_rows();
			if($num_rows == 0)
			{
				$this->db->insert('article_ratings',$data);
				if($this->db->affected_rows() > 0 )
				{
					$this->session->set_flashdata('inserted','Rating Successfully Inserted.');
					$this->session->set_flashdata('inserted_class','alert alert-success');
				}
				else
				{
					$this->session->set_flashdata('inserted','Sorry! Some Problems Occured.');
					$this->session->set_flashdata('inserted_class','alert alert-danger');
				}
			}
			else
			{
				$data = array(
					'ratings'			=> $rating,
					'updated_date'		=> $created_date,
				);

				$this->db->where(array('id'=>$user_id,'article_id'=>$article_id));
				$this->db->update('article_ratings',$data);

				if($this->db->affected_rows() > 0 )
				{
					$this->session->set_flashdata('inserted','Rating Successfully Updated.');
					$this->session->set_flashdata('inserted_class','alert alert-success');
				}
				else
				{
					$this->session->set_flashdata('inserted','Sorry! Rating not Updated.');
					$this->session->set_flashdata('inserted_class','alert alert-danger');
				}
			}
			$total_ratings = 0;
			$query = "SELECT * FROM article_ratings WHERE article_id = '$article_id'";
			$article_counts = $this->db->query($query)->num_rows();
			
			$results = $this->db->query($query)->result();
			if($article_counts > 0)
			{
				foreach($results as $result)
					$total_ratings = $total_ratings + $result->ratings;
			}
			$average_rating = $total_ratings;
			if($article_counts > 1)
			{
				$average_rating = $total_ratings / $article_counts;
			}
			$query = "SELECT * FROM article_average_ratings WHERE article_id = '$article_id'";
			$num_count = $this->db->query($query)->num_rows();
			if($num_count == 0)
			{
				$data = array(
								'article_id'		=> $article_id,
								'average_rating'	=> $average_rating,
								'total_ratings'		=> $total_ratings,
								'rating_count'		=> $article_counts,
								'created_date'		=> date('Y-m-d H:i:s')
							);
				$this->db->insert('article_average_ratings',$data);
			}
			else
			{
				$data = array(
								'average_rating'	=> $average_rating,
								'total_ratings'		=> $total_ratings,
								'rating_count'		=> $article_counts,
								'updated_date'		=> date('Y-m-d H:i:s')
							);

				$this->db->where('article_id',$article_id);
				$this->db->update('article_average_ratings',$data);
			}

			redirect('article-list-for-ratings');
		}

		public function article_rating_details($article_id)
		{
			// getting article rating details :- start
			$query = "SELECT article_ratings.*, login.name, articles.image_path FROM article_ratings LEFT JOIN articles ON articles.article_id = article_ratings.article_id INNER JOIN login ON login.id = article_ratings.id WHERE article_ratings.article_id = '$article_id'";
			$data['rating_details'] = $this->db->query($query)->result();
			// article rating details ends

			$query = "SELECT * FROM article_average_ratings WHERE article_id = '$article_id'";
			$data['article_average_rating'] = $this->db->query($query)->row();

			$this->load->view('hheader');
			$this->load->view('rating_details',$data);
			$this->load->view('ffooter');
		}
}