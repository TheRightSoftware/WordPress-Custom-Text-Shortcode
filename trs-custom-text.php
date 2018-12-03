<?php
/*
Plugin Name: Custom Text Shortcode
Plugin URI:  https://therightsw.com
Description: You can add your desired text anywhere in website by using Custom Text Shortcode.
Version:     1.0.0
Author:      The Right software
Author URI:  http https://therightsw.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

*/

function trs_custom_text_activation() {
}
register_activation_hook(__FILE__, 'trs_custom_text_activation');
function trs_custom_text_deactivation() {
}
register_deactivation_hook(__FILE__, 'trs_custom_text_deactivation');

// create custom plugin settings menu
add_action('admin_menu', 'trs_custom_text_create_menu');

function trs_custom_text_create_menu() {

	//create new top-level menu
	add_menu_page('Custom Text Shortcode Plugin Settings', 'Custom Text Shortcode', 'administrator', __FILE__, 'trs_custom_text_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_trs_custom_text_settings' );
}

//Register Setting
function register_trs_custom_text_settings() {
	//register our settings
	register_setting( 'trs-custom-text-settings-group', 'trs_custom_text' );
}

function trs_custom_text_settings_page() {
?>
<div class="wrap">
<h2>Shortcode to display your text </h2>
[trs_custom_text_shortcode]
<p>you can used this shortcode in theme files as follow</p>
<?php echo htmlspecialchars("<?php echo do_shortcode('[trs_custom_text_shortcode]') ?>");?>
<h1>Your Custom Text</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'trs-custom-text-settings-group' ); ?>
    <?php do_settings_sections( 'trs-custom-text-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Custom Text</th>
        <td><?php wp_editor( get_option( 'trs_custom_text' ), 'trs_custom_text' ); ?> </td>
        </tr>
    </table>
    <?php submit_button(); ?>

</form>

</div>
<?php } 
add_shortcode("trs_custom_text_shortcode", "trs_custom_text_shortcode_function");

function trs_custom_text_shortcode_function() {
return get_option( 'trs_custom_text' );
}