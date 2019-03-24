<?php

	class Validatedatamodel extends CI_Model
	{
		
		public function validatedata($uname,$pwd)
		{
			$this->load->database();
			$q = $this->db->where(array('uname'=>$uname,'pwd'=>$pwd))
					->get('login');
			if($q->num_rows())
			{
				return $q->row()->id;
			}
			else
			{
				return false;
			}
		}
	}
?>
