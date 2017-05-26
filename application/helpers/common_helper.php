<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * a file to hold the solochecker skin paths eg stylesheet url, image urls
 * Added By Ravi Prakash on 12/3/13
 */
if ( ! function_exists('getSkinUrl') )
{
	function getSkinUrl($obj='')
	{
		$url = base_url();
		return $url.$obj;
	}
}

/*
 * solochecker app urls
 * Added By Ravi Prakash on 12/3/13
 */
if ( ! function_exists('getUrl') )
{
	function getUrl($obj='')
	{
		$url = site_url();
		return $url.$obj;
	}
}

/*
 * solochecker instance
 * Added By Ravi Prakash on 12/3/13
 */
if(! function_exists('CI'))
{
	function CI()
	{
		$CI =& get_instance(); // making instance of CI
		return $CI; // Its returning an object for CI class
	}
}

/*
 * function is to check if user is logged in or not
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('isUserLoggedIn') )
{
	function isUserLoggedIn()
	{
		$name = CI()->session->userdata('id');
		if( isset($name) && !empty($name) ) return 1;
		else return 0;
	}
}	


/*
 * function is to check if user is logged in or not
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('isPanditLoggedIn') )
{
	function isPanditLoggedIn()
	{
		$name = CI()->session->userdata('pandit_id');
		if( isset($name) && !empty($name) ) return 1;
		else return 0;
	}
}	

/*
 * function is to check if user is logged in or not
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('isClientUserLoggedIn') )
{
	function isClientUserLoggedIn()
	{
		$name = CI()->session->userdata('user_id');
		if( isset($name) && !empty($name) ) return 1;
		else return 0;
	}
}	

/*
 * function is to get user rating new
 * Added By Ravi Prakash on 11/9/13
 */
if( ! function_exists('getUserRatingMyNew') )
{
	function getUserRatingMyNew($id, $type)
	{
		CI()->load->model('ordermodel');
		$q = CI()->ordermodel->getUserRatingMyNew($id, $type);
		return $q;
	}
}	

/*
 * function is to get withdraw balance
 * Added By Raman Chauhan on 4March,14
 */
if( ! function_exists('getUserWithdrawBalance') )
{
	function getUserWithdrawBalance($biller_id, $meta_key)
	{
		CI()->load->model('customer_model');
		$q = CI()->customer_model->getUserWithdrawBalance($biller_id, $meta_key);
		return $q;
	}
}	

/*
 * function is to get user rating
 * Added By Ravi Prakash on 6/5/13
 */
if( ! function_exists('getUserRating') )
{
	function getUserRating($id)
	{
		CI()->load->model('ordermodel');
		$q = CI()->ordermodel->getUserRatings($id);
		return $q;
	}
}
	

/*
 * function is to get round money
 * Added By Ravi Prakash on 11/10/13
 */
if( ! function_exists('getRoundMoney') )
{
	function getRoundMoney($decimal,$places = 2)
	{
		$decimal = round($decimal,$places);
		return ceil($decimal);
	}
}	

/*
 * function is to get user reputation
 * Added By Ravi Prakash on 21/9/13
 */
if( ! function_exists('getUserReputation') )
{
	function getUserReputation($id)
	{
		// getting user rep starts here
		$user_rating     = getUserRating($id);
		//$rate_count      = count($user_rating);
		$user_data       = getUser($id);

		$plusseven       = 0;
		if(!empty($user_rating) && !empty($user_data))
		{						
			if($user_data[0]['user_type'] == 2)
			{
				$total_feed_pts = 0;
				$rate_count = 0;
				foreach($user_rating as $fd)
				{
					$feed_temp       = $fd['easeofwork_rating']*10;

					if($feed_temp >= 70)
					{
						$plusseven++;
					}

					$total_feed_pts += $feed_temp;
					
					$rate_count++;
				}

				$rep = round($total_feed_pts/$rate_count);
			}
			else
			{
				$total_feed_pts = 0;
				$rate_count = 0;
				foreach($user_rating as $fd)
				{
					if($fd['type'] == 1)
					{
						if($fd['backendsales_na_rating'] == 1)
						{
							$feed_temp       = $fd['communication_rating']+$fd['sellervalue_rating']+$fd['deliverytime_rating']+$fd['overallexp_rating']+$fd['conversationandquality_rating']+$fd['buyagain_rating'];

							// for calculating above 70% starts here
							$fff = round($feed_temp/6, 2)*10;
						}
						else
						{
							$feed_temp       = $fd['communication_rating']+$fd['sellervalue_rating']+$fd['deliverytime_rating']+$fd['overallexp_rating']+$fd['conversationandquality_rating']+$fd['backendsales_rating']+$fd['buyagain_rating'];

							// for calculating above 70% starts here
							$fff = round($feed_temp/7, 2)*10;
						}

						if($fff >= 70)
						{
							$plusseven++;
						}
						// for calculating above 70% ends here

						$total_feed_pts += $fff;
						$rate_count++;
					}
					/*
					else
					{
						$feed_temp       = $fd['easeofwork_rating']*10;

						if($feed_temp >= 70)
						{
							$plusseven++;
						}

						$total_feed_pts += $feed_temp;
					}
					*/
				}
				$rep = round($total_feed_pts/$rate_count);
			}
		}
		else
		{
			$rep = 0;
		}
		// getting user rep ends here
		
		return array("rep" => $rep, "plusseven" => $plusseven, "ratecount" => $rate_count);
	}
}	

/*
 * function is to get user favourates
 * Added By Ravi Prakash on 5/6/13
 */
if( ! function_exists('getUserFavourates') )
{
	function getUserFavourates($id)
	{
		CI()->load->model('usermodel');
		$q = CI()->usermodel->getUserFavourates($id);
		return $q;
	}
}	

/*
 * function is to get user sales
 * Added By Ravi Prakash on 6/5/13
 */
if( ! function_exists('getNumberOfSales') )
{
	function getNumberOfSales($id)
	{
		CI()->load->model('ordermodel');
		$q = CI()->ordermodel->getNumberOfSales($id);
		return $q;
	}
}	

/*
 * function is to get unresolved disputes
 * Added By Ravi Prakash on 6/5/13
 */
if( ! function_exists('getUnresolvedDispute') )
{
	function getUnresolvedDispute($id)
	{
		CI()->load->model('ordermodel');
		$q = CI()->ordermodel->getUnresolvedDispute($id);
		return $q;
	}
}

