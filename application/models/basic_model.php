<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basic_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
	
	function savedata($table,$data){
		$this->db->insert($table, $data);
		//echo $this->db->last_query();
		//echo "<br>"; 
		return $this->db->insert_id();
	}
	function dele($table,$id){
		$this->db->delete($table, array('id' => $id));
	}

	function delein($table,$arr){
		$this->db->where_in('id', $arr);
		$this->db->delete($table);
	}

	function customdele($table,$delcond){
		$this->db->delete($table, $delcond);
//		echo $this->db->last_query();
	}
	
	function customupd($table,$upddata,$updcond){
		$this->db->update($table,$upddata,$updcond);
//		echo $this->db->last_query();
	}

	function updatesql($sql){
		$this->db->query($sql);
	}

	function insertupdatedb($data,$tablename,$id=''){
		if ($id!='')
		{
			
			$this->db->where('id', $id);
			$this->db->update($tablename, $data);
			//echo $this->db->last_query();
			return $whmdata['id'];
		}
		else
		{
			$this->db->insert($tablename, $data);
			//echo $this->db->last_query();
			return $this->db->insert_id();
		}
	}

	function getthumbnailqueue(){
		$this->db->order_by('id', 'RANDOM');
		$this->db->limit(20);
		$query = $this->db->get('tblthumbnailqueue');
		return $query->result_array();
	}
}