<div id="main">
            
<div class="userform">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form name="doctorreg" id="doctorreg" action="<?php echo base_url('user/registration'); ?>" method="post" enctype="multipart/form-data" >
          
          <div class="top-row">
            <div class="field-wrap">
              Registerd As <span class="req">*</span>
            <input type="radio" name="usertype" value="1" checked/> User
			<input type="radio" name="usertype" value="2" /> Doctor
			<input type="radio" name="usertype" value="3" /> Legal
			<input type="radio" name="usertype" value="4" /> Mediolegal
          </div>
			<div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name="name" id="Name"/>
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="surname" id="Surname"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="email" onblur="checkIsEmailExist();" id="Email"/>
          </div>
          <div class="top-row">
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" id="uspassword" name="upassword"/>
          </div>
             <div class="field-wrap">
            <label>
              Confirm Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="cpassword" id="cpassword"/>
          </div>
            </div>
            <div class="field-wrap">
            <label>
              ID Proof<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="id_proof_number" id="id_proof_number"/>
          </div><div class="field-wrap">
            <label>
              Upload ID Proof for NRI
            </label>
<input type="file" name="profile_pic" id="pimage" class="show-for-sr">          </div>    
            <div class="field-wrap">
            <label>
              Mobile No.(+91-XXXXXXXXXX)<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="phone" id="phone" onblur="checkIsPhoneExist();"/>
          </div>
          
          <button type="submit" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form id="login" action="<?php echo base_url('user/login'); ?>" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="email" id="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="upassword" id="upassword"/>
          
          <input class="input-text" type="hidden" name="refer" value="<?php echo $refer; ?>">
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <input type="submit"  class="button button-block" name="btnsumit" value="Login"/>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->


</div>