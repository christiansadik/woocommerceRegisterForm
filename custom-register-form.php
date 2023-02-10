<?php
/**
 * Plugin Name:     Custom register form
 * Description:     Plugin to adding roles and custom fields in the register form
 * Company:         Forbidden Design
 * Agency URI:      https://forbidden.design
 * Author:          Christian Sadik Melik
 * Text domain:     custom-register-form
 */

define('PLUGIN_NAME','Custom register form');
define('PLUGIN_URL', plugin_dir_url(__FILE__) );
define('PLUGIN_URL_ASSETS', plugin_dir_url(__FILE__) . 'assets/' );
define('PLUGIN_URI', dirname(__FILE__) );

/**
 * Require necessary files
 */
require 'core/functions.php';
require 'core/scripts.php';
require 'core/custom-fields/add-custom-fields.php';
require 'core/custom-fields/error-message.php';
require 'core/custom-fields/save-custom-fields.php';
require 'core/custom-fields/show-values-custom-fields.php';


/** CUSTOM ROLES*/
$custom_roles = array(
    'sales_man'     => __('Agente', 'custom-register-form'),
    'company'       => __('Azienda', 'custom-register-form'),
    'distributor'   => __('Distributore', 'custom-register-form'),
    'dealer'        => __('Rivenditore', 'custom-register-form'),
);

/** TYPES OF ACTIVITY */
$types_activity = array(
    'agent'                     => __( 'Agente', 'custom-register-form' ),
    'camping'                   => __( 'Campeggio', 'custom-register-form' ),
    'water_center'              => __( 'Centro acquatico', 'custom-register-form' ),
    'rehabilitation_center'     => __( 'Centro di riabilitazione', 'custom-register-form' ),
    'fitness_with_pool'         => __( 'Centro fitness con piscina', 'custom-register-form' ),
    'fitness_without_pool'      => __( 'Centro fitness senza piscina', 'custom-register-form' ),
    'sportiv_center'            => __( 'Centro sportivo', 'custom-register-form' ),
    'builder'                   => __( 'Costruttore', 'custom-register-form' ),
    'distributor'               => __( 'Distributore', 'custom-register-form' ),
    'sports_federation'         => __( 'Federazione sportiva', 'custom-register-form' ),
    'hotel'                     => __( 'Hotel', 'custom-register-form' ),
    'water_park'                => __( 'Parco acquatico', 'custom-register-form' ),
    'public_administration'     => __( 'Pubblica Amministrazione', 'custom-register-form'),
    'resort'                    => __( 'Resort', 'custom-register-form' ),
    'dealer'                    => __( 'Rivenditore', 'custom-register-form' ),
    'service_company'           => __( 'Società di servizi', 'custom-register-form' ),
    'sports_club'               => __( 'Società / Associazione Sportiva', 'custom-register-form'),
    'beach_resort'              => __( 'Stabilimento balneare', 'custom-register-form' ),
    'thermal_baths'             => __( 'Stabilimento termale', 'custom-register-form' ),
    'tourist_resort'            => __( 'Villaggio turistico', 'custom-register-form' ),
    'coach'                     => __( 'Istruttore / Allenatore', 'custom-register-form' ),
    'private'                   => __( 'Privato', 'custom-register-form' )
  );

