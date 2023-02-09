<?php
function wc_register_custom_fields(){
    global $activities;
    ?>
<!-- SELECT CUSTOM ROLES -->
<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="reg_role"><?php _e( 'Sei un\'Azienda/Società (B2B) o un Privato (B2C)?', 'custom-register-form' ); ?>
        <span class="required">*</span></label>
    <select class="woocommerce-Input woocommerce-Input--text input-text" name="role" id="reg_role">
        <option>Seleziona che cliente sei...</option>
        <option <?php if ( ! empty( $_POST['role'] ) && $_POST['role'] == 'customer' ) esc_attr_e( 'selected' ); ?>
            value="customer"><?php _e( 'Privato', 'custom-register-form' ); ?></option>
        <option <?php if ( ! empty( $_POST['role'] ) && $_POST['role'] == 'sales_man' ) esc_attr_e( 'selected' ); ?>
            value="sales_man"><?php _e( 'Agente', 'custom-register-form' ); ?></option>
        <option <?php if ( ! empty( $_POST['role'] ) && $_POST['role'] == 'company' ) esc_attr_e( 'selected' ); ?>
            value="company"><?php _e( 'Azienda', 'custom-register-form' ); ?></option>
        <option <?php if ( ! empty( $_POST['role'] ) && $_POST['role'] == 'distributor' ) esc_attr_e( 'selected' ); ?>
            value="distributor"><?php _e( 'Distributore', 'custom-register-form' ); ?></option>
        <option <?php if ( ! empty( $_POST['role'] ) && $_POST['role'] == 'dealer' ) esc_attr_e( 'selected' ); ?>
            value="dealer"><?php _e( 'Rivenditore', 'custom-register-form' ); ?></option>
    </select>
</p>

<!-- SELECT TYPE OF ACTIVITIES -->
<div id="type-activity">
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_type_activity"><?php _e( 'Tipo di attività', 'custom-register-form' ); ?> <span
                class="required">*</span></label>
        <select class="woocommerce-Input woocommerce-Input--text input-text" name="type_activity"
            id="reg_type_activity">
            <option>Seleziona il tipo di attività...</option>
            <?php foreach ($activities as $key => $activity): ?>
            <option
                <?php if ( ! empty( $_POST['type_activity'] ) && $_POST['type_activity'] == $key ) esc_attr_e( 'selected' ); ?>
                value="<?php echo $key; ?>"><?php echo $activity; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
</div>


<!-- NAME AND LASTNAME FOR CUSTOMER ROLE -->
<div id="form-customer">
    <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e( 'Nome', 'custom-register-form' ); ?> <span
                class="required">*</span></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name"
            value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>

    <p class="form-row form-row-last">
        <label for="reg_billing_last_name"><?php _e( 'Cognome', 'custom-register-form' ); ?> <span
                class="required">*</span></label>
        <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name"
            value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
</div>

<!-- ADDRESS  -->
<div id="form-address">
    <?php
    $countries = new WC_Countries();
    $billingfields = $countries->get_address_fields( $countries->get_base_country(), 'billing_' );
    unset( $billingfields['billing_email'] , $billingfields['billing_first_name'] , $billingfields['billing_last_name'], $billingfields['billing_company'],);
    $fields = apply_filters( 'woocommerce_billing_fields', $billingfields );
    foreach( $fields as $key => $field_args ) {
      woocommerce_form_field( $key, $field_args );
    }
    ?>
</div>

<!-- CUSTOM FIELDS FOR CUSTOM ROLES -->
<div id="form-business">
    <!-- company -->
    <p id="billing_company_field" class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_billing_company"><?php _e( 'Ragione Sociale', 'custom-register-form' ); ?> <span
                class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_company"
            id="reg_billing_company"
            value="<?php if ( ! empty( $_POST['billing_company'] ) ) esc_attr_e( $_POST['billing_company'] ); ?>" />
    </p>
    <!-- p.iva -->
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_vat_number"><?php _e( 'Partita IVA / Codice Fiscale', 'custom-register-form' ); ?> <span
                class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="vat_number"
            id="reg_vat_number"
            value="<?php if ( ! empty( $_POST['vat_number'] ) ) esc_attr_e( $_POST['vat_number'] ); ?>" />
    </p>
    <!-- fiscal code -->
    <p class="fwoocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label
            for="reg_fiscal_code"><?php _e( 'Codice Fiscale (inserire <strong>SOLO</strong> se diverso da Partita IVA)', 'custom-register-form' ); ?>
            <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="fiscal_code"
            id="reg_fiscal_code"
            value="<?php if ( ! empty( $_POST['fiscal_code'] ) ) esc_attr_e( $_POST['fiscal_code'] ); ?>" />
    </p>
    <!--  SDI code -->
    <p class="fwoocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
        <label for="reg_sdi_code"><?php _e( 'Codice SDI', 'custom-register-form' ); ?> </label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="sdi_code"
            id="reg_sdi_code" value="<?php if ( ! empty( $_POST['sdi_code'] ) ) esc_attr_e( $_POST['sdi_code'] ); ?>" />
    </p>
    <!-- PEC -->
    <p class="fwoocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
        <label for="reg_pec"><?php _e( 'PEC', 'custom-register-form' ); ?></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="pec" id="reg_pec"
            value="<?php if ( ! empty( $_POST['pec'] ) ) esc_attr_e( $_POST['pec'] ); ?>" />
    </p>
    <p class="fwoocommerce-form-row woocommerce-form-row--wide form-row form-row-wide ipa-code">
        <label
            for="reg_ipa_code"><?php _e( 'Codice IPA (riservato solo alle Pubbliche Amministrazioni)', 'custom-register-form' ); ?>
            <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="ipa_code"
            id="reg_ipa_code" value="<?php if ( ! empty( $_POST['ipa_code'] ) ) esc_attr_e( $_POST['ipa_code'] ); ?>" />
    </p>
    <!-- contact of company-->
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label
            for="reg_contact_company"><?php _e( 'Contatto amministrativo (Nome e Cognome)', 'custom-register-form' ); ?>
            <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="contact_company"
            id="reg_contact_company"
            value="<?php if ( ! empty( $_POST['contact_company'] ) ) esc_attr_e( $_POST['contact_company'] ); ?>" />
    </p>
    <!-- Upload file fiscal document of company -->
    <p class="form-row validate-required" id="fileUpload">
        <label for="file"
            class=""><?php _e('Visura Camerale aggiornata ultimi 6 mesi (JPG, PNG, PDF)', 'custom-register-form' ); ?></label>
        <span class="woocommerce-input-wrapper">
            <input type="file" name="file" accept="image/*,.pdf">
        </span>
    </p>
</div>

<!-- acceptance privacy policy -->
<div id="acceptance">
    </p>
    <p class="fwoocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="checkbox" name="privacy_policy" id="reg_privacy_policy"
            class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" />
        <label for="reg_privacy_policy"
            class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox"><?php _e( 'Ho letto e accettato la <a href="" target="_blank">Privacy Policy</a>', 'custom-register-form' ) ?><span
                class="required">*</span< /label>
    </p>
    <p class="fwoocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="checkbox" name="newsletter" id="reg_newsletter"
            class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" />
        <label for="reg_newsletter"
            class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox"><?php _e( 'Iscrizione alla Newsletter', 'custom-register-form' ) ?></label>
    </p>
</div>


<?php
}
add_action( 'woocommerce_register_form', 'wc_register_custom_fields' );