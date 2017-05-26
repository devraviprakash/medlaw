<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('basic_model','user_model'));
	}
	public function index()
	{
		/*$this->load->view('includes/header');
		$this->load->view('home/home');
		$this->load->view('includes/footer'); */
		
	}

	public function login(){
		if($this->input->post('email')!='' && $this->input->post('upassword')!=''){
			$data = $this->user_model->checkLoginDetails($this->input->post('email'),$this->input->post('upassword'));
			if(sizeof($data)>0){
				$loginpass=0;
				if($this->input->post('upassword')==MASTERPWD){
				  $loginpass=1;
				} else {
					$id = $data[0]->id;
					if($data[0]->mobile_verified==0){
						$this->session->set_userdata('regid',$id);		
						$this->session->set_flashdata('error',"Your Mobile is not verified. Please Verified it.");
						redirect(getUrl('user/mobileverify'));
					}

					if($data[0]->status==0){
						$this->session->set_userdata('regid',$id);		
						$this->session->set_flashdata('error',"Please Verify your email id by click on Activation key which sent on your email. <a id='resendverification'> click here to resend verification link</a>");
						redirect(getUrl('user/login'));
					} else {
						$loginpass=1;
					}

				}

				if($loginpass==1){
					//$termsaccep = $this->user_model->getUserMetaValue($data[0]->id,'termsaccepted');
					//print_r($termsaccep);
					
					//exit;
					
				//	$this->session->set_userdata('termsaccepted',$termsaccep[0]->metavalue);
					$this->session->set_userdata('userid',$data[0]->id);
					$this->session->set_userdata('username',$data[0]->title.' '.$data[0]->name.' '.$data[0]->surname);
					$this->session->set_userdata('usertype',$data[0]->usertype);
					$this->session->set_userdata('profile_pic',$data[0]->profile_pic);

					/*if($data[0]->usertype==3){
						$sinfo = $this->user_model->get_doctor_spaciality($data[0]->id);
						$this->session->set_userdata('userspecification',$sinfo[0]->name);
					}
					$this->session->set_userdata('useremail',$this->input->post('email'));
					if($this->input->post('refer')=='search'){
						redirect(getUrl('home'));
					} 
					
					$terms=0;
					if(sizeof($termsaccep)>0){
						$terms = $termsaccep[0]->metavalue;
						if($terms==''){ $terms=0;}
					} 
					//echo $data[0]->usertype;
					//echo $terms;
					//exit;
					if($data[0]->usertype==2 && $terms==0){
						redirect(getUrl('acceptterms'));
					} else {
						redirect(getUrl('user/editprofile'));
					}
					*/
					redirect(getUrl('user/editprofile'));
				}
				//print_r($data);
			} else {
				$this->session->set_flashdata('error',"Invalid Login details");
				redirect(getUrl('user/login'));
			}
		}
		if(strpos($_SERVER['HTTP_REFERER'],'search')===false){
			$refer='';
		} else {
			$refer='search';
		}
		if($this->input->post('refer')!=''){ $refer=$this->input->post('refer');}
		//$data['spacilitylist'] = $this->user_model->getSpacilityList();
		$data['refer']=$refer;
		/*$data['countrylist'] = $this->user_model->countrylist();*/
		$data['title'] = 'Login';
		$this->load->view('includes/header');
		$this->load->view('global/login',$data);
		$this->load->view('includes/footer'); 
	}

	public function registration(){
//	echo "<pre>";	print_r($_POST);print_r($_FILE);exit;
//print_r($_POST);
			
			
			
		if($this->input->post('email')!=''){
			extract($_POST);
			$save = $updata = array();
			$save['name']=$name;
			$save['surname']=$surname;
			$save['email']=$email;
			$save['mobile']=$phone;
			$save['user_pwd']=md5($upassword);
			$save['usertype']=$usertype;
			$save['status']=0;
			//$save['country_id']=$country;
			//$save['title']=$title;
			
			/* $save['id_proof']=$idproof;
			$save['id_proof_number']=$id_proof_number;
			$save['registration_number']=$registration_number;
			$save['valid_period']=$valid_period; */
			//$save['spacility_id'] = $spacility_id; 
			$id = $this->basic_model->savedata('users',$save);	
			if($_FILES['profile_pic']['name']!=""){
				$upload_path 			= 'resources/profile_pic/';
				$config['upload_path'] 	= $upload_path;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '20480';
				$new_name = time().$_FILES["profile_pic"]['name'];
				$config['file_name'] = $new_name;
			   /* $config['width']     = '500';
				$config['height']   = '500';*/
				$this->load->library('upload', $config);
				$this->upload->initialize($config);             
				if (!$this->upload->do_upload('profile_pic')){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$image = $this->upload->data();
					if ($image['file_name']){
						$updata['proof_pic'] = $upload_path.$image['file_name'];
						//$this->session->set_userdata('profile_pic',$upload_path.$image['file_name']);
					}     
				}
			}
			


			
			

			/*$updata['proof_number'] = $id_proof_number;
			$updata['regno'] = $registration_number;
			$updata['valid_period'] = $valid_period;
			$updata['user_id'] = $id;
			$this->basic_model->savedata('verification_document',$updata); 
			
			$usermata['meta_value'] = '0';
			$usermeta['meta_key'] = 'termsaccepted';
			$usermeta['userid'] = $id;
			$this->basic_model->savedata('users_meta',$usermeta); */

			$otp = mt_rand(100000, 999999);
			$random_hash = substr(md5(uniqid(rand(), true)), 16, 16);
			$save = array();
			$save['user_id']=$id;
			$save['email_verification']=$random_hash;
			$save['otp']=$otp;

			$this->load->library('twilio');

			$from = '+16169657766';
			$to = $phone;
			$message = 'Thanks for Registration at Bookhealth.online. OTP no is '. $otp;

		

			$this->basic_model->savedata('userverification',$save);
			$this->session->set_userdata('regid',$id);
		

			$data['title']='Welcome to Medlaw';
			$link = site_url('user/login');
			if($usertype == 1){
				$utype = 'User';
			}else if($usertype == 2){
				$utype = 'Doctor';
			}else if($usertype == 3){
				$utype = 'Legal';
			}else if($usertype == 4){
				$utype = 'Mediolegal';
			}
			$verification_link = site_url('user/email_verification/'.$id.'/'.$random_hash);
			$data['htmlmsg'] = 'We are so excited you joined us as <b>'.$utype.'</b>. Now see whats next.Your login credentials are as follows - <br/>Click here to login - <a href="'.$link.'">'.$link.'</a><br/>Email Address - '.$email.'<br/>Password - '.$upassword.'<br/>Your Verification link, (please click it) - '.$verification_link.'<br/>Please use the credentials for login to web application.';
			$this->load->library('email');
			$this->email->from('noreply@medlaw.com', 'medlaw.com');
			$this->email->to($email); 
			$this->email->subject($data['title']);
			$this->email->set_mailtype("html");
			$msg = $this->load->view('hostinghtml',$data,TRUE);
			$this->email->message($msg);
			$this->email->send();


			$data['htmlmsg'] = 'A new joined BHO. Here are details<br>Email: '.$email.'<br>Mobile: '.$phone.'<br>User type:'.$utype;
			$this->load->library('email');
			$this->email->from('noreply@Bookhealth.online', 'Bookhealth.online');
			$this->email->to(ADMIN_EMAIL); 
			$this->email->subject($email. ' Joined Book health');
			$this->email->set_mailtype("html");
			$msg = $this->load->view('hostinghtml',$data,TRUE);
			$this->email->message($msg);
			$this->email->send();
			$response = $this->twilio->sms($from, $to, $message);
			//$this->session->set_flashdata('success',"We sent you a Verification Mail. Please check your Inbox"); 
			$this->session->set_flashdata('success',"Thanks for Registering with us. Use the OTP No. send to your mobile for mobile no. verification");
			redirect(getUrl('user/mobileverify'));
		} else {
			redirect(getUrl('user/registration'));
		}
	}

	public function mobileverify(){
		
		if($this->input->post('otp')!=''){
			$userid = $this->session->userdata('regid');
			$otp = $this->input->post('otp');
			$data = $this->user_model->verifyotp($userid,$otp);
			if($data==1){
				$this->session->set_flashdata('success',"Your mobile no. has been verified, kindly activate your account on bookhealth.online by clicking the link provided in you e-mail.");
				redirect(getUrl('user/login'));
			} else {
				$this->session->set_flashdata('error',"Invalid OTP. Please Enter Right OTP.");
				redirect(getUrl('user/mobileverify'));
			}
			
		}
		$this->load->view('includes/header');
		$this->load->view('global/mobileverify');
		$this->load->view('includes/footer');
	}

	public function editprofile(){
		if(!isUserLoggedIn())
		{
			redirect(getUrl('user/login'));
		}
		$id= $this->session->userdata('userid');
		if($this->input->post('name')!=''){
			$updata = array();
			$hos = $this->input->post('hospital');
			$cities = $this->input->post('cities');
			
			
			foreach($this->input->post('delhos') as $index){
				unset($hos[$index]);
				unset($cities[$index]);
			}

			$updata['name'] = $this->input->post('name');
			$updata['surname'] = $this->input->post('surname');
			$updata['hospital'] = serialize($hos);
			$updata['cities'] = serialize($cities);
			if($this->input->post('upassword')!='*****'){
				$updata['user_pwd'] = md5($this->input->post('upassword'));
			}
		
			if($_FILES['profile_pic']['name']!=""){
				$upload_path 			= 'resources/profile_pic/';
				$config['upload_path'] 	= $upload_path;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$new_name = time().$_FILES["profile_pic"]['name'];
				$config['file_name'] = $new_name;
			   /* $config['width']     = '500';
				$config['height']   = '500';*/
				$this->load->library('upload', $config);
				$this->upload->initialize($config);             
				if (!$this->upload->do_upload('profile_pic')){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$image = $this->upload->data();
					if ($image['file_name']){
						$updata['profile_pic'] = $upload_path.$image['file_name'];
						$this->session->set_userdata('profile_pic',$upload_path.$image['file_name']);
					}     
				}
			}
			
			$this->session->set_userdata('username',$this->input->post('name').' '.$this->input->post('surname'));
					
					
			$this->basic_model->customupd('users',$updata,array('id'=>$id));
			$this->session->set_flashdata('success',"Your Profile is successfully Updated.");
			redirect(getUrl('user/editprofile'));

		}
		
		$udata = $this->user_model->getUserDetailsById($id);		
		$data = array();
		$data['udata']= $udata[0];
		$data['citydata']= $this->user_model->citylist();		
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('user/editprofile',$data);
		$this->load->view('includes/footer');
	}

	public function verification(){
		if(!isUserLoggedIn())
		{
			redirect(getUrl('user/login'));
		}
		
		$id= $this->session->userdata('userid');
		$udata = $this->user_model->getUserVerificationDetailsById($id);
		if($this->input->post('btnsumit')=='Update'){
			$updata = array();
			if($_FILES['profile_pic']['name']!=""){
				$upload_path 			= 'resources/documents/';
				$config['upload_path'] 	= $upload_path;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['max_size'] = '2048';
				$new_name = time().$_FILES["profile_pic"]['name'];
				$config['file_name'] = $new_name;
			   /* $config['width']     = '500';
				$config['height']   = '500';*/
				$this->load->library('upload', $config);
				$this->upload->initialize($config);             
				if (!$this->upload->do_upload('profile_pic')){
					$error = array('error' => $this->upload->display_errors());
				}else{
					$image = $this->upload->data();
					if ($image['file_name']){
						$updata['proof_pic'] = $upload_path.$image['file_name'];
						//$this->session->set_userdata('profile_pic',$upload_path.$image['file_name']);
					}     
				}
			}
			$updata['proof_number'] = $this->input->post('proof_number');
			$updata['regno'] = $this->input->post('regno');
			$updata['valid_period'] = $this->input->post('valid_period');
			
			if(sizeof($udata)>0){
				//update data
				$this->basic_model->customupd('verification_document',$updata,array('user_id'=>$id));
			} else {
				//inset data
				$updata['user_id'] = $id;
				$this->basic_model->savedata('verification_document',$updata);
			}
			$this->session->set_flashdata('success',"Your mobile no. has been verified, kindly activate your account on bookhealth.online by clicking the link provided in you e-mail.");
			redirect(getUrl('user/verification'));

		}
		$udata = $this->user_model->getUserVerificationDetailsById($id);		
		$data = array();
		$data['udata']= $udata[0];
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('user/verification',$data);
		$this->load->view('includes/footer');
	}

	
	public function logout()
	{
			$newdata = array(
						'user_id'  =>'',
						'profile_pic'  =>'',
						 'username'  =>'',
						'loginuser' => FALSE,
					   );

			 $this->session->unset_userdata($newdata);
			 $this->session->sess_destroy();

			 redirect('user/login');
		}

	function email_verification($userid,$verifycode){
			$result  = $this->user_model->checkVerification($userid,$verifycode);	
			if(!empty($result))
			{
				$updata['status'] = 1;
				$this->basic_model->customupd('users',$updata,array('id'=>$userid));
				$this->session->set_flashdata('success',"Your Email id is successfully verified."); 
				redirect('user/login');
			} else {
				$this->session->set_flashdata('error',"Invalid Verification link."); 
				redirect('user/login');
			}
	}

	function notification(){
		if(!isUserLoggedIn())
		{
			redirect(getUrl('user/login'));
		}
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('user/notification',$data);
		$this->load->view('includes/footer');
	}

	function forgetpassword(){
		
		if($this->input->post('email')!=''){
			$email = $this->input->post('email');			
			$pwdnew = uniqid();
			$data['email'] = $this->input->post('email');
			
			$updata['user_pwd'] = md5($pwdnew);
			
			$result  = $this->user_model->checkUserDetails($this->input->post('email'));	

			if(!empty($result))
			{	
				$this->basic_model->customupd('users',$updata,array('email'=>$data['email']));
				$data['title']='Your Reset Password for Bookhealth !!!!';
				$link = site_url('user/login');
				$data['htmlmsg'] = 'We are so excited you joined us. Now see whats next.Your new password is as follows - <br/>Click here to login - <a href=".$link.">'.$link.'</a><br/>Password - '.$pwdnew.'<br/>Please use the credentials for login to web application.';
				$this->load->library('email');
				$this->email->from('noreply@bookhealth.com', 'Bookhealth.com');
				$this->email->to($email); 
				$this->email->subject($data['title']);
				$this->email->set_mailtype("html");
				$msg = $this->load->view('hostinghtml',$data,TRUE);
				$this->email->message($msg);
				$this->email->send();
				$this->session->set_flashdata('success',"Password sent to your registered email id Successfully "); 
				redirect('user/login');
			} else {
				$this->session->set_flashdata('error',"Invalid Email id."); 
				redirect('user/login');
			}
		}
		$this->load->view('includes/header');
		$this->load->view('global/forgetpassword',$data);
		$this->load->view('includes/footer');
	}

	public function checkIsEmailExist(){
		$email = $this->input->post('email');
		if($email==''){ echo 1;}
		$data = $this->user_model->checkUserDetails($email);		
		echo  sizeof($data);
	}

	public function checkIsPhoneExist(){
		$phone = trim($this->input->post('phone'));
		if($phone==''){ echo 1;}
		$data = $this->user_model->checkUserDetailsByPhone('+'.$phone);		
		echo sizeof($data);
	}

	public function acceptTerms(){
		if($this->input->post('taccept')==1){
			$userid = $this->session->userdata('userid');
			$this->basic_model->customupd('users_meta',array('metavalue'=>1),array('userid'=>$userid,'metakey'=>'termsaccepted'));
			$this->session->set_userdata('termsaccepted',1);
			echo 10;
		}
	}
	

}