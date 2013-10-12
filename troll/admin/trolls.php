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

if(Params::getParam('plugin_action')=='delete_troll') {
    ModelTroll::newInstance()->deleteTroll(Params::getParam('troll'));
} else if(Params::getParam('plugin_action')=='delete_value') {
    ModelTroll::newInstance()->deleteTrollValue(Params::getParam('value'));
} else if(Params::getParam('plugin_action')=='add_troll') {
    ModelTroll::newInstance()->insertValue(Params::getParam('troll'), Params::getParam('value'));
}

$tmp_trolls = ModelTroll::newInstance()->listAll();
$trolls = array();
foreach($tmp_trolls as $troll) {
    $trolls[$troll['i_troll_id']][] = $troll['s_value'];
}

?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#dialog-troll-delete").dialog({
            autoOpen: false,
            modal: true,
            title: '<?php echo osc_esc_js(__('Delete', 'antitroll')); ?>'
        });

        $("#dialog-troll-new").dialog({
            autoOpen: false,
            modal: true,
            title: '<?php echo osc_esc_js(__('Add new rule', 'antitroll')); ?>'
        });
    });

    function add_troll() {
        $("#dialog-troll-new input[name='troll']").attr('value', '');
        $("#dialog-troll-new input[name='value']").attr('value', '');
        $("#dialog-troll-new").dialog('open');
    }

    function add_value(id) {
        $("#dialog-troll-new input[name='troll']").attr('value', id);
        $("#dialog-troll-new input[name='value']").attr('value', '');
        $("#dialog-troll-new").dialog('open');
    }

    function delete_troll(id) {
        $("#dialog-troll-delete input[name='plugin_action']").attr('value', 'delete_troll');
        $("#dialog-troll-delete input[name='troll']").attr('value', id);
        $("#dialog-troll-delete input[name='value']").attr('value', '');
        $("#dialog-troll-delete").dialog('open');
    }

    function delete_value(value) {
        $("#dialog-troll-delete input[name='plugin_action']").attr('value', 'delete_value');
        $("#dialog-troll-delete input[name='troll']").attr('value', '');
        $("#dialog-troll-delete input[name='value']").attr('value', value);
        $("#dialog-troll-delete").dialog('open');
    }
</script>
<h2 class="render-title"><?php _e('Trolls', 'antitroll'); ?> <span><a href="javascript:add_troll();" ><?php _e('add new troll', 'antitroll'); ?></a></span></h2>
<ul class="troll_list" >
    <?php foreach($trolls as $k => $troll) { ?>
        <li class="troll"><h3><?php printf(__('Troll #%d', 'antitroll'), $k); ?> <span><a href="javascript:delete_troll('<?php echo $k; ?>');" ><?php _e('delete troll', 'antitroll'); ?></a></span> | <span><a href="javascript:add_value('<?php echo $k; ?>');" ><?php _e('add new rule', 'antitroll'); ?></a></span></h3>
            <ul class="troll_value_list">
                <?php foreach($troll as $value) { ?>
                    <li class="troll_value"><?php antitroll_print_value($value); ?> <span><a href="javascript:delete_value('<?php echo $value; ?>');" ><?php _e('delete rule', 'antitroll'); ?></a></span></li>
                <?php }; ?>
            </ul>
        </li>
    <?php }; ?>
</ul>

<form id="dialog-troll-delete" method="get" action="<?php echo osc_admin_base_url(true); ?>" class="has-form-actions hide">
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="route" value="troll-admin-list" />
    <input type="hidden" name="plugin_action" value="" />
    <input type="hidden" name="troll" value="" />
    <input type="hidden" name="value" value="" />
    <div class="form-horizontal">
        <div class="form-row">
            <?php _e('This action can not be undone. Do you want to continue?', 'antitroll'); ?>
        </div>
        <div class="form-actions">
            <div class="wrapper">
                <a class="btn" href="javascript:void(0);" onclick="$('#dialog-troll-delete').dialog('close');"><?php _e('Cancel', 'antitroll'); ?></a>
                <input id="troll-delete-submit" type="submit" value="<?php echo osc_esc_html( __('Delete', 'antitroll')); ?>" class="btn btn-red" />
            </div>
        </div>
    </div>
</form>

<form id="dialog-troll-new" method="get" action="<?php echo osc_admin_base_url(true); ?>" class="has-form-actions hide">
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="route" value="troll-admin-list" />
    <input type="hidden" name="plugin_action" value="add_troll" />
    <input type="hidden" name="troll" value="" />
    <div class="form-horizontal">
        <div class="form-row">
            <input type="text" name="value" value="" placeholder="email or ip" />
        </div>
        <div class="form-actions">
            <div class="wrapper">
                <a class="btn" href="javascript:void(0);" onclick="$('#dialog-troll-new').dialog('close');"><?php _e('Cancel', 'antitroll'); ?></a>
                <input id="troll-delete-submit" type="submit" value="<?php echo osc_esc_html( __('Add', 'antitroll')); ?>" class="btn btn-red" />
            </div>
        </div>
    </div>
</form>