/*
 * function is to get current logged username 
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('getCurrentUserName') )
{
	function getCurrentUserName()
	{
		if(getCurrentUserId())
		{
			$details = getUser(getCurrentUserId());
			return $details[0]['full_name'] != '' ? $details[0]['full_name'] : $details[0]['username'];
		}
	}
}

/*
 * function is to get current logged userid
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('getCurrentUserId') )
{
	function getCurrentUserId()
	{
		return CI()->session->userdata('id');
	}
}

/*
 * function is to get user data
 * Added By Ravi Prakash on 12/3/13
 */
if(! function_exists('getUser'))
{
	function getUser($uid)
	{
		CI()->load->model('usermodel');
		
		$user = CI()->usermodel->getUser($uid);
		return $user;
	}
}

/*
 * function is to get user data by public profile name
 * Added By Ravi Prakash on 12/9/13
 */
if(! function_exists('getUserDataByProfileName'))
{
	function getUserDataByProfileName($publicname)
	{
		CI()->load->model('usermodel');
		
		$user = CI()->usermodel->getUserDataByProfileName($publicname);
		return $user;
	}
}

/*
 * function is to get all active users
 * Added By Ravi Prakash on 10/5/13
 */
if(! function_exists('getUsers'))
{
	function getUsers()
	{
		CI()->load->model('usermodel');
		
		$users = CI()->usermodel->getUsers();
		return $users;
	}
}

/*
 * function is to get user badges
 * Added By Ravi Prakash on 10/5/13
 */
if(! function_exists('getUserBadges'))
{
	function getUserBadges($id)
	{
		CI()->load->model('usermodel');
		
		$badges = CI()->usermodel->getUserBadges($id);
		return $badges;
	}
}

/*
 * function is to assing user badge
 * Added By Ravi Prakash on 10/5/13
 */
if(! function_exists('assignBadge'))
{
	function assignBadge($id, $type)
	{
		CI()->load->model('usermodel');
		
		$data = CI()->usermodel->assignBadge($id, $type);
		return $data;
	}
}

/*
 * function is to get user subscription
 * Added By Ravi Prakash on 28/3/13
 */
if(! function_exists('getUserSubscription'))
{
	function getUserSubscription()
	{
		CI()->load->model('usermodel');
		
		$uid               = getCurrentUserId();
		$user_subscription = CI()->usermodel->getUserSubscription($uid);
		
		$subs_array        = array();
		if(!empty($user_subscription))
		{
			foreach($user_subscription as $subs)
			{
				$key = $subs['meta_key'];
				$val = $subs['meta_value'];
				$subs_array[$key] = $val;
			}
		}
		return $subs_array;
	}
}

/*
 * function is to give start date & end date of current running week
 * Added By Ravi Prakash on 30/3/13
 */
if(! function_exists('getWeekRange'))
{
	/*
	function getWeekRange($date)
	{
		$ts    = strtotime($date);
		$start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
		return array(date('Y-m-d', $start), date('Y-m-d', strtotime('next sunday', $start)));
	}
	*/
	function getWeekRange($datestr)
	{
		date_default_timezone_set(date_default_timezone_get());
		$dt    = strtotime($datestr);
		$res[] = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
		$res[] = date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
		return $res;
    }
}

/*
 * function is to give hall of fame members
 * Added By Ravi Prakash on 13/5/13
 */
