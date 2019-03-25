<?php  

class Registration extends CI_Model
{
	
	public function user_registration(array $data)
	{
				$this->load->database();
				$this->db->insert('login',$data);
		return $this->db->insert_id();
	}
}
