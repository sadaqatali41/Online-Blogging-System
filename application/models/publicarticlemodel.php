<?php
	
	class Publicarticlemodel extends CI_Model
	{
		public function fetch_article($limit,$offset)
		{
			$this->load->database();
			$q = $this->db->select('title,body,name,article_id,image_path')
							->from('articles')
							->limit($limit,$offset)
							->join('login','articles.id = login.id','inner')
							->get();
							return $q->result();
		}
		public function fetch_rows()
		{
			$this->load->database();
			$q = $this->db->select('title,body,id')
							->get('articles');
							return $q->num_rows();
		}

		public function get_details($article_id)
		{
			$this->load->database();
			$q = $this->db->where('article_id',$article_id)
							->get('articles');
							if($q->num_rows()==1)
							{
								return $q->row();
							}
							else
							{
								return false;
							}
		}
		
	}

?>