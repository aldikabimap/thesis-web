<?php

class M_login extends CI_Model {

    function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->where('u.username', $username);
        $this->db->where('u.password', $password);
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->row();
			$dataArr = array(
				'UserID'    	=> $querycheck->user_id,
				'Username'  	=> $querycheck->username,
				'project_name' 	=> 'Toko Beauty',
				'copyright' 	=> '&copy; 2019',
				'established'	=> '2019'
			);
			$this->session->set_userdata('loginData',$dataArr);
            return true;
        }else{ 
            return false;
        }
	}

	function checkLoginApi($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->where('u.username', $username);
        $this->db->where('u.password', $password);
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->row();
			$dataArr = array(
				'UserID'    	=> $querycheck->user_id,
				'Username'  	=> $querycheck->username,
			);
			return $querycheck;
        }else{ 
            return false;
        }
	}

	public function checkLoginAppsAdmin($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->where('u.username', $username);
        $this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function checkLoginKasirApi($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->where('u.username', $username);
        $this->db->where('u.password', md5($password));
        $this->db->where('u.role', '2');
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->row();
			return $querycheck;
        }else{ 
            return false;
        }
	}

	public function checkLoginAppsKasir($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->where('u.username', $username);
        $this->db->where('password', md5($password));
        $this->db->where('u.role', '2');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getIDlogin($id){
		$this->db->select('*');
		$this->db->from('tbl_login_info');
		$this->db->where('username' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function checkUsername($username){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('username' , $username);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
}
