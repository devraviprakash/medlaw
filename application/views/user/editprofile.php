        <div class="columns large-9 medium-8 right">
            <?php showsessionmsg(); ?>
			<div class="content">
              <article class="event article-single-event">
                  <div class="">
                      <div class="columns large-12 medium-12 ">
                        <h3>Edit Profile</h3>                
                        </div>
						<form name="registration" enctype="multipart/form-data" action="<?php echo base_url('user/editprofile'); ?>" method="post" />
						
						<p>
                    	<div class="row">
						<?php //print_r($udata); ?>
                            <div class="small-3 columns">
                              <label for="right-label" class="right">Name</label>
                            </div>
                            <div class="small-9 columns">
                              <input type="text" name="name" id="name" value="<?php echo $udata->name; ?>" class="required" >
                            </div>
                          </div>
					 </p>
					 <p>
                    	<div class="row">
                            <div class="small-3 columns">
                              <label for="right-label" class="right">Surname</label>
                            </div>
                            <div class="small-9 columns">
                              <input type="text" name="surname" id="surname" class="required" value="<?php echo $udata->surname; ?>">
                            </div>
                          </div>
					 </p>
					 <p>
                    	<div class="row">
                            <div class="small-3 columns">
                              <label for="right-label" class="right">Email</label>
                            </div>
                            <div class="small-9 columns">
                              <input type="text" name="email" id="email" disabled class="required email" value="<?php echo $udata->email; ?>">
                            </div>
                          </div>
					 </p>
					 <p>
                    	<div class="row">
                            <div class="small-3 columns">
                              <label for="right-label" class="right">Profile Image</label>
                            </div>
                            <div class="small-9 columns">
                              <!--<input type="file" name="profile_pic" id="pimage" >-->
							  <label for="profile_pic" class="button">Choose File</label>
									<input type="file" name="profile_pic" id="profile_pic" class="show-for-sr">
                            </div>
                          </div>
					 </p>
					 <p>
                    	<div class="row">
                            <div class="small-3 columns">
                              <label for="right-label" class="right">Mobile</label>
                            </div>
                            <div class="small-9 columns">
                              <input type="text" name="mobile" class="required" id="mobile" disabled value="<?php echo $udata->mobile; ?>">
                            </div>
                          </div>
					 </p>
					 <p>
						<div id="locationdiv">

						<?php 
						//echo $this->session->userdata('usertype');
						if($this->session->userdata('usertype')==3){
							if($udata->hospital==''){ ?>
                    		<div class="row">
							
								<div class="small-3 large-3 medium-3 columns">
								  <label for="right-label" class="right">Workplace</label>
								</div>
								<div class="small-4 large-5 medium-5 columns">
									<label>Hospital/Clinic
								  <input type="text" name="hospital[]" class="required" value="<?php echo $udata->location; ?>"></label>
								</div>
								<div class="small-5 large-4 medium- columns">
								<label> City
								<select name="cities[]" class="required cities">
									<?php foreach($citydata as $city){ ?>
									<option <?php if($citiesarr[$i]==$city->cityname){ echo 'selected';} ?>><?php echo $city->cityname; ?></option>
									<?php } ?>
								  </select>
								  
								  </label>
								</div>
								
								<!-- <div class="small-1 large-1 medium-1 columns">
									<label>&nbsp;</label><a class="close" href="#" alt="Close" title="Close">&times;</a>
								</div> -->
                          </div>
						<?php } else { 
									$hospitalarr = unserialize($udata->hospital);
									$citiesarr = unserialize($udata->cities);
									$i=0;
									foreach($hospitalarr as $hospital){
									?>
							<div class="row">
							
								<div class="small-3 large-3 medium-3 columns">
								  <label for="right-label" class="right"><?php if($i==0){ echo 'Workplace'; } else echo '&nbsp;'; ?></label>
								</div>
								<div class="small-4 large-5 medium-5 columns">
									<label>Hospital/Clinic
								  <input type="text" name="hospital[]" class="required" value="<?php echo $hospital; ?>"></label>
								</div>
								<div class="small-4 large-3 medium-3 columns">
								<label> City
								  <select name="cities[]" class="required cities">
									<?php foreach($citydata as $city){ ?>
									<option <?php if($citiesarr[$i]==$city->cityname){ echo 'selected';} ?>><?php echo $city->cityname; ?></option>
									<?php } ?>
								  </select>
								  <!-- <input type="text" name="cities[]" class="required" value="<?php echo $citiesarr[$i]; ?>"> -->
								  </label>
								</div>
								<div class="small-1 large-1 medium-1 columns">
									<label>Del</label><input type="checkbox" name="delhos[]" value="<?php echo $i; ?>" />
								</div>
                          </div>
						<?php $i++; } } } ?>
						</div>
					 </p>
					 <?php 
					 if($this->session->userdata('usertype')==3){ ?>
					 <p>
					
                         <label for="right-label" class="right"><a id="addmorewp">Add More Workplace</a></label>
                    
					 </p>
					 <?php } ?>
					 <p>
                    	<div class="row">
                            <div class="small-3 columns">
                              <label for="right-label" class="right">New Password</label>
                            </div>
                            <div class="small-9 columns">
                              <input type="password" id="upassword" name="upassword" value='*****'>
                            </div>
                          </div>
					 </p>
					 <p>
                    	<div class="row">
                            <div class="small-3 columns">
                              <label for="right-label" class="right">Confirm Password</label>
                            </div>
                            <div class="small-9 columns">
                              <input  type="password" name="cpassword" id="cpassword" value='*****'>
                            </div>
                          </div>
					 </p>
                   </div>
				   <p class="form-submit">
                              <input class="right button tiny grey" name="btnsumit" type="submit" value="Update">                              
                            </p>                           
				   </form>
              </article>
                            
              
               
              <!-- /.event article-single-event --> 
              
            </div>
            <!-- /.content --> 
          </div>
        </div>
     
      <div class="clearfix"></div>
    </section>
  </div>
  <!-- /.main -->
  <article style=" height:20px;"></article>
