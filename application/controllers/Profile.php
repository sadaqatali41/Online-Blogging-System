<?php 

class Profile extends CI_Controller
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

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$this->db->where('id',$user_id);
		$data['profile'] = $this->db->get('login')->row();

		$this->load->view('hheader');
		$this->load->view('profile_details',$data);
		$this->load->view('ffooter');
	}

	public function change_profile_picture()
	{
		$this->load->view('hheader');
		$this->load->view('change_profile_picture');
		$this->load->view('ffooter');
	}

	public function profile_picture_submit()
	{
		$user_id = $this->session->userdata('user_id');
		$data = array('updated_date'=>date('Y-m-d H:i:s'));
		
		$config = array(

				'upload_path'		=> './user-profile/',
				'allowed_types'		=> 'png|jpeg|jpg',
				'file_name'			=> $user_id.'.jpg',
				'overwrite'			=> TRUE,
		);

		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('profile'))
		{
			$error = $this->upload->display_errors();
			echo "<script>
					alert('".$error."');
					window.location.href = '".base_url('user-dashboard')."';
			</script>";
			exit;
		}
		$this->db->where('id',$user_id);
		$this->db->update('login',$data);
		if($this->db->affected_rows() > 0)
		{
			echo "<script>
					alert('Profile Picture Changed Successfully.');
					window.location.href = '".base_url('user-dashboard')."';
			</script>";
		}
		else
		{
			echo "<script>
					alert('Profile Picture not Changed Successfully.');
					window.location.href = '".base_url('user-dashboard')."';
			</script>";
		}

	}
}