if(! function_exists('getHallOfFameMembers'))
{
	function getHallOfFameMembers($data)
	{
		if($data['sort_type'] == 'week')
		{
			$ts          = time();
			$start       = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
			$final_start = $start; 
			$final_end   = strtotime('next sunday', $start);
		}
		elseif($data['sort_type'] == 'month')
		{
			$ts          = time();
			$start       = (date('w', $ts) == 0) ? $ts : strtotime('last month', $ts);
			$final_start = $start; 
			$final_end   = strtotime('next month', $start);
		}
		elseif($data['sort_type'] == 'year')
		{
			$ts          = time();
			$start       = (date('w', $ts) == 0) ? $ts : strtotime('last year', $ts);
			$final_start = $start; 
			$final_end   = strtotime('next year', $start);
		}
		elseif($data['sort_type'] == 'lifetime')
		{
			$final_start = ''; 
			$final_end   = '';
		}
		else
		{			
			$final_start = ''; 
			$final_end   = '';
		}
		
		CI()->load->model('adpackagemodel');
		CI()->load->model('ordermodel');
		CI()->load->model('usermodel');
		
		// get all ad packages that matches time conditions
		$result = CI()->adpackagemodel->getAllAvailableAdsByTime($final_start, $final_end, $data['click_type']);

		$final_users = array();
		$usersss     = array();
		if(!empty($result))
		{
			foreach($result as $res)
			{
				// calculating reputation
				$reputaion = 0;
				
				// get user data
				$userdataaa = getUser($res['biller_id']);				
				
				// user is active and seller
				if($userdataaa[0]['is_active'] == 1 && $userdataaa[0]['user_type'] == 1)
				{	
					// get user subscription
					$usersubs   = CI()->usermodel->getUserSubscription($res['biller_id']);
					$subs_array = array();
					if(!empty($usersubs))
					{
						foreach($usersubs as $subs)
						{
							$key = $subs['meta_key'];
							$val = $subs['meta_value'];
							$subs_array[$key] = $val;
						}
					}
					
					// user subscription is gold or above
					if(!empty($subs_array) && $subs_array['id'] > 1)
					{
						$user_ratingtest = CI()->ordermodel->getUserRatingByKeys($res['id'], $res['ad_id'], $res['biller_id']);
						$user_rating     = getUserRating($res['biller_id']);
					
						$plusseven       = 0;
						if(!empty($user_ratingtest))
						{
							if(!in_array($res['biller_id'], $usersss))
							{
								$rate_count      = count($user_rating);
					
								$total_feed_pts = 0;
								foreach($user_rating as $fd)
								{
									if($fd['type'] == 1)
									{
										$feed_temp       = $fd['communication_rating']+$fd['sellervalue_rating']+$fd['deliverytime_rating']+$fd['overallexp_rating']+$fd['conversationandquality_rating']+$fd['backendsales_rating']+$fd['buyagain_rating'];
						
										$fff = round($feed_temp/7, 2)*10;
						
										if($fff >= 7)
										{
											$plusseven++;
										}
						
										$total_feed_pts += $fff;
									}							
									else
									{
										$feed_temp       = $fd['easeofwork_rating']*10;

										if($feed_temp >= 70)
										{
											$plusseven++;
										}

										$total_feed_pts += $feed_temp;
									}
								}
					
								$reputaion = round($total_feed_pts/$rate_count);
				
								$final_users[$res['biller_id'].'_'.$fd['id']] = $reputaion;
								$usersss[] = $res['biller_id'];
							}
						}
					}
				}
			}
		}
		
		$html = '';
		if(!empty($final_users))
		{
			arsort($final_users);
			$counter = 1;
			foreach($final_users as $user => $rating)
			{
				if($counter > 10)
				{
					break;
				}
						
				$explode     = explode('_', $user);
				$user_detail = getUser($explode[0]);
				$profile_pic = getUserMeta($explode[0], 'profile_pic');
				
				$user_badges = getUserBadges($explode[0]);
				
				$ratings     = CI()->ordermodel->getRatingById($explode[1]);
				$rating_user = getUser($ratings['post_rating_biller_id']);
				
				$new_badge = '';
				if(!empty($user_badges))
				{
					foreach($user_badges as $badge)
					{
						if($badge['assigned_badge'] == 's_1')
						{
							$new_badge .= '<img style="width:72px;height:69px;" src="'.getSkinUrl('images/01-Seller.png').'" alt="" />';
						}
						elseif($badge['assigned_badge'] == 's_2')
						{
							$new_badge .= '<img style="width:72px;height:69px;" src="'.getSkinUrl('images/02-Approved-Seller.png').'" alt="" />';
						}
						elseif($badge['assigned_badge'] == 's_3')
						{
							$new_badge .= '<img style="width:72px;height:69px;" src="'.getSkinUrl('images/03-Trusted-Seller.png').'" alt="" />';
						}
						elseif($badge['assigned_badge'] == 's_4')
						{
							$new_badge .= '<img style="width:72px;height:69px;" src="'.getSkinUrl('images/04-Premium-Seller.png').'" alt="" />';
						}
						elseif($badge['assigned_badge'] == 's_5')
						{
							$new_badge .= '<img style="width:72px;height:69px;" src="'.getSkinUrl('images/05-Top-Seller.png').'" alt="" />';
						}
						elseif($badge['assigned_badge'] == 's_6')
						{
							$new_badge .= '<img style="width:72px;height:69px;" src="'.getSkinUrl('images/06-Seller-VIP-Badge.png').'" alt="" />';
						}
						elseif($badge['assigned_badge'] == 'sss')
						{
							$new_badge .= '<img style="width:72px;height:69px;" src="'.getSkinUrl('images/06-Seller-VIP-Badge.png').'" alt="" />';
						}
					}
				}


				$html .= '<section class="sc-block-main-comment">
							<aside class="fleft sc-block-one">
								<span class="sc-number">'.$counter.'</span>
								<section class="fright">
									<article class="sc-photo-blk">';
										if(isset($profile_pic['meta_value']) && $profile_pic['meta_value'] != '')
										{
											$html .= '<img style="width:77px;height:77px;" src="'.getSkinUrl('images/users/'.$profile_pic['meta_value']).'"/>';
										}
										else
										{
											$html .= '<img style="width:77px;height:77px;" src="'.getSkinUrl('images/dummy-img.jpg').'"/>';
										}
									$html .= '</article>
									<article class="sc-rep-blk">
										<img style="width:77px;" src="'.getSkinUrl('images/repnumbers/rep__'.$rating.'.jpg').'">
										<!-- h3>REP</h3>
										<span class="sc-count-blk">'.$rating.'</span -->
									</article>
								</section>								
							</aside>

							<aside class="fright sc-block-two">
								<article class="fleft sc-comment-blk">';
									if(!empty($user_detail))
									{
										$html .= '<h3>'.$user_detail[0]['first_name'].' '.$user_detail[0]['last_name'].'</h3>';
									}
									else
									{
										$html .= '<h3>Deleted User</h3>';
									}
									
									if(strlen($ratings['user_comments']) > 380)
									{
										$user_comments = '<div id="small_'.$counter.'"><p>"'.substr(trim($ratings['user_comments']), 0, 380).'..."
												  		  	&nbsp;<a href="javascript:void(0);" class="showfulldata" rel="'.$counter.'">Read More</a></p>
												  		  </div>
												  		  <div style="display:none;" id="full_'.$counter.'"><p>"'.trim($ratings['user_comments']).'"
												  		  	&nbsp;<a href="javascript:void(0);" class="hidefulldata" rel="'.$counter.'">Hide</a></p>
												  		  </div>';
									}
									else
									{
										$user_comments = '<p>"'.trim($ratings['user_comments']).'"</p>';
									}
									
									$html .= $user_comments.'
									<div class="sc-clear"></div>
									<span class="fright sc-member-name">"'.$rating_user[0]['first_name'].' '.$rating_user[0]['last_name'].'"</span>
									<div class="sc-clear"></div>
								</article>

								<article class="fright sc-bades-blk">';
								if(!empty($user_detail))
								{
									$html .= '<span class="sc-date">Date: '.date('d M Y', $user_detail[0]['created_date']).'</span>';
								}
								else
								{
									$html .= '<span class="sc-date">Date: N/A</span>';
								}
									$html .= $new_badge.'
									<span class="sc-bades-award">Badges Awarded</span>';
								if(!empty($user_detail))
								{
									$html .= '<a href="'.getUrl('member/viewprofile/'.$explode[0]).'" target="_blank" class="sc-commen-btn sc-view-button">View Profile</a>';
								}
								$html .= '</article>
							</aside>
							<div class="sc-clear"></div>
						</section>';
						
						$counter++;
			}
		}
		else
		{
			$html .= "<center>No Members Yet</center>";
		}
		echo $html;
	}
}

/*
 * function is to get user meta data
 * Added By Ravi Prakash on 26/3/13
 */
if(! function_exists('getUserMeta'))
{
	function getUserMeta($uid, $key='')
	{
		CI()->load->model('usermodel');
		
		$user = CI()->usermodel->getUserMeta($uid, $key);
		return $user;
	}
}

/*
 * function is to get order meta data
 * Added By Ravi Prakash on 2/5/13
 */
if(! function_exists('getOrderMeta'))
{
	function getOrderMeta($oid, $key='')
	{
		CI()->load->model('ordermodel');
		
		$order = CI()->ordermodel->getOrderMeta($oid, $key);
		return $order;
	}
}

/*
 * function is to get avg delivery time
 * Added By Ravi Prakash on 6/5/13
 */
