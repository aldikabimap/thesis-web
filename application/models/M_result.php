<?php
/**
 * 
 */
class M_result extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getResult(){
		$this->db->select('*');
		$this->db->from('tbl_result');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getResultWhere($data){
		$this->db->select('*');
		$this->db->from('tbl_result');
		$this->db->where('min_height <=',$data['height']);
		$this->db->where('max_height >=',$data['height']);
		$this->db->where('min_weight <=',$data['weight']);
		$this->db->where('max_weight >=',$data['weight']);
		// $this->db->where('alergies',$data['alergies']);
		$this->db->where('goals',$data['lose_goals']);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getResultDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_result');
		$this->db->where('result_id' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}

?>