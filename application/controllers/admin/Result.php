<?php

/**
 * 
 */
class Result extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_result');
	}

	public function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_result->getResult();
		$data['v_content'] = "member/result/daftar";
		$this->load->view("member/layout",$data);
	}

	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['detailData'] = $this->m_result->getResultDetail($id);
		$data['plan'] = $this->db->where('id_result',$id)->get('tbl_plan')->result();
		$data['v_content'] = "member/result/edit";
		$this->load->view("member/layout" , $data);
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['v_content'] = "member/result/add";
		$this->load->view("member/layout" , $data);
	}

	public function removePlan($id)
	{
		$this->db->delete('tbl_plan',['plan_id'=>$id]);
	}

	public function doAdd(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'min_height' 	=> $post['min_height'],
			'max_height' 	=> $post['max_height'],
			'min_weight' 	=> $post['min_weight'],
			'max_weight' 	=> $post['max_weight'],
			'alergies' 		=> $post['alergies'],
			'goals'			=> $post['goals'],
			'description'	=> $post['description']
			 );
		$insert = $this->db->insert("tbl_result" , $dataArray);
		if($insert){
			$insert_id = $this->db->insert_id();
			foreach ($post['plan'] as $key => $value) {
				$this->db->insert('tbl_plan',['id_result'=>$insert_id,'plan_name'=>$value]);
			}
			$this->m_umum->generatePesan("Success Add data","berhasil");
			redirect('admin/result');
		}else{
			$this->m_umum->generatePesan("Failed Add data","gagal");
			redirect('admin/result/add');
		}
	}

	public function doEdit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();

		$dataArray = array(
			'min_height' 	=> $post['min_height'],
			'max_height' 	=> $post['max_height'],
			'min_weight' 	=> $post['min_weight'],
			'max_weight' 	=> $post['max_weight'],
			'alergies' 		=> $post['alergies'],
			'goals'			=> $post['goals'],
			'description'	=> $post['description']
		);
		$update = $this->db->update("tbl_result" , $dataArray, array('result_id' => $id ));
		if($update){
			foreach ($post['plan'] as $key => $value) {
				$this->db->insert('tbl_plan',['id_result'=>$id,'plan_name'=>$value]);
			}
			foreach ($post['planEdit'] as $key => $value) {
				$this->db->update('tbl_plan',['plan_name'=>$value],['plan_id'=>$post['planId'][$key]]);
			}
			$this->m_umum->generatePesan("Success Update data","berhasil");
			redirect('admin/result');
		}else{
			$this->m_umum->generatePesan("Failed Update data","gagal");
			redirect('admin/result/edit');
		}
	}

	public function doDelete($id){
		$delete = $this->db->delete("tbl_result" , array('result_id' => $id ));
		if($delete){
			$this->m_umum->generatePesan("Success Deleted data","berhasil");
			redirect('admin/result');
		}else{
			$this->m_umum->generatePesan("Failed Deleted data","gagal");
			redirect('admin/result');
		}
	}
}
?>