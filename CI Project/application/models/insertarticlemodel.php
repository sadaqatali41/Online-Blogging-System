<?php

class Insertarticlemodel extends CI_Model
{
	
	public function insertarticles($title,$body,$user_id,$image_path)
	{
		$this->load->database();
		$data = array('id'=>$user_id,
						'title'=>$title,
						'body'=>$body,
						'image_path'=>$image_path,
					);
		 $q =  $this->db->insert('articles',$data);
							return $q;
	}
}

?>