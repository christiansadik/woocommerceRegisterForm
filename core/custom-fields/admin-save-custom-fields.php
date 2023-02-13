<?php

/**
 * Callback function for saving custom fields values from administration dashboard
 *
 * @param [int] $customer_id
 * @return void
 */
function wc_admin_save_custom_fields($customer_id)
{
    global $custom_roles;

    if (isset($_POST['type_activity'])) {
        update_user_meta($customer_id, 'type_activity', sanitize_text_field($_POST['type_activity']));
    }

    if (isset($_POST['vat_number'])) {
        update_user_meta($customer_id, 'vat_number', sanitize_text_field($_POST['vat_number']));
    }
    if (isset($_POST['fiscal_code'])) {
        update_user_meta($customer_id, 'fiscal_code', sanitize_text_field($_POST['fiscal_code']));
    }
    if (isset($_POST['sdi_code'])) {
        update_user_meta($customer_id, 'sdi_code', sanitize_text_field($_POST['sdi_code']));
    }
    if (isset($_POST['pec'])) {
        update_user_meta($customer_id, 'pec', sanitize_text_field($_POST['pec']));
    }
    if (isset($_POST['ipa_code'])) {
        update_user_meta($customer_id, 'ipa_code', sanitize_text_field($_POST['ipa_code']));
    }
    if (isset($_POST['contact_company'])) {
        update_user_meta($customer_id, 'contact_company', sanitize_text_field($_POST['contact_company']));
    }

    // Controlla se è presente il caricamento della Visura Camerale
    if (isset($_FILES['file'])) {
        // Lo inserisce all'interno dei file media
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        $attachment_id = media_handle_upload('file', 0);
        // Salva l'Id del file appena caricato come meta_key = 'visura_camerale' nella tabella usermeta del db
        if (is_wp_error($attachment_id)) {
            update_user_meta($customer_id, 'company_registration', $_FILES['file'] . ": " . $attachment_id->get_error_message());
        } else {
            update_user_meta($customer_id, 'company_registration', $attachment_id);
        }
    }
}
add_action('personal_options_update', 'wc_admin_save_custom_fields');
add_action('edit_user_profile_update', 'wc_admin_save_custom_fields');
add_action('woocommerce_save_account_details', 'wc_admin_save_custom_fields');
