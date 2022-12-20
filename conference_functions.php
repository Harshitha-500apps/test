<?php

/**
 * initializing the plugin
 * @param $class_name
 */
function conference_class_loader($class_name)
{
    $class_file = conference_DIR . 'classes/class.'
        . trim(strtolower(str_replace('\\', '_', $class_name)), '\\') . '.php';
    if (is_file($class_file)) {
        require_once $class_file;
    }
}

/**
 * To add the token to DB
 */
function conference_addtoken()
{
    $token_value = $_POST['token_value'];
    if (get_option('user_token')) {
        update_option('user_token', $token_value);
        echo "updated";
    } else if (get_option('user_token') == "") {
        update_option('user_token', $token_value);
        echo "updated";
    } else {
        add_option('user_token', $token_value);
        echo "added";
    }
}


/** To extract the Token **/
function conference_extract_token()
{
    $token         = get_option('user_token');
    $tokenParts    = explode(".", $token);
    $tokenHeader   = base64_decode($tokenParts[0]);
    $tokenPayload  = base64_decode($tokenParts[1]);
    $jwtHeader     = json_decode($tokenHeader);
    $jwtPayload    = json_decode($tokenPayload);
    return $jwtPayload;
}
