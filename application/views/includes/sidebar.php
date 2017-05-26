<div class="main">
    <section class="section">
     
        <div class="row">
          <div class="columns large-3 medium-4 left-box equal-col">
            <div class="off-canvas position-left reveal-for-large" id="my-info" data-off-canvas data-position="left">              
                <br>
               <div class="p-image"> 
			   <?php if($this->session->userdata('profile_pic')!=''){ ?>
					<img class="thumbnail" src="<?php echo base_url($this->session->userdata('profile_pic')); ?>" alt="image">	
				<?php } else { ?>
			   <img class="thumbnail" src="<?php echo base_url('assets/images/no-image.gif'); ?>" alt="image">
			   <?php } ?>
			   </div>
                <?php if($this->session->userdata('usertype')==3){ ?>
				<p class="share">
                	<a href="#" target="_self" class="button  default"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#" target="_self" class="button  default"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </p>
                <?php } ?>
                <div class="p-details">
                    <h3><?php echo $this->session->userdata('username'); ?></h3>
		   <?php 
					$contrnm = $this->router->fetch_class();
					$funame = $this->router->fetch_method();
					
					if($this->session->userdata('usertype')==3){ ?>
                    
                    				<h4><?php echo $this->session->userdata('userspecification'); ?></h4>
					<?php } ?>	                    
			
                    <div>
					
					</div>					
                    
                </div>
                <div class="clearfix"></div>
				
				<div class="show-menu-in-mobile">
					<p>
						<a href="#" class="btn_menu2">
							<span></span>
						</a>
					</p>
				</div>
                 <ul  id="newpost" class="side-menu">
					
					<li <?php if($contrnm=="dashboard" && $funame=="index"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a></li>
                	<li <?php if($contrnm=="user" && $funame=="editprofile"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('user/editprofile'); ?>"><i class="fa fa-address-book" aria-hidden="true"></i> Edit Profile</a></li>
					<?php if($this->session->userdata('usertype')!=4){ ?>
					<li <?php if($contrnm=="user" && $funame=="verification"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('user/verification'); ?>"><i class="fa fa-id-card" aria-hidden="true"></i> Verification</a></li> 
					<?php } if($this->session->userdata('usertype')==3){ ?>
					<li <?php if($contrnm=="doctor" && $funame=="editprofile"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('doctor/editprofile'); ?>"><i class="fa fa-address-book" aria-hidden="true"></i> Professional Profile</a></li>
					<li <?php if($contrnm=="doctor" && $funame=="procedures"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('doctor/procedures'); ?>"><i class="fa fa-address-book" aria-hidden="true"></i> Procedures</a></li>
					<li <?php if($contrnm=="doctor" && $funame=="add_procedure"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('doctor/add_procedure'); ?>"><i class="fa fa-address-book" aria-hidden="true"></i> Add Procedure</a></li>
					<li <?php if($contrnm=="doctor" && $funame=="addimage"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('doctor/addimages'); ?>"><i class="fa fa-address-book" aria-hidden="true"></i> Images</a></li>
					<?php } ?>
					<?php if($this->session->userdata('usertype')==1){ ?>
					<!-- <li <?php if($contrnm=="agents" && $funame=="addagent"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('agents'); ?>"><i class="fa fa-users" aria-hidden="true"></i> Agents</a></li>
					<li <?php if($contrnm=="agents" && $funame=="addagent"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('agents/addagent'); ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Agent</a></li> -->
					<?php } ?>
                    <li <?php if($contrnm=="appointments" && $funame=="index"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('appointments'); ?>"><i class="fa fa-medkit" aria-hidden="true"></i> Appointments</a></li>
                    <li <?php if($contrnm=="notification"){ echo 'class="active"'; } ?>><!--<span class="notification-count"> 10 </span>--><a href="<?php echo base_url('notification'); ?>"><i class="fa fa-location-arrow" aria-hidden="true"></i> Notification</a></li>
					<li><a href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                </ul>                
                </div>
            <!-- /.sidebar -->
<script>
jQuery(document).ready(function(){
        jQuery("#hideshow").on('click', function(event) {        
             jQuery("#content").toggle('show');
        });
    });
</script>			
          </div>
  
