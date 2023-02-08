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