if(! function_exists('getAvgDeliveryTime'))
{
	function getAvgDeliveryTime($uid)
	{
		CI()->load->model('ordermodel');
		
		$order = CI()->ordermodel->getAvgDeliveryTime($uid);
		return $order;
	}
}

/*
 * function is to get dispute list for order page
 * Added By Ravi Prakash on 4/5/13
 */
if(! function_exists('getDisputeListForOrderPage'))
{
	function getDisputeListForOrderPage($oid)
	{
		CI()->load->model('ordermodel');
		
		$order = CI()->ordermodel->getDisputeListForOrderPage($oid);
		return $order;
	}
}

/*
 * function is to get dispute list for order page after order completion
 * Added By Ravi Prakash on 4/5/13
 */
if(! function_exists('getDisputeListForOrderPageAfter'))
{
	function getDisputeListForOrderPageAfter($oid)
	{
		CI()->load->model('ordermodel');
		
		$order = CI()->ordermodel->getDisputeListForOrderPageAfter($oid);
		return $order;
	}
}

/*
 * function is to get dispute resolved by
 * Added By Ravi Prakash on 4/5/13
 */
if(! function_exists('getDisputeResolvedBy'))
{
	function getDisputeResolvedBy($did)
	{
		CI()->load->model('ordermodel');
		
		$order = CI()->ordermodel->getDisputeResolvedBy($did);
		return $order;
	}
}

/*
 * function is to get all canned message
 * Added By Ravi Prakash on 18/3/13
 */
if(! function_exists('getAllCannedMessage'))
{
	function getAllCannedMessage()
	{
		CI()->load->model('cannedmodel');
		
		$canned = CI()->cannedmodel->getAllCanned();
		return $canned;
	}
}

/*
 * function is to get canned message by id
 * Added By Ravi Prakash on 18/3/13
 */
if(! function_exists('getCannedById'))
{
	function getCannedById($id)
	{
		CI()->load->model('cannedmodel');
		
		$canned = CI()->cannedmodel->getCannedById($id);
		return $canned;
	}
}

/* get the help page by id
added by dheeraj maulekhi*/
if(! function_exists('getHelpPageById'))
{
	function getHelpPageById($id)
	{
		CI()->load->model('cannedmodel');
		
		$canned = CI()->cannedmodel->getHelpPageById($id);
		return $canned;
	}
}



/*
 * function is to get subscription by id
 * Added By Ravi Prakash on 23/3/13
 */
if(! function_exists('getSubscriptionById'))
{
	function getSubscriptionById($id)
	{
		CI()->load->model('subscriptionmodel');
		
		$subscription = CI()->subscriptionmodel->getSubscriptionById($id);
		return $subscription;
	}
}

/*
 * function is to get subscription by id
 * Added By Ravi Prakash on 23/3/13
 */
if(! function_exists('getBuyerSubscriptionById'))
{
	function getBuyerSubscriptionById($id)
	{
		CI()->load->model('subscriptionmodel');
		
		$subscription = CI()->subscriptionmodel->getBuyerSubscriptionById($id);
		return $subscription;
	}
}

/*
 * function is to get registered sellers
 * Added By Ravi Prakash on 23/3/13
 */
if(! function_exists('totalRegisteredSellers'))
{
	function totalRegisteredSellers()
	{
		CI()->load->model('usermodel');
		
		$sellers = CI()->usermodel->totalRegisteredSellers();
		return $sellers;
	}
}

/*
 * function is to get tutorial by id
 * Added By Ravi Prakash on 22/3/13
 */
if(! function_exists('getTutorialById'))
{
	function getTutorialById($id)
	{
		CI()->load->model('tutorialmodel');
		
		$tutorial = CI()->tutorialmodel->getTutorialById($id);
		return $tutorial;
	}
}

/*
 * function is to get faq by id
 * Added By Ravi Prakash on 22/3/13
 */
if(! function_exists('getFaqById'))
{
	function getFaqById($id)
	{
		CI()->load->model('faqmodel');
		
		$faq = CI()->faqmodel->getFaqById($id);
		return $faq;
	}
}

//by dheeraj for get the rec of cash limit
if(! function_exists('getCashLimitById'))
{
 function getCashLimitById($id)
    {
	
		CI()->load->model('customer_model');
		
		$cash = CI()->customer_model->getCashLimitById($id);
		return $cash;
		
    	
    }
}
// code end

/*
 * function is to get benifit by id
 * Added By Ravi Prakash on 10/4/13
 */
if(! function_exists('getBenifitById'))
{
	function getBenifitById($id)
	{
		CI()->load->model('benifitmodel');
		
		$bn = CI()->benifitmodel->getBenifitById($id);
		return $bn;
	}
}

/*
 * function is to get feature by id
 * Added By Ravi Prakash on 11/4/13
 */
if(! function_exists('getFeatureById'))
{
	function getFeatureById($id)
	{
		CI()->load->model('featuremodel');
		
		$fe = CI()->featuremodel->getFeatureById($id);
		return $fe;
	}
}

/*
 * function is to get all active benifits
 * Added By Ravi Prakash on 10/4/13
 */
if(! function_exists('getAllActiveBenifits'))
{
	function getAllActiveBenifits()
	{
		CI()->load->model('benifitmodel');
		
		$bn = CI()->benifitmodel->getAllActiveBenifits();
		return $bn;
	}
}

/*
 * function is to get all active features
 * Added By Ravi Prakash on 11/4/13
 */
if(! function_exists('getAllActiveFeatures'))
{
	function getAllActiveFeatures()
	{
		CI()->load->model('featuremodel');
		
		$fe = CI()->featuremodel->getAllActiveFeatures();
		return $fe;
	}
}

/*
 * function is to get assigned ad data
 * Added By Ravi Prakash on 4/5/13
 */
if(! function_exists('getAssignedAdData'))
{
	function getAssignedAdData($asid)
	{
		CI()->load->model('adpackagemodel');
		
		$faq = CI()->adpackagemodel->getAssignedAdData($asid);
		return $faq;
	}
}

/*
 * function is to get solo ads by category id
 * Added By Ravi Prakash on 22/3/13
 */
if(! function_exists('getAdsByCategory'))
{
	function getAdsByCategory($cid)
	{
		CI()->load->model('adpackagemodel');
		
		$faq = CI()->adpackagemodel->getAdsByCategoryId($cid);
		return $faq;
	}
}

