<?php
/*
Plugin Name: Knew The News - Associate Markets
Version: 1.2
Plugin URI: http://wordpress.org/extend/plugins/knew-the-news-associated-markets/
Description: Easily associate and integrate markets from the news prediction site Knew The News in your blog posts.
License: GPLv2
*/

require_once("metabox.php");

define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
define('MY_THEME_FOLDER',str_replace("\\",'/',dirname(__FILE__)));
define('MY_THEME_PATH','/' . substr(MY_THEME_FOLDER,stripos(MY_THEME_FOLDER,'wp-content')));
 
wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'jquery-ui-core' );
wp_enqueue_script( 'jquery-ui-dialog' );
wp_enqueue_script( 'jquery-validate', MY_THEME_PATH . "/validation.js", array('jquery'));

wp_enqueue_style('knewthenews_associatemarkets_css', MY_THEME_PATH . '/metabox/meta.css');

load_plugin_textdomain('knewthenews', false, basename( dirname( __FILE__ ) ) . '/languages' );

add_filter('the_content', 'knewthenews_associatemarkets_the_content');

add_action('admin_init','knewthenews_associatemarkets_admin_init');

add_action('show_user_profile', 'knewthenews_profile_show');
add_action('edit_user_profile', 'knewthenews_profile_show');

add_action('personal_options_update', 'knewthenews_profile_save');
add_action('edit_user_profile_update', 'knewthenews_profile_save');

 

function knewthenews_profile_save($user_id) 
{
	 if ( !current_user_can( 'edit_user', $user_id ) )
	  return false;
	
	 update_usermeta( $user_id, 'knewthenews_username', $_POST['knewthenews_username'] );
	 update_usermeta( $user_id, 'knewthenews_password', $_POST['knewthenews_password'] );
}

function knewthenews_profile_show($user) 
{
?>
	<h3><a name="knewthenews"></a>Knew The News - user information</h3>
	<table class="form-table">
		<tr>
			<th><label for="login">Username</label></th>
			<td>
				<input type="text" name="knewthenews_username" id="knewthenews_username" 
				value="<?php print esc_attr( get_the_author_meta( 'knewthenews_username', $user->ID ) ); ?>" class="regular-text" /><br />
				<!--<span class="description">Enter your Knew The News username.</span>-->
			</td>
		</tr>
		<tr>
			<th><label for="login">Password</label></th>
			<td>
				<input type="password" name="knewthenews_password" id="knewthenews_password" 
				value="<?php print esc_attr( get_the_author_meta( 'knewthenews_password', $user->ID ) ); ?>" class="regular-text" /><br />
				<!--<span class="description">Enter your Knew The News password.</span>-->
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input type="button" onclick="return checkCredentials();" Value="Test" /> 
				<img src="<?php print get_bloginfo('wpurl') ?>/wp-admin/images/wpspin_light.gif" 
					id="credentialscheck_busy" style="display:none;top:3px;position:relative;visibility:visible;" class="ajax-loading" />
				<span id="credentialscheck_ok" style="display:none">Credentials successfully tested!</span>
				<span id="credentialscheck_failed" style="display:none">Credentials check failed.</span>
			</td>
		</tr>
	</table>
	<script type="text/javascript">
	var $j = jQuery.noConflict();
	var xhr = null;
	function checkCredentials() {
		$j('#credentialscheck_failed').hide();
		$j('#credentialscheck_ok').hide();
		$j('#credentialscheck_busy').show();
		if (xhr)
			xhr.abort();
		xhr = $j.ajax({
			url: "<?php print get_bloginfo('wpurl') ?>/wp-content/plugins/knew-the-news-associated-markets/proxy.php?t=" + Math.random() + "&url=" + encodeURIComponent("auth.gettoken?username=" + $j('#knewthenews_username').val() + "&password=" + $j('#knewthenews_password').val()),
			dataType: "xml",
			success: function(xml) {
				$j('#credentialscheck_busy').hide();
				if($j('response', xml).attr("success") == "true") {
					$j('#credentialscheck_failed').hide();
					$j('#credentialscheck_ok').show();
				} else {
					$j('#credentialscheck_failed').show();
					$j('#credentialscheck_ok').hide();
				}
			}
		});
	}
	</script>
<?php
}

?>