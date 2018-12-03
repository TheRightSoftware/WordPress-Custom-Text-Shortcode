<?php
/*
Plugin Name: WordPress Custom Text Shortcode
Plugin URI:  https://therightsw.com
Description: You can add your desired text anywhere in website by using WordPress Custom Text Shortcode.
Version:     1.0.0
Author:      The Right software
Author URI:  http https://therightsw.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

*/

function wp_custom_text_activation() {
}
register_activation_hook(__FILE__, 'wp_custom_text_activation');
function wp_custom_text_deactivation() {
}
register_deactivation_hook(__FILE__, 'wp_custom_text_deactivation');

// create custom plugin settings menu
add_action('admin_menu', 'wp_custom_text_create_menu');

function wp_custom_text_create_menu() {

	//create new top-level menu
	add_menu_page('WordPress Custom Text Shortcode Plugin Settings', 'WordPress Custom Text Shortcode', 'administrator', __FILE__, 'wp_custom_text_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_wp_custom_text_settings' );
}

//Register Setting
function register_wp_custom_text_settings() {
	//register our settings
	register_setting( 'wp-custom-text-settings-group', 'wp_custom_text' );
}

function wp_custom_text_settings_page() {
?>
<div class="wrap">
<h2>Shortcode to display your text </h2>
[wp_custom_text_shortcode]
<p>you can used this shortcode in theme files as follow</p>
<?php echo htmlspecialchars("<?php echo do_shortcode('[wp_custom_text_shortcode]') ?>");?>
<h1>Your Custom Text</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'wp-custom-text-settings-group' ); ?>
    <?php do_settings_sections( 'wp-custom-text-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">WordPress Custom Text</th>
        <td><?php wp_editor( get_option( 'wp_custom_text' ), 'wp_custom_text' ); ?> </td>
        </tr>
    </table>
    <?php submit_button(); ?>

</form>

</div>
<?php } 
add_shortcode("wp_custom_text_shortcode", "wp_custom_text_shortcode_function");

function wp_custom_text_shortcode_function() {
return get_option( 'wp_custom_text' );
}