<?php

/**
 * 
 */
class Lose extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_lose');
	}

	public function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_lose->getLose();
		$data['v_content'] = "member/lose/daftar";
		$this->load->view("member/layout",$data);
	}

	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['detailData'] = $this->m_lose->getLoseDetail($id);
		$data['v_content'] = "member/lose/edit";
		$this->load->view("member/layout" , $data);
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['v_content'] = "member/lose/add";
		$this->load->view("member/layout" , $data);
	}

	public function doAdd(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'lose' => $post['name'],
			 );
		$insert = $this->db->insert("tbl_lose" , $dataArray);
		if($insert){
			$this->m_umum->generatePesan("Success Add data","berhasil");
			redirect('admin/lose');
		}else{
			$this->m_umum->generatePesan("Failed Add data","gagal");
			redirect('admin/lose/add');
		}
	}

	public function doEdit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'lose' => $post['name'],
		);
		$update = $this->db->update("tbl_lose" , $dataArray, array('lose_id' => $id ));
		if($update){
			$this->m_umum->generatePesan("Success Update data","berhasil");
			redirect('admin/lose');
		}else{
			$this->m_umum->generatePesan("Failed Update data","gagal");
			redirect('admin/lose/edit');
		}
	}

	public function doDelete($id){
		$delete = $this->db->delete("tbl_lose" , array('lose_id' => $id ));
		if($delete){
			$this->m_umum->generatePesan("Success Deleted data","berhasil");
			redirect('admin/lose');
		}else{
			$this->m_umum->generatePesan("Failed Deleted data","gagal");
			redirect('admin/lose');
		}
	}
}
?>