<?php

// declare array and call it as global
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
"postcode"=>"postcode",
"surname"=>"surname",
"partner_id"=>"partner_id",
"letter_password"=>"letter_password"

);


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
	"postcode"=>"your postcode",
	"surname"=>"your surname",
	"partner_id"=>"your partner_id",
	"letter_password"=>"password"
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
	"postcode",
	"surname",
	"partner_id",
	"letter_password"
	);

	$pdftvtpl2_allfields_default = array(
	"first_name"=>"YOURDATA",
	"last_name"=>"YOURDATA",
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
	"postcode"=>"YOURDATA",
	"surname"=>"YOURDATA",
	"partner_id"=>"YOURDATA",
	"letter_password"=>"YOURDATA"	
	);

//load plugin style
function pdftvtpl2_styles() {

	if(is_page('create-newsletter')  or is_page('pdf-template-list')){

	wp_enqueue_style('thickbox');
	//wp_enqueue_style('pdftvtpl2-bootstrap-style', pdftvtpl2_plugin_url."/assets/css/bootstrap.min.css");
	wp_enqueue_style('pdftvtpl2-main-style', pdftvtpl2_plugin_url."/assets/css/main.css");
	wp_enqueue_style('pdftvtpl2-jqueryui-style', pdftvtpl2_plugin_url."/assets/jquery-ui/jquery-ui.css");

	}

}

//load plugin scripts
function pdftvtpl2_scripts() {

		if(is_page('create-newsletter') or is_page('pdf-template-list')){

			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			//wp_enqueue_script( 'pdftvtpl2-bootstrap-js', pdftvtpl2_plugin_url."/assets/js/bootstrap.min.js", array('jquery'), '3.3.7', true );
			//wp_enqueue_script( 'pdftvtpl2-jquery-ui', pdftvtpl2_plugin_url."/assets/jquery-ui/jquery-ui.js", array('jquery'), '3.3.7', true );

		}
}


//check if radios is checked
function checked_radio($postradioval,$radioval){
	if($postradioval===$radioval){
		echo "checked";
	}
}

//select dropdown post meta checker
function get_selected_meta($valuemeta=null,$value=null){
	if($valuemeta==$value){
		return "selected";
	}else{
		return "";
	}
}

//get_pdfnewsletter_meta
function get_pdfnewsletter_meta($pid,$metakey){
	return get_post_meta($pid,$metakey,true);
}



function get_option_select_pdftemplator($name=null,$value=null){

	$optionval = get_option($name);


	if($optionval==$value){

		echo "selected='selected'";

	}
}


//ajax calls

function prefix_ajax_get_postid($ptype) {

	$ptype= $_REQUEST['post_type'];
	$myposts = get_posts( array( 'post_type' => $ptype ) );
	$html = "<form action='' method='post' id='getPostContent'>";
	$html .=  "<select id='readymadepost'><option>---Select One---</option>";

	foreach ( $myposts as $post ) : setup_postdata( $post );

	$html .= "<option value='".$post->ID."'>".get_the_title($post->ID)."</option>";

	endforeach;
	wp_reset_postdata();
	 $html .= "</select>";
	 $html .= "&nbsp; &nbsp; <input class='btn-primary btn' id='contentAdder' type='button' name='' value='Add content to editor'>";
	 $html .= "</form?>";

	 echo $html;


	die();
}

function prefix_ajax_get_postcontent($ptype) {

	$pid = $_REQUEST['post_content'];

	$post = get_post($pid );


		echo $content   = $post->post_content;


	die();
}


