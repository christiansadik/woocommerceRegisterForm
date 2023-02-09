<?php

/**
 * Callback function to validate input of form
 *
 * @param [string] $username
 * @param [string] $email
 * @param [string] $validation_errors
 * @return void
 */
function wc_validate_custom_fields($username, $email, $validation_errors)
{
    global $custom_roles;

    /** SELECT ROLE */
    if (!isset($_POST['role']) || is_null($_POST['role'])) {
        $validation_errors->add('role_error', __('Selezionare un Ruolo', 'custom-register-form'));
    }

    /** SELECT TYPE OF ACTIVITY */
    if (!isset($_POST['type_activity']) ||  is_null($_POST['type_activity'])) {
        $validation_errors->add('role_error', __('Selezionare il tipo di attività', 'custom-register-form'));
    }

    /** NAME AND LASTNAME IF ROLE SELECTED IS CUSTOMER (Privato) */
    if ($_POST['role'] == 'customer') {
        if (empty($_POST['billing_first_name'])) {
            $validation_errors->add('billing_first_name_error', __('Nome mancante', 'custom-register-form'));
        }
        if (empty($_POST['billing_last_name'])) {
            $validation_errors->add('billing_last_name_error', __('Cognome mancante', 'custom-register-form'));
        }
    }

    /** INPUT GENERAL INFO */
    if (empty($_POST['billing_address_1'])) {
        $validation_errors->add('billing_address_1_error', __('Indirizzo mancante.', 'custom-register-form'));
    }
    if (empty($_POST['billing_city'])) {
        $validation_errors->add('billing_city_error', __('Città mancante', 'custom-register-form'));
    }
    if (empty($_POST['billing_country'])) {
        $validation_errors->add(
            'billing_country_error',
            __('Nessuna nazione selezionata', 'custom-register-form')
        );
    }
    if ($_POST['billing_country'] == 'IT') {
        if (empty($_POST['billing_state'])) {
            $validation_errors->add('billing_state_error', __('Nessuna Provincia selezionata', 'custom-register-form'));
        }
        if (empty($_POST['billing_postcode'])) {
            $validation_errors->add(
                'billing_postcode_error',
                __('CAP mancante', 'custom-register-form')
            );
        }
    }
    if (empty($_POST['billing_phone'])) {
        $validation_errors->add(
            'billing_phone_error',
            __('Numero di telefono mancante', 'custom-register-form')
        );
    }

    /** CUSTOM INPUTS FOR CUSTOM ROLES (SALES_MAN, COMPANY, DISTRIBUTOR, DEALER) */
    if (array_key_exists($_POST['role'], $custom_roles)) {

        // company name
        if (isset($_POST['billing_company']) && empty($_POST['billing_company'])) {
            $validation_errors->add('file_error', __('Ragione Sociale mancante', 'custom-register-form'));
        }
        // p.iva -> check if is unique
        if (isset($_POST['vat_number']) && empty($_POST['vat_number'])) {
            $validation_errors->add('file_error', __('Partita IVA mancante', 'custom-register-form'));
        } else {

            $args = array(
                'meta_key' => 'vat_number',
                'meta_value' => $_POST['vat_number']
            );
            $user = get_users($args);
            if (!empty($user)) {
                $validation_errors->add('file_error', __('Un account con questa P. IVA è già stato registrato. <a href="' . site_url('/my-account/lost-password/') . '" target="_blank" >Recupera Password</a>', 'custom-register-form'));
            }
        }
        // SDI code or Pec
        if (empty($_POST['sdi_code'])  &&  empty($_POST['pec'])) {
            $validation_errors->add('file_error', __('Codice SDI e PEC mancante, inserire almeno un campo', 'custom-register-form'));
        }
        // ipa code -> check if is public administration
        if ($_POST['type_activity'] == 'public_administration') {
            if (isset($_POST['ipa_code']) && empty($_POST['ipa_code'])) {
                $validation_errors->add('file_error', __('Codice IPA mancante', 'custom-register-form'));
            }
        }
        // contact of company
        if (isset($_POST['contact_company']) && empty($_POST['contact_company'])) {
            $validation_errors->add('file_error', __('Contatto amministrativo mancante', 'custom-register-form'));
        }
        //upload file fiscal document of company
        // if ( isset( $_POST['file'] ) && empty( $_POST['file'] ) ) {
        //     $validation_errors->add( 'file_error', __( 'File inserito non corretto o mancante', 'custom-register-form' ) );
        // }
    }


    return $validation_errors;
}
add_action('woocommerce_register_post', 'wc_validate_custom_fields', 10, 3);


/**
 * Callback function to validate acceptance privacy policy
 *
 * @param [string] $validation_errors
 * @param [string] $username
 * @param [string] $email
 * @return void
 */
function wc_validate_privacy_policy( $validation_errors, $username, $email ) {
    if ( ! is_checkout() ) {
      if ( !isset( $_POST['privacy_policy'] ) ) {
        $validation_errors->add( 'reg_privacy_policy_error', __( 'La Privacy Policy deve essere accettata.', 'custom-register-form' ) );
      }
    }
    return $validation_errors;
}
add_filter( 'woocommerce_registration_errors', 'wc_validate_privacy_policy', 10, 3 );