<?php
	
	class Publicarticlemodel extends CI_Model
	{
		public function fetch_article($limit,$offset)
		{
			$this->load->database();
			$q = $this->db->select('title,body,id')
							->limit($limit,$offset)
							->get('articles');
							return $q->result();
		}
		public function fetch_rows()
		{
			$this->load->database();
			$q = $this->db->select('title,body,id')
							->get('articles');
							return $q->num_rows();
		}
		
	}

?>