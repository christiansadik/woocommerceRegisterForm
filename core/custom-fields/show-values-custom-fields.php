<?php
/**
 * Callback function to show the values of user customised fields saved for the user in the administartion dashboard
 *
 * @param [object] $user
 * @return void
 */
function wc_show_values_custom_fields($user){
    global $custom_roles;
    global $types_activity;


    if (empty ( $user ) ) {
      $userId   = get_current_user_id();
      $user     = get_userdata( $userId );
    }
  
  
  
    $attachmentId = get_user_meta( $user->ID, 'company_registration', true );
    $imageUrl 	  = wp_get_attachment_url( $attachmentId );
  
    ?>

</div id="custom-roles">
<h2>Dati</h2>
<table class="form-table">
    <tbody>
        <tr id="user-type-activity">
            <th>
                <label for="reg_type_activity"><?php _e( 'Tipo di attività', 'custom-register-form' ); ?></label>
            </th>
            <td>
                <select class="woocommerce-Input woocommerce-Input--text input-text" name="type_activity"
                    id="reg_type_activity">
                    <option>— Nessun tipo di attività per questo ruolo —</option>
                    <?php
                        $user_type_activity = get_user_meta( $user->ID, 'type_activity', true);
                        foreach ($types_activity as $key => $type_activity): ?>
                    <option
                        <?php if ( ! empty( $user_type_activity ) && $user_type_activity == $key ) esc_attr_e( 'selected' ); ?>
                        value="<?php echo $key; ?>"><?php echo $type_activity; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>
                <label for="reg_vat_number"><?php _e( 'Partita IVA', 'custom-register-form' ); ?></label>
            </th>
            <td>
                <input type="text" class="regular-text" name="vat_number" id="reg_vat_number"
                    value="<?php if (  get_user_meta($user->ID, 'vat_number', true ) ) esc_attr_e( get_user_meta($user->ID, 'vat_number', true ) ); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="reg_fiscal_code"><?php _e( 'Codice Fiscale', 'custom-register-form' ); ?></label>
            </th>
            <td>
                <input type="text" class="regular-text" name="fiscal_code" id="reg_fiscal_code"
                    value="<?php if (  get_user_meta($user->ID, 'fiscal_code', true ) ) esc_attr_e( get_user_meta($user->ID, 'fiscal_code', true ) ); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="reg_sdi_code"><?php _e( 'Codice SDI', 'custom-register-form' ); ?></label>
            </th>
            <td>
                <input type="text" class="regular-text" name="sdi_code" id="reg_sdi_code"
                    value="<?php if (  get_user_meta($user->ID, 'sdi_code', true ) ) esc_attr_e( get_user_meta($user->ID, 'sdi_code', true ) ); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="reg_pec"><?php _e( 'Posta certificata (PEC)', 'custom-register-form' ); ?></label>
            </th>
            <td>
                <input type="text" class="regular-text" name="pec" id="reg_pec"
                    value="<?php if (  get_user_meta($user->ID, 'pec', true ) ) esc_attr_e( get_user_meta($user->ID, 'pec', true ) ); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label
                    for="reg_ipa_code"><?php _e( 'Codice IPA (riservato solo alle Pubbliche Amministrazioni)', 'custom-register-form' ); ?></label>
            </th>
            <td>
                <input type="text" class="regular-text" name="ipa_code" id="reg_ipa_code"
                    value="<?php if (  get_user_meta($user->ID, 'ipa_code', true ) ) esc_attr_e( get_user_meta($user->ID, 'ipa_code', true ) ); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label
                    for="reg_contact_company"><?php _e( 'Contatto amministrativo', 'custom-register-form' ); ?></label>
            </th>
            <td>
                <input type="text" class="regular-text" name="contact_company" id="reg_contact_company"
                    value="<?php if (  get_user_meta($user->ID, 'contact_company', true ) ) esc_attr_e( get_user_meta($user->ID, 'contact_company', true ) ); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="file" class="">Visura Camerale (JPG, PNG, PDF)</label>
            </th>
            <td>
                <input type="file" name="file" accept="image/*,.pdf">
                <p><a href="<?php echo $imageUrl;  ?>" target="_blank">Clicca qui per scaricare la Visura Camerale</a>
                </p>
            </td>
        </tr>
    </tbody>
</table>
</div>
<?php
  
}
add_action( 'show_user_profile', 'wc_show_values_custom_fields', 30 );
add_action( 'edit_user_profile', 'wc_show_values_custom_fields', 30 );
add_action( 'woocommerce_edit_account_form', 'wc_show_values_custom_fields', 30 );