/*
 * function is to get solo ads by id
 * Added By Ravi Prakash on 18/4/13
 */
if(! function_exists('getAdsById'))
{
	function getAdsById($id)
	{
		CI()->load->model('adpackagemodel');
		
		$faq = CI()->adpackagemodel->getAdPackageById($id);
		return $faq;
	}
}

/*
 * function is to get ad category by id
 * Added By Ravi Prakash on 2/4/13
 */
if(! function_exists('getAdPackageCategoryById'))
{
	function getAdPackageCategoryById($id)
	{
		CI()->load->model('adpackagemodel');
		
		$ad_pack = CI()->adpackagemodel->getAdPackageCategoryById($id);
		return $ad_pack;
	}
}

/*
 * function is to get news and announcement by id
 * Added By Ravi Prakash on 22/3/13
 */
if(! function_exists('getNewsAnnouncementById'))
{
	function getNewsAnnouncementById($id)
	{
		CI()->load->model('newsandannouncementmodel');
		
		$news = CI()->newsandannouncementmodel->getNewsAndAnnouncementById($id);
		return $news;
	}
}

/*
 * function is to get static ad by id
 * Added By Ravi Prakash on 22/3/13
 */
if(! function_exists('getStaticAdById'))
{
	function getStaticAdById($id)
	{
		CI()->load->model('staticadsmodel');
		
		$ad = CI()->staticadsmodel->getStaticAdById($id);
		return $ad;
	}
}

/*
 * function is to get banner by id
 * Added By Ravi Prakash on 17/4/13
 */
if(! function_exists('getBannerById'))
{
	function getBannerById($id)
	{
		CI()->load->model('bannermodel');
		
		$ad = CI()->bannermodel->getBannerById($id);
		return $ad;
	}
}

/*
 * function is to get active banners
 * Added By Ravi Prakash on 17/4/13
 */
if(! function_exists('getActiveBanners'))
{
	function getActiveBanners()
	{
		CI()->load->model('bannermodel');
		
		$ad = CI()->bannermodel->getAllActiveBanners();
		return $ad;
	}
}

/*
 * function is to get all active news and announcement
 * Added By Ravi Prakash on 25/3/13
 */
if(! function_exists('getAllActiveNewsAnnouncements'))
{
	function getAllActiveNewsAnnouncements()
	{
		CI()->load->model('newsandannouncementmodel');
		
		$news = CI()->newsandannouncementmodel->getAllActiveNewsAnnouncements();
		return $news;
	}
}

/*
 * function is to get faq category by id
 * Added By Ravi Prakash on 22/3/13
 */
if(! function_exists('getFaqCategoryById'))
{
	function getFaqCategoryById($id)
	{
		CI()->load->model('faqmodel');
		
		$cat = CI()->faqmodel->getFaqCategoryById($id);
		return $cat;
	}
}

/*
 * function is to get all active faq category
 * Added By Ravi Prakash on 22/3/13
 */
if(! function_exists('getAllActiveFaqCategory'))
{
	function getAllActiveFaqCategory()
	{
		CI()->load->model('faqmodel');
		
		$cats = CI()->faqmodel->getAllActiveFaqCategory();
		return $cats;
	}
}

/*
 * function is to get order detail
 * Added By Ravi Prakash on 29/4/13
 */
if(! function_exists('getOrderDetail'))
{
	function getOrderDetail($oid)
	{
		CI()->load->model('ordermodel');
		
		$order = CI()->ordermodel->getOrderDetail($oid);
		return $order;
	}
}

/*
 * function is to get user total orders
 * Added By Ravi Prakash on 7/5/13
 */
if(! function_exists('getUserTotalOrders'))
{
	function getUserTotalOrders($uid, $type)
	{
		CI()->load->model('ordermodel');
		
		$order = CI()->ordermodel->getUserTotalOrders($uid, $type);
		return $order;
	}
}

/*
 * function is to get spam user
 * Added By Abdul Quadir on 27/5/13
 */
if(! function_exists('getUserSpam'))
{
	function getSpamUser($uid)
	{
		CI()->load->model('ordermodel');
		
		$spam = CI()->ordermodel->getSpamUser($uid);
		return $spam;
	}
}

/*
 * function is to get order disputes
 * Added By Ravi Prakash on 4/5/13
 */
if(! function_exists('getOrderDispute'))
{
	function getOrderDispute($oid)
	{
		CI()->load->model('ordermodel');
		
		$orderdispute = CI()->ordermodel->getOrderDispute($oid);
		return $orderdispute;
	}
}

/*
 * function is to get site content
 * Added By Ravi Prakash on 9/4/13
 */
if(! function_exists('getSiteContentByKey'))
{
	function getSiteContentByKey($key)
	{
		CI()->load->model('cmsmodel');
		
		$cats = CI()->cmsmodel->getContentByKey($key);
		return $cats;
	}
}

if(! function_exists('getUserOrdersByUserId') )
{
    function getUserOrdersByUserId($userid)
    {
        CI()->load->model('ordermodel');
		
		$orders = CI()->ordermodel->getUserOrdersByUserId($userid);
		return $orders;
    }
}

if(! function_exists('getBuyerOrdersByBuyerId') )
{
    function getBuyerOrdersByBuyerId($userid)
    {
        CI()->load->model('ordermodel');
		
		$orders = CI()->ordermodel->getBuyerOrdersByBuyerId($userid);
		return $orders;
    }
}

if(! function_exists('getOrderUserRating') )
{
    function getOrderUserRating($postuserid, $getuserid, $oid)
    {
        CI()->load->model('ordermodel');
		
		$data                        = array();
		$data['post_rating_biller_id'] = $postuserid;
		$data['get_rating_biller_id']  = $getuserid;
		$data['order_id']            = $oid;
		
		$rating = CI()->ordermodel->checkFeedback($data);
		return $rating;
    }
}

if(! function_exists('checkBothFeedback') )
{
    function checkBothFeedback($postuserid, $getuserid, $oid)
    {
        CI()->load->model('ordermodel');
		
		$data                        = array();
		$data['post_rating_biller_id'] = $postuserid;
		$data['get_rating_biller_id']  = $getuserid;
		$data['order_id']            = $oid;
		
		$rating = CI()->ordermodel->checkBothFeedback($data);
		return $rating;
    }
}

