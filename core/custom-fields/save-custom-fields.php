<?php

/**
 * Callback function to save the values of custom fields
 *
 * @param [int] $user_id
 * @return void
 */
function wc_save_custom_fields($user_id)
{
    global $custom_roles;

    if (isset($_POST['role'])) {

        if (isset($_POST['billing_country'])) {
            update_user_meta($user_id, 'billing_country', sanitize_text_field($_POST['billing_country']));
        }
        if (isset($_POST['billing_address_1'])) {
            update_user_meta($user_id, 'billing_address_1', sanitize_text_field($_POST['billing_address_1']));
        }
        if (isset($_POST['billing_address_2'])) {
            update_user_meta($user_id, 'billing_address_2', sanitize_text_field($_POST['billing_address_2']));
        }
        if (isset($_POST['billing_city'])) {
            update_user_meta($user_id, 'billing_city', sanitize_text_field($_POST['billing_city']));
        }
        if (isset($_POST['billing_state'])) {
            update_user_meta($user_id, 'billing_state', sanitize_text_field($_POST['billing_state']));
        }
        if (isset($_POST['billing_postcode'])) {
            update_user_meta($user_id, 'billing_postcode', sanitize_text_field($_POST['billing_postcode']));
        }
        if (isset($_POST['billing_phone'])) {
            update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
        }
        if (isset($_POST['type_activity'])) {
            update_user_meta($user_id, 'type_activity', sanitize_text_field($_POST['type_activity']));
        }


        /** IF THE ROLE SELECTED  IS CUSTOMER */
        if ($_POST['role'] == 'customer') {
            if (isset($_POST['billing_first_name'])) {
                update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['billing_first_name']));
                update_user_meta($user_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
            }
            if (isset($_POST['billing_last_name'])) {
                update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));
                update_user_meta($user_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
            }
        }


        /** IF THE ROLE SELECTED IS SALES_MAN, COMPANY, DISTRIBUTOR, DEALER */
        if (array_key_exists($_POST['role'], $custom_roles)) {

            if (isset($_POST['billing_company'])) {
                update_user_meta($user_id, 'billing_company', sanitize_text_field($_POST['billing_company']));
            }
            if (isset($_POST['vat_number'])) {
                update_user_meta($user_id, 'vat_number', sanitize_text_field($_POST['vat_number']));
            }
            if (isset($_POST['fiscal_code'])) {
                update_user_meta($user_id, 'fiscal_code', sanitize_text_field($_POST['fiscal_code']));
            }
            if (isset($_POST['sdi_code'])) {
                update_user_meta($user_id, 'sdi_code', sanitize_text_field($_POST['sdi_code']));
            }
            if (isset($_POST['pec'])) {
                update_user_meta($user_id, 'pec', sanitize_text_field($_POST['pec']));
            }
            if (isset($_POST['ipa_code'])) {
                update_user_meta($user_id, 'ipa_code', sanitize_text_field($_POST['ipa_code']));
            }
            if (isset($_POST['contact_company'])) {
                update_user_meta($user_id, 'contact_company', sanitize_text_field($_POST['contact_company']));
            }
        }


        if (isset($_FILES['file'])) {
            // Lo inserisce all'interno dei file media
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            $attachment_id = media_handle_upload('file', 0);
            // Salva l'Id del file appena caricato come meta_key = 'visura_camerale' nella tabella usermeta del db
            if (is_wp_error($attachment_id)) {
                update_user_meta($user_id, 'company_registration', $_FILES['file'] . ": " . $attachment_id->get_error_message());
            } else {
                update_user_meta($user_id, 'company_registration', $attachment_id);
            }
        }
    }
}
add_action('woocommerce_created_customer', 'wc_save_custom_fields');
