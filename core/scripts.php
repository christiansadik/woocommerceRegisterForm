<?php
function frontend_scripts(){
    global $wp;
    $request = explode( '/', $wp->request );

    if(  ( end($request) == 'my-account' && is_account_page() ) ){
		if ( !is_user_logged_in() ) {
			wp_enqueue_style( 'register-form-style', PLUGIN_URL_ASSETS . '/css/custom-fields-register.css', array(),  time(), 'all' );
			wp_enqueue_script( 'register-form-js', PLUGIN_URL_ASSETS . '/js/custom-fields-register.js', array(), time(),true );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'frontend_scripts');