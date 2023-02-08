<?php
/**
 * Callback function to create and register new roles`
 *
 * @return void
 */
function add_custom_roles(){
    global $wp_roles;
	if ( ! isset( $wp_roles ) );
	$wp_roles = new WP_Roles();

    $sales_man	 	= $wp_roles->get_role( 'customer' );
	$company	 	= $wp_roles->get_role( 'customer' );
	$distributor 	= $wp_roles->get_role( 'customer' );
	$dealer		 	= $wp_roles->get_role( 'customer' );

    $wp_roles->add_role( 'sales_man', __( 'Agente', 'custom-register-form ') , $sales_man->capabilities );
	$wp_roles->add_role( 'company', __( 'Azienda', 'custom-register-form' ), $company->capabilities );
	$wp_roles->add_role( 'distributor', __( 'Distributore', 'custom-register-form' ), $distributor->capabilities );
	$wp_roles->add_role( 'dealer', __( 'Rivenditore', 'custom-register-form' ), $dealer->capabilities );
}
add_action( 'init', 'add_custom_roles' );

/**
 * Callback function to remove custom roles
 *
 * @return void
 */
function remove_custom_roles(){
    global $wp_roles;
	if ( ! isset( $wp_roles ) );

    remove_role( 'sales_man' );
	remove_role( 'company' );
	remove_role( 'distributor' );
	remove_role( 'dealer' );
}
// add_action('init', 'remove_custom_roles');