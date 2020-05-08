<?php
/**
 * 
 */
class M_lose extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getLose(){
		$this->db->select('*');
		$this->db->from('tbl_lose');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getLoseDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_lose');
		$this->db->where('lose_id' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}

?>