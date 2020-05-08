<?php

/**
 * 
 */
class Alergi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_alergi');
	}

	public function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_alergi->getAlergi();
		$data['v_content'] = "member/alergi/daftar";
		$this->load->view("member/layout",$data);
	}

	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['detailData'] = $this->m_alergi->getAlergiDetail($id);
		$data['v_content'] = "member/alergi/edit";
		$this->load->view("member/layout" , $data);
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['v_content'] = "member/alergi/add";
		$this->load->view("member/layout" , $data);
	}

	public function doAdd(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'alergi' => $post['name'],
			 );
		$insert = $this->db->insert("tbl_alergi" , $dataArray);
		if($insert){
			$this->m_umum->generatePesan("Success Add data","berhasil");
			redirect('admin/alergi');
		}else{
			$this->m_umum->generatePesan("Failed Add data","gagal");
			redirect('admin/alergi/add');
		}
	}

	public function doEdit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'alergi' => $post['name'],
		);
		$update = $this->db->update("tbl_alergi" , $dataArray, array('alergi_id' => $id ));
		if($update){
			$this->m_umum->generatePesan("Success Update data","berhasil");
			redirect('admin/alergi');
		}else{
			$this->m_umum->generatePesan("Failed Update data","gagal");
			redirect('admin/alergi/edit');
		}
	}

	public function doDelete($id){
		$delete = $this->db->delete("tbl_alergi" , array('alergi_id' => $id ));
		if($delete){
			$this->m_umum->generatePesan("Success Deleted data","berhasil");
			redirect('admin/alergi');
		}else{
			$this->m_umum->generatePesan("Failed Deleted data","gagal");
			redirect('admin/alergi');
		}
	}
}
?>