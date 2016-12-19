<?php
	$user_id = get_current_user_id();
	$pdftvtpl2_allfields_defaults_option = get_option('pdftvtpl2_allfields_defaults'.$user_id);
	
	
	$deliveryClass = array(
	'A4_1st_class'=>0.80,
	'A4_2nd_class'=>0.60,
	'A5_1st_class'=>0.60,
	'A5_2nd_class'=>0.40
	);
	
	
	$deliveryType = array(
	
	'A5 Self-Mailer'=>0.10,
	'A4 Transparent Wallet'=>0.20,
	'A5 Transparent Wallet'=>0.20,
   
	
	
	);
	

	$advertcost_size_array = array(
	"quarterpage"=>0.10,
	"halfpage"=>0.20,
	"fullpage"=>0.40 );

	$pdftvtpl2_allfields = array(
	"first_name"=>"first name",
	"last_name"=>"last name",
	"email"=>"email",
	"company"=>"company name",
	"company_number"=>"company number",
	"phone_number"=>"phone number",
	"mobile_number"=>"mobile number",
	"fax_number"=>"fax number",
	"town"=>"town",
	"city"=>"city",
	"county"=>"county",
	"address"=>"address",
	"address2"=>"address 2",
	"website"=>"website",
	"title"=>"title",
	"office_phone"=>"office phone",
	"industry"=>"industry",
	"birthday"=>"birthday",
	"date"=>"date",
	"postcode"=>"postcode"	);


if(empty($pdftvtpl2_allfields_defaults_option)){

	$pdftvtpl2_allfields_defaults = array(
	"first_name"=>"Friend",
	"last_name"=>"",
	"email"=>"your email",
	"company"=>"your company",
	"company_number"=>"your company number",
	"phone_number"=>"your phone number",
	"mobile_number"=>"your mobile number",
	"fax_number"=>"your fax number",
	"town"=>"your town",
	"city"=>"your city",
	"county"=>"your county",
	"address"=>"your address",
	"address2"=>"your address 2",
	"website"=>"your website",
	"title"=>"your title",
	"office_phone"=>"your office phone",
	"industry"=>"your industry",
	"birthday"=>"your birthday",
	"date"=>"your date",
	"postcode"=>"your postcode"
	);
	

}else{

	$pdftvtpl2_allfields_defaults = $pdftvtpl2_allfields_defaults_option;


}

	$pdftvtpl2_short = array(

	"first_name",
	"last_name",
	"email",
	"company",
	"company_number",
	"phone_number",
	"mobile_number",
	"fax_number",
	"town",
	"city",
	"county",
	"address",
	"address2",
	"website",
	"title",
	"office_phone",
	"industry",
	"birthday",
	"date",
	"postcode"
	);

	$pdftvtpl2_allfields_default = array(
	"full_name"=>"YOURDATA",
	"email"=>"YOURDATA",
	"company"=>"YOURDATA",
	"company_number"=>"YOURDATA",
	"phone_number"=>"YOURDATA",
	"mobile_number"=>"YOURDATA",
	"fax_number"=>"YOURDATA",
	"town"=>"YOURDATA",
	"city"=>"YOURDATA",
	"county"=>"YOURDATA",
	"address"=>"YOURDATA",
	"address2"=>"YOURDATA",
	"website"=>"YOURDATA",
	"title"=>"YOURDATA",
	"office_phone"=>"YOURDATA",
	"industry"=>"YOURDATA",
	"birthday"=>"YOURDATA",
	"date"=>"YOURDATA",
	"postcode"=>"YOURDATA"
	);
?>	