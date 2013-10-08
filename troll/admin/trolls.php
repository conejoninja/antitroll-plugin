<?php

function antitroll_print_value($value) {
    if(is_numeric($value)) {
        printf(__('user id : %s'), $value);
    } else if(strpos($value, '@')!==false) {
        printf(__('email : %s'), $value);
    } else {
        printf(__('ip : %s'), $value);
    }
}

$tmp_trolls = ModelTroll::newInstance()->listAll();
$trolls = array();
foreach($tmp_trolls as $troll) {
    $trolls[$troll['i_troll_id']][] = $troll['s_value'];
}

?>
<h2 class="render-title"><?php _e('Trolls', 'antitroll'); ?></h2>
<ul class="troll_list" >
    <?php foreach($trolls as $k => $troll) { ?>
        <li class="troll"><h3><?php printf(__('Troll #%d', 'antitroll'), $k); ?></h3>
            <ul class="troll_value_list">
                <?php foreach($troll as $value) { ?>
                    <li class="troll_value"><?php antitroll_print_value($value); ?></li>
                <?php }; ?>
            </ul>
        </li>
    <?php }; ?>
</ul>




<!-- <form name="antitroll_form" action="<?php echo osc_admin_base_url(true); ?>" method="post">
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="route" value="payment-admin-conf" />
    <input type="hidden" name="plugin_action" value="done" />
    <fieldset>
        <div class="form-horizontal">
            <div class="form-row">
                <div class="form-label"><?php _e('Tracking ID', 'google_analytics') ?></div>
                <div class="form-controls"><input type="text" class="xlarge" name="webid" value="<?php echo osc_esc_html( osc_google_analytics_id() ); ?>"></div>
            </div>
            <div class="form-actions">
                <input type="submit" value="Save changes" class="btn btn-submit">
            </div>
        </div>
    </fieldset>
</form> -->