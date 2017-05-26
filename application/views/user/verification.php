        <div class="columns large-9 medium-8 right equal-col">
            <?php showsessionmsg(); ?>
			<div class="content">
              <article class="event article-single-event">
                  <div class="">
                      <div class="columns large-12 medium-12 ">
                        <h3>Verification</h3>                
                        </div>
						<form name="registration" enctype="multipart/form-data" action="<?php echo base_url('user/verification'); ?>" method="post" />
						
						<p>
                    	
						<p>
                    	<div class="row">
                            <div class="small-5 columns">
                              <label for="right-label" class="right">ID Proof(Upload Passpost in case of NRI)</label>
                            </div>
                            <div class="small-7 columns">
                              <input type="file" name="profile_pic" id="pimage" >
							  <?php if($udata->proof_pic!=''){ ?>
							  <a href="<?php echo base_url($udata->proof_pic); ?>" target="_blank">Click here to download </a>
							  <?php } ?>
                            </div>
                          </div>
					 </p>
					 <p>
						
						<div class="row">
						<?php //print_r($udata); ?>
                            <div class="small-5 columns">
                              <label for="right-label" class="right">ID Proof Number</label>
                            </div>
                            <div class="small-7 columns">
                              <input type="text" name="proof_number" id="proof_number" value="<?php echo $udata->proof_number; ?>" class="required" >
                            </div>
                          </div>
					 </p>
					 <?php if($this->session->userdata('usertype')==3){ ?>
					 <p>
                    	<div class="row">
                            <div class="small-5 columns">
                              <label for="right-label" class="right">Registration Number</label>
                            </div>
                            <div class="small-7 columns">
                              <input type="text" name="regno" id="regno" class="required" value="<?php echo $udata->regno; ?>">
                            </div>
                          </div>
					 </p>
					 <p>
                    	<div class="row">
                            <div class="small-5 columns">
                              <label for="right-label" class="right">Valid Period</label>
                            </div>
                            <div class="small-7 columns">
                              <input type="text" name="valid_period" id="valid_period" class="required" value="<?php echo $udata->valid_period; ?>">
                            </div>
                          </div>
					 </p>
					 <?php } ?>
                   
				   <p class="form-submit">
                              <input class="button tiny grey" name="btnsumit" type="submit" value="Update">                              
                            </p>                           
				   </div>
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
