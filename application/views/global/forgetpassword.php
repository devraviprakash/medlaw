<div>
    <section class="section page-title">
      <header class="section-head">
        <h2>Login / Register</h2>
        <h6>Home &nbsp;<i class="fa fa-angle-right"></i>&nbsp; Become A Member</h6>
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
				<form id="login" action="<?php echo base_url('user/login'); ?>" method="post">
                  <p class="form-row-wide">
                    <input type="text" class=" input-text" name="email" id="email" value="">
                  </p>
                  <p class="form-row-wide">
                    <input class=" input-text" type="password" name="upassword" id="upassword">
					<input class="input-text" type="hidden" name="refer" value="<?php echo $refer; ?>">
                  </p>
                  <p class="form-row">
                    
                    <input type="submit" class="button" name="btnsumit" value="Login">
                  </p>
                  <p class=" lost_password"> <a href="<?php echo base_url('user/login'); ?>">Sign Up</a> </p>
                </form>
              </div>
              <!-- /.widgets --> 
            </div>
            <!-- /.sidebar --> 
          </div>
          <div class="columns large-8 medium-7 right">
            <div class="content">
              <article class="event article-single-event register-box">
                <h3>Forget Password</h3>
				<form id="login" action="<?php echo base_url('user/forgetpassword'); ?>" method="post">
                <div class="row">
					<div class="columns large-12 medium-12 right">
						
					  <p class="form-row-wide">
						<input type="text" class=" input-text" name="email" id="email" placeholder="Enter your Registerd Email id">
					  </p>
						<p class="form-row">
                    
                    <input type="submit" class="button" name="btnsumit" value="Reset Password">
                  </p>
					</div>
				</div>
				</form>
				</article> 
            <!-- /.content --> 
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.main -->