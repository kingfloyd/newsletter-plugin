<?php



if(isset($_REQUEST['partner_id']) and  isset($_REQUEST['letter_password'])){

	$arr = $_REQUEST;
	
	

	$errFound = array();

	//check if there is empty values.

	if(in_array_r("",$arr)){		
		
		$errFound[] = "Missing Data"; 	
		
	}
	
	if(count($arr)>1){
	
			
		$errFound[] = "Data value should not be placeholder"; 	
	}	
	
	//check if part and password good

	if(check_partner_account($arr['partner_id'],$arr['letter_password'])=='false'){

		//news letter id, error text, the $_POST or $_GET or $_REQUEST data

		$errFound[] = "Partner_id or Password Incorrect"; 	
		
	}
	

	$NewsletterErr = get_post_meta($arr['newsletter_id'],'pingError',true);
	
	
	$list = get_post_meta($arr['newsletter_id'],PREMETA.'ping',true);
	
	if(!empty($list) and $list!=""){	
	
		
		$arr['TIMEDATE'] = date("H:i A d/m/Y");
		$list[] = $arr;
		
		update_post_meta($arr['newsletter_id'],PREMETA.'ping',$list);
		
				
						
 	// 	foreach($list as $listarr){
			
		// 		$containsSearch = count(array_intersect($_REQUEST, $listarr)) == count($_REQUEST);
			
		// 		if($containsSearch==1){			
		// 			continue;				
		// 		}			
		// } 		
	
		// if($containsSearch!=1){
			
		// 	$_REQUEST['TIMEDATE'] = date("H:i A d/m/Y");
		// 	$list[] = $_REQUEST;
		// 	update_post_meta($_REQUEST['newsletter_id'],PREMETA.'ping',$list);
			
		// }else{
			
		// 	$errFound[] = "Data is a Duplicate"; 		
			
		// }
				
		
	}else{
		
		$arr['TIMEDATE'] = date("H:i A d/m/Y");
		$list[] = $arr;
		
		update_post_meta($arr['newsletter_id'],PREMETA.'ping',$list);
		
		
		
	}

	
	//update_post_meta($_REQUEST['newsletter_id'],PREMETA.'ping',"");	
	
	$ping = true;
	
	
	//process error
	if(!empty($errFound)){
		log_error_funct($arr['newsletter_id'],$errFound,$arr);
			
	}
	update_post_meta($arr['newsletter_id'],PREMETA.'customerlist',"http");
	//update_post_meta($_REQUEST['newsletter_id'],'pingError',"");
	
}





function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}	


?>
