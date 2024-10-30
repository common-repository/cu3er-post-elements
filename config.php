<?php
header("Content-type: text/xml");
require_once( '../../../wp-config.php' );
require_once( dirname(__FILE__) . '/cu3er-post-elements.php' );
$slice_value = array("horizontal","vertical"); $rand_slice_keys = array_rand($slice_value, 2);
$direction_value = array("left","right","up","down"); $rand_direction_keys = array_rand($direction_value, 4);
//posts
//$cu3erOptions = Cu3erElements::cu3er_elements_set_default_options(false);
$num_posts = get_option('cu3er_numof_posts');
$portfolio_id = get_option('cu3er_portfolio_id');
$main_color = get_option('cu3er_main_color');
$secondary_color = get_option('cu3er_secondary_color');
$arrow_type = get_option('cu3er_arrow_type');
//timer
$autoplay_time = get_option('cu3er_autoplay_time');
$autoplay_left = get_option('cu3er_autoplay_left');
$autoplay_top = get_option('cu3er_autoplay_top');
//excerpt
$excerpt_width = get_option('cu3er_excerpt_width');
$excerpt_height = get_option('cu3er_excerpt_height');
$excerpt_top = get_option('cu3er_excerpt_top');
$excerpt_left = get_option('cu3er_excerpt_left');
$excerpt_time = get_option('cu3er_excerpt_time');
$xml .= '<?xml version="1.0" encoding="utf-8" ?>';
$xml .= '<cu3er>';
  $xml .= '<settings>';
	$xml .= '<auto_play>';
	  $xml .= '<defaults symbol="circular" time="' . $autoplay_time . '" />';
	  $xml .= '<tweenIn x="' . $autoplay_left . '" y="' . $autoplay_top . '" width="35" height="35" tint="0x' . $main_color . '" />';
	$xml .= '</auto_play>';
	
	$xml .= '<prev_button>';
	  $xml .= '<defaults round_corners="5,5,5,5"/>';
	  $xml .= '<tweenOver tint="0x' . $main_color . '" scaleX="1.1" scaleY="1.1"/>';
	  $xml .= '<tweenOut tint="0x' . $secondary_color . '" />';
	$xml .= '</prev_button>';
	
	$xml .= '<prev_symbol>';
	  $xml .= '<defaults type="' . $arrow_type . '" />';
	  $xml .= '<tweenIn tint="0x' . $main_color . '" />';
	  $xml .= '<tweenOver tint="0x' . $secondary_color . '" />';		
	$xml .= '</prev_symbol>';

    $xml .= '<next_button>';
		$xml .= '<defaults round_corners="5,5,5,5"/>';			
		$xml .= '<tweenOver tint="0x' . $main_color . '"  scaleX="1.1" scaleY="1.1"/>';
		$xml .= '<tweenOut tint="0x' . $secondary_color . '" />';
	$xml .= '</next_button>';
	
	$xml .= '<next_symbol>';
	    $xml .= '<defaults type="' . $arrow_type . '" />';
	    $xml .= '<tweenIn tint="0x' . $main_color . '" />';
		$xml .= '<tweenOver tint="0x' . $secondary_color . '" />';
	$xml .= '</next_symbol>';
	
	$xml .= '<description>';
		$xml .= '<defaults 
				round_corners="5, 5, 5, 5" 
				heading_font="Trebuchet MS, Arial, Helvetica, sans-serif"
				heading_text_size="22"
				heading_text_color="0x' . $main_color . '"			
				heading_text_margin="10, 0, 0,10"	
				paragraph_font="Trebuchet MS, Arial, Helvetica, sans-serif"
				paragraph_text_size="13"
				paragraph_text_color="0x' . $main_color . '"
				paragraph_text_margin="10, 0, 0, 10"		
			/>';
		$xml .= '<tweenIn tint="0x' . $secondary_color . '"  x="' . $excerpt_left . '" y="' . $excerpt_top . '" alpha="0.5" width="' . $excerpt_width . '" height="' . $excerpt_height . '" />';
		$xml .= '<tweenOut time="' . $excerpt_time . '" x="' . $excerpt_left . '" />';
		$xml .= '<tweenOver tint="0x' . $secondary_color . '" alpha="0.8" />';
	$xml .= '</description>';
  $xml .= '</settings>';
  $xml .= '<slides>';
	query_posts( 'cat=' . $portfolio_id . '&posts_per_page=' . $num_posts . '' );
	if( have_posts() ) : while( have_posts() ) : the_post(); 
	preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post->post_content, $m );
	$xml .= '<slide>';
		if( $m[ 1 ] ) $xml .= '<url>' . $m[ 1 ][ 0 ] . '</url>';
		$xml .= '<description>';
		    $xml .= '<link target="_self">' . $post->guid . '</link>';
			$xml .= '<heading>' . $post->post_title . '</heading>';
			$xml .= '<paragraph>' . $post->post_excerpt . '</paragraph>';
		$xml .= '</description>';
	$xml .= '</slide>';
	$xml .= '<transition num="' . rand(2, 5) . '" slicing="' . $slice_value[$rand_slice_keys[rand(0, 1)]] . '" direction="' . $direction_value[$rand_direction_keys[rand(0, 3)]] . '" shader="phong" delay="0.05" z_multiplier="4" />';
endwhile; endif;
  $xml .= '</slides>';
$xml .= '</cu3er>';
echo $xml;
?>