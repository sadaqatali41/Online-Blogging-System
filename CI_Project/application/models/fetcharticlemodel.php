<?php 
 
 	class Fetcharticlemodel extends CI_Model
 	{
 		
 		public function fetcharticles($limit,$offset)
 		{
 			$this->load->database();
 			$art = $this->db->where(array('id'=>$this->session->userdata('user_id')))
 								->limit($limit,$offset)
 								->get('articles');
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
 		public function deletearticles($article_id)
 		{
 			$this->load->database();
 			$q = $this->db->where(array('article_id'=>$article_id))
 						->delete('articles');
 						return $q;
 		}
 	}

 ?>
