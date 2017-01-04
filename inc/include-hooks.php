<?php
// Custom Posts
// add_action('init', 'pdftvtpl2_package_posts');

add_action('init', 'pdftvtpl2_posts');


add_action('wp_head','generate_pdf');
// Shortcode
add_shortcode(strtoupper('PDFTVTPL2'), 'pdftvtpl2_do_shortcode');

add_shortcode(strtoupper('PDFTVTPL2_LETTER_PAGE'), 'pdftvtpl2_do_letter_page');
//add_shortcode(strtoupper('PDFTVTPL2_LISTING'), 'pdftvtpl2_listing_do_shortcode');
add_shortcode(strtoupper('PDFTVTPL2_ERROR'), 'pdftvtpl2_listing_error');

// Admin Menu
//add_action('admin_menu', 'pdftvtpl2_create_menu');

// Admin Scripts and Styles
add_action('admin_print_styles', 'pdftvtpl2_styles');
add_action('admin_print_scripts', 'pdftvtpl2_scripts');
add_action('wp_head', 'pdftvtpl2_styles');
add_action('wp_head', 'pdftvtpl2_scripts');


add_action( 'wp_enqueue_scripts', 'pdftemplator_enqueue' );

// Metabox
add_action('admin_menu', 'pdftvtpl2_add_custom_box');
add_action('save_post', 'pdftvtpl2_save_postdata');

add_action( 'wp_ajax_get_postid', 'prefix_ajax_get_postid' );
add_action( 'wp_ajax_nopriv_get_postid', 'prefix_ajax_get_postid' );

add_action( 'wp_ajax_get_postcontent', 'prefix_ajax_get_postcontent' );
add_action( 'wp_ajax_nopriv_get_postcontent', 'prefix_ajax_get_postcontent' );


add_action( 'wp_ajax_get_readymadecontent', 'prefix_ajax_get_readymadecontent' );
add_action( 'wp_ajax_nopriv_get_readymadecontent', 'prefix_ajax_get_readymadecontent' );

add_action( 'wp_ajax_get_pdftpl2advertisement', 'prefix_ajax_get_pdftpl2advertisement' );
add_action( 'wp_ajax_nopriv_get_pdftpl2advertisement', 'prefix_ajax_get_pdftpl2advertisement' );


add_action( 'wp_ajax_get_readymadeinnercontent', 'prefix_ajax_get_readymadeinnercontent' );
add_action( 'wp_ajax_nopriv_get_readymadeinnercontent', 'prefix_ajax_get_readymadeinnercontent' );


add_action( 'wp_ajax_get_advertisementinnercontent', 'prefix_ajax_get_advertisementinnercontent' );
add_action( 'wp_ajax_nopriv_get_advertisementinnercontent', 'prefix_ajax_get_advertisementinnercontent' );



add_action( 'wp_ajax_process__pdftemplate_form', 'process__pdftemplate_form' );
add_action( 'wp_ajax_nopriv_process__pdftemplate_form', 'process__pdftemplate_form' );


add_action( 'wp_ajax_update_onradio', 'update_onradio' );
add_action( 'wp_ajax_nopriv_update_onradio', 'update_onradio' );


add_action( 'wp_ajax_submittoque', 'submittoque' );
add_action( 'wp_ajax_nopriv_submittoque', 'submittoque' );

add_action( 'wp_ajax_view_csv_listbtn', 'view_csv_listbtn' );
add_action( 'wp_ajax_nopriv_view_csv_listbtn', 'view_csv_listbtn' );

add_action( 'wp_ajax_get_readymade_entry', 'get_readymade_entry' );
add_action( 'wp_ajax_nopriv_get_readymade_entry', 'get_readymade_entry' );

add_action( 'wp_ajax_get_advertisement_entry', 'get_advertisement_entry' );
add_action( 'wp_ajax_nopriv_get_advertisement_entry', 'get_advertisement_entry' );


add_action( 'wp_ajax_get_pdftpl_a4a5', 'get_pdftpl_a4a5' );
add_action( 'wp_ajax_nopriv_get_pdftpl_a4a5', 'get_pdftpl_a4a5' );


add_action( 'wp_ajax_add_pdftpl_a4a5', 'add_pdftpl_a4a5' );
add_action( 'wp_ajax_nopriv_add_pdftpl_a4a5', 'add_pdftpl_a4a5' );



add_action( 'wp_ajax_get_pdftpl_a4a5_deliverytype', 'get_pdftpl_a4a5_deliverytype' );
add_action( 'wp_ajax_nopriv_get_pdftpl_a4a5_deliverytype', 'get_pdftpl_a4a5_deliverytype' );

add_action( 'wp_ajax_get_pdftpl_a4a5_deliveryclass', 'get_pdftpl_a4a5_deliveryclass' );
add_action( 'wp_ajax_nopriv_get_pdftpl_a4a5_deliveryclass', 'get_pdftpl_a4a5_deliveryclass' );

add_action( 'wp_ajax_get_number_of_pages_entry', 'get_number_of_pages_entry' );
add_action( 'wp_ajax_nopriv_get_number_of_pages_entry', 'get_number_of_pages_entry' );


add_action( 'wp_ajax_saveCSVfunction', 'saveCSVfunction' );
add_action( 'wp_ajax_nopriv_saveCSVfunction', 'saveCSVfunction' );

add_action( 'wp_ajax_deleteTableContent', 'deleteTableContent' );
add_action( 'wp_ajax_nopriv_deleteTableContent', 'deleteTableContent' );

add_action( 'wp_ajax_deletePing', 'deletePing' );
add_action( 'wp_ajax_nopriv_deletePing', 'deletePing' );

add_action( 'wp_ajax_pdftplgetPing', 'pdftplgetPing' );
add_action( 'wp_ajax_nopriv_pdftplgetPing', 'pdftplgetPing' );


?>
