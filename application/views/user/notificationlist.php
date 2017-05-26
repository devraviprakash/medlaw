<div class="columns large-9 medium-8 right equal-col">
<?php showsessionmsg(); ?>
            <div class="content">
				<div class="row event">
          			<div class="columns large-7 medium-4">
						<h3>
							Notification
						</h3>
                  	</div>
				</div>
				
				<article class="notification-box">   
                    <dl  >
					<?php foreach($notilist as $notidata){ 
						$userdata = $this->user_model->getUserDetailsById($notidata->senderid);
						?>	      

                      <dd class="<?php if($notidata->orderid==0){ echo 'gray';} else { echo 'current';} ?>">
                          <a href="<?php echo site_url('notification/details/'.$notidata->parentid); ?>">
                            <h3> <?php echo $userdata[0]->name.' '.$userdata[0]->surname; ?> <span><?php $old_date_timestamp = strtotime($notidata->msgdate);
							echo $new_date = date('m/d/Y h:i A', $old_date_timestamp);  ?></span> </h3>
                            <p><?php 
								if($notidata->title==''){
	
									$ntitlobj = $this->user_model->getNotificationsubject($notidata->parentid);
									//print_r()
									echo $ntitlobj[0]->title;
								} else {
									echo $notidata->title; 
								}?>
							</p>
                          </a>
                      </dd>
					  <?php } ?>
                      
                    </dl>

					<div id="pagination">
						<ul class="tsc_pagination">

						<!-- Show pagination links -->
						<?php foreach ($links as $link) {
						echo "<li>". $link."</li>";
						} ?>
						</ul>
					</div>
					
					<!--<div class="pagination">
					  <ul>
						<li><a href="#">Prev</a></li>
						<li class="active">
						  <a href="#">1</a>
						</li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">Next</a></li>
					  </ul>
					</div>-->
					
				</article>
			</div>
            <!-- /.content --> 
          </div>
        </div>
     
      <div class="clearfix"></div>
    </section>
  </div>