<?php 
 
 	class Fetcharticlemodel extends CI_Model
 	{
 		
 		public function fetcharticles($limit,$offset)
 		{
 			$this->load->database();
 			$art = $this->db->where(array('login.id'=>$this->session->userdata('user_id')))
 								->select('*')
 								->from('articles')
 								->limit($limit,$offset)
 								->join('login','articles.id = login.id','inner')
 								->get();
 								return $art->result();
 		}
 		public function fetch_rows()
 		{
 			$this->load->database();
 			$art = $this->db->where(array('id'=>$this->session->userdata('user_id')))
 								->get('articles');
 								return $art->num_rows();
 		}
 		public function find_article($article_id)
 		{
 			$this->load->database();
 			$q = $this->db->where(array('article_id'=>$article_id,'id'=>$this->session->userdata('user_id')))
 						->get('articles');
 						return $q->row();
 		}
 		public function update_article($title,$body,$article_id,$image_path)
 		{
 			$this->load->database();
 			$data = array(
 							'title'=>$title,
 							'body'=>$body,
 							'image_path'=>$image_path,
 						);

 			$q = $this->db->where(array('article_id'=>$article_id,'id'=>$this->session->userdata('user_id')))
 							->update('articles',$data);
 							return $q;
 		}
 		public function update_articles($title,$body,$article_id)
 		{
 			$this->load->database();
 			$data = array(
 							'title'=>$title,
 							'body'=>$body,
 						);

 			$q = $this->db->where(array('article_id'=>$article_id,'id'=>$this->session->userdata('user_id')))
 							->update('articles',$data);
 							return $q;
 		}
 		public function deletearticles($article_id)
 		{
 			$this->load->database();
 			$num_rows = $this->db->where('article_id',$article_id)
 									->get('article_ratings')->num_rows();
 								// echo gettype($num_rows);die;
 			if($num_rows == 0)
 			{
 				$q = $this->db->where(array('article_id'=>$article_id))
 								->delete('articles');
 						return $q;
 			}
 			else
 			{
 				$q = $this->db->where('article_id',$article_id)
 								->delete(array('articles','article_ratings','article_average_ratings'));
 							return $q;
 			}
 		}
 	}

 ?>