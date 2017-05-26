<div class="main">
    <section class="section page-title">
      <header class="section-head">
        <h2>Login / Verification</h2>
        <h6>Home &nbsp;<i class="fa fa-angle-right"></i>&nbsp; Verify Mobile</h6>
      </header>
    </section>
    <section class="section">
		
		<?php showsessionmsg(); ?>
	  <div class="main">
        <div class="row">
          <div class="columns large-4 medium-5">
            <div class="sidebar">
              <div class="widgets login">
                <h3>Login Now</h3>
                <form method="post">
                  <p class="form-row-wide">
                    <input type="text" class=" input-text" name="username" id="username" value="">
                  </p>
                  <p class="form-row-wide">
                    <input class=" input-text" type="password" name="password" id="password">
                  </p>
                  <p class="form-row">
                    
                    <input type="submit" class="button" name="login" value="Login">
                  </p>
                  <p class=" lost_password"> <a href="">Lost your password?</a> </p>
                </form>
              </div>
              <!-- /.widgets --> 
            </div>
            <!-- /.sidebar --> 
          </div>
          <div class="columns large-8 medium-7 right">
            <div class="content">
              <article class="event article-single-event register-box">
                <h3>Mobile Verification</h3>
                <div class="tabs tabs-services">
                  
                  
                    <div class="row">
                        <div class="columns">
                          
                            <div class="row">                             
                              
							<form name="registration" action="<?php echo base_url('user/mobileverify'); ?>" method="post" />
							<p class="comment-form-field  columns medium-12">
								Enter OTP Number
                              </p>
                              <p class="comment-form-field  columns medium-12">
                                
								<input type="text" name="otp" placeholder="Enter OTP" id="otp" class="required" size="30"/>
							  </p>
							  
                                                       
                              <p class="comment-form-field  columns medium-12">                               
                                <label for="rememberme" class="inline">
                                <a href="#">Click Here to resend OTP</a></label>
                              </p>
                            </div>
                            <p class="form-submit">
                              <input class="button tiny grey" name="btnsumit" type="submit" value="Verify">                              
                            </p>                           
                          </form>
                        </div>
                      </div>
                      <!-- /.row --> 
                    
                  <!-- /.tabs-body --> 
                </div>
                <!-- /.tabs --> 
                
              </article>
              
            </div>
            <!-- /.content --> 
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.main -->