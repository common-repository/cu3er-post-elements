<?php
/*
Plugin Name: Cu3er Post Elements
Plugin URI: http://18elements.com/tools/cu3er-post-elements
Description: Creates a cu3er flash gallery of your recent posts for your Front Page or Header
Author: Daniel Sachs
Author URI: http://18elements.com/
Version: 0.5.1
*/
/*  
Copyright 2009 18elements.com  (email: hello@18elements.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
register_activation_hook( __FILE__, 'cu3er_elements_activate' );
register_deactivation_hook( __FILE__, 'cu3er_elements_deactivate' );

add_action('switch_theme', 'cu3er_elements_activate');

add_action('wp_print_scripts','swfobject_js');
function swfobject_js(){	
  if(!is_admin()){
	wp_enqueue_script ('cu3er_swfobject', '/' . PLUGINDIR . '/cu3er-post-elements/js/swfobject/swfobject.js');
  }
}
if (!defined('WP_CONTENT_DIR')) {
	define( 'WP_CONTENT_DIR', ABSPATH.'wp-content');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
}
if (!defined('WP_PLUGIN_DIR')) {
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');
}
if (!defined('WP_PLUGIN_URL')) {
	define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
}
if (!defined('CU3ER_EL_VER')) {
	define('CU3ER_EL_VER', '0.5.1');
}

add_action('admin_print_scripts', 'cu3er_admin_scripts'); 
function cu3er_admin_scripts(){
	wp_enqueue_script ('jquery');
	wp_enqueue_script ('color_picker', '/' . PLUGINDIR . '/cu3er-post-elements/picker/colorpicker.js', array('jquery'));
}

function install_cu3er(){ 
  $cu3erWidth = get_option('cu3er_width');
  $cu3erHeight = get_option('cu3er_height');
  ?>
<script type="text/javascript">
		var flashvars = {};
		flashvars.xml = "<?php echo WP_PLUGIN_URL.'/cu3er-post-elements/config.php';?>";
		flashvars.font = "<?php echo WP_PLUGIN_URL.'/cu3er-post-elements/font.swf';?>";
		var attributes = {};
		attributes.wmode = "transparent";
		attributes.id = "slider";
		swfobject.embedSWF("<?php echo WP_PLUGIN_URL.'/cu3er-post-elements/cu3er.swf';?>", "cu3er-container", "<?php echo $cu3erWidth; ?>", "<?php echo $cu3erHeight; ?>", "9", "<?php echo WP_PLUGIN_URL.'/cu3er-post-elements/js/swfobject/expressInstall.swf';?>", flashvars, attributes);
</script>
<style type="text/css">
<!--
#cu3er-container {width:<?php echo $cu3erWidth; ?>px; outline:0;}
-->
</style>
<!-- Using Cu3er Post Elements ver. <?php echo CU3ER_EL_VER; ?>-->
<div id="cu3er-container">
    <a href="http://www.adobe.com/go/getflashplayer">
        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
    </a>
</div>

<?php 
} 
function cu3er_elements_activate()
{
  cu3er_elements_set_default_options();
}
function cu3er_elements_deactivate()
{
  	    delete_option('cu3er_portfolio_id');
	    delete_option('cu3er_numof_posts');
	    delete_option('cu3er_main_color');
	    delete_option('cu3er_secondary_color');
	    delete_option('cu3er_height');
	    delete_option('cu3er_width');
	    delete_option('cu3er_arrow_type');
	    delete_option('cu3er_autoplay_time');
	    delete_option('cu3er_autoplay_left');
	    delete_option('cu3er_autoplay_top' );
		delete_option('cu3er_excerpt_height');
		delete_option('cu3er_excerpt_left');
		delete_option('cu3er_excerpt_top');
		delete_option('cu3er_excerpt_time');
}

function cu3er_elements_set_default_options() {
	if ( !get_option( 'cu3er_portfolio_id' ) ) {
	    update_option( 'cu3er_portfolio_id', '1,3');
	    update_option( 'cu3er_numof_posts', '5' );
	    update_option( 'cu3er_main_color', 'FFFFFF' );
	    update_option( 'cu3er_secondary_color', '000000' );
	    update_option( 'cu3er_height', '300');
	    update_option( 'cu3er_width', '600' );
	    update_option( 'cu3er_arrow_type', '3' );
	    update_option( 'cu3er_autoplay_time', '10' );
	    update_option( 'cu3er_autoplay_left', '550' );
	    update_option( 'cu3er_autoplay_top', '50' );
		update_option( 'cu3er_excerpt_width', '600' );
		update_option( 'cu3er_excerpt_height', '100' );
		update_option( 'cu3er_excerpt_left', '0' );
		update_option( 'cu3er_excerpt_top', '200' );
		update_option( 'cu3er_excerpt_time', '3.5' );
	}
}

add_action('admin_menu','cu3er_elements_add_pages');	
function cu3er_elements_add_pages() {
	add_options_page('Cu3er Elements', 'Cu3er Elements', 8, 'cu3er_elements_page', 'cu3er_elements_options_page');
}

function cu3er_elements_options_page() {
?>	
<style type="text/css"> 
.mytable {
	width: 700px;
	padding: 0;
	margin: 0;
	border-top:1px solid #C1DAD7;
}
caption {
	padding: 0 0 5px 0;
	width: 700px;	 
	font: italic 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	text-align: right;
}
th {
	font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	color: #4f6b72;
	border-right: 1px solid #C1DAD7;
	border-bottom: 1px solid #C1DAD7;
	border-top: 1px solid #C1DAD7;
	letter-spacing: 2px;
	text-transform: uppercase;
	text-align: left;
	padding: 6px 6px 6px 12px;
	background: #CAE8EA url(images/bg_header.jpg) no-repeat;
}
th h3, th h3 .alert {
	font: normal 18px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
}
th h3.alert { color: #CC0000; }
th.nobg, th.right {
	border-top: 0;
	border-left: 0;
	border-right: 0px;
	text-transform: none;
	padding: 10px 0;
	letter-spacing: 0px;
	background: none;
}
th.right {
	text-align: right;
}
td {
	border-right: 1px solid #C1DAD7;
	border-bottom: 1px solid #C1DAD7;
	background: #fff;
	padding: 6px 6px 6px 12px;
	color: #4f6b72;
}
td.alert {
	border: 2px dashed #CC0000;
	background: #fffcfc;
	padding: 6px 6px 6px 12px;
	color: #000000;
}

td.alt {
	background: #F5FAFA;
	color: #797268;
}
th.spec {
	border-left: 1px solid #C1DAD7;
	border-top: 0;
	background: #fff;
	font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
}
th.specalt {
	border-left: 1px solid #C1DAD7;
	border-top: 0;
	background: #f5fafa;
	font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	color: #797268;
}
.note {
	font: bold 14px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	/*color: #CC0000;*/
	color:#9C3;
	padding:6px 0px 6px 10px;
	background:#CF9;
	width:690px;
	border-top: 1px solid #C1DAD7;
}
#arrowType {
	display:none;
	position:absolute;
	border:5px solid #C1DAD7;
}
#showArrows {
	cursor:pointer;
}
</style>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo bloginfo( 'url' ) . '/wp-content/plugins/cu3er-post-elements/picker/colorpicker.css'; ?>" />
<?php if ( current_user_can( 'manage_options' ) ) { ?>
		<div class="wrap" >  <?php
			if ( $_POST['cu3er_save'] ) {
				update_option('cu3er_main_color', $_POST['cu3er_main_color']);
				update_option('cu3er_secondary_color', $_POST['cu3er_secondary_color']);
				update_option('cu3er_numof_posts', $_POST['cu3er_numof_posts']);
				update_option('cu3er_portfolio_id', $_POST['cu3er_portfolio_id']);
				update_option('cu3er_height', $_POST['cu3er_height']);
				update_option('cu3er_width', $_POST['cu3er_width']);
				update_option('cu3er_arrow_type', $_POST['cu3er_arrow_type']);
				update_option('cu3er_autoplay_time', $_POST['cu3er_autoplay_time']);
				update_option('cu3er_autoplay_left', $_POST['cu3er_autoplay_left']);
				update_option('cu3er_autoplay_top', $_POST['cu3er_autoplay_top']);
				update_option('cu3er_excerpt_width', $_POST['cu3er_excerpt_width']);
				update_option('cu3er_excerpt_height', $_POST['cu3er_excerpt_height']);
				update_option('cu3er_excerpt_left', $_POST['cu3er_excerpt_left']);
				update_option('cu3er_excerpt_top', $_POST['cu3er_excerpt_top']);
				update_option('cu3er_excerpt_time', $_POST['cu3er_excerpt_time']);

		} ?>
	<h2>Cu3er Post Elements Options</h2>
	 <script type="text/javascript">
      var $jq = jQuery.noConflict();
		$jq(document).ready(function() {

		  $jq(".note").fadeIn("slow").animate({opacity: 1.0}, 3000).fadeOut("slow", function() {
			$jq(this).remove();
		  });

		  $jq("#showArrows").hover( function () { $jq('#arrowType').fadeIn(); }, function () { $jq('#arrowType').fadeOut("slow"); } );
		  $jq('#cu3er_main_color, #cu3er_secondary_color').ColorPicker({
			  onShow: function (colpkr) { 
			       $jq(colpkr).fadeIn(500); 
				   return false; 
			  }, 
			  onHide: function (colpkr) {
				  $jq(colpkr).fadeOut(500); 
				  return false; 
			  },
			  onSubmit: function(hsb, hex, rgb, el) {
				  $jq(el).val(hex);
				  $jq(el).ColorPickerHide();
			  },
			  onBeforeShow: function () {
				  $jq(this).ColorPickerSetColor(this.value);
			  }
		  })
		  .bind('keyup', function(){
			  $jq(this).ColorPickerSetColor(this.value);
		  });
		});
      </script>
      <?php
		if (isset($_POST['cu3er_save'])) {
		echo ('<div class="note">Cu3er Elements Options updated!</div>');
		}
		if (isset($_POST['cu3er_reset'])) {
		cu3er_elements_set_default_options();	
		echo ('<div class="note">Cu3er Elements Options has been reset!</div>');
		}
	  ?>
    <form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post" name="massive_form" id="massive_form">
    <table class="mytable" cellspacing="0" summary="Cu3er Post Elements options">
      <tr>
      	<th colspan="3" scope="row" abbr="Basic settings" class="nobg">
        <h3>Basic Setings</h3>
        </th>
      </tr>
      <tr>
        <th scope="row" abbr="Category ID" class="specalt">Category IDs</th>
        <td class="alt">
       <input name="cu3er_portfolio_id" id="cu3er_portfolio_id" value="<?php echo get_option('cu3er_portfolio_id'); ?>" size="5" ></input></td>
        <td class="alt">numeric, comma separated</td>
      </tr>
      <tr>
        <th scope="row" abbr="Number of Posts" class="spec">Number of Posts</th>
        <td><input name="cu3er_numof_posts" id="cu3er_numof_posts" value="<?php echo get_option('cu3er_numof_posts'); ?>" size="5" ></input></td>
        <td>numeric</td>
      </tr>
      <tr>
        <th scope="row" abbr="Cu3er Elements width" class="specalt">Cu3er width</th>
        <td class="alt"><input name="cu3er_width" id="cu3er_width" value="<?php echo get_option('cu3er_width'); ?>" size="5" ></input></td>
        <td class="alt">px</td>
      </tr>
      <tr>
        <th scope="row" abbr="Cu3er Elements height" class="spec">Cu3er height</th>
        <td><input name="cu3er_height" id="cu3er_height" value="<?php echo get_option('cu3er_height'); ?>" size="5" ></input></td>
        <td>px</td>
      </tr>
      <tr>
        <th scope="row" abbr="Cu3er Main Color" class="specalt">Cu3er Main Color</th>
        <td class="alt"><input name="cu3er_main_color" id="cu3er_main_color" value="<?php echo get_option('cu3er_main_color'); ?>" size="5" ></input></td>
        <td class="alt">HEX, text, arrows and timer color</td>
      </tr>
      <tr>
        <th scope="row" abbr="Cu3er Secondary Color" class="spec">Cu3er Secondary Color</th>
        <td><input name="cu3er_secondary_color" id="cu3er_secondary_color" value="<?php echo get_option('cu3er_secondary_color'); ?>" size="5" ></input></td>
        <td>HEX, Background colors</td>
      </tr>
      <tr>
        <th scope="row" abbr="Cu3er Arrow Type" class="specalt">Cu3er Arrow Type</th>
        <td class="alt"><input name="cu3er_arrow_type" id="cu3er_arrow_type" value="<?php echo get_option('cu3er_arrow_type'); ?>" size="5" ></input></td>
        <td class="alt">numeric (<span id="showArrows">View Available</span>)<div id="arrowType"><img src="<?php echo WP_PLUGIN_URL.'/cu3er-post-elements/images/arrows.gif';?>" /></div></td>
      </tr>

      <tr>
      	<th colspan="3" scope="row" abbr="Timer settings" class="nobg">
        <h3>Timer Settings</h3>
        </th>
      </tr>
      <tr>
        <th scope="row" abbr="timer time" class="specalt">Slide Queue Time</th>
        <td class="alt"><input name="cu3er_autoplay_time" id="cu3er_autoplay_time" value="<?php echo get_option('cu3er_autoplay_time'); ?>" size="5" ></input></td>
        <td class="alt">seconds</td>
      </tr>
      <tr>
        <th scope="row" abbr="timer left" class="spec">Timer Left Padding</th>
        <td><input name="cu3er_autoplay_left" id="cu3er_autoplay_left" value="<?php echo get_option('cu3er_autoplay_left'); ?>" size="5" ></input></td>
        <td>px</td>
      </tr>
      <tr>
        <th scope="row" abbr="timer top" class="specalt">Timer Top Padding</th>
        <td class="alt"><input name="cu3er_autoplay_top" id="cu3er_autoplay_top" value="<?php echo get_option('cu3er_autoplay_top'); ?>" size="5" ></input></td>
        <td class="alt">px</td>
      </tr>
      <tr>
      	<th colspan="3" scope="row" abbr="Title settings" class="nobg">
        <h3>Title and Excerpt Settings</h3>
        </th>
      </tr>
      <tr>
        <th scope="row" abbr="Excerpt Time" class="specalt">Excerpt Area Queue Time</th>
        <td class="alt"><input name="cu3er_excerpt_time" id="cu3er_excerpt_time" value="<?php echo get_option('cu3er_excerpt_time'); ?>" size="5" ></input></td>
        <td class="alt">seconds</td>
      </tr>
      <tr>
        <th scope="row" abbr="Excerpt Width" class="spec">Excerpt Area Width</th>
        <td><input name="cu3er_excerpt_width" id="cu3er_excerpt_width" value="<?php echo get_option('cu3er_excerpt_width'); ?>" size="5" ></input></td>
        <td>px</td>
      </tr>
      <tr>
        <th scope="row" abbr="Excerpt Height" class="specalt">Excerpt Area Height</th>
        <td class="alt"><input name="cu3er_excerpt_height" id="cu3er_excerpt_height" value="<?php echo get_option('cu3er_excerpt_height'); ?>" size="5" ></input></td>
        <td class="alt">px</td>
      </tr>
      <tr>
        <th scope="row" abbr="Excerpt Left" class="spec">Excerpt Area Left Padding</th>
        <td><input name="cu3er_excerpt_left" id="cu3er_excerpt_left" value="<?php echo get_option('cu3er_excerpt_left'); ?>" size="5" ></input></td>
        <td>px</td>
      </tr>
      <tr>
        <th scope="row" abbr="Excerpt Top" class="specalt">Excerpt Area Top Padding</th>
        <td class="alt"><input name="cu3er_excerpt_top" id="cu3er_excerpt_top" value="<?php echo get_option('cu3er_excerpt_top'); ?>" size="5" ></input></td>
        <td class="alt">px</td>
      </tr>

      <tr>
        <th colspan="3" scope="row" class="right"><input type="submit" name="cu3er_save" value="Save Options" /><input type="submit" name="cu3er_reset" value="Reset Options" /></th>
      </tr>
     </table>
    </form>
    <div style="float:left; font-size:9px; color:#666;">Plugin by <a href="http://18elements.com/tools/cu3er-post-elements">18elements</a>   |   Cu3er by Stefan Kovac @ <a href="http://www.progressivered.com/cu3er/docs/">ProgressiveRed</a>   |   If you liked this plugin, please consider a donation to <a href="http://www.unicef.org/support/index.html">UNICEF</a></div>  
</div><img style="margin:2px 4px;" src="http://mw1.google.com/mw-earth-vectordb/outreach/root2/icons/unicef.png" />
<?php
}
}
?>