function prefix_ajax_get_readymadecontent($cat) {
    //echo  $_REQUEST['article_size'];
$catid = $_REQUEST['catid'];
if(isset($_REQUEST['pagenum'])){

$pagenum = $_REQUEST['pagenum']*4;
$currpage = $_REQUEST['pagenum'];

}else{

$pagenum = 4;
$currpage = 1;

}
$args = array(
	'post_type' => 'pdfreadymadecontent',
	'tax_query' => array(
		array(
			'taxonomy' => 'pdfReadymade',
			'field'    => 'term_id',
			'terms'    => $catid,
		),
		//article_size
	),
	'meta_query' => array(
		array(
			'key'     => 'pdftpl2_article_size',
			'value'   => $_REQUEST['article_size'],
			'compare' => '=',
		),
	),
	'posts_per_page' => $pagenum
);
$query = new WP_Query( $args );


$i = 0;

?>


<div class="col-md-12">
<?php if ( $query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<?php $size = get_post_meta($query->post->ID,'pdftpl2_article_size',true); ?>
		<div class="col-md-3 readymadepost" id="readymadepost<?php echo $query->post->ID; ?>" style="margin-bottom:10px; height:100%; cursor:pointer;">
			<div class="media" style="border: 1px solid; min-height:290px;">
			  <div class="" style="width:250px;">
				<a href="javascript:void(0);" >
				  <?php echo get_the_post_thumbnail($query->post->ID, array("200","200") ); ?>
				</a>

				<?php if($size=="All Sizes"){ ?>

				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/allsize.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />

				<?php }elseif($size=="Quarter Page"){ ?>

				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/quarter-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />

				<?php }elseif($size=="Half Page"){ ?>

				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/half-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />

				<?php } ?>


			  </div>
			  <div class="media-body" style="padding:10px;">
				<p class="media-heading"><b><?php echo get_the_title($query->post->ID); ?></b></p><br /><br />
				<?php echo  substr( strip_tags( get_the_excerpt($query->post->ID) ), 0, 40 )."..."; ?>
				<a href=""></a>
			  </div>
			</div>
		</div>

	<?php $i++; ?>
	<?php if($i==4){ ?>
	</div>
	<div class="col-md-12">
	<?php $i=0; } ?>
	<?php  endwhile; ?>
	<?php

	if($query->max_num_pages!=$_REQUEST['pagenum']){

		if($query->max_num_pages>1){
		echo "<br /><br /><p align='center'><a href='javascript:void(0);' id='rdyviewerarticles' data-pagi='$currpage'>View More Articles>></a></p>";
		}

	}


	?>
	<!-- end of the loop -->
</div>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<div class="col-md-12"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></div>
<?php endif; ?>
<?php

	die();
}


function prefix_ajax_get_pdftpl2advertisement($cat) {
    //echo  $_REQUEST['article_size'];
$catid = $_REQUEST['catid'];
if(isset($_REQUEST['pagenum'])){

$pagenum = $_REQUEST['pagenum']*4;
$currpage = $_REQUEST['pagenum'];

}else{

$pagenum = 4;
$currpage = 1;

}
$args = array(
	'post_type' => 'pdfcr-advertisement',
	'tax_query' => array(
		array(
			'taxonomy' => 'pdftpl2advertisement',
			'field'    => 'term_id',
			'terms'    => $catid,
		),
		//article_size
	),
 	'meta_query' => array(
		array(
			'key'     => 'pdftpl2_advertisement_size',
			'value'   => $_REQUEST['advert_size'],
			'compare' => '=',
		),
	),
	'posts_per_page' => $pagenum
);
$query = new WP_Query( $args );


$i = 0;

?>


<div class="col-md-12">
<?php if ( $query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<?php $size = get_post_meta($query->post->ID,'pdftpl2_advertisement_size',true); ?>
		<div class="col-md-3 addvertisementpost" id="addvertisementpost<?php echo $query->post->ID; ?>" style="margin-bottom:10px; height:100%; cursor:pointer;" advert-size="<?php echo $size; ?>">
			<div class="media" style="border: 1px solid; min-height:290px;">
			  <div class="" style="width:250px;">
				<a href="javascript:void(0);" >
				  <?php echo get_the_post_thumbnail($query->post->ID, array("200","200") ); ?>
				</a>

				<?php if($size=="All Sizes"){ ?>

				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/allsize.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />

				<?php }elseif($size=="Quarter Page"){ ?>

				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/quarter-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />

				<?php }elseif($size=="Half Page"){ ?>

				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/half-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />

				<?php } ?>


			  </div>
			  <div class="media-body" style="padding:10px;">
				<p class="media-heading"><b><?php echo get_the_title($query->post->ID); ?></b></p><br /><br />
				<?php echo  substr( strip_tags( get_the_excerpt($query->post->ID) ), 0, 40 )."..."; ?>
				<a href=""></a>
			  </div>
			</div>
		</div>

	<?php $i++; ?>
	<?php if($i==4){ ?>
	</div>
	<div class="col-md-12">
	<?php $i=0; } ?>
	<?php  endwhile; ?>
	<?php

	if($query->max_num_pages!=$_REQUEST['pagenum']){

		if($query->max_num_pages>1){
		echo "<br /><br /><p align='center'><a href='javascript:void(0);' id='rdyviewerarticles' data-pagi='$currpage'>View More Advertisement>></a></p>";
		}

	}


	?>
	<!-- end of the loop -->
</div>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<div class="col-md-12"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></div>
<?php endif; ?>
<?php

	die();
}


function pdftpl2_excerpt_filter( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'pdftpl2_excerpt_filter', 999 );

function prefix_ajax_get_readymadeinnercontent($cat) {

 $readymadeid = $_REQUEST['readymadeid'];

$content_post = get_post($readymadeid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);


	echo "<div class='readymadecontentAppend' style='display:none;'>";
	echo $content;
	echo "</div>";

	die();

}


function prefix_ajax_get_advertisementinnercontent($cat) {

 $add = $_REQUEST['readymadeid'];

$content_post = get_post($add);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);


	echo "<div class='advertisementcontentAppend' style='display:none;'>";
	echo $content;
	echo "</div>";

	die();

}




function pdftemplator_enqueue() {

	if($_REQUEST['newsletter_id']!=""){

		$nid = $_REQUEST['newsletter_id'];
	}else{

		$nid = 1;

	}

	wp_enqueue_script( 'ajax-script', pdftvtpl2_plugin_url."/assets/js/main.js", array('jquery'), '3.3.7', true );
    wp_localize_script( 'ajax-script', 'main_script_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'PDFsite_url'=>site_url(),'generatehttpurl'=>generate_pdftvtpl2_url(),'step'=>'step'.$nid,'newsletter_id'=>$nid,'pdftvtpl2_delivery_class'=>get_post_meta($nid,'pdftvtpl2_delivery_class',true),'pdftvtpl2_delivery_type'=>get_post_meta($nid,'pdftvtpl2_delivery_type',true) ) );

}


function generate_pdftvtpl2_url(){
	global $pdftvtpl2_allfields_default;

	global $post;

	$data = site_url()."/create-newsletter?newsletter_id=".$_REQUEST['newsletter_id']."&".http_build_query($pdftvtpl2_allfields_default);

	return $data;


}


function generate_pdftvtpl2_httpvariable(){
	global $pdftvtpl2_allfields_default;

	global $post;

	$data = "?newsletter_id=".$_REQUEST['newsletter_id']."&".http_build_query($pdftvtpl2_allfields_default);

	return $data;


}


function get_csv_listing_head(){


	$data =  get_post_meta($_REQUEST['newsletter_id'],'customer_list_head',true);
	//print_r($data);
	if(is_array($data)){
	return $data = site_url()."/create-newsletter?newsletter_id=".$_REQUEST['newsletter_id']."&".http_build_query($data);
	}

}

function get_csv_listing($newsletterID){

	print_r(get_post_meta($_REQUEST['newsletter_id'],'customer_list',true));



}

//proccess step 1 up to 4 form
function process__pdftemplate_form(){

	global $advertcost_size_array;

	$pid = $_REQUEST['pid'];
	$user_id = get_current_user_id();


	foreach ($_REQUEST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	
	if($_REQUEST['step2']=="true"){
		
		update_post_meta($pid, 'step3', 'false');
		update_post_meta($pid, 'step4', 'false');
		
	}	

	if(isset($_REQUEST['readymadeentry'])){

		$readymadeentry_request = $_REQUEST['readymadeentry'];

		if(intval($readymadeentry_request)==1){
			$readymadeentry_cost = 0.35;
		}elseif(intval($readymadeentry_request)==2){
			$readymadeentry_cost = 0.70;
		}elseif(intval($readymadeentry_request)>=3){
			$readymadeentry_cost = 1.00;
		}

		update_post_meta($pid, 'readymadeentry_cost', $readymadeentry_cost);

	}



/* 		formdata.append('quarterpage', quarterpage);
	formdata.append('halfpage', halfpage);
	formdata.append('fullpage', fullpage);
*/
	if(isset($_REQUEST['quarterpage'])){
	$quarterpage = intVal($_REQUEST['quarterpage'])*floatVal($advertcost_size_array['quarterpage']);
	}else{


		if(get_post_meta($pid,'quarterpage',true)!=""){

		$quarterpage = intVal(get_post_meta($pid,'quarterpage',true))*floatVal($advertcost_size_array['quarterpage']);

		}else{

		$quarterpage = 0.00;

		}


	}

	if(isset($_REQUEST['halfpage'])){

	$halfpage = intVal($_REQUEST['halfpage'])*floatVal($advertcost_size_array['halfpage']);

	}else{

		if(get_post_meta($pid,'halfpage',true)!=""){

		$halfpage = intVal(get_post_meta($pid,'halfpage',true))*floatVal($advertcost_size_array['halfpage']);

		}else{

		$halfpage = 0.00;

		}


	}

	if(isset($_REQUEST['fullpage'])){

	$fullpage = intVal($_REQUEST['fullpage'])*floatVal($advertcost_size_array['fullpage']);

	}else{


		if(get_post_meta($pid,'fullpage',true)!=""){

		$fullpage = intVal(get_post_meta($pid,'fullpage',true))*floatVal($advertcost_size_array['fullpage']);

		}else{

		$fullpage = 0.00;

		}


	}

	$advertisemententry_cost = floatval($fullpage)+floatval($halfpage)+floatval($quarterpage);

	update_post_meta($pid, 'advertisemententry_cost', $advertisemententry_cost);


	$pricing__newsletter_pagenum = get_post_meta($pid,'pricing__newsletter_pagenum',true);
	$pdftvtpl2_printing_type = get_post_meta($pid,'pdftvtpl2_printing_type',true);
	$pdftvtpl2_delivery_type = get_post_meta($pid,'pdftvtpl2_delivery_type',true);
	$pdftvtpl2_delivery_class = get_post_meta($pid,'pdftvtpl2_delivery_class',true);
	$pdftvtpl2_promotional_leaflets = get_post_meta($pid,'pdftvtpl2_promotional_leaflets',true);
	$pdftvtpl2_accompanying_letter = get_post_meta($pid,'pdftvtpl2_accompanying_letter',true);
	$readymadeentry_cost = get_post_meta($pid,'readymadeentry_cost',true);
	$advertisemententry_cost = get_post_meta($pid,'advertisemententry_cost',true);

	$totalprice = floatval($pricing__newsletter_pagenum) + floatval($pdftvtpl2_printing_type) + floatval($pdftvtpl2_delivery_type) + floatval($pdftvtpl2_delivery_class) + floatval($pdftvtpl2_promotional_leaflets) + floatval($pdftvtpl2_accompanying_letter) + floatval($readymadeentry_cost) + floatval($advertisemententry_cost);



	if($totalprice!=""){
	update_post_meta($pid, 'totalprice', number_format((float)$totalprice, 2, '.', ''));
	}



	$totalprice = number_format((float)get_post_meta($pid,'totalprice',true), 2, '.', '');

	echo $submit_return = "<div class='alert-success alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>Data saved!<div id='hiddentotal' style='display:none;'>".$totalprice."</div></div>";


	if(isset($_REQUEST['templateorfile'])){

		if($_REQUEST['templateorfile']=="file"){

			update_post_meta($pid, 'saved_as_file', 1);


		}

		if($_REQUEST['templateorfile']=="template"){

			update_post_meta($pid, 'saved_as_template', 1);


		}


	}

	exit;

}



//process on radio select on step 3

function update_onradio(){


	$pid = $_REQUEST['pid'];

	$user_id = get_current_user_id();

	foreach ($_REQUEST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}


	if(isset($_REQUEST['readymadeentry'])){

		$readymadeentry_request = $_REQUEST['readymadeentry'];

		if(intval($readymadeentry_request)==1){

			$readymadeentry_cost = 0.35;

		}elseif(intval($readymadeentry_request)==2){

			$readymadeentry_cost = 0.70;

		}elseif(intval($readymadeentry_request)>=3){

			$readymadeentry_cost = 1.00;

		}

		update_post_meta($pid, 'readymadeentry_cost', $readymadeentry_cost);


	}


	$pricing__newsletter_pagenum = get_post_meta($pid,'pricing__newsletter_pagenum',true);
	$pdftvtpl2_printing_type = get_post_meta($pid,'pdftvtpl2_printing_type',true);
	$pdftvtpl2_delivery_type = get_post_meta($pid,'pdftvtpl2_delivery_type',true);
	$pdftvtpl2_delivery_class = get_post_meta($pid,'pdftvtpl2_delivery_class',true);
	$pdftvtpl2_promotional_leaflets = get_post_meta($pid,'pdftvtpl2_promotional_leaflets',true);
	$pdftvtpl2_accompanying_letter = get_post_meta($pid,'pdftvtpl2_accompanying_letter',true);
	$readymadeentry_cost = get_post_meta($pid,'readymadeentry_cost',true);
	$advertisemententry_cost = get_post_meta($pid,'advertisemententry_cost',true);

	$totalprice = floatval($pricing__newsletter_pagenum) + floatval($pdftvtpl2_printing_type) + floatval($pdftvtpl2_delivery_type) + floatval($pdftvtpl2_delivery_class) + floatval($pdftvtpl2_promotional_leaflets) + floatval($pdftvtpl2_accompanying_letter) + floatval($readymadeentry_cost) + floatval($advertisemententry_cost);


	if($totalprice!=""){
	update_post_meta($pid, 'totalprice', number_format((float)$totalprice, 2, '.', ''));
	}

	//echo $totalprice = number_format((float)get_post_meta($pid,'totalprice',true), 2, '.', '');
	echo number_format((float)$totalprice, 2, '.', '');

	exit;

}

//SUBMIT TO QUE



function submittoque(){


	$pid = $_REQUEST['pid'];
	$partnerid = $_REQUEST['partner_id'];
	$letter_password = $_REQUEST['letter_password'];
	$pp_date = $_REQUEST['pp_date'];
	$user_id = get_current_user_id();
	global $current_user;
	get_currentuserinfo();
	
	
	if(isset($_REQUEST['submitlater']) && $_REQUEST['submitlater']==1){
			
			foreach ($_REQUEST as $key => $value) {
				update_post_meta($pid, $key, $value);
			}


			$totalprice = number_format((float)get_post_meta($pid,'totalprice',true), 2, '.', '');
			
			echo $submit_return = "<div class='alert-success alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>Newsletter Saved.<div id='hiddentotal' style='display:none;'>".$totalprice."</div></div>";
			
		exit;		
	}

	if(check_partner_account($partnerid,$letter_password)=='true'){

						
			foreach ($_REQUEST as $key => $value) {
				update_post_meta($pid, $key, $value);
			}


			$totalprice = number_format((float)get_post_meta($pid,'totalprice',true), 2, '.', '');


			if($pp_date==""){
				
				$pp_date = date('m-d-y');
			}

			/**
			 *  Example API POST call
			 *  Post a service to queue
			 */

			// type of service
			$service = 'autonewsletter';

			$data = array (
			 "partner_id" => $partnerid,
			 "password" => '',
			 "deliver_to" => $current_user->user_firstname." ".$current_user->user_lastname,
			 "cost" => $totalprice,
			 "schedule" => $pp_date
			);

			// api post url
			$url = 'http://connect.umbrellasupport.co.uk/'.$service.'/';

			// set up the curl resource
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			// execute the request
			$output = curl_exec($ch);
	
			// output the profile information - includes the header
			//echo '<pre>';

			$output = json_decode($output, true);

			
			if($output['success']==1){
				
			update_post_meta($pid, 'status', 'live');
			
			}

			//echo($output) . PHP_EOL;
			//echo '</pre>';
			
		//print_r($data);
			// close curl resource to free up system resources
			curl_close($ch);


		if($output['success']!=1){
				
				if($output['process_message']==""){
					
					$message = $output['message'];
					
				}else{
					
					$message = $output['process_message'];
				
				}	
				
				
			echo $submit_return = "<div class='alert-danger alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>".$message."<div id='hiddentotal' style='display:none;'>".$totalprice."</div></div>";		
				
		}else{	
			
			echo $submit_return = "<div class='alert-success alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>Data submitted to que!<div id='hiddentotal' style='display:none;'>".$totalprice."</div></div>";
			
		}
			require_once(pdftvtpl2_plugin_path.'/MPDF57/mpdf.php');
			require_once pdftvtpl2_plugin_path.'/helper/helper.php';
			
			
			
			if($partnerid!="" && $pid!="" && $output['success']==1){
				
				$pdfpage_contents = get_post_meta($pid ,'pdfconverted_contents',true);	
				$pdffile = helper_html_to_pdf_generate_file($pdfpage_contents, $extraCSS,$partnerid,$pid,1);
				
			}	
				
			
			if($pdffile!=""){
				
				update_post_meta("pdffile".$pid."_partner".$partnerid, 'status', 'live');
				
			}
	
	}else{
		
		if($partnerid!="" && $letter_password!=""){
				
		echo $submit_return = "<div class='alert-danger alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>Validation error: Invalid Partner Id or Password</div></div>";		
		
		}else{
			
		echo $submit_return = "<div class='alert-danger alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>Validation error: Partner Id & Password are required.</div></div>";	
			
		}	
				
		
	}	
	
	
	exit;

}



// ADD NEW COLUMN
function ST4fim_columns_head($defaults) {
    $defaults['manufacturer_id'] = 'Manufacturer ID';
    return $defaults;
}

// SHOW THE FEATURED IMAGE
function ST4fim_columns_content($column_name, $post_ID) {
    if ($column_name == 'manufacturer_id') {
        $manufacturer_id = get_post_meta($post_ID,'manufacturer_id',true);
        if ($manufacturer_id) {
            echo $manufacturer_id;
        }
    }
}

add_filter('manage_toplevel_page_shopp-products_columns', 'ST4fim_columns_head', 10);
add_action('manage_shopp_product_posts_custom_column', 'ST4fim_columns_content', 10, 2);






function register_default_newsletter_shortcode_val(){
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Newsletter Defaults',
        'manage_options',
        'pdftpl-default-news-values',
        'default_newsletter_shortcode_val',
        'dashicons-list-view',
        6
    );
}
add_action( 'admin_menu', 'register_default_newsletter_shortcode_val' );

/**
 * Display a custom menu page
 */
function default_newsletter_shortcode_val(){

	global $pdftvtpl2_allfields_defaults;

	$user_id = get_current_user_id();


	if(isset($_REQUEST['pdftvtpl2_allfields_defaults_name'])){

	if ( !isset( $_REQUEST['pdftvtpl2_allfields_defaults_name'] ) || !wp_verify_nonce( $_REQUEST['pdftvtpl2_allfields_defaults_name'], 'pdftvtpl2_allfields_defaults' ) ) {

	   print 'Sorry, your nonce did not verify.';
	   exit;

	} else {


		unset($_REQUEST['pdftvtpl2_allfields_defaults_name']);
		unset($_REQUEST['_wp_http_referer']);
		unset($_REQUEST['submit']);

		echo "<div class=\"notice notice-success is-dismissible\">
        <p>Option update done.</p>
		</div>";
		update_option( 'pdftvtpl2_allfields_defaults'.$user_id , $_REQUEST );

	   // process form data
	}

	}
	$option = get_option('pdftvtpl2_allfields_defaults'.$user_id);





?>

<div class="wrap">
<h1>Default Newsletter Fields Value <a href="<?php echo site_url()."/create-newsletter/?newsletter_id=".$_GET['newsletter_id']; ?>">Back</a></h1>

<form method="post" action="">

    <table class="form-table">

        <?php if($option!=""){  ?>

			<?php
			foreach($option as $key=>$val){
			?>
			<tr valign="top">
			<th scope="row"><?php echo $key; ?></th>
			<td><input type="text" name="<?php echo $key; ?>" value="<?php echo $val; ?>" /></td>
			</tr>
			  <?php } ?>

			<?php }else{ ?>

			<?php   foreach($pdftvtpl2_allfields_defaults as $key=>$val){ ?>
			<tr valign="top">
			<th scope="row"><?php echo $key; ?></th>
			<td><input type="text" name="<?php echo $key; ?>" value="<?php echo $val; ?>" /></td>
			</tr>
			<?php } ?>

		<?php } ?>


    </table>
    <?php wp_nonce_field( 'pdftvtpl2_allfields_defaults', 'pdftvtpl2_allfields_defaults_name' ); ?>
    <?php submit_button(); ?>


</form>
</div>

<?php
}



function get_readymade_entry(){
	$pid= $_REQUEST['pid'];
	$readymadeentry = get_post_meta($pid,'readymadeentry',true);
	$readymadeentry_cost = get_post_meta($pid,'readymadeentry_cost',true);
	if($readymadeentry_cost==0){

		$readymadeentry_cost = '0.00';

	}else{

		$readymadeentry_cost = number_format((float)$readymadeentry_cost, 2, '.', '');

	}
	print_r('{"records":[{"count":"'.$readymadeentry.'","cost":"'.$readymadeentry_cost.'"}]}');


	die();

}


function get_advertisement_entry(){
	global $advertcost_size_array;

	$pid= $_REQUEST['pid'];

	/* formdata.append('quarterpage', quarterpage);
	formdata.append('halfpage', halfpage);
	formdata.append('fullpage', fullpage);
	 */

	 $quarterpage = get_post_meta($pid,'quarterpage',true);
	 $halfpage = get_post_meta($pid,'halfpage',true);
	 $fullpage = get_post_meta($pid,'fullpage',true);

	 $quarterpagecost = $quarterpage*floatVal($advertcost_size_array['quarterpage']);
	 $halfpagecost = $halfpage*floatVal($advertcost_size_array['halfpage']);
	 $fullpagecost = $fullpage*floatVal($advertcost_size_array['fullpage']);

	 $appendtoObject = '{"name":"Quarter Page","count":"'.$quarterpage.'","cost":"'.number_format((float)$quarterpagecost, 2, '.', '').'"},';
	 $appendtoObject .= '{"name":"Half Page","count":"'.$halfpage.'","cost":"'.number_format((float)$halfpagecost, 2, '.', '').'"},';
	 $appendtoObject .= '{"name":"Full Page","count":"'.$fullpage.'","cost":"'.number_format((float)$fullpagecost, 2, '.', '').'"}';

	/* 	$advertisemententry = get_post_meta($pid,'advertisemententry',true);
	$advertisemententry_cost = get_post_meta($pid,'advertisemententry_cost',true);
	if($advertisemententry_cost==0){

		$advertisemententry_cost = '0.00';

	}else{

		$advertisemententry_cost = number_format((float)$advertisemententry_cost, 2, '.', '');

	}

	 */
	print_r('{"records":['.$appendtoObject.']}');


	die();

}

function get_pdftpl_a4a5(){

	$pid = $_REQUEST['pid'];

	if(get_post_meta($pid,'get_pdftpl_a4a5',true)!=""){
		
		print_r("data exist");
		
	}else{
	
		print_r("data is empty");
	
	}	

	die();



}



function get_pdftpl_a4a5_deliveryclass(){
			
		global $deliveryClass;
		$pid = $_REQUEST['pid'];
		$a4a5 = get_post_meta($pid,'get_pdftpl_a4a5',true);
		$pdftvtpl2_delivery_class = get_post_meta($pid,'pdftvtpl2_delivery_class',true);
		
		$first_class = $deliveryClass[$a4a5."_1st_class"];
		$second_class = $deliveryClass[$a4a5."_2nd_class"];
		
		if($pdftvtpl2_delivery_class==$first_class){
			
		 $appendtoObject = '{"name":"1st Class Mail","cost":"'.number_format((float)$first_class, 2, '.', '').'","checked":"checked" },';
		 $appendtoObject .= '{"name":"2nd Class Mail","cost":"'.number_format((float)$second_class, 2, '.', '').'","checked":"checked"}';	
			
		}else{
			
		 $appendtoObject = '{"name":"1st Class Mail","cost":"'.number_format((float)$first_class, 2, '.', '').'","checked":"checked"},';
		 $appendtoObject .= '{"name":"2nd Class Mail","cost":"'.number_format((float)$second_class, 2, '.', '').'","checked":"checked"}';	
						
			
			
		}

			

		print_r('{"records":['.$appendtoObject.']}');
					
		//return '{"records":['.$appendtoObject.']}';
		
		die();
}	


function get_pdftpl_a4a5_deliverytype(){
	
	
		global $deliveryType;
		$pid = $_REQUEST['pid'];
		$a4a5 = get_post_meta($pid,'get_pdftpl_a4a5',true);
		$pdftvtpl2_delivery_type = get_post_meta($pid,'pdftvtpl2_delivery_type',true);
		
		$appendtoObject = "";
		$alltype = count($deliveryType);
		$loper = 1;
		foreach($deliveryType as $k=>$v){
		//$pdftvtpl2_delivery_type
		
		if (strpos($k, $a4a5) !== false) {

				$appendtoObject .= '{"name":"'.$k.'","cost":"'.number_format((float)$v, 2, '.', '').'"},';
				

		}
		

		
		}
		//nuller
		$appendtoObject .= '{"name":"","cost":""}';
			

		print_r('{"records":['.$appendtoObject.']}');
					
		//return '{"records":['.$appendtoObject.']}';
		
		die();	
	
	
}
	
function add_pdftpl_a4a5(){

		$pid = $_REQUEST['pid'];
		$a4a5 = $_REQUEST['a4a5'];
		update_post_meta($pid,'get_pdftpl_a4a5',$a4a5);
		echo $a4a5;
	die();
	
}	


function get_number_of_pages_entry(){
	$pid = $_REQUEST['pid'];
	$pricing__newsletter_pagenum = get_post_meta($pid,'pricing__newsletter_pagenum',true);
	$pdftvtpl2_newsletter_pagenum = get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true);	
	
	$appendtoObject .= '{"num":"'.$pdftvtpl2_newsletter_pagenum.'","cost":"'.number_format((float)$pricing__newsletter_pagenum, 2, '.', '').'"}';

	print_r('{"records":['.$appendtoObject.']}');
				
	//return '{"records":['.$appendtoObject.']}';
	
	die();		

}


//viewcsvlistbtn

function view_csv_listbtn(){
	
global $pdftvtpl2_allfields;

$pid = $_REQUEST['pid'];

$customer_list = get_post_meta(intval($pid),'customer_list',true); 
$appendtoObject = "";
$countlist = count($customer_list);
$i = 1;
if(is_array($customer_list)){
	rsort($customer_list);
	foreach($customer_list as $index=>$customervalues){
		
		
		$fullname = $customervalues['first_name']." ".$customervalues['last_name'];
		$business = $customervalues['company'];
		$type = "Newsletter";
		$missingdata = join('\n', array_diff_key($pdftvtpl2_allfields, $customervalues));
		$pdflink = site_url()."/create-newsletter?newsletter_id=".$pid."&".urldecode(http_build_query($customervalues))."&status=testing";
		
		if($countlist==$i){
		
		$appendtoObject .= '{"line":"'.$index.'","fullname":"'.$fullname .'","business":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"}';
		
		}else{
	
		$appendtoObject .= '{"line":"'.$index.'","fullname":"'.$fullname .'","business":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"},';	
			
		}
		
		$i++;
		
	}
	
}



	
	print_r('{"records":['.$appendtoObject.']}');
	//print_r($customer_list);


	die();

}




function saveCSVfunction(){
	
global $pdftvtpl2_allfields;

$pid = $_REQUEST['pid'];
$csvurl = $_REQUEST['csvurl'];
	
	
$lines = file($csvurl, FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value)
{
	if($key==0){
		
		$head = str_getcsv($value);
		
	}
	
	if($key!=0){
		$csv[$key] = array_combine($head,str_getcsv($value));
	}
	
	
	
}


update_post_meta(intval($pid),'customer_list',$csv); 
update_post_meta(intval($pid),'pdftvtpl2_customerlist',"csv"); 

$countlist=count($csv);

$i = 1;
if(is_array($csv)){
	foreach($csv as $index=>$customervalues){

		$fullname = $customervalues['first_name']." ".$customervalues['last_name'];
		$business = $customervalues['company'];
		$type = "Newsletter";
		$missingdata = join('\n', array_diff_key($pdftvtpl2_allfields, $customervalues));
		$pdflink = site_url()."/create-newsletter?newsletter_id=".$pid."&".urldecode(http_build_query($customervalues))."&status=testing";
		
		if($countlist==$i){
		
		$appendtoObject .= '{"line":"'.$index.'","fullname":"'.$fullname .'","business":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"}';
		
		}else{
	
		$appendtoObject .= '{"line":"'.$index.'","fullname":"'.$fullname .'","business":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"},';	
			
		}
			
		$i++;
		
	}
	
	
	
}


	print_r('{"records":['.$appendtoObject.']}');


	die();
}

function deleteTableContent(){
	
global $pdftvtpl2_allfields;
$pid = $_REQUEST['pid'];	
	
/*	
(
    [action] => deleteTableContent
    [pid] => 276
    [selected] => 9,10
    [table_action] => delete
)	
*/	
	if($_REQUEST['table_action']=="deleteall"){
		
		update_post_meta(intval($pid),'customer_list',""); 
		
	}else{
		
		$removeKeys = explode(",", $_REQUEST['selected']);
		$csvlist = get_post_meta(intval($pid),'customer_list',true); 				
		$csvlistnEW = array_diff_key($csvlist, array_flip($removeKeys));
			
		$countlist=count($csvlistnEW);
		$i=1;	
		if(is_array($csvlistnEW)){
			rsort($csvlistnEW);
			foreach($csvlistnEW as $index=>$customervalues){

				$fullname = $customervalues['first_name']." ".$customervalues['last_name'];
				$business = $customervalues['company'];
				$type = "Newsletter";
				$missingdata = join('\n', array_diff_key($pdftvtpl2_allfields, $customervalues));
				$pdflink = site_url()."/create-newsletter?newsletter_id=".$pid."&".urldecode(http_build_query($customervalues))."&status=testing";
				
				if($countlist==$i){
				
				$appendtoObject .= '{"line":"'.$index.'","fullname":"'.$fullname .'","business":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"}';
				
				}else{
			
				$appendtoObject .= '{"line":"'.$index.'","fullname":"'.$fullname .'","business":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"},';	
					
				}
					
				$i++;
				
			}
			
		}
	
	update_post_meta(intval($pid),'customer_list',$csvlistnEW); 
	
	print_r('{"records":['.$appendtoObject.']}');		
		
		
		
	}
	
	die();
	
	
}



function process_ping($request){
	
	echo $request['partner_id'];
	
}


function pdftplgetPing(){
	
	global $pdftvtpl2_allfields;
	$pid = $_REQUEST['pid'];	
	
	$allping = get_post_meta($pid,PREMETA.'ping',true);

	$countlist = count($allping);
	$i = 1;
	
if(is_array($allping)){
	rsort($allping);
	foreach($allping as $index=>$customervalues){

		$fullname = $customervalues['first_name']." ".$customervalues['last_name'];
		$business = $customervalues['company'];
		$TIMEDATE = $customervalues['TIMEDATE'];
		$type = "Newsletter";
		$missingdata = join('\n', array_diff_key($pdftvtpl2_allfields, $customervalues));
		$pdflink = site_url()."/create-newsletter?newsletter_id=".$pid."&".urldecode(http_build_query($customervalues))."&status=testing";
		
		if($countlist==$i){
		
		$appendtoObject .= '{"line":"'.$index.'","TIMEDATE":"'.$TIMEDATE .'","fullname":"'.$fullname .'","company":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"}';
		
		}else{
	
		$appendtoObject .= '{"line":"'.$index.'","TIMEDATE":"'.$TIMEDATE .'","fullname":"'.$fullname .'","company":"'.$business.'","type":"'.$type .'","missingdata":"'.$missingdata .'","pdflink":"'.$pdflink .'"},';	
			
		}
			
		$i++;
		
	}
	
}	
	
	print_r('{"records":['.$appendtoObject.']}');	
	
	die();
	
	
}


function deletePing(){
	
	global $pdftvtpl2_allfields;
	$pid = $_REQUEST['pid'];	
	
	$allping = get_post_meta($pid,PREMETA.'ping',true);
	
	if($_REQUEST['table_action']=="deleteall"){
		
		update_post_meta(intval($pid),PREMETA.'ping',""); 
		
	}else{
		
		$removeKeys = explode(",", $_REQUEST['selected']);
		
		foreach($removeKeys as $ind){
			
			
			unset($allping[$ind]);
			
		}
		
		update_post_meta(intval($pid),PREMETA.'ping',$allping); 
		 
	
	
	}	
	
	//print_r($allping);
	
	die();
	
	
}

function check_partner_account($partner_id,$letter_password){
	
	
	/**
 *  Example API POST call
 *  validate partner password for sms, voice, fax and newsletter
 */

$data = array (
 "partner_id" => $partner_id,
 "password" => $letter_password,
 "service" => 'newsletter'
);

// api post url
$url = 'http://connect.umbrellasupport.co.uk/validate/';

// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// execute the request
$output = curl_exec($ch);

// output the profile information - includes the header
/* echo '<pre>';
echo $output;
echo '</pre>'; */

// close curl resource to free up system resources
curl_close($ch);
	
	
	return $output;
	
}


function log_error_funct($newsletterid,$error,$request){
	
	
			$errarr = array(
				
				"TIMEDATE"=>date("H:i A d/m/Y"),
				"Reference"=> "ER".$newsletterid,
				"Service"=> "Newsletter",
				"Method"=> "HTTP Post",
				"ERROR"=> join(",<br />",$error),
				"View Data"=>$request
		
			);	
			
			$NewsletterErr = get_post_meta($newsletterid,'pingError',true);			
			$NewsletterErr[] = $errarr;			
			update_post_meta($newsletterid,'pingError',$NewsletterErr);				
/* 	echo "<pre>";
		print_r($NewsletterErr);
	echo "</pre>"; */
}