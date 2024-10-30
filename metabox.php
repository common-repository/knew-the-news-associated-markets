<?php
 
function knewthenews_associatemarkets_admin_init()
{
	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 
	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/add_meta_box
 
	// add a meta box for each of the wordpress page types: posts and pages
	foreach (array('post','page') as $type) 
	{
		add_meta_box(
			'knewthenews_associatemarkets_all_meta', 
			'Knew The News: Associate Markets', 
			'knewthenews_associatemarkets_meta_setup', 
			$type, 
			'normal', 
			'high'
		);
	}
 
	// add a callback function to save any data a user enters in
	add_action('save_post','knewthenews_associatemarkets_meta_save');
	
	add_action('publish_post','knewthenews_associatemarkets_publish_post');

}


function knewthenews_associatemarkets_the_content($content) 
{
	global $post;
	
	$meta = get_post_meta($post->ID, '_knewthenews_associatemarkets', TRUE);	
	
	if (!is_array($meta))
		$meta = array("id" => array(), "label" => array(), "style" => array());
	
	$postcontent = "";
	$haslinks = false;
	
	for ($i = 0; $i < count($meta["id"]); $i++) {
		
		$id = $meta["id"][$i];
		$label = $meta["label"][$i];
		$style = $meta["style"][$i];
		
		$associated = "";
		$needle = "[KnewTheNewsMarket-" . ($i+1) . "]";
	
		if (!is_single())
		{
			$associated .= '<h5><a href="http://www.knewthenews.com/Market/' . $id . '/">' . htmlentities($label) . '</a></h5>';
			if (strpos($content, $needle)) 
			{
				$content = str_replace($needle, '<div class="knewthenews_associatedmarket_inline">' . $associated . '</div>', $content);
				$haslinks = true;
			}
			
		}
		else
		{
			switch($style) 
			{
				case "graph":
					$associated .= '<h5 class="none"><a href="http://www.knewthenews.com/Market/' . $id . '/">' . htmlentities($label) . '</a></h5>';
					$associated .= '<script src="http://knewthenews.com/Widget/' . $id . 'graph.js" type="text/javascript"></script>';
					break;
				case "table":
					$associated .= '<h5 class="none"><a href="http://www.knewthenews.com/Market/' . $id . '/">' . htmlentities($label) . '</a></h5>';
					$associated .= '<script src="http://knewthenews.com/Widget/' . $id . 'text.js" type="text/javascript"></script>';
					break;
				default:
					$associated .= '<h5><a href="http://www.knewthenews.com/Market/' . $id . '/">' . htmlentities($label) . '</a></h5>';
			}
			if (strpos($content, $needle)) 
			{
				$content = str_replace($needle, '<div class="knewthenews_associatedmarket_inline">' . $associated . '</div>', $content);
				$haslinks = true;
			}
			else 
			{
				$postcontent .= '<div class="knewthenews_associatedmarket">' . $associated . '</div>';
				$haslinks = true;
			}
		}
	}
	
	if (!empty($postcontent)) {
		$content .= '<div class="knewthenews_associatedmarkets>"><h3>Associated markets on <a href="http://www.knewthenews.com/">Knew The News</a>:</h3>' . $postcontent . '</div>';
	}
	
	if ($haslinks)
	{
		$content .= '
	<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(document).ready(function(){$j(".none").hide();});
	</script>
		';
	}
	

	return $content;
	
}

function knewthenews_associatemarkets_meta_setup($post, $box)
{
	
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_knewthenews_associatemarkets',TRUE);
 
	// instead of writing HTML here, lets do an include
	include(MY_THEME_FOLDER . '/metabox/meta.php');
 
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="_knewthenews_associatemarkets_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
function knewthenews_associatemarkets_meta_save($post_id) 
{

	// authentication checks
 
	// make sure data came from our meta box
	if (!wp_verify_nonce($_POST['_knewthenews_associatemarkets_noncename'],__FILE__)) 
		return $post_id;
 
	// check user permissions
	if ($_POST['post_type'] == 'page')  {
		if (!current_user_can('edit_page', $post_id)) 
			return $post_id;
	} else  {
		if (!current_user_can('edit_post', $post_id)) 
			return $post_id;
	}
 
	// authentication passed, save data
 
	// var types
	// single: _my_meta[var]
	// array: _my_meta[var][]
	// grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]
 
	$current_data = get_post_meta($post_id, '_knewthenews_associatemarkets', true);	
 
	$new_data = $_POST['_knewthenews_associatemarkets'];
 
	knewthenews_associatemarkets_meta_clean($new_data);
 
	if ($current_data) 
	{
		if (is_null($new_data)) 
			delete_post_meta($post_id, '_knewthenews_associatemarkets');
		else 
			update_post_meta($post_id, '_knewthenews_associatemarkets', $new_data);
	}
	elseif (!is_null($new_data))
	{
		add_post_meta($post_id, '_knewthenews_associatemarkets', $new_data, true);
	}

	return $post_id;
}

function knewthenews_associatemarkets_publish_post($post_id) 
{

	$post = get_post($post_id);

	// if username and password are provided
	$username = get_the_author_meta('knewthenews_username', $post->post_author);
	$password = get_the_author_meta('knewthenews_password', $post->post_author);

	if ($username && $password)
	{
		
		require_once("serviceclient.php");
		
		$client = new serviceclient();
		if ($client->authenticate($username, $password))
		{
		
			$meta = get_post_meta($post_id, '_knewthenews_associatemarkets', true);	
		 
		 	$data = array();
			$data["post_url"] = $post->guid;
			$data["post_title"] = $post->post_title;
			$data["blog_name"] = get_bloginfo("name");
			$data["blog_url"] = home_url();
			$data["associated"] = $meta;
			
			@$client->post("predictionmarkets.assignblog", $data);
			
		}

	}
	
}

 
function knewthenews_associatemarkets_meta_clean(&$arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $i => $v)
		{
			if (is_array($arr[$i])) 
			{
				knewthenews_associatemarkets_meta_clean($arr[$i]);
 
				if (!count($arr[$i])) 
				{
					unset($arr[$i]);
				}
			}
			else 
			{
				if (trim($arr[$i]) == '') 
				{
					unset($arr[$i]);
				}
			}
		}
 
		if (!count($arr)) 
		{
			$arr = NULL;
		}
	}
}
 
?>