<?php
/*
Plugin Name: LOLPress
Plugin URI: http://9seeds.com/plugins/
Description: Submit any of your post images to to the Cheezeburger network
Author: 9Seeds.com
Version: 1.0.1
Author URI: http://9seeds.com/
*/

add_action('init', array("chz","js"), 1);
add_action('wp_head', array("chz","path"));

class chz
{
	function js() 
	{
		if(($_REQUEST['chzredirect'] == 'create' || $_REQUEST['chzredirect'] == 'view') && strlen ($_REQUEST["chzurl"]))
		{
			$blogname = get_option('blogname');
			$blogurl = get_option('home');
			if($_REQUEST['chzredirect'] == 'create')
			{	
				$url = 'http://cheezburger.com/CaptionPic.aspx?url='.urlencode($_REQUEST["chzurl"]).'&source='.urlencode($blogname).'&sourceUrl='.urlencode($blogurl).'';
				
				$notify_message = "Someone has submitted this image ".$_REQUEST["chzurl"]." to the Cheezburger Network for captioning \r\n";
				$notify_message .= "You can click this link ".$blogurl.'?chzredirect=view&chzurl='.urlencode($_REQUEST["chzurl"])." to see the captions for this image\r\n";
				$subject = '['.$blogname.'] Image submitted to the Cheezburger Network';
				$wp_email = 'wordpress@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
				$reply_to = $from = "From: \"$blogname\" <$wp_email>";
				$message_headers = "$from\n"
					. "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
				$message_headers .= $reply_to . "\n";
				@wp_mail(get_option('admin_email'), $subject, $notify_message, $message_headers);
				
			}	
			if($_REQUEST['chzredirect'] == 'view')
			{
				$url = "http://cheezburger.com/TemplateView.aspx?url=".urlencode($_REQUEST["chzurl"]);
			}
			
			header("Location: ".$url);
			exit;
		}

		$pluginurl = WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__));
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery.qtip-1.0.0-rc3.js',$pluginurl.'/jquery.qtip-1.0.0-rc3.js');
		wp_enqueue_script('chz.js',$pluginurl.'/chz.js');
	}
	function path()
	{
		$pluginurl = WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__));
		echo '<script>var chzlogourl="'.$pluginurl.'/chz.jpg";</script>';
		echo '<style>
				a.chz{	
					text-decoration: underline;
					color: blue;
				}
			</style>';
	}
}
?>
