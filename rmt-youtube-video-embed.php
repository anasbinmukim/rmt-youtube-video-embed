<?php
/*
Plugin Name: Youtube video API Embed
Plugin URI: https://rmweblab.com/
Description: Pause audio when video playing.
Author: Anas
Version: 1.0.0
Author URI: https://rmweblab.com/
Copyright: © 2018 RM Web Lab
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: familylife-today
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function rmt_youtube_vido_embed_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
				'id' => 'M7lc1UVf-VE',
				'width' => '640',
				'height' => '360'
		), $atts));

		ob_start();
		?>
		<iframe id="rmt-youtube-video-embed"
		        width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>"
		        src="https://www.youtube.com/embed/<?php echo esc_attr($id); ?>?enablejsapi=1"
		        frameborder="0"
		        style="border: solid 4px #37474F"
		></iframe>

		<script type="text/javascript">
		  var tag = document.createElement('script');
		  tag.id = 'iframe-demo';
		  tag.src = 'https://www.youtube.com/iframe_api';
		  var firstScriptTag = document.getElementsByTagName('script')[0];
		  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		  var player;
		  function onYouTubeIframeAPIReady() {
		    player = new YT.Player('rmt-youtube-video-embed', {
		        events: {
		          'onReady': onPlayerReady,
		          'onStateChange': onPlayerStateChange
		        }
		    });
		  }
		  function onPlayerReady(event) {
		    document.getElementById('rmt-youtube-video-embed').style.borderColor = '#FF6D00';
		  }
		  function changeBorderColor(playerStatus) {
		    var color;
		    if (playerStatus == -1) {
		      color = "#37474F"; // unstarted = gray
		    } else if (playerStatus == 0) {
		      color = "#FFFF00"; // ended = yellow
		    } else if (playerStatus == 1) {
		      color = "#33691E"; // playing = green
		    } else if (playerStatus == 2) {
		      color = "#DD2C00"; // paused = red
		    } else if (playerStatus == 3) {
		      color = "#AA00FF"; // buffering = purple
		    } else if (playerStatus == 5) {
		      color = "#FF6DOO"; // video cued = orange
		    }
		    if (color) {
		      document.getElementById('rmt-youtube-video-embed').style.borderColor = color;
		    }
		  }
		  function onPlayerStateChange(event) {
		    changeBorderColor(event.data);
		  }
		</script>
		<?php

		$retembed = ob_get_contents();
		ob_end_clean();
		return $retembed;

}
add_shortcode('rmt_youtube_vido_embed', 'rmt_youtube_vido_embed_shortcode');
