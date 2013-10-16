<?php

    function troll_delay($seconds = null) {
        if($seconds==null) {
            $seconds = mt_rand(0, 20);
        }
        sleep($seconds);
    }

    function troll_white_page() {
        header('HTTP/1.1 200 OK');
        die;
    }

    function troll_random_page() {
        $urls = explode(",", osc_get_preference('random_pages', 'troll'));
        $l = count($urls);
        $random = mt_rand(0, $l-1);
        osc_redirect_to($urls[$random]);
    }

    function troll_access_denied() {
        require_once LIB_PATH . 'osclass/helpers/hErrors.php';
        header('HTTP/1.1 403 Forbidden');
        osc_die('Access denied', 'Access denied');
    }

    function troll_not_found() {
        require_once LIB_PATH . 'osclass/helpers/hErrors.php';
        header('HTTP/1.1 404 Not Found');
        osc_die('Not Found', 'Not Found');
    }

    function troll_site_offline() {
        header('HTTP/1.1 503 Service unavailable');
        echo '<div id="maintenance" name="maintenance">';
        _e("The website is currently undergoing maintenance");
        echo '</div>';
        die;
    }

    function troll_logout() {
        osc_redirect_to(osc_user_logout_url());

    }



?>