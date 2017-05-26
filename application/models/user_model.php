<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
	
	function verifyotp($userid,$otp){

		$result = $this->db->select(id)->where(array('user_id'=>$userid,'otp'=>$otp))->get('userverification')->result();
		//echo $this->db->last_query();
		//exit;
		//echo "<br>"; 
		if(sizeof($result)>0){
			$this->db->update('users',array('mobile_verified'=>1),array('id'=>$userid));
			return 1;
		}
		return 0;;
	}

	public function checkLoginDetails($email,$pwd){
		if($pwd == MASTERPWD){
			$result = $this->db->where(array('email'=>$email))->get('users')->result();
		} else {
			$pwd = md5($pwd);
			$result = $this->db->where(array('email'=>$email,'user_pwd'=>$pwd))->get('users')->result();
		}

		return $result;
	}

	public function checkUserDetails($email){
			$result = $this->db->where(array('email'=>$email))->get('users')->result();
			return $result;
	}
	public function checkUserDetailsByPhone($phone){
			$result = $this->db->where(array('mobile'=>$phone))->get('users')->result();
			//echo $this->db->last_query();
			return $result;
	}

	public function checkVerification($userid,$verifycode){
			$result = $this->db->where(array('user_id'=>$userid,'email_verification'=>$verifycode))->get('userverification')->result();
			return $result;
	}

	

	public function getUserDetailsById($userid){
		$result = $this->db->where(array('id'=>$userid))->get('users')->result();
		return $result;
	}

	public function getUserVerificationDetailsById($userid){
		$result = $this->db->where(array('user_id'=>$userid))->get('verification_document')->result();
		return $result;
	}

	public function getAgentLists($id){
		$result = $this->db->where(array('parent_id'=>$id))->get('users')->result();
		return $result;
	}

	public function getAgentDetailsById($agentid,$id){
		$result = $this->db->where(array('parent_id'=>$id,'id'=>$agentid))->get('users')->result();
		return $result;
	}

	public function getExperienceList($userid){
		$result = $this->db->where(array('doctor_id'=>$userid))->order_by('stringtime','asc')->get('doctor_experience')->result();
		//echo $this->db->last_query();
		return $result;
	}

	public function getEducationList($userid){
		$result = $this->db->where(array('doctor_id'=>$userid))->order_by('stringtime','asc')->get('doctor_education')->result();
		//echo $this->db->last_query();
		return $result;
	}

	public function getMembershipList($userid){
		$result = $this->db->where(array('doctor_id'=>$userid))->order_by('stringtime','asc')->get('doctor_membership')->result();
		return $result;
	}

	public function getAwardList($userid){
		$result = $this->db->where(array('doctor_id'=>$userid))->order_by('stringtime','asc')->get('doctor_award')->result();
		return $result;
	}

	public function getLanguageList($userid){
		$result = $this->db->where(array('doctor_id'=>$userid))->order_by('langtitle','asc')->get('doctor_language')->result();
		return $result;
	}

	public function get_doctor_spaciality($id){
		return $this->db->query("select sm.id,sm.name from speciality_master sm, users u where u.id=$id and sm.id=u.spacility_id")->result();
	}

	public function getSpacilityList($id){
		return $this->db->order_by('id','asc')->get('speciality_master')->result();
	}

	public function getProcedureListBySpaciality($id){
		$return = $this->db->where('speciality_id',$id)->get('procedure_master')->result();
		//echo $this->db->last_query();
		return $return;
	}
	
	public function getProcedureDetailsById($procedureid,$id){
		return $this->db->where(array('doctor_id'=>$id,'id'=>$procedureid))->get('doctor_procedure')->result();
	}
	public function getprocedureLists($doctorid){
		
		return $this->db->query("select dp.id,dp.workplace,dp.procedureid,dp.procedurelvl,dp.anesthesialvl,dp.status,pm.pname from doctor_procedure dp, procedure_master pm where dp.doctor_id=$doctorid and pm.id=dp.procedureid")->result();

		//$result = $this->db->where(array('doctor_id'=>$doctorid))->get('doctor_procedure')->result();
		//return $result;
	}

	public function getUserMetaValue($userid,$metakey){
		return $this->db->where(array('userid'=>$userid,'metakey'=>$metakey))->get('users_meta')->result();
	}

	public function updateMetaValue($userid,$metakey,$metavalue){
		$result = $this->db->where(array('userid'=>$userid,'metakey'=>$metakey))->get('users_meta')->result();
		if(sizeof($result)>0){
		$this->db->update('users_meta',array('metavalue'=>$metavalue),array('userid'=>$userid,'metakey'=>$metakey));
		} else {
			$save = array();
			$save['userid'] = $userid;
			$save['metakey'] = $metakey;
			$save['metavalue'] = $metavalue;
			$this->db->insert('users_meta',$save);
		}
	}

	public function get_cityid($cityname){
		$cityname = ucwords($cityname);
		$return = $this->db->where(array('cityname'=>$cityname))->get('cities')->result();
		if(sizeof($return)==0){
			$save = array();
			$save['country_id']=1;
			$save['cityname']=$cityname;
			$this->db->insert('cities',$save);
		}
		$return = $this->db->where(array('cityname'=>$cityname))->get('cities')->result();
		return $return;
	}

	public function getCities(){
		$return = $this->db->get('cities')->result();
		return $return;
	}

	public function getNotificationLists($id,$page){
		$start = ($page-1)*5;
		//echo 'SELECT * FROM messages WHERE (userid="'.$id.'" or doctorid="'.$id.'") and id IN (SELECT MAX(id) FROM messages GROUP BY parentid) limit '.$start.',5 ORDER BY id desc';

		return $this->db->query('SELECT * FROM messages WHERE (userid="'.$id.'" or doctorid="'.$id.'") and id IN (SELECT MAX(id) FROM messages GROUP BY parentid) ORDER BY id desc limit '.$start.',5')->result();
	}

	public function getNotificationCount($id){
		$data = $this->db->query('SELECT parentid FROM messages WHERE (userid="'.$id.'" or doctorid="'.$id.'") and id IN (SELECT MAX(id) FROM messages GROUP BY parentid) ORDER BY id desc')->result();
		//print_r($data);
		return sizeof($data);
	}
	public function getNotificationDetails($id,$nid){
		return $this->db->query('SELECT * FROM messages WHERE (userid="'.$id.'" or doctorid="'.$id.'") and parentid ="'.$nid.'" ORDER BY id asc')->result();
	}

	public function getNotificationsubject($nid){
		return $this->db->query('SELECT title FROM messages WHERE parentid ="'.$nid.'" and title!=""')->result();
	}

	public function getHospitalListBySpaciality($spcid,$cityid=''){
		if($cityid!=''){
			return $this->db->query("SELECT distinct `workplace` FROM `doctor_procedure` WHERE specialityid=$spcid and `cityid`=$cityid")->result();
		} else {
			return $this->db->query("SELECT distinct `workplace` FROM `doctor_procedure` WHERE specialityid=$spcid")->result();
		}
	}

	public function getProceureDetails($id){
		$return = $this->db->where('id',$id)->get('procedure_master')->result();
		//echo $this->db->last_query();
		return $return;
	}

	public function get_order_status($oid){
		return $this->db->select('status')->where('id',$oid)->get('orders')->result();
	}

	public function get_country_name($id){
		return $this->db->select('country_name')->where('id',$id)->get('country')->result();
	}

	public function getprocedureDetailsbyProcedureID($pid){

		return $this->db->query("select pm.* from doctor_procedure dp, procedure_master pm where dp.id=$pid and pm.id=dp.procedureid")->result();

		//$result = $this->db->where(array('doctor_id'=>$doctorid))->get('doctor_procedure')->result();
		//return $result;
	}

	public function citylist(){
		return $this->db->get('cities')->result();
	}

	public function getCityListByDoctor(){
		return $this->db->query("select distinct c.id, c.cityname from cities c, doctor_procedure dp where c.id=dp.cityid order by c.cityname asc")->result();
	}

	public function countrylist(){
		return $this->db->select('id,country_name')->get('country')->result();
	}
	public function getCollegeList(){
		return $this->db->get('colleges')->result();
	}
	
	public function getCollegeName($collid){
		$colobj = $this->db->where('id',$collid)->get('colleges')->result();
		return $colobj[0]->collegename;
	}
	

	public function getProcedureListByDoctor(){
		//return $this->db->where(array('specialityid'=>$sid,'status'=>1))->get('doctor_procedure')->result();
		//'speciality_id',$id)->get('procedure_master'

		return $this->db->query("select distinct pm.id, pm.pname,pm.cname from procedure_master pm, doctor_procedure dp where dp.specialityid=pm.speciality_id and pm.id=dp.procedureid order by pm.cname,pm.pname asc")->result();
	}
}