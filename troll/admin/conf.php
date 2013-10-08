<?php
/*
 *      OSCLass – software for creating and publishing online classified
 *                           advertising platforms
 *
 *                        Copyright (C) 2010 OSCLASS
 *
 *       This program is free software: you can redistribute it and/or
 *     modify it under the terms of the GNU Affero General Public License
 *     as published by the Free Software Foundation, either version 3 of
 *            the License, or (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful, but
 *         WITHOUT ANY WARRANTY; without even the implied warranty of
 *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *             GNU Affero General Public License for more details.
 *
 *      You should have received a copy of the GNU Affero General Public
 * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if(Params::getParam('plugin_action')=='done') {
    osc_set_preference('default_premium_cost', Params::getParam("default_premium_cost") ? Params::getParam("default_premium_cost") : '1.0', 'payment', 'STRING');
    osc_set_preference('allow_premium', Params::getParam("allow_premium") ? Params::getParam("allow_premium") : '0', 'payment', 'BOOLEAN');
    osc_set_preference('default_publish_cost', Params::getParam("default_premium_cost") ? Params::getParam("default_publish_cost") : '1.0', 'payment', 'STRING');
    osc_set_preference('pay_per_post', Params::getParam("pay_per_post") ? Params::getParam("pay_per_post") : '0', 'payment', 'BOOLEAN');
    osc_set_preference('premium_days', Params::getParam("premium_days") ? Params::getParam("premium_days") : '7', 'payment', 'INTEGER');
    osc_set_preference('currency', Params::getParam("currency") ? Params::getParam("currency") : 'USD', 'payment', 'STRING');
    osc_set_preference('pack_price_1', Params::getParam("pack_price_1"), 'payment', 'STRING');
    osc_set_preference('pack_price_2', Params::getParam("pack_price_2"), 'payment', 'STRING');
    osc_set_preference('pack_price_3', Params::getParam("pack_price_3"), 'payment', 'STRING');

    osc_set_preference('paypal_api_username', payment_crypt(Params::getParam("paypal_api_username")), 'payment', 'STRING');
    osc_set_preference('paypal_api_password', payment_crypt(Params::getParam("paypal_api_password")), 'payment', 'STRING');
    osc_set_preference('paypal_api_signature', payment_crypt(Params::getParam("paypal_api_signature")), 'payment', 'STRING');
    osc_set_preference('paypal_email', Params::getParam("paypal_email"), 'payment', 'STRING');
    osc_set_preference('paypal_standard', Params::getParam("paypal_standard") ? Params::getParam("paypal_standard") : '0', 'payment', 'BOOLEAN');
    osc_set_preference('paypal_sandbox', Params::getParam("paypal_sandbox") ? Params::getParam("paypal_sandbox") : '0', 'payment', 'BOOLEAN');
    osc_set_preference('paypal_enabled', Params::getParam("paypal_enabled") ? Params::getParam("paypal_enabled") : '0', 'payment', 'BOOLEAN');

    osc_set_preference('blockchain_btc_address', Params::getParam("blockchain_btc_address") ? Params::getParam("blockchain_btc_address") : '', 'payment', 'STRING');
    osc_set_preference('blockchain_enabled', Params::getParam("blockchain_enabled") ? Params::getParam("blockchain_enabled") : '0', 'payment', 'BOOLEAN');

    osc_set_preference('braintree_merchant_id', payment_crypt(Params::getParam("braintree_merchant_id")), 'payment', 'STRING');
    osc_set_preference('braintree_public_key', payment_crypt(Params::getParam("braintree_public_key")), 'payment', 'STRING');
    osc_set_preference('braintree_private_key', payment_crypt(Params::getParam("braintree_private_key")), 'payment', 'STRING');
    osc_set_preference('braintree_encryption_key', payment_crypt(Params::getParam("braintree_encryption_key")), 'payment', 'STRING');
    osc_set_preference('braintree_sandbox', (Params::getParam("braintree_sandbox") == 'sandbox') ? 'sandbox' : 'production', 'payment', 'STRING');
    osc_set_preference('braintree_enabled', Params::getParam("braintree_enabled") ? Params::getParam("braintree_enabled") : '0', 'payment', 'BOOLEAN');

    osc_set_preference('stripe_secret_key', payment_crypt(Params::getParam("stripe_secret_key")), 'payment', 'STRING');
    osc_set_preference('stripe_public_key', payment_crypt(Params::getParam("stripe_public_key")), 'payment', 'STRING');
    osc_set_preference('stripe_secret_key_test', payment_crypt(Params::getParam("stripe_secret_key_test")), 'payment', 'STRING');
    osc_set_preference('stripe_public_key_test', payment_crypt(Params::getParam("stripe_public_key_test")), 'payment', 'STRING');
    osc_set_preference('stripe_sandbox', Params::getParam("stripe_sandbox") ? Params::getParam("stripe_sandbox") : '0', 'payment', 'BOOLEAN');
    osc_set_preference('stripe_enabled', Params::getParam("stripe_enabled") ? Params::getParam("stripe_enabled") : '0', 'payment', 'BOOLEAN');

    osc_set_preference('coinjar_merchant_user', payment_crypt(Params::getParam("coinjar_merchant_user")), 'payment', 'STRING');
    osc_set_preference('coinjar_merchant_password', payment_crypt(Params::getParam("coinjar_merchant_password")), 'payment', 'STRING');
    osc_set_preference('coinjar_api_key', payment_crypt(Params::getParam("coinjar_api_key")), 'payment', 'STRING');
    osc_set_preference('coinjar_sb_merchant_user', payment_crypt(Params::getParam("coinjar_sb_merchant_user")), 'payment', 'STRING');
    osc_set_preference('coinjar_sb_merchant_password', payment_crypt(Params::getParam("coinjar_sb_merchant_password")), 'payment', 'STRING');
    osc_set_preference('coinjar_sb_api_key', payment_crypt(Params::getParam("coinjar_sb_api_key")), 'payment', 'STRING');
    osc_set_preference('coinjar_merchant_reference', Params::getParam("coinjar_merchant_reference"), 'payment', 'STRING');
    osc_set_preference('coinjar_sandbox', Params::getParam("coinjar_sandbox") ? Params::getParam("coinjar_sandbox") : '0', 'payment', 'BOOLEAN');
    osc_set_preference('coinjar_enabled', Params::getParam("coinjar_enabled") ? Params::getParam("coinjar_enabled") : '0', 'payment', 'BOOLEAN');

    // HACK : This will make possible use of the flash messages ;)
    ob_get_clean();
    osc_add_flash_ok_message(__('Congratulations, the plugin is now configured', 'payment'), 'admin');
    osc_redirect_to(osc_route_admin_url('payment-admin-conf'));
}
?>

<script type="text/javascript" >
    $(document).ready(function(){
        $("#dialog-paypal").dialog({
            autoOpen: false,
            modal: true,
            width: '90%',
            title: '<?php echo osc_esc_js( __('Paypal help', 'payment') ); ?>'
        });
        $("#dialog-blockchain").dialog({
            autoOpen: false,
            modal: true,
            width: '90%',
            title: '<?php echo osc_esc_js( __('Blockchain help', 'payment') ); ?>'
        });
        $("#dialog-braintree").dialog({
            autoOpen: false,
            modal: true,
            width: '90%',
            title: '<?php echo osc_esc_js( __('Braintree help', 'payment') ); ?>'
        });
        $("#dialog-stripe").dialog({
            autoOpen: false,
            modal: true,
            width: '90%',
            title: '<?php echo osc_esc_js( __('Stripe help', 'payment') ); ?>'
        });
        $("#dialog-coinjar").dialog({
            autoOpen: false,
            modal: true,
            width: '90%',
            title: '<?php echo osc_esc_js( __('CoinJar help', 'payment') ); ?>'
        });
    });
</script>
<?php if(PAYMENT_CRYPT_KEY=='randompasswordchangethis') {
    echo '<div style="text-align:center; font-size:22px; background-color:#dd0000;"><p>' . sprintf(__('Please, change the crypt key (PAYMENT_CRYPT_KEY) in %s', 'payment'), payment_path().'index.php') . '</p></div>';
}; ?>
<div id="general-setting">
<div id="general-settings">
<h2 class="render-title"><?php _e('Payments settings', 'payment'); ?></h2>
<ul id="error_list"></ul>
<form name="payment_form" action="<?php echo osc_admin_base_url(true); ?>" method="post">
<input type="hidden" name="page" value="plugins" />
<input type="hidden" name="action" value="renderplugin" />
<input type="hidden" name="route" value="payment-admin-conf" />
<input type="hidden" name="plugin_action" value="done" />
<fieldset>
<div class="form-horizontal">
<div class="form-row">
    <div class="form-label"><?php _e('Premium ads', 'payment'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('allow_premium', 'payment') ? 'checked="true"' : ''); ?> name="allow_premium" value="1" />
                <?php _e('Allow premium ads', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-label"><?php _e('Default premium cost', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="default_premium_cost" value="<?php echo osc_get_preference('default_premium_cost', 'payment'); ?>" /></div>
</div>
<div class="form-row">
    <div class="form-label"><?php _e('Premium days', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="premium_days" value="<?php echo osc_get_preference('premium_days', 'payment'); ?>" /></div>
</div>
<div class="form-row">
    <div class="form-label"><?php _e('Publish fee', 'payment'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('pay_per_post', 'payment') ? 'checked="true"' : ''); ?> name="pay_per_post" value="1" />
                <?php _e('Pay per post ads', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-label"><?php _e('Default publish cost', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="default_publish_cost" value="<?php echo osc_get_preference('default_publish_cost', 'payment'); ?>" /></div>
</div>
<div class="form-row">
    <div class="form-label"><?php _e('Default currency'); ?></div>
    <div class="form-controls">
        <select name="currency" id="currency">
            <option value="AUD" <?php if(osc_get_preference('currency', 'payment')=="AUD") { echo 'selected="selected"';}; ?> >AUD</option>
            <option value="BRL" <?php if(osc_get_preference('currency', 'payment')=="BRL") { echo 'selected="selected"';}; ?> >BRL</option>
            <option value="CAD" <?php if(osc_get_preference('currency', 'payment')=="CAD") { echo 'selected="selected"';}; ?> >CAD</option>
            <option value="CHF" <?php if(osc_get_preference('currency', 'payment')=="CHF") { echo 'selected="selected"';}; ?> >CHF</option>
            <option value="CZK" <?php if(osc_get_preference('currency', 'payment')=="CZK") { echo 'selected="selected"';}; ?> >CZK</option>
            <option value="DKK" <?php if(osc_get_preference('currency', 'payment')=="DKK") { echo 'selected="selected"';}; ?> >DKK</option>
            <option value="EUR" <?php if(osc_get_preference('currency', 'payment')=="EUR") { echo 'selected="selected"';}; ?> >EUR</option>
            <option value="GBP" <?php if(osc_get_preference('currency', 'payment')=="GBP") { echo 'selected="selected"';}; ?> >GBP</option>
            <option value="HKD" <?php if(osc_get_preference('currency', 'payment')=="HKD") { echo 'selected="selected"';}; ?> >HKD</option>
            <option value="HUF" <?php if(osc_get_preference('currency', 'payment')=="HUF") { echo 'selected="selected"';}; ?> >HUF</option>
            <option value="JPY" <?php if(osc_get_preference('currency', 'payment')=="JPY") { echo 'selected="selected"';}; ?> >JPY</option>
            <option value="NOK" <?php if(osc_get_preference('currency', 'payment')=="NOK") { echo 'selected="selected"';}; ?> >NOK</option>
            <option value="NZD" <?php if(osc_get_preference('currency', 'payment')=="NZD") { echo 'selected="selected"';}; ?> >NZD</option>
            <option value="PLN" <?php if(osc_get_preference('currency', 'payment')=="PLN") { echo 'selected="selected"';}; ?> >PLN</option>
            <option value="SEK" <?php if(osc_get_preference('currency', 'payment')=="SEK") { echo 'selected="selected"';}; ?> >SEK</option>
            <option value="SGD" <?php if(osc_get_preference('currency', 'payment')=="SGD") { echo 'selected="selected"';}; ?> >SGD</option>
            <option value="USD" <?php if(osc_get_preference('currency', 'payment')=="USD") { echo 'selected="selected"';}; ?> >USD</option>
            <option value="BTC" <?php if(osc_get_preference('currency', 'payment')=="BTC") { echo 'selected="selected"';}; ?> >BTC*</option>
        </select>
    </div>
    <span class="help-box"><?php _e('BTC are not currently supported by Paypal (use only with Blockchain).', 'payment'); ?></span>
</div>
<div class="form-row">
                        <span class="help-box">
                            <?php _e("You could specify up to 3 'packs' that users can buy, so they don't need to pay each time they publish an ad. The credit from the pack will be stored for later uses.",'payment'); ?>
                        </span>
</div>
<div class="form-row">
    <div class="form-label"><?php echo sprintf(__('Price of pack #%d', 'payment'), '1'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="pack_price_1" value="<?php echo osc_get_preference('pack_price_1', 'payment'); ?>" /></div>
</div>
<div class="form-row">
    <div class="form-label"><?php echo sprintf(__('Price of pack #%d', 'payment'), '2'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="pack_price_2" value="<?php echo osc_get_preference('pack_price_2', 'payment'); ?>" /></div>
</div>
<div class="form-row">
    <div class="form-label"><?php echo sprintf(__('Price of pack #%d', 'payment'), '3'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="pack_price_3" value="<?php echo osc_get_preference('pack_price_3', 'payment'); ?>" /></div>
</div>
<h2 class="render-title separate-top"><?php _e('Paypal settings', 'payment'); ?> <span><a href="javascript:void(0);" onclick="$('#dialog-paypal').dialog('open');" ><?php _e('help', 'payment'); ?></a></span> <span style="font-size: 0.5em" ><a href="javascript:void(0);" onclick="$('.paypal').toggle();" ><?php _e('Show options', 'payment'); ?></a></span></h2>
<div class="form-row paypal hide">
    <div class="form-label"><?php _e('Enable Paypal'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('paypal_enabled', 'payment') ? 'checked="true"' : ''); ?> name="paypal_enabled" value="1" />
                <?php _e('Enable Paypal as a method of payment', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row paypal hide">
    <div class="form-label"><?php _e('Paypal API username', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="paypal_api_username" value="<?php echo payment_decrypt(osc_get_preference('paypal_api_username', 'payment')); ?>" /></div>
</div>
<div class="form-row paypal hide">
    <div class="form-label"><?php _e('Paypal API password', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="paypal_api_password" value="<?php echo payment_decrypt(osc_get_preference('paypal_api_password', 'payment')); ?>" /></div>
</div>
<div class="form-row paypal hide">
    <div class="form-label"><?php _e('Paypal API signature', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="paypal_api_signature" value="<?php echo payment_decrypt(osc_get_preference('paypal_api_signature', 'payment')); ?>" /></div>
</div>
<div class="form-row paypal hide">
    <div class="form-label"><?php _e('Paypal email', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="paypal_email" value="<?php echo osc_get_preference('paypal_email', 'payment'); ?>" /></div>
</div>
<div class="form-row paypal hide">
    <div class="form-label"><?php _e('Standard payments'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('paypal_standard', 'payment') ? 'checked="true"' : ''); ?> name="paypal_standard" value="1" />
                <?php _e('Use "Standard payments" if "Digital Goods" is not available in your country', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row paypal hide">
    <div class="form-label"><?php _e('Paypal sandbox'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('paypal_sandbox', 'payment') ? 'checked="true"' : ''); ?> name="paypal_sandbox" value="1" />
                <?php _e('Use Paypal sandbox to test everything is right before going live', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<h2 class="render-title separate-top"><?php _e('Blockchain settings', 'payment'); ?> <span><a href="javascript:void(0);" onclick="$('#dialog-blockchain').dialog('open');" ><?php _e('help', 'payment'); ?></a></span> <span style="font-size: 0.5em" ><a href="javascript:void(0);" onclick="$('.blockchain').toggle();" ><?php _e('Show options', 'payment'); ?></a></span></h2>
<div class="form-row blockchain hide">
    <div class="form-label"><?php _e('Enable Blockchain'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('blockchain_enabled', 'payment') ? 'checked="true"' : ''); ?> name="blockchain_enabled" value="1" />
                <?php _e('Enable Blockchain as a method of payment', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row blockchain hide">
    <div class="form-label"><?php _e('Bitcoin address', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="blockchain_btc_address" value="<?php echo osc_get_preference('blockchain_btc_address', 'payment'); ?>" /></div>
</div>
<h2 class="render-title separate-top"><?php _e('Braintree settings', 'payment'); ?> <span><a href="javascript:void(0);" onclick="$('#dialog-braintree').dialog('open');" ><?php _e('help', 'payment'); ?></a></span> <span style="font-size: 0.5em" ><a href="javascript:void(0);" onclick="$('.braintree').toggle();" ><?php _e('Show options', 'payment'); ?></a></span></h2>
<div class="form-row braintree hide">
    <div class="form-label"><?php _e('Enable Braintree'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('braintree_enabled', 'payment') ? 'checked="true"' : ''); ?> name="braintree_enabled" value="1" />
                <?php _e('Enable Braintree as a method of payment', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row braintree hide">
    <div class="form-label"><?php _e('Enable Sandbox'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('braintree_sandbox', 'payment') == 'sandbox' ? 'checked="true"' : ''); ?> name="braintree_sandbox" value="sandbox" />
                <?php _e('Enable sandbox for development testing', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row braintree hide">
    <div class="form-label"><?php _e('Braintree merchant id', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="braintree_merchant_id" value="<?php echo payment_decrypt(osc_get_preference('braintree_merchant_id', 'payment')); ?>" /></div>
</div>
<div class="form-row braintree hide">
    <div class="form-label"><?php _e('Braintree public key', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="braintree_public_key" value="<?php echo payment_decrypt(osc_get_preference('braintree_public_key', 'payment')); ?>" /></div>
</div>
<div class="form-row braintree hide">
    <div class="form-label"><?php _e('Braintree private key', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="braintree_private_key" value="<?php echo payment_decrypt(osc_get_preference('braintree_private_key', 'payment')); ?>" /></div>
</div>
<div class="form-row braintree hide">
    <div class="form-label"><?php _e('Braintree encryption key', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="braintree_encryption_key" value="<?php echo payment_decrypt(osc_get_preference('braintree_encryption_key',
            'payment')); ?>" /></div>
</div>
<h2 class="render-title separate-top"><?php _e('Stripe settings', 'payment'); ?> <span><a href="javascript:void(0);" onclick="$('#dialog-stripe').dialog('open');" ><?php _e('help', 'payment'); ?></a></span> <span style="font-size: 0.5em" ><a href="javascript:void(0);" onclick="$('.stripe').toggle();" ><?php _e('Show options', 'payment'); ?></a></span></h2>
<div class="form-row stripe hide">
    <div class="form-label"><?php _e('Enable Stripe'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('stripe_enabled', 'payment') ? 'checked="true"' : ''); ?> name="stripe_enabled" value="1" />
                <?php _e('Enable Stripe as a method of payment', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row stripe hide">
    <div class="form-label"><?php _e('Enable Sandbox'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('stripe_sandbox', 'payment') ? 'checked="true"' : ''); ?> name="stripe_sandbox" value="1" />
                <?php _e('Enable sandbox for development testing', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row stripe hide">
    <div class="form-label"><?php _e('Stripe secret key', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="stripe_secret_key" value="<?php echo payment_decrypt(osc_get_preference('stripe_secret_key', 'payment')); ?>" /></div>
</div>
<div class="form-row stripe hide">
    <div class="form-label"><?php _e('Stripe public key', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="stripe_public_key" value="<?php echo payment_decrypt(osc_get_preference('stripe_public_key', 'payment')); ?>" /></div>
</div>
<div class="form-row stripe hide">
    <div class="form-label"><?php _e('Stripe secret key (test)', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="stripe_secret_key_test" value="<?php echo payment_decrypt(osc_get_preference('stripe_secret_key_test', 'payment')); ?>" /></div>
</div>
<div class="form-row stripe hide">
    <div class="form-label"><?php _e('Stripe public key (test)', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="stripe_public_key_test" value="<?php echo payment_decrypt(osc_get_preference('stripe_public_key_test', 'payment')); ?>" /></div>
</div>
<h2 class="render-title separate-top"><?php _e('CoinJar settings', 'payment'); ?> <span><a href="javascript:void(0);" onclick="$('#dialog-coinjar').dialog('open');" ><?php _e('help', 'payment'); ?></a></span> <span style="font-size: 0.5em" ><a href="javascript:void(0);" onclick="$('.coinjar').toggle();" ><?php _e('Show options', 'payment'); ?></a></span></h2>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('Enable CoinJar'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('coinjar_enabled', 'payment') ? 'checked="true"' : ''); ?> name="coinjar_enabled" value="1" />
                <?php _e('Enable CoinJar as a method of payment', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('Enable Sandbox'); ?></div>
    <div class="form-controls">
        <div class="form-label-checkbox">
            <label>
                <input type="checkbox" <?php echo (osc_get_preference('coinjar_sandbox', 'payment') ? 'checked="true"' : ''); ?> name="coinjar_sandbox" value="1" />
                <?php _e('Enable sandbox for development testing', 'payment'); ?>
            </label>
        </div>
    </div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('CoinJar merchant user', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="coinjar_merchant_user" value="<?php echo payment_decrypt(osc_get_preference('coinjar_merchant_user', 'payment')); ?>" /></div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('CoinJar merchant password', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="coinjar_merchant_password" value="<?php echo payment_decrypt(osc_get_preference('coinjar_merchant_password', 'payment')); ?>" /></div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('CoinJar API key', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="coinjar_api_key" value="<?php echo payment_decrypt(osc_get_preference('coinjar_api_key', 'payment')); ?>" /></div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('CoinJar merchant user (sandbox)', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="coinjar_sb_merchant_user" value="<?php echo payment_decrypt(osc_get_preference('coinjar_sb_merchant_user', 'payment')); ?>" /></div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('CoinJar merchant password (sandbox)', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="coinjar_sb_merchant_password" value="<?php echo payment_decrypt(osc_get_preference('coinjar_sb_merchant_password', 'payment')); ?>" /></div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('CoinJar API key (sandbox)', 'payment'); ?></div>
    <div class="form-controls"><input type="text" class="xlarge" name="coinjar_sb_api_key" value="<?php echo payment_decrypt(osc_get_preference('coinjar_sb_api_key', 'payment')); ?>" /></div>
</div>
<div class="form-row coinjar hide">
    <div class="form-label"><?php _e('CoinJar merchant reference', 'payment'); ?></div>
    <div class="form-controls">
        <input type="text" class="xlarge" name="coinjar_merchant_reference" value="<?php echo osc_get_preference('coinjar_merchant_reference', 'payment'); ?>" />
        <span class="help-box"><?php _e('It you have several websites this field helps you identify from which one is the payment', 'payment'); ?></span>
    </div>
</div>
<div class="clear"></div>
<div class="form-actions">
    <input type="submit" id="save_changes" value="<?php echo osc_esc_html( __('Save changes') ); ?>" class="btn btn-submit" />
</div>
</div>
</fieldset>
</form>
</div>
</div>
<form id="dialog-paypal" method="get" action="#" class="has-form-actions hide">
    <div class="form-horizontal">
        <div class="form-row">
            <h3><?php _e('API or Standard Payments?', 'payment'); ?></h3>
            <p>
                <?php _e('API payments give you more control over the payment process, it\'s required for digital goods & micropayments (Note: Not all countries are allowed to have digital goods & micropayments processes). On the other side standard payments are simple, less customizable but works everywhere.', 'payment'); ?>.
                <br/>
                <?php _e('Micropayments offers a reduction on the fee to pay Paypal for orders under 4$ (or equivalent), around 5cents + 5% while standard payments have a fee around 30cents + 5%. Due the nature of OSClass is recommended to use micropayments, but we\'re aware that they\'re not available worldwide. Please check with Paypal the avalaibility of the service in your area.', 'payment'); ?>.
                <br/>
            </p>
            <h3><?php _e('Setting up your Paypal account for Standard Payments', 'payment'); ?></h3>
            <p>
                <?php _e('Introduce your payment email and check the "Use Standard Payment" option here.', 'payment'); ?>.
                <br/>
                <?php _e('You need Paypal API credentials (before entering here your API credentials, MODIFY index.php file of this plugin and change the value of PAYPAL_CRYPT_KEY variable to make your API more secure)', 'payment'); ?>.
                <br/>
                <?php _e('You need to tell Paypal where is your IPN file', 'payment'); ?>
            </p>
            <h3><?php _e('Setting up your Paypal account for micropayments/API', 'payment'); ?></h3>
            <p>
                <?php _e('Before being able to use Paypal plugin, you need to set up some configuration at your Paypal account', 'payment'); ?>.
                <br/>
                <?php _e('Your Paypal account has to be set as Business or Premier, you could change that at Your Profile, under My Settings', 'payment'); ?>.
                <br/>
                <?php echo sprintf( __('You need to sign in up for micropayments/digital good <a href="%s">from here</a>.', 'payment'), 'https://merchant.payment.com/cgi-bin/marketingweb?cmd=_render-content&content_ID=merchant/digital_goods'); ?>.
                <br/>
                <?php _e('You need Paypal API credentials (before entering here your API credentials, MODIFY index.php file of this plugin and change the value of PAYPAL_CRYPT_KEY variable to make your API more secure)', 'payment'); ?>.
                <br/>
                <?php _e('You need to tell Paypal where is your IPN file', 'payment'); ?>
            </p>
            <h3><?php _e('Setting up your IPN', 'payment'); ?></h3>
            <p>
                <?php _e('Click Profile on the My Account tab', 'payment'); ?>.
                <br/>
                <?php _e('Click Instant Payment Notification Preferences in the Selling Preferences column', 'payment'); ?>.
                <br/>
                <?php _e("Click Choose IPN Settings to specify your listener’s URL and activate the listener (usually is http://www.yourdomain.com/oc-content/plugins/payment/notify_url.php)", 'payment'); ?>.
            </p>
            <h3><?php _e('How to obtain API credentials', 'payment'); ?></h3>
            <p>
                <?php _e('In order to use the Paypal plugin you will need Paypal API credentials, you could obtain them for free following theses steps', 'payment'); ?>:
                <br/>
                <?php _e('Verify your account status. Go to your PayPal Profile under My Settings and verify that your Account Type is Premier or Business, or upgrade your account', "payment"); ?>.
                <br/>
                <?php _e('Verify your API settings. Click on My Selling Tools. Click Selling Online and verify your API access. Click Update to view or set up your API signature and credentials', 'payment'); ?>.
            </p>
        </div>
        <div class="form-actions">
            <div class="wrapper">
                <a class="btn" href="javascript:void(0);" onclick="$('#dialog-paypal').dialog('close');"><?php _e('Cancel'); ?></a>
            </div>
        </div>
    </div>
</form>
<form id="dialog-blockchain" method="get" action="#" class="has-form-actions hide">
    <div class="form-horizontal">
        <div class="form-row">
            <h3><?php _e('Learn more about Bitcoins', 'payment'); ?></h3>
            <p>
                <?php printf(__('Bitcoin official website: %s', 'payment'), '<a href="http://bitcoin.org/en/">http://bitcoin.org/en/</a>'); ?>.
                <br/>
                <?php printf(__('Getting started: %s', 'payment'), '<a href="https://en.bitcoin.it/wiki/Getting_started">https://en.bitcoin.it/wiki/Getting_started</a>'); ?>.
                <br/>
                <?php printf(__('F.A.Q.: %s', 'payment'), '<a href="https://en.bitcoin.it/wiki/FAQ">https://en.bitcoin.it/wiki/FAQ</a>'); ?>.
                <br/>
                <?php printf(__('We use coins: %s', 'payment'), '<a href="http://www.weusecoins.com/en/">http://www.weusecoins.com/en/</a>'); ?>.
                <br/>
                <?php printf(__('More info about Blockchain: %s', 'payment'), '<a href="https://blockchain.info/api">https://blockchain.info/api</a>'); ?>.
                <br/>
            </p>
            <h3><?php _e('Blockchain', 'payment'); ?></h3>
            <p>
                <?php _e('To use Blockchain as a method of payment you need a bitcoin address, there are several ways to obtain one (they are free of charge), please refer to some of the previous links on more information about how to obtain one.', 'payment'); ?>.
                <br/>
                <?php _e('The services of Blockchain are free if the usage fits in their "fair use policy".', 'payment'); ?>.
                <br/>
            </p>
        </div>
        <div class="form-actions">
            <div class="wrapper">
                <a class="btn" href="javascript:void(0);" onclick="$('#dialog-blockchain').dialog('close');"><?php _e('Cancel'); ?></a>
            </div>
        </div>
    </div>
</form>
<form id="dialog-braintree" method="get" action="#" class="has-form-actions hide">
    <div class="form-horizontal">
        <div class="form-row">
            <h3><?php _e('Learn more about Braintree', 'payment'); ?></h3>
            <p>
                <?php printf(__('Braintree official website: %s', 'payment'), '<a href="https://www.braintreepayments.com/">https://www.braintreepayments.com/</a>'); ?>.
                <br/>
                <?php printf(__('Getting started: %s', 'payment'), '<a href="https://www.braintreepayments.com/tour/payment-gateway">https://www.braintreepayments.com/tour/payment-gateway</a>'); ?>.
                <br/>
            </p>
        </div>
        <div class="form-actions">
            <div class="wrapper">
                <a class="btn" href="javascript:void(0);" onclick="$('#dialog-braintree').dialog('close');"><?php _e('Cancel'); ?></a>
            </div>
        </div>
    </div>
</form>
<form id="dialog-stripe" method="get" action="#" class="has-form-actions hide">
    <div class="form-horizontal">
        <div class="form-row">
            <h3><?php _e('Learn more about Stripe', 'payment'); ?></h3>
            <p>
                <?php printf(__('Stripe official website: %s', 'payment'), '<a href="https://stripe.com/">https://stripe.com/</a>'); ?>.
                <br/>
                <?php printf(__('Getting started: %s', 'payment'), '<a href="https://stripe.com/docs">https://stripe.com/docs</a>'); ?>.
                <br/>
            </p>
        </div>
        <div class="form-actions">
            <div class="wrapper">
                <a class="btn" href="javascript:void(0);" onclick="$('#dialog-stripe').dialog('close');"><?php _e('Cancel'); ?></a>
            </div>
        </div>
    </div>
</form>
<form id="dialog-coinjar" method="get" action="#" class="has-form-actions hide">
    <div class="form-horizontal">
        <div class="form-row">
            <h3><?php _e('Learn more about CoinJar', 'payment'); ?></h3>
            <p>
                <?php printf(__('CoinJar official website: %s', 'payment'), '<a href="http://coinjar.io/">http://coinjar.io/</a>'); ?>.
                <br/>
                <?php printf(__('Getting started: %s', 'payment'), '<a href="https://developer.coinjar.io/display/CD/Home">https://developer.coinjar.io/display/CD/Home</a>'); ?>.
                <br/>
            </p>
        </div>
        <div class="form-actions">
            <div class="wrapper">
                <a class="btn" href="javascript:void(0);" onclick="$('#dialog-coinjar').dialog('close');"><?php _e('Cancel'); ?></a>
            </div>
        </div>
    </div>
</form>