/*
 * function is to check if admin is logged in or not
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('isAdminLoggedIn') )
{
	function isAdminLoggedIn()
	{
	
		$name = CI()->session->userdata('admin_id');
		if( isset($name) && !empty($name) ) return 1;
		else return 0;
	}
}

/*
 * function is to get admin id
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('getCurrentAdminId') )
{
	function getCurrentAdminId()
	{
		return CI()->session->userdata('adminid');
	}
}

/*
 * format string
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('cleanString') )
{
	function cleanString($string='')
	{
		$string	= html_entity_decode($string);
		$string	= strip_slashes($string);
		return $string;
	}
}

/*
 * encode string
 * Added By Ravi Prakash on 12/3/13
 */
if(! function_exists('encodeString'))
{
    function encodeString($string = '')
    {
		$string = addslashes($string);
		$string = htmlentities($string);
		return $string;
    }
}

/*
 * delete extra ads
 * Added By Ravi Prakash on 12/3/13
 */
if(! function_exists('getUserTodaysAssignedAdsBySellerId'))
{
	function getUserTodaysAssignedAdsBySellerId($biller_id, $assigned_id)
	{
		CI()->load->model('adpackagemodel');
		// get assigned ad data
		$assigned_ad_data = getAssignedAdData($assigned_id);
		
		$tmpdate          = date('d/m/Y', $assigned_ad_data['assigned_date']);
		$explode          = explode('/', $tmpdate);
		$strtoday         = mktime(0, 0, 0, $explode[1], $explode[0], $explode[2]);
		//$strnext          = strtotime("+1 Day", $strtoday);
		
		// get active ads started on the ordered assigned date
		$active_ads       = CI()->adpackagemodel->getUserActiveAdsByUserAndDate($biller_id, $strtoday);
		
		// get ordered ads started on the ordered assigned date
		$inactive_ads     = CI()->adpackagemodel->getUserSoldAdsByUserAndDate($biller_id, $strtoday);
		
		if(empty($active_ads))
		{
			$ads = $inactive_ads;
		}
		elseif(empty($inactive_ads))
		{
			$ads = $active_ads;
		}
		elseif(!empty($active_ads) && !empty($inactive_ads))
		{
			$ads = array_merge($active_ads, $inactive_ads);
		}
		else
		{
			$ads = array();
		}
		
		$finalads = array();
		if(!empty($ads))
		{
			foreach($ads as $ad)
			{
				if($ad['assigned_date'] >= $strtoday)
				{
					$finalads[] = $ad;
				}
			}
		}
		
		/*
		$active_ads      = $this->adpackagemodel->getUserActiveAssignedAdsById($biller_id);
		
		$inactive_ads    = $this->adpackagemodel->getUserSoldAdsByUserId($biller_id);
		
		if(empty($active_ads))
		{
			$ads = $inactive_ads;
		}
		elseif(empty($inactive_ads))
		{
			$ads = $active_ads;
		}
		elseif(!empty($active_ads) && !empty($inactive_ads))
		{
			$ads = array_merge($active_ads, $inactive_ads);
		}
		else
		{
			$ads = array();
		}
		
		// get assigned ad data
		$assigned_ad_data = getAssignedAdData($assigned_id);
		
		$tmpdate  = date('d/m/Y', $assigned_ad_data['assigned_date']);
		$explode  = explode('/', $tmpdate);
		$strtoday = mktime(0, 0, 0, $explode[1], $explode[0], $explode[2]);
		$strnext  = strtotime("+1 Day", $strtoday);
		$finalads = array();
		if(!empty($ads))
		{
			foreach($ads as $ad)
			{
				if($ad['assigned_date'] >= $strtoday && $ad['assigned_date'] < $strnext)
				{
					$finalads[] = $ad;
				}
			}
		}
		*/
		
		$userdailyclicklimit = getUserMeta($biller_id, 'user_daily_click_limit');
		$addwithstatus       = 0;
		if(!empty($finalads))
		{
			foreach($finalads as $aafd)
			{
				if($aafd['status'] == 0)
				{
					$addwithstatus += @$aafd['amount'];
				}
			}
			
			$remainingclick = $userdailyclicklimit['meta_value'] - $addwithstatus;
			
			/*
			if($remainingclick < 0)
			{
			*/
				$remainder = floor($addwithstatus/$userdailyclicklimit['meta_value']);
				
				for($i=0; $i < $remainder; $i++)
				{
					if($i == 0)
					{
						$start = $strtoday;
						$end   = strtotime("+1 Day", $strtoday);
					}
					else
					{
						$start = strtotime("+$i Days", $strtoday);
						
						$day   = $i+1;
						$end   = strtotime("+$day Days", $strtoday);
					}
					
					//echo date('d/m/Y', $start).', '.date('d/m/Y', $end)."<br />";
					CI()->adpackagemodel->removeUserAssignedAdsByDates($start, $end);
				}
				/*
			}
			else
			{
				$remainder = floor($addwithstatus/$userdailyclicklimit['meta_value']);
				
				for($i=0; $i <= $remainder; $i++)
				{
					if($i == 0)
					{
						$start = $strtoday;
						$end   = strtotime("+1 Day", $strtoday);
					}
					else
					{
						$start = strtotime("+$i Days", $strtoday);
						
						$day   = $i+1;
						$end   = strtotime("+$day Days", $strtoday);
					}
					
					
					$this->adpackagemodel->removeUserAssignedAdsByDates($start, $end);
				}
			}
			*/
		}
	}
}

/*
 * get site notifications 
 * Added By Ravi Prakash on 12/3/13
 */
if( ! function_exists('getNotificationHtml') )
{
	function getNotificationHtml()
	{
		if( CI()->session->flashdata('notification') )
		{
			$notificationData = CI()->session->flashdata('notification');
			
			if( $notificationData['error'] == 0 )
			{
			?>
				<div class="mm-success"><?php echo $notificationData['message']; ?></div>
			<?php
			}
			elseif( $notificationData['error'] == 1 )
			{
			?>
			<div class="mm-error"><?php echo $notificationData['message']; ?></div>
			<?php
			}
		}
	}
}

/* 
 * function to generate random passwords
 * Added By Ravi Prakash on 21/3/13
 */
if ( ! function_exists('random_password'))
{
	function random_password($length = 10)
	{
		$allowable_characters = "abcdefghjkmnpqrstuvxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";
		$ps_len               = strlen($allowable_characters);
		mt_srand((double)microtime()*1000000);

		$pass = "";
		for($i = 0; $i < $length; $i++)
		{
			$pass .= $allowable_characters[mt_rand(0,$ps_len-1)];
		}
		return $pass;
	}
}

