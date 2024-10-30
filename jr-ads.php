<?php
/*
Plugin Name: JR Ads
Plugin URI: http://www.jakeruston.co.uk/2009/11/wordpress-plugin-jr-ads/
Description: This plugin allows you to display advertisements from various different networks or ad sizes!
Version: 1.4.0
Author: Jake Ruston
Author URI: http://www.jakeruston.co.uk
*/

/*  Copyright 2010 Jake Ruston - the.escapist22@gmail.com

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

$pluginname="ads";

// Hook for adding admin menus
add_action('admin_menu', 'jr_ads_add_pages');
add_filter('the_content', 'show_ads_content');
add_filter('the_content', 'show_ads_content2');

// action function for above hook
function jr_ads_add_pages() {
    add_options_page('JR Ads', 'JR Ads', 'administrator', 'jr_ads', 'jr_ads_options_page');
}

if (!function_exists("_iscurlinstalled")) {
function _iscurlinstalled() {
if (in_array ('curl', get_loaded_extensions())) {
return true;
} else {
return false;
}
}
}

if (!function_exists("jr_show_notices")) {
function jr_show_notices() {
echo "<div id='warning' class='updated fade'><b>Ouch! You currently do not have cURL enabled on your server. This will affect the operations of your plugins.</b></div>";
}
}

if (!_iscurlinstalled()) {
add_action("admin_notices", "jr_show_notices");

} else {
if (!defined("ch"))
{
function setupch()
{
$ch = curl_init();
$c = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
return($ch);
}
define("ch", setupch());
}

if (!function_exists("curl_get_contents")) {
function curl_get_contents($url)
{
$c = curl_setopt(ch, CURLOPT_URL, $url);
return(curl_exec(ch));
}
}
}

register_activation_hook(__FILE__,'ads_choice');

if (!function_exists("jr_ads_refresh")) {
function jr_ads_refresh() {
update_option("jr_submitted_1", "0");
}
}

function ads_choice () {
if (get_option("jr_ads_links_choice")=="") {

$rand=rand(1,3);

switch ($rand) {
case 1:
$content="<a href='http://www.xeromi.net'>Web Hosting</a>";
break;
case 2:
$content="<a href='http://directory.xeromi.net'>Web Hosting Directory</a>";
break;
case 3:
$content="<a href='http://blog.xeromi.net'>Web Hosting Blog</a>";
break;
}

update_option("jr_ads_links_choice", $content);
}
}

// jr_ads_options_page() displays the page content for the Test Options submenu
function jr_ads_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_ads_header';
	$opt_name_2 = 'mt_ads_1';
    $opt_name_3 = 'mt_ads_code_1';
	$opt_name_4 = 'mt_ads_2';
    $opt_name_6 = 'mt_ads_code_2';
	$opt_name_7 = 'mt_ads_3';
	$opt_name_8 = 'mt_ads_code_3';
	$opt_name_9 = 'mt_ads_plugin_support';
	$opt_name_10 = 'mt_ads_code_content';
	$opt_name_11 = 'mt_ads_code_content2';
	$opt_name_12 = 'mt_ads_4';
	$opt_name_13 = 'mt_ads_code_4';
	$opt_name_14 = 'mt_ads_5';
	$opt_name_15 = 'mt_ads_code_5';
    $hidden_field_name = 'mt_ads_submit_hidden';
    $data_field_name = 'mt_ads_header';
	$data_field_name_2 = 'mt_ads_1';
    $data_field_name_3 = 'mt_ads_code_1';
	$data_field_name_4 = 'mt_ads_2';
    $data_field_name_6 = 'mt_ads_code_2';
	$data_field_name_7 = 'mt_ads_3';
	$data_field_name_8 = 'mt_ads_code_3';
	$data_field_name_9 = 'mt_ads_plugin_support';
	$data_field_name_10 = 'mt_ads_code_content';
	$data_field_name_11 = 'mt_ads_code_content2';
	$data_field_name_12 = 'mt_ads_4';
	$data_field_name_13 = 'mt_ads_code_4';
	$data_field_name_14 = 'mt_ads_5';
	$data_field_name_15 = 'mt_ads_code_5';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val_2 = get_option( $opt_name_2 );
    $opt_val_3 = get_option( $opt_name_3 );
	$opt_val_4 = get_option($opt_name_4);
    $opt_val_6 = get_option($opt_name_6);
	$opt_val_7 = get_option($opt_name_7);
	$opt_val_8 = get_option($opt_name_8);
	$opt_val_9 = get_option($opt_name_9);
	$opt_val_10 = get_option($opt_name_10);
	$opt_val_11 = get_option($opt_name_11);
	$opt_val_12 = get_option($opt_name_12);
	$opt_val_13 = get_option($opt_name_13);
	$opt_val_14 = get_option($opt_name_14);
	$opt_val_15 = get_option($opt_name_15);
    
if (!$_POST['feedback']=='') {
$my_email1="the.escapist22@gmail.com";
$plugin_name="JR Ads";
$blog_url_feedback=get_bloginfo('url');
$user_email=$_POST['email'];
$user_email=stripslashes($user_email);
$subject=$_POST['subject'];
$subject=stripslashes($subject);
$name=$_POST['name'];
$name=stripslashes($name);
$response=$_POST['response'];
$response=stripslashes($response);
$category=$_POST['category'];
$category=stripslashes($category);
if ($response=="Yes") {
$response="REQUIRED: ";
}
$feedback_feedback=$_POST['feedback'];
$feedback_feedback=stripslashes($feedback_feedback);
if ($user_email=="") {
$headers1 = "From: feedback@jakeruston.co.uk";
} else {
$headers1 = "From: $user_email";
}

$emailsubject1=$response.$plugin_name." - ".$category." - ".$subject;
$emailmessage1="Blog: $blog_url_feedback\n\nUser Name: $name\n\nUser E-Mail: $user_email\n\nMessage: $feedback_feedback";
mail($my_email1,$emailsubject1,$emailmessage1,$headers1);
?>
<div class="updated"><p><strong><?php _e('Feedback Sent!', 'mt_trans_domain' ); ?></strong></p></div>
<?php
}

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
		$opt_val_2 = $_POST[ $data_field_name_2 ];
        $opt_val_3 = $_POST[ $data_field_name_3 ];
		$opt_val_4 = $_POST[$data_field_name_4];
        $opt_val_6 = $_POST[$data_field_name_6];
		$opt_val_7 = $_POST[$data_field_name_7];
		$opt_val_8 = $_POST[$data_field_name_8];
		$opt_val_9 = $_POST[$data_field_name_9];
		$opt_val_10 = $_POST[$data_field_name_10];
		$opt_val_11 = $_POST[$data_field_name_11];
		$opt_val_12 = $_POST[$data_field_name_12];
		$opt_val_13 = $_POST[$data_field_name_13];
		$opt_val_14 = $_POST[$data_field_name_14];
		$opt_val_15 = $_POST[$data_field_name_15];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
		update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_3, $opt_val_3 );
		update_option($opt_name_4, $opt_val_4);
        update_option( $opt_name_6, $opt_val_6 );  
		update_option( $opt_name_7, $opt_val_7 );
		update_option( $opt_name_8, $opt_val_8 );
		update_option( $opt_name_9, $opt_val_9 );
		update_option( $opt_name_10, $opt_val_10 );
		update_option( $opt_name_11, $opt_val_11 );
		update_option( $opt_name_12, $opt_val_12 );
		update_option( $opt_name_13, $opt_val_13 );
		update_option( $opt_name_14, $opt_val_14 );
		update_option( $opt_name_15, $opt_val_15 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'JR Ads Plugin Options', 'mt_trans_domain' ) . "</h2>";
$blog_url_feedback=get_bloginfo('url');

	?>
	<div class="updated"><p><strong><?php _e('Please consider donating to help support the development of my plugins!', 'mt_trans_domain' ); ?></strong><br /><br /><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ULRRFEPGZ6PSJ">
<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form></p><br /><form action="" method="post"><input type="hidden" name="mtdonationjr" value="444" /><input type="submit" value="Don't Show This Again" /></form></div>
<?php
    // options form
    
    $change4 = get_option("mt_ads_plugin_support");

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}
    ?>

<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Ad Code 1 - Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo stripslashes($opt_val_2); ?>">
</p><hr />

<p><?php _e("Ad Code 1 - Code:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_3; ?>" rows="5" cols="50"><?php echo stripslashes($opt_val_3); ?></textarea>
</p><hr />

<p><?php _e("Ad Code 2 - Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_4; ?>" value="<?php echo stripslashes($opt_val_4); ?>">
</p><hr />

<p><?php _e("Ad Code 2 - Code:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_6; ?>" rows="5" cols="50"><?php echo stripslashes($opt_val_6); ?></textarea>
</p><hr />

<p><?php _e("Ad Code 3 - Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_7; ?>" value="<?php echo stripslashes($opt_val_7); ?>">
</p><hr />

<p><?php _e("Ad Code 3 - Code:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_8; ?>" rows="5" cols="50"><?php echo stripslashes($opt_val_8); ?></textarea>
</p><hr />

<p><?php _e("Ad Code 4 - Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_12; ?>" value="<?php echo stripslashes($opt_val_12); ?>">
</p><hr />

<p><?php _e("Ad Code 4 - Code:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_13; ?>" rows="5" cols="50"><?php echo stripslashes($opt_val_13); ?></textarea>
</p><hr />

<p><?php _e("Ad Code 5 - Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_14; ?>" value="<?php echo stripslashes($opt_val_14); ?>">
</p><hr />

<p><?php _e("Ad Code 5 - Code:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_15; ?>" rows="5" cols="50"><?php echo stripslashes($opt_val_15); ?></textarea>
</p><hr />

<p><?php _e("Ad Code ABOVE Posts - Code:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_10; ?>" rows="5" cols="50"><?php echo stripslashes($opt_val_10); ?></textarea>
</p><hr />

<p><?php _e("Ad Code BELOW Posts - Code:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_11; ?>" rows="5" cols="50"><?php echo stripslashes($opt_val_11); ?></textarea>
</p><hr />

<p><?php _e("Show Plugin Support?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_9; ?>" value="Yes" <?php echo $change4; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_9; ?>" value="No" <?php echo $change41; ?> >No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}

function validateEmail(ctrl){

var strMail = ctrl.value
        var regMail =  /^\w+([-.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

        if (regMail.test(strMail))
        {
            return true;
        }
        else
        {

            return false;

        }
					
	}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_required(subject,"Subject must be filled out!")==false)
  {email.focus();return false;}
  if (validate_required(email,"E-Mail must be filled out!")==false)
  {email.focus();return false;}
  if (validate_required(feedback,"Feedback must be filled out!")==false)
  {email.focus();return false;}
  if (validateEmail(email)==false)
  {
  alert("E-Mail Address not valid!");
  email.focus();
  return false;
  }
 }
}
</script>
<h3>Submit Feedback about my Plugin!</h3>
<p><b>Note: Only send feedback in english, I cannot understand other languages!</b><br /><b>Please do not send spam messages!</b></p>
<form name="form2" method="post" action="" onsubmit="return validate_form(this)">
<p><?php _e("Your Name:", 'mt_trans_domain' ); ?> 
<input type="text" name="name" /></p>
<p><?php _e("E-Mail Address (Required):", 'mt_trans_domain' ); ?> 
<input type="text" name="email" /></p>
<p><?php _e("Message Category:", 'mt_trans_domain'); ?>
<select name="category">
<option value="General">General</option>
<option value="Feedback">Feedback</option>
<option value="Bug Report">Bug Report</option>
<option value="Feature Request">Feature Request</option>
<option value="Other">Other</option>
</select>
<p><?php _e("Message Subject (Required):", 'mt_trans_domain' ); ?>
<input type="text" name="subject" /></p>
<input type="checkbox" name="response" value="Yes" /> I want e-mailing back about this feedback</p>
<p><?php _e("Message Comment (Required):", 'mt_trans_domain' ); ?> 
<textarea name="feedback"></textarea>
</p>
<p class="submit">
<input type="submit" name="Send" value="<?php _e('Send', 'mt_trans_domain' ); ?>" />
</p><hr /></form>
</div>
<?php
}

if (get_option("jr_ads_links_choice")=="") {
ads_choice();
}

function show_ads_1() {

  $ads_code_1 = get_option("mt_ads_code_1"); 
  $ads_code_1 = stripslashes($ads_code_1);
  $supportplugin = get_option("mt_ads_plugin_support");
  
echo $ads_code_1 . "<br /><br />";

if ($supportplugin=="Yes") {
add_action('wp_footer', 'ads_footer_plugin_support');
}

}

function show_ads_2() {

  $ads_code_2 = get_option("mt_ads_code_2"); 
  $ads_code_2 = stripslashes($ads_code_2);
  $supportplugin = get_option("mt_ads_plugin_support");
  
echo $ads_code_2 . "<br /><br />";

if ($supportplugin=="Yes") {
add_action('wp_footer', 'ads_footer_plugin_support');
}
}

function show_ads_3() {

  $ads_code_3 = get_option("mt_ads_code_3"); 
  $ads_code_3 = stripslashes($ads_code_3);
  $supportplugin = get_option("mt_ads_plugin_support");
  
echo $ads_code_3 . "<br /><br />";

if ($supportplugin=="Yes") {
add_action('wp_footer', 'ads_footer_plugin_support');
}
}

function show_ads_4() {

  $ads_code_4 = get_option("mt_ads_code_4"); 
  $ads_code_4 = stripslashes($ads_code_4);
  $supportplugin = get_option("mt_ads_plugin_support");
  
echo $ads_code_4 . "<br /><br />";

if ($supportplugin=="Yes") {
add_action('wp_footer', 'ads_footer_plugin_support');
}
}

function show_ads_5() {

  $ads_code_5 = get_option("mt_ads_code_5"); 
  $ads_code_5 = stripslashes($ads_code_5);
  $supportplugin = get_option("mt_ads_plugin_support");
  
echo $ads_code_5 . "<br /><br />";

if ($supportplugin=="Yes") {
add_action('wp_footer', 'ads_footer_plugin_support');
}
}

function init_ads_widget() {
$title1=get_option("mt_ads_1");
$title2=get_option("mt_ads_2");
$title3=get_option("mt_ads_3");
$title4=get_option("mt_ads_4");
$title5=get_option("mt_ads_5");

if ($title1=="") {
$title1="Ad 1";
}

if ($title2=="") {
$title1="Ad 2";
}

if ($title3=="") {
$title1="Ad 3";
}

if ($title4=="") {
$title1="Ad 4";
}

if ($title5=="") {
$title1="Ad 5";
}

register_sidebar_widget("JR Ads - ".$title1, "show_ads_1");
register_sidebar_widget("JR Ads - ".$title2, "show_ads_2");
register_sidebar_widget("JR Ads - ".$title3, "show_ads_3");
register_sidebar_widget("JR Ads - ".$title4, "show_ads_4");
register_sidebar_widget("JR Ads - ".$title5, "show_ads_5");
}

function show_ads_content($content) {
$adcode=get_option("mt_ads_code_content");
$adcode = stripslashes($adcode);
$supportplugin = get_option("mt_ads_plugin_support");

global $single, $feed, $post;

if (!$feed && $single) {
$content = $adcode . "<br />" . $content;
}

if ($supportplugin=="Yes") {
add_action('wp_footer', 'ads_footer_plugin_support');
}

return $content;
}

function show_ads_content2($content) {
$adcode=get_option("mt_ads_code_content2");
$adcode = stripslashes($adcode);
$supportplugin = get_option("mt_ads_plugin_support");

global $single, $feed, $post;

if (!$feed && $single) {
$content = $content . "<br />" . $adcode;
}

if ($supportplugin=="Yes") {
add_action('wp_footer', 'ads_footer_plugin_support');
}

return $content;
}

function ads_footer_plugin_support() {

  $pshow = "<p style='font-size:x-small'>Ads Plugin created by and published by ".stripslashes(get_option('jr_ads_links_choice'))."</p>";
  echo $pshow;
  
}

add_action("plugins_loaded", "init_ads_widget");

add_shortcode('jr_ads_1', 'show_ads_1');
add_shortcode('jr_ads_2', 'show_ads_2');
add_shortcode('jr_ads_3', 'show_ads_3');
add_shortcode('jr_ads_4', 'show_ads_4');
add_shortcode('jr_ads_5', 'show_ads_5');
?>
