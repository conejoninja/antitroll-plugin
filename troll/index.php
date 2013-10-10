<?php
/*
Plugin Name: Anti-troll plugin
Plugin URI: http://www.osclass.org/
Description: This plugin will troll your trolls and spammers
Version: 0.0.1
Author: Osclass
Author URI: http://www.osclass.org/
Plugin update URI: troll
*/

    require_once osc_plugins_path() . osc_plugin_folder(__FILE__) . 'ModelTroll.php';
    require_once osc_plugins_path() . osc_plugin_folder(__FILE__) . 'functions.php';
    function troll_install() {
        ModelTroll::newInstance()->install();
    }

    function troll_uninstall() {
        ModelTroll::newInstance()->uninstall();
    }

    function troll_admin_menu() {
        osc_add_admin_submenu_divider('plugins', 'Anti-troll', 'antitroll_divider', 'administrator');
        osc_add_admin_submenu_page('plugins', __('Manage trolls', 'antitroll'), osc_route_admin_url('troll-admin-list'), 'troll_admin_list', 'administrator');
    }

    function troll_init() {
        if(troll_is_troll()) {
            osc_add_filter('sql_search_item_conditions', 'troll_search');
            if(mt_rand(0,100)<40) { troll_delay(); };
            if(mt_rand(0,100)<8) { troll_white_page(); };
            if(mt_rand(0,100)<8) { troll_random_page(); };
            if(mt_rand(0,100)<8) { troll_access_denied(); };
            if(mt_rand(0,100)<8) { troll_not_found(); };
            if(mt_rand(0,100)<5) { troll_site_offline(); };
            if(mt_rand(0,100)<8) { troll_logout(); };
        }

    }

    function troll_login($user) {
        $mTroll = ModelTroll::newInstance();
        $troll = $mTroll->isTroll(osc_is_web_user_logged_in()?osc_logged_user_id():0, $_SERVER['REMOTE_ADDR']);
        if($troll!=0) {
            ModelTroll::newInstance()->insertValue($troll, $user['s_email']);
        }
    }

    function troll_search($conditions) {
        foreach($conditions as $k => $v) {
            if(trim($v)==DB_TABLE_PREFIX.'t_item.b_spam = 0') {
                $aliases = ModelTroll::newInstance()->aliases;
                $users = array();
                foreach($aliases as $alias) {
                    if(is_numeric($alias['s_value'])) { $users[$alias['s_value']] = DB_TABLE_PREFIX."t_item.fk_i_user_id = ".$alias['s_value']; }
                }
                if(count($users)>0) {
                    $conditions[$k] = "( ".DB_TABLE_PREFIX."t_item.b_spam = 0 OR ( ".DB_TABLE_PREFIX."t_item.b_spam = 1 AND ( ".implode(' OR ', $users)." ) ) )";
                }
                break;
            }
        }
        return $conditions;
    }

    function troll_before_html() {
        if(Params::getParam('page')=='user') {
            if(Params::getParam('action')=='items') {
                $itemsPerPage = (Params::getParam('itemsPerPage')!='')?Params::getParam('itemsPerPage'):10;
                $page         = (Params::getParam('iPage') > 0) ? Params::getParam('iPage') -1 : 0;
                $itemType     = Params::getParam('itemType');
                $total_items  = ModelTroll::newInstance()->countItemTypesByUserID(osc_logged_user_id(), $itemType);
                $total_pages  = ceil($total_items/$itemsPerPage);
                $items        = ModelTroll::newInstance()->findItemTypesByUserID(osc_logged_user_id(), $page*$itemsPerPage, $itemsPerPage, $itemType);

                $view = View::newInstance();
                $view->_exportVariableToView('items', $items);
                $view->_exportVariableToView('list_total_pages', $total_pages);
                $view->_exportVariableToView('list_total_items', $total_items);
                $view->_exportVariableToView('items_per_page', $itemsPerPage);
                $view->_exportVariableToView('items_type', $itemType);
                $view->_exportVariableToView('list_page', $page);
            } else if(Params::getParam('action')=='dashboard') {
                $max_items = (Params::getParam('max_items')!='')?Params::getParam('max_items'):5;
                $aItems = ModelTroll::newInstance()->findByUserIDEnabled(osc_logged_user_id(), 0, $max_items);

                $view = View::newInstance();
                $view->_exportVariableToView('items', $aItems);
                $view->_exportVariableToView('max_items', $max_items);
            }
        }
    }

    function troll_show_item($item) {
        $mTroll = ModelTroll::newInstance();
        $troll = $mTroll->isTroll(osc_is_web_user_logged_in()?osc_logged_user_id():0, $_SERVER['REMOTE_ADDR']);
        $item_troll= $mTroll->isTroll(0, null, $item['s_contact_email']);
        if($troll==$item_troll) {
            $item['b_spam'] = 0;
            View::newInstance()->_exportVariableToView('comments', ModelTroll::newInstance()->findCommentsByItemID($item['pk_i_id'], $mTroll->findByID($troll), osc_item_comments_page(), osc_comments_per_page()));
        }
        return $item;
    }

    function troll_avoid_contact($item) {
        $troll = ModelTroll::newInstance();
        $from = $troll->isTroll(osc_is_web_user_logged_in()?osc_logged_user_id():0, $_SERVER['REMOTE_ADDR']);
        $to = $troll->isTroll($item['fk_i_user_id'], null, $item['s_contact_email']);
        if($from!=$to) {
            osc_remove_hook('hook_email_item_inquiry', 'fn_email_item_inquiry');
        }
    }

    function troll_block_item($item) {
        if(ModelTroll::newInstance()->isTroll(osc_is_web_user_logged_in()?osc_logged_user_id():0, $_SERVER['REMOTE_ADDR'], $item['s_contact_email'])!==0) {
            $mItems = new ItemActions(false);
            $mItems->spam($item['pk_i_id'], true);
        }
    }

    function troll_avoid_comment_email($comment) {
        if(troll_is_troll()) {
            osc_remove_hook('hook_email_new_comment_admin', 'fn_email_new_comment_admin');
            osc_remove_hook('hook_email_new_comment_user', 'fn_email_new_comment_user');
        }
    }

    function troll_block_comment($commentID) {
        if(troll_is_troll()) {
            ItemComment::newInstance()->update(
                array('b_enabled' => 0),
                array('pk_i_id' => $commentID)
            );
        }
    }

    function troll_is_troll() {
        return (ModelTroll::newInstance()->isTroll(osc_is_web_user_logged_in()?osc_logged_user_id():0, $_SERVER['REMOTE_ADDR'])!==0);
    }

    osc_add_route('troll-admin-list', 'troll/admin/list', 'troll/admin/list', osc_plugin_folder(__FILE__).'admin/trolls.php');

    osc_register_plugin(osc_plugin_path(__FILE__), 'troll_install');
    osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'troll_uninstall');
    osc_add_hook('admin_menu_init', 'troll_admin_menu');

    // ONLY TO USERS
    if(OC_ADMIN!=1) {
        // GENERAL TROUBLE
        osc_add_hook('init', 'troll_init');
        osc_add_hook('before_html', 'troll_before_html');
        osc_add_hook('after_login', 'troll_login');

        // SHOW IT TO TROLLS
        osc_add_filter('pre_show_item', 'troll_show_item');
        // AVOID CONTACTING OTHER USERS
        osc_add_hook('pre_item_contact_post', 'troll_avoid_contact');
        // AUTO BLOCK ANY POSTED/EDITED ITEM
        osc_add_hook('posted_item', 'troll_block_item');
        osc_add_hook('edited_item', 'troll_block_item');
        // AVOID COMMENTS FROM TROLLS
        osc_add_hook('before_add_comment', 'troll_avoid_comment_email');
        osc_add_hook('add_comment', 'troll_block_comment');
    }

?>