/* 
 * function to generate random username
 * Added By Ravi Prakash on 21/3/13
 */
if ( ! function_exists('randomusername'))
{
	function randomusername($string, $length = 10)
	{
		$allowable_characters = $string;
		$ps_len               = strlen($allowable_characters);
		mt_srand((double)microtime()*1000000);

		$pass = "";
		for($i = 0; $i < $length; $i++)
		{
			$pass .= $allowable_characters[mt_rand(0,$ps_len-1)];
		}
		return $pass;
	}
}

/*
 * function to get conversation excerpt
 * Added By Ravi Prakash on 30/3/13
 */        
if(! function_exists('getConversationExcerpt'))
{
	function getConversationExcerpt($tid)
	{
		//$tid is id of the conversation
		CI()->load->model('usermodel');
		$result = CI()->usermodel->get_thread_excerpt($tid);
		return $result;
	}
}

/*
 * function to get excerpt
 * Added By Ravi Prakash on 22/3/13
 */
if(!function_exists('excerpt'))
{
	function excerpt($str, $length=10, $link='', $trailing='...')
	{
		$str    = strip_tags($str);
		/*
		** $str -String to truncate
		** $length - length to truncate
		** $trailing - the trailing character, default: "..."
		*/
		// take off chars for the trailing
		$length -= mb_strlen($trailing);
		if(mb_strlen($str) > $length)
		{
			// string exceeded length, truncate and add trailing dots
			return mb_substr($str,0,$length).$trailing.$link;
		}
		else
		{
			// string was already short enough, return the string
			$res = $str;
		}
		return $res;
	}
}

/*
 * function to get youtube image
 * Added By Ravi Prakash on 22/3/13
 */
if(!function_exists('getYoutubeImage'))
{
	function getYoutubeImage($e)
	{
		//GET THE URL
		$url = $e;

		$queryString = parse_url($url, PHP_URL_QUERY);

		parse_str($queryString, $params);

		$v = $params['v'];  
		//DISPLAY THE IMAGE
		if(strlen($v) > 0)
		{
			return $v;
			//echo "<img src='http://i3.ytimg.com/vi/$v/default.jpg' />";
		}
		else
		{
			return "";
		}
	}
}

