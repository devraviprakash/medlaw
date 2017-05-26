<div class="columns event large-9 medium-8 right">
<?php showsessionmsg(); ?>
            <div class="content">
			<?php 
			$usertype = $this->session->userdata('usertype');
			//print_r($notidetails[0]); ?>
			<h3><?php echo $notidetails[0]->title; 
			
			$userid= $notidetails[0]->userid;
			$doctorid= $notidetails[0]->doctorid;
			$orderid= $notidetails[0]->orderid;
			$parentid= $notidetails[0]->parentid;
			
			?></h3>
                      <div class="content active" id="vtabcontent1">
                        <div class="from-m">
                        	<?php 
							foreach($notidetails as $notify){
							$userdata = $this->user_model->getUserDetailsById($notify->senderid);
							?>
							<div class=" from-head">
                            	<span  class="details">
                                <b><?php echo $userdata[0]->name.' '.$userdata[0]->surname; ?> </b>
                                
                                </span>
                                <span class="pull-right"> <?php $old_date_timestamp = strtotime($notify->msgdate);
echo $new_date = date('m/d/Y h:i A', $old_date_timestamp);  ?></span>
                            </div>
                            <div>
								
							
							<?php if($notify->procedureid!='' && $orderid==0){?>
									
									<?php $procedurdata = $this->user_model->getProcedureDetailsById($notify->procedureid,$doctorid);
									$sinfo = $this->user_model->get_doctor_spaciality($doctorid);
									$cinfo = $this->user_model->getprocedureDetailsbyProcedureID($notify->procedureid);
									
								//print_r($cinfo);
											
											$userdata = $this->user_model->getUserDetailsById($userid);
											//$userdata[0]->country_id;
											$docdata = $this->user_model->getUserDetailsById($doctorid);
											
											if($userdata[0]->country_id=='1'){
												
												$symbol = 'Rs. ';
											$daycareamt = $procedurdata[0]->daycareprice;
											$economyamt = $procedurdata[0]->economyinr;
											$singleamt = $procedurdata[0]->singleinr;
											$deluxamt = $procedurdata[0]->deluxinr;
											$suiteamt = $procedurdata[0]->suiteinr;
											} else {
												$symbol = '$';
												$daycareamt = $procedurdata[0]->daycareinter;
												$economyamt = $procedurdata[0]->economyinter;
												$singleamt = $procedurdata[0]->singleinter;
												$deluxamt = $procedurdata[0]->deluxinter;
												$suiteamt = $procedurdata[0]->suiteinter;

											}


											$ddocdata = $procedurdata[0];
											echo substr($notify->msg, 0, -8);
											echo '<tr><td>Recommanded Surgery Date:- '.$notify->surgery_date.'</td></tr>';
											echo '<tr><td>Recommanded Procedure:- '.$cinfo[0]->pname.'</td></tr>';
											echo '<tr><td><a data-reveal-id="readmore'.$notify->id.'">Click here to Know More and Book Appointment</td></tr></table>';
									?>
								<div id="readmore<?php echo $notify->id; ?>" class="small  reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                          <h3 id="modalTitle"><?php echo $docdata[0]->name.' '.$docdata[0]->surname; ?></h3>
                          <div class="modal-body">
                            <table border="0" class="" style="width:100%">
                              <tr>
                                <td><?php echo  $sinfo[0]->name; ?></td>
								<td>Rate <?php echo $symbol; ?> <span id="showpricepop<?php echo $docdata->id; ?>" class="showpricepop"><?php echo $daycareamt; ?></span></td>
								</tr>
                              <tr>
                                <td><?php echo $docdata[0]->name.' '.$docdata[0]->surname; ?></td>
                                <td><select class="select-box valid roompricepop" id="roompricepop<?php echo $ddocdata->id;?>" aria-invalid="false" >
                            		    <option value="<?php echo $daycareamt; ?>/Daycare">Day Care</option>
										<option value="<?php echo $economyamt; ?>/Daycare">Economy</option>
										<option value="<?php echo $singleamt; ?>/Daycare">Single</option>
										<option value="<?php echo $deluxamt; ?>/Daycare">Delux</option>
										<option value="<?php echo $suiteamt; ?>/Daycare">Suite</option>
										
                                  </select></td>
                              </tr>
                              <tr>
                                <td><?php 
								
								  echo $cinfo[0]->pname; ?></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td id="workplace<?php echo $docdata->id; ?>"><?php echo str_replace('--||--',',',$ddocdata->workplace); ?></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2" ><b>Procedure Level- </b><span id="plevel<?php echo $docdata->id; ?>"><?php echo $ddocdata->procedurelvl; ?></span></td>
                              </tr>
                              <tr>
                                <td colspan="2"><b>Duration </b><span id="duration<?php echo $docdata->id; ?>"><?php echo $ddocdata->surgery_dur; ?></span> Min</td>
                              </tr>
                              <tr>
                                <td colspan="2"><b>Anaesthesia Type- </b><span id="atype<?php echo $docdata->id; ?>"><?php echo $ddocdata->anesthesialvl; ?></span></td>
                              </tr>
                              <tr>
                                <td colspan="2">Total stay at unit- <span id="totstay<?php echo $docdata->id; ?>"><?php echo $ddocdata->surgery_hospi; ?></span></td>
                              </tr>
                              <tr>
                                <td colspan="2">Return to normal activity <span id="sugnormal<?php echo $docdata->id; ?>"><?php echo $ddocdata->surgery_normal; ?></span> days</td>
                              </tr>
                              <tr>
                                <td colspan="2"><b>Chances of repeat procedure- </b><span id="repproc<?php echo $docdata->id; ?>"><?php echo $ddocdata->repateproc; ?></span></td>
                              </tr>
							  <?php $hosinclusion = unserialize($ddocdata->hosinclusion); 
							  
								if(sizeof($hosinclusion)>0){ ?>
                              <tr>
								<td colspan="2"><b>Inclusion</b> <br><span id="inclusi<?php echo $docdata->id; ?>">
								<?php echo implode('<br>',$hosinclusion); ?></span>
                              </tr>
							  <?php } ?>

							  <?php $hosinclusion = unserialize($ddocdata->hospexclusion); 
							  
								if(sizeof($hosinclusion)>0){ ?>
                              <tr>
								<td colspan="2"><b>Exclusion</b> <br><span id="exclusi<?php echo $docdata->id; ?>">
								<?php echo implode('<br>',$hosinclusion); ?></span>
                              </tr>
							  <?php } ?>
                            </table>
                          </div>
                          <div class="model-foot"> 
						  	<form action="<?php echo base_url('booking/bookingreq'); ?>" method="post" />
							<input type="hidden" name="doctorid" value="<?php echo $doctorid; ?>" />
							<input type="hidden" name="procid" id="procdid<?php echo $notify->procedureid; ?>" value="<?php echo $notify->procedureid; ?>" />
							<input type="hidden" name="speciid" value="<?php echo $sinfo[0]->id; ?>" />
							<input type="submit" class="button  default book" value="Request Booking"> 
							</form>
						  
						  </div>
                          <a class="close-reveal-modal" aria-label="Close">&#215;</a> 
                        </p>
                      </div>
							
							<?php }  else {
									echo $notify->msg;
							}
							echo '</div>';
							} ?>
							
							<form name="registration" enctype="multipart/form-data" action="<?php echo base_url('notification/userreply'); ?>" method="post" />
								<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
								<input type="hidden" name="doctorid" value="<?php echo $doctorid; ?>" />
								<input type="hidden" name="orderid" value="<?php echo $orderid; ?>" />
								<input type="hidden" name="parentid" value="<?php echo $parentid; ?>" />
							<div class="attachement">
                            	<div class="row">
                                	<div class="columns large-12 medium-12">
                                    	<div class="send-message">
                                        	
                                        	<hr>
                                            <span><textarea placeholder="Reply Here" rows="8" class="required" name="replytext"></textarea></span>
                                            <span>
                                            	Attachment<!--<input type="file" name="patientdocuments[]" multiple/>-->
												<label for="patientdocuments" class="button">Choose File</label>
												<input type="file" name="patientdocuments[]" id="patientdocuments" class="show-for-sr" multiple/>
                                            </span>
                                        </div>
										<?php if($usertype==3 && $orderid==0){ ?>
										<div class="columns large-12 medium-12 btn-set">
											Please select date and procedure once you decide when and what procedure will be given to user.
										</div>
										<div>
											<div class="columns large-12 medium-12 btn-set">
                                            	<div class="pull-left">
													Surgery Date
													<input class="field field-date valid" placeholder="Select Operation Date" type="text" name="surgerydate" />
												</div>
                                                <div class="pull-right">
													Procedure to be done
													<select name="procedureassign"/>
														<option value="">Select From My Serives</option>
														<?php 
														$existprocarr = array();
														foreach($procelist as $procedure){
															$existprocarr[]=$procedure->procedureid;
														$workplace = str_replace('--||--',',',$procedure->workplace);
																echo '<option value="'.$procedure->id.'">'.$procedure->pname.'('.$workplace .')</option>';
															}?> 
													</select>
													<br>OR<br>
													<?php //print_r($existprocarr); ?>
													<select name="procedureglobal"/>
														<option value="">Select From Global </option>
														<?php 
														
															foreach($Procedurelist as $procedure){
														if(!in_array($procedure->id,$existprocarr)){
														//$workplace = str_replace('--||--',',',$procedure->workplace);
																echo '<option value="'.$procedure->id.'">'.$procedure->pname.'</option>';
															} }?> 
													</select>
												</div>
											</div>
										</div>
										<?php } ?>
                                        <div class="row">
                                        	
											<div class="columns large-12 medium-12 btn-set">
                                            	<div class="pull-left">
                                                    <?php if($usertype==3 && $orderid>0){ 
														$statusobj = $this->user_model->get_order_status($orderid);
														if($statusobj[0]->status!=1){
													?>
														Please click on cofirm booking once you think, everything you discussed.
														<input type="submit" class="button" name="btnconfirm" value="Confirm Booking">	
													<?php }
													}?>
												</div>
                                                <div class="pull-right">
                                                    <input type="submit" class="button" name="btnsend" value="Reply">
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</form>
                        </div>
                        
                      </div>
					</div>
			    </div>
		    </div>