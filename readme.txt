=== Cu3er Post Elements ===

Contributors: Daniel Sachs
Tags: featured posts, gallery, image gallery, feafured gallery, cu3er, flash
Requires at least: 2.7
Tested up to: 2.9
Stable tag: 0.5.1

Displays your portfolio or posts via the incredible Cu3er flash component

== Description ==

**Cu3er Post Elements plugin displays any set number of your recent posts from a selected category via flash gallery slider/rotator for your Front Page or Header. 

Cu3er Post Elements is an integration of an incredible Cu3er flash component.**

The Cu3er is customizable via the plugin's control panel and uses random effects and transitions for each slide

The plugin is used on http://18elements.com homepage

== Installation ==

1. Upload `cu3er-posts-elements` directory to the `/wp-content/plugins/` directory.
2. Insert `<?php if ( function_exists('install_cu3er') )  { install_cu3er(); } ?>` into your template file.
3. Activate the plugin via the Plugins menu.
4. Configure options via the Settings > Cu3er Settings menu.

**Please note: if your theme doesn't use wp_head()  function the cu3er will not be displayed. Always use wp_head() as a part of your theme.

== Frequently Asked Questions  ==

**How to install custom fonts?**

*   go to your library, right-click and choose "New Font ..."
*   under the "Name" field type the name of the font "myFont"
*   select font & style from the respective drop down menus
*   Click "advanced > linkage" and check "Export for Actionscript" and "Export in first frame"
*   Click OK
*   Open 'ActionScript panel' and register font by typing following AS code:
      `Font.registerFont(myFont);`
*   Publish this swf for Flash Player 9 with Actionscript 3, as `font.fla`
*   Copy published font .swf into the plugin's directory on the server

**Where do I insert the code?**

* Go to your Wordpress control panel
* Select Appearance > Editor
* Select one of the template files you'd like the Cu3er be inserted into. ( normally: Main Index Template (index.php) or Header (header.php) )
* Paste the code somewhere on that page. If you're unsure, go to your index.php, locate ` get_header(); ?>` at the top of the template file, and insert the code right after it. You'll see the Cu3er appear right under your Header.

== Change Log ==
*Version 0.5.1
bugfix: colorpicker

* Version 0.5.0
initial release

== Screenshots ==

1. The Cu3er
2. Setup Page
