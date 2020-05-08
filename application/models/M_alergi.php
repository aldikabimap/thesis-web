<?php
/**
 * 
 */
class M_alergi extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAlergi(){
		$this->db->select('*');
		$this->db->from('tbl_alergi');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getAlergiDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_alergi');
		$this->db->where('alergi_id' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}

?>