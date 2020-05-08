<?php

/**
 * 
 */
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_user');
	}

	public function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_user->getUser();
		$data['v_content'] = "member/user/daftar";
		$this->load->view("member/layout",$data);
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['v_content'] = "member/user/add";
		$this->load->view("member/layout" , $data);
	}

	public function wizard(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['v_content'] = "member/user/wizard";
		$this->load->view("member/layout" , $data);
	}

	public function doAdd(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'name' => $post['name'],
			'weight' => $post['weight'],
			'height' => $post['height'],
			'username' => $post['username'],
			'password' => md5($post['password']),
			'alergies'	=> $post['alergies']
			 );
		$insert = $this->db->insert("tbl_user" , $dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/user');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/user/add');
		}
	}

	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['detailData'] = $this->m_user->getUserDetail($id);
		$data['v_content'] = "member/user/edit";
		$this->load->view("member/layout" , $data);
	}

	public function doEdit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'name' => $post['name'],
			'weight' => $post['weight'],
			'height' => $post['height'],
			'username' => $post['username'],
		);
		if (!empty($post['password'])) {
			$dataArray['password'] = md5($post['password']);
		}
		$update = $this->db->update("tbl_user" , $dataArray, array('user_id' => $id ));
		if($update){
			$this->m_umum->generatePesan("Berhasil mengubah data","berhasil");
			redirect('admin/user');
		}else{
			$this->m_umum->generatePesan("Gagal mengubah data","gagal");
			redirect('admin/user/edit');
		}
	}

	public function doDelete($id){
		$delete = $this->db->delete("tbl_user" , array('user_id' => $id ));
		if($delete){
			$this->m_umum->generatePesan("Berhasil menghapus data","berhasil");
			redirect('admin/user');
		}else{
			$this->m_umum->generatePesan("Gagal menghapus data","gagal");
			redirect('admin/user');
		}
	}
}
?>