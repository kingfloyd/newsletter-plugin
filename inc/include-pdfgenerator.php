<?php 

function generate_pdf(){
	require_once(pdftvtpl2_plugin_path.'/MPDF57/mpdf.php');
	require_once pdftvtpl2_plugin_path.'/helper/helper.php';


	$current_url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	$urlArray = explode('/', $current_url);

	$post_name =  $urlArray[count($urlArray)-2];

	//helper_print( "post name " . $post_name);
	require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

	if(in_array('pdftemplate', $urlArray)) {
		//    helper_print( "print pdf");
	} else {
		//    helper_print( "do not print pdf");
	}



	$pdfpage_contents = get_post_meta($_GET['newsletter_id'],'pdfconverted_contents',true);


	//if(get_post_type($post->ID)=='pdftvtpl2'){
	if($_GET['newsletter_id']!=""){
		
		$pdfpage_contents = get_post_meta($_GET['newsletter_id'],'pdfconverted_contents',true);
		if($pdfpage_contents!=""){
			
			if($_GET['status']=="live"){
				
				$status = get_post_meta($_GET['newsletter_id'],'status',true);
				
			}	
			
			//if((isset($_GET['status']) and $_GET['status']=="testing") or $status=="live") {
			if((isset($_GET['status']) and $_GET['status']=="testing") or $status=="live") {
				if($_GET['status']!="live"){
				$extraCSS['wattermark'] = "Preview";
				}
				
				if($_GET['status']=="live" && check_partner_account($_REQUEST['partner_id'],$_REQUEST['letter_password'])=="true"){
					helper_html_to_pdf_preview_floyd($pdfpage_contents, $extraCSS,$_REQUEST['partner_id'],$_REQUEST['newsletter_id'],1);
					exit;
				}else{
					
					helper_html_to_pdf_preview_floyd($pdfpage_contents, $extraCSS);
					exit;
				}	
					
			}
		}
	}
}