<?php

/*############################################# CORE ##########################################*/

function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/linuxgnublog.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/*############################################# USER ##########################################*/

//modificar mensaje de error en wp-admin
function failed_login()
{
    return 'Tus credenciales de acceso a Linuxgnublog.org son incorrectas.';
}
add_filter('login_errors', 'failed_login');

//Simple Comment Editing
function edit_sce_comment_time($time_in_minutes)
{
    return 10;
}
add_filter('sce_comment_time', 'edit_sce_comment_time');

//notificacion actualizacion solo visible admin
global $user_login;
get_currentuserinfo();
if ($user_login !== "admin") {
    add_action('init', create_function('$a', "remove_action( 'init', 'wp_version_check' );"), 2);
    add_filter('pre_option_update_core', create_function('$a', "return null;"));
}

/*############################################# SHORTCODES ##########################################*/

function short_code_success($atts, $content = "")
{
    return '<div class="alert alert-success" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('success', 'short_code_success');

function short_code_info($atts, $content = "")
{
    return '<div class="alert alert-info" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('info', 'short_code_info');

function short_code_warning($atts, $content = "")
{
    return '<div class="alert alert-warning" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('warning', 'short_code_warning');

function short_code_danger($atts, $content = "")
{
    return '<div class="alert alert-danger" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('danger', 'short_code_danger'); 
