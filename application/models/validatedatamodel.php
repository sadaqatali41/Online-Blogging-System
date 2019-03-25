<?php

	class Validatedatamodel extends CI_Model
	{
		
		public function validatedata($uname,$pwd)
		{
			$this->load->database();
			$this->db->where(array('uname'=>$uname,'status'=>1));
			$num_rows = $this->db->get('login')->num_rows();
			if($num_rows == 1)
			{
				$q = $this->db->where(array('uname'=>$uname,'pwd'=>$pwd))
							->get('login');
				if($q->num_rows())
				{
					return $q->row();
				}
				else
				{
					return 'wrong';
				}
			}
			else
			{
				return 'not';
			}
		}
	}
?>