/*
 * function is to get the timezone array
 * Added By Ravi Prakash on 12/3/13
 */
 if(!function_exists('getTimeZoneArray'))
 {
 	function getTimeZoneArray()
 	{
 		/*
 		$timezones = DateTimeZone::listAbbreviations();

		$cities = array();
		foreach( $timezones as $key => $zones )
		{
			foreach( $zones as $id => $zone )
			{
				/**
				 * Only get timezones explicitely not part of "Others".
				 * @see http://www.php.net/manual/en/timezones.others.php
				 */
				/*
				if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'] ) 
					&& $zone['timezone_id']) {
				    $cities[$zone['timezone_id']][] = $key;
				}
			}
		}

		// For each city, have a comma separated list of all possible timezones for that city.
		foreach( $cities as $key => $value )
			$cities[$key] = join( ', ', $value);

		// Only keep one city (the first and also most important) for each set of possibilities. 
		$cities = array_unique( $cities );

		// Sort by area/city name.
		ksort( $cities );
		*/
		$cities  = array(
						'Pacific/Midway'					=> '(GMT-11:00) Midway Island, Samoa',
						'America/Adak'						=> '(GMT-10:00) Hawaii-Aleutian',
						'Etc/GMT+10'						=> '(GMT-10:00) Hawaii',
						'Pacific/Marquesas' 				=> '(GMT-09:30) Marquesas Islands',
						'Pacific/Gambier' 					=> '(GMT-09:00) Gambier Islands',
						'America/Anchorage' 				=> '(GMT-09:00) Alaska',
						'America/Ensenada' 					=> '(GMT-08:00) Tijuana, Baja California',
						'Etc/GMT+8' 						=> '(GMT-08:00) Pitcairn Islands',
						'America/Los_Angeles' 				=> '(GMT-08:00) Pacific Time (US & Canada)',
						'America/Denver' 					=> '(GMT-07:00) Mountain Time (US & Canada)',
						'America/Chihuahua' 				=> '(GMT-07:00) Chihuahua, La Paz, Mazatlan',
						'America/Dawson_Creek' 				=> '(GMT-07:00) Arizona',
						'America/Belize' 					=> '(GMT-06:00) Saskatchewan, Central America',
						'America/Cancun' 					=> '(GMT-06:00) Guadalajara, Mexico City, Monterrey',
						'Chile/EasterIsland' 				=> '(GMT-06:00) Easter Island',
						'America/Chicago' 					=> '(GMT-06:00) Central Time (US & Canada)',
						'America/New_York' 					=> '(GMT-05:00) Eastern Time (US & Canada)',
						'America/Havana' 					=> '(GMT-05:00) Cuba',
						'America/Bogota' 					=> '(GMT-05:00) Bogota, Lima, Quito, Rio Branco',
						'America/Caracas' 					=> '(GMT-04:30) Caracas',
						'America/Santiago' 					=> '(GMT-04:00) Santiago',
						'America/La_Paz' 					=> '(GMT-04:00) La Paz',
						'Atlantic/Stanley' 					=> '(GMT-04:00) Faukland Islands',
						'America/Campo_Grande' 				=> '(GMT-04:00) Brazil',
						'America/Goose_Bay' 				=> '(GMT-04:00) Atlantic Time (Goose Bay)',
						'America/Glace_Bay' 				=> '(GMT-04:00) Atlantic Time (Canada)',
						'America/St_Johns' 					=> '(GMT-03:30) Newfoundland',
						'America/Araguaina' 				=> '(GMT-03:00) UTC-3',
						'America/Montevideo' 				=> '(GMT-03:00) Montevideo',
						'America/Miquelon' 					=> '(GMT-03:00) Miquelon, St. Pierre',
						'America/Godthab' 					=> '(GMT-03:00) Greenland',
						'America/Argentina/Buenos_Aires' 	=> '(GMT-03:00) Buenos Aires',
						'America/Sao_Paulo' 				=> '(GMT-03:00) Brasilia',
						'America/Noronha' 					=> '(GMT-02:00) Mid-Atlantic',
						'Atlantic/Cape_Verde' 				=> '(GMT-01:00) Cape Verde Is.',
						'Atlantic/Azores' 					=> '(GMT-01:00) Azores',
						'Europe/Belfast' 					=> '(GMT) Greenwich Mean Time : Belfast',
						'Europe/Dublin' 					=> '(GMT) Greenwich Mean Time : Dublin',
						'Europe/Lisbon' 					=> '(GMT) Greenwich Mean Time : Lisbon',
						'Europe/London' 					=> '(GMT) Greenwich Mean Time : London',
						'Africa/Abidjan' 					=> '(GMT) Monrovia, Reykjavik',
						'Europe/Amsterdam' 					=> '(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna',
						'Europe/Belgrade' 					=> '(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague',
						'Europe/Brussels' 					=> '(GMT+01:00) Brussels, Copenhagen, Madrid, Paris',
						'Africa/Algiers' 					=> '(GMT+01:00) West Central Africa',
						'Africa/Windhoek'	 				=> '(GMT+01:00) Windhoek',
						'Asia/Beirut' 						=> '(GMT+02:00) Beirut',
						'Africa/Cairo' 						=> '(GMT+02:00) Cairo',
						'Asia/Gaza' 						=> '(GMT+02:00) Gaza',
						'Africa/Blantyre' 					=> '(GMT+02:00) Harare, Pretoria',
						'Asia/Jerusalem' 					=> '(GMT+02:00) Jerusalem',
						'Europe/Minsk' 						=> '(GMT+02:00) Minsk',
						'Asia/Damascus' 					=> '(GMT+02:00) Syria',
						'Europe/Moscow' 					=> '(GMT+03:00) Moscow, St. Petersburg, Volgograd',
						'Africa/Addis_Ababa' 				=> '(GMT+03:00) Nairobi',
						'Asia/Tehran' 						=> '(GMT+03:30) Tehran',
						'Asia/Dubai' 						=> '(GMT+04:00) Abu Dhabi, Muscat',
						'Asia/Yerevan' 						=> '(GMT+04:00) Yerevan',
						'Asia/Kabul' 						=> '(GMT+04:30) Kabul',
						'Asia/Yekaterinburg' 				=> '(GMT+05:00) Ekaterinburg',
						'Asia/Tashkent' 					=> '(GMT+05:00) Tashkent',
						'Asia/Kolkata' 						=> '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi',
						'Asia/Katmandu' 					=> '(GMT+05:45) Kathmandu',
						'Asia/Dhaka' 						=> '(GMT+06:00) Astana, Dhaka',
						'Asia/Novosibirsk' 					=> '(GMT+06:00) Novosibirsk',
						'Asia/Rangoon' 						=> '(GMT+06:30) Yangon (Rangoon)',
						'Asia/Bangkok' 						=> '(GMT+07:00) Bangkok, Hanoi, Jakarta',
						'Asia/Krasnoyarsk' 					=> '(GMT+07:00) Krasnoyarsk',
						'Asia/Hong_Kong' 					=> '(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi',
						'Asia/Irkutsk' 						=> '(GMT+08:00) Irkutsk, Ulaan Bataar',
						'Australia/Perth' 					=> '(GMT+08:00) Perth',
						'Australia/Eucla' 					=> '(GMT+08:45) Eucla',
						'Asia/Tokyo' 						=> '(GMT+09:00) Osaka, Sapporo, Tokyo',
						'Asia/Seoul' 						=> '(GMT+09:00) Seoul',
						'Asia/Yakutsk' 						=> '(GMT+09:00) Yakutsk',
						'Australia/Adelaide' 				=> '(GMT+09:30) Adelaide',
						'Australia/Darwin' 					=> '(GMT+09:30) Darwin',
						'Australia/Brisbane' 				=> '(GMT+10:00) Brisbane',
						'Australia/Hobart' 					=> '(GMT+10:00) Hobart',
						'Asia/Vladivostok' 					=> '(GMT+10:00) Vladivostok',
						'Australia/Lord_Howe' 				=> '(GMT+10:30) Lord Howe Island',
						'Etc/GMT-11' 						=> '(GMT+11:00) Solomon Is., New Caledonia',
						'Asia/Magadan' 						=> '(GMT+11:00) Magadan',
						'Pacific/Norfolk' 					=> '(GMT+11:30) Norfolk Island',
						'Asia/Anadyr' 						=> '(GMT+12:00) Anadyr, Kamchatka',
						'Pacific/Auckland' 					=> '(GMT+12:00) Auckland, Wellington',
						'Etc/GMT-12' 						=> '(GMT+12:00) Fiji, Kamchatka, Marshall Is.',
						'Pacific/Chatham' 					=> '(GMT+12:45) Chatham Islands',
						'Pacific/Tongatapu' 				=> '(GMT+13:00) Nuku\'alofa',
						'Pacific/Kiritimati' 				=> '(GMT+14:00) Kiritimati'
		);
		return $cities;
 	}
 }
 
 /* function to get number of live games for particular game type */
 
 function gmaeTypeLiveGames($cash_id){
	CI()->load->model('cashmodel');
	return CI()->cashmodel->gmaeTypeLiveGames($cash_id);
 }
 
 function practiceTypeLivePractices($practice_type_id){
 	CI()->load->model('practicemodel');
	return CI()->practicemodel->practiceTypeLivePractices($practice_type_id);
 }
 
 /*
	purpose 	: function to get number of tournaments created for cash/special/beginer etc.
	Dated   	: March 12,2014
    Developer	: Bhuvnesh Gupta	
 */
 
	function CreatedTournaments($tournament_type_id){
		CI()->load->model('tournamentsmodel');
		return CI()->tournamentsmodel->CreatedTournaments($tournament_type_id);
		
	}
	
	/* function to get product name */
	function getProdutctName($product_id){
		CI()->load->model('productsmodel');
		return CI()->productsmodel->getProductName($product_id);
	}
	
	/* function to get packages */
	function getPackages(){
		CI()->load->model('packagemodel');
		return CI()->packagemodel->getPackages(0,3);
	}
	
	/**** Can only create new tournament
			If last tournament all games started
			means there is no single game which status is 0(means not started yet)
	****/
	function can_create_mega_rummy_tournament(){
		CI()->load->model('tournamentsmodel');
		return CI()->tournamentsmodel->can_create_mega_rummy_tournament();
	}
	
	/* function to update column of table */
	
	function update_column_value($table_name,$column_name,$value,$primary_key,$primary_key_val){
		CI()->load->model('gamemodel');
		return CI()->gamemodel->update_column_value($table_name,$column_name,$value,$primary_key,$primary_key_val);
		
	}