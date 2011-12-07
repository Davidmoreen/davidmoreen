<?php
/**
 * Contact page
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

require_once 'includes/init.php';
require_once 'lib/validation.lib.php';

$Validate = new Validation();

$Template->set_current_page("contact");
$Template->set_subtitle("Contact ".ucfirst($Me->display_name));

define("EMAIL_SENT", $Data->flash_data("email_sent"));

/**
 * array of ip addresses to not allow
 * to send messages. e.g.:
 * 
 *     $bans = array('127.0.0.1', '0.0.0.0');
 * 
 */
$bans = array();

if (isset($_POST['submit_button']) && !EMAIL_SENT) {
	$name      = clean($_POST['name']);
	$email     = clean($_POST['email']);
	$subject   = clean($_POST['subject']);
	$message   = clean($_POST['message']);
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$to        = $Me->email;
	$errors    = array();
	
	if ( ! $Validate->length($name, 75, 1))
		$errors[] .= "Invalid name";
	
	if ( ! $Validate->email($email))
		$errors[] .= "Invalid email address";
	
	if ( ! $Validate->length($message, 1000, 10))
		if (strlen($message) > 1000)
			$error[] .= "Your message is too long";
		else
			$errors[] .= "Your message is too short";
	
	if (in_array($ipaddress, $bans))
		$errors[] .= "Sorry, you have been banned from sending me messages via this form.";
	
	
	if (empty($errors)) {
		$email_body = <<<EOF
$message
<br /><hr /><br />
Email address: $email<br />
Name: $name<br />
IP address: $ipaddress
EOF;
		
		$email_data = array(
			"method"    => $Config->item("mail_method"),
			"subject"   => $subject,
			"to"        => $to,
			"from"      => $email,
			"body"      => $email_body,
			"sendmail"  => "",
			"encrypt"   => $Config->item("smtp_encrypt"),
			"host"      => $Config->item("smtp_host"),
			"port"      => $Config->item("smtp_port"),
			"user"      => $Config->item("smtp_user"),
			"pass"      => $Config->item("smtp_pass"));
		
		if (@sendmail($email_data)) {
			$Data->set_flash_data("email_sent", true);
			redirect("contact");
		} else {
			$errors .= "There was an error sending your message. Please try again.";
		}
	}
}

include("template/header.php");
?>

<div class="container" id="main_content" style="margin-top: 30px;">	
	<div class="sidebar">
		<?php include 'template/modules/nav.php' ?>
		
		<?php include 'template/modules/hi_there.php' ?>
		
		<?php include 'template/modules/find_me.php' ?>
	</div><!-- /sidebar -->
	
	
	<div class="primary_content">
		<div class="contact">
			<div id="contact_methods">
				<ul>
					<li class="email_address"><a href="mailto:<?php echo obfuscate_email($Me->email) ?>"><?php echo obfuscate_email($Me->email) ?></a></li>
					<?php if ($Me->phone) { ?><li class="phone">Phone : <?php echo $Me->phone ?></li><?php } ?>
					<?php if ($Me->vcard) { ?><li class="vcard"><a href="<?php echo $Me->vcard ?>">Download vcard</a></li><?php } ?>
					<?php if ($Me->skype) { ?><li class="misc_method">Skype : <?php echo $Me->skype ?></li><?php } ?>
				</ul>
			</div>
			
			<h1 style="margin-bottom:12px">Send me a message</h1>
			<?php if ( ! EMAIL_SENT) { ?>
			<div id="contact_form">
				<?php if (!empty($errors)) { echo feedback($errors, "error", 'color:#c14f4b;margin:15px 0 25px;'); } ?>
				<table cellspacing="0" cellpadding="0" class="form_table"  style="margin-top:15px">
					<form method="post" action="" id="contact_form">
					<tr>
						<td class="label"><label for="name">Your name<span class="req_star">*</span></label></td>
						<td><input type="text" name="name" value="<?php echo $name ?>" class="text_input" id="name"><br /><span id="name_error" class="error_label"></span></td>
					</tr>
					<tr>
						<td class="label"><label for="email">Your email address<span class="req_star">*</span></label></td>
						<td><input type="text" name="email" value="<?php echo $email ?>" class="text_input" id="email"><br /><span id="email_error" class="error_label"></span></td>
					</tr>
					<tr>
						<td class="label"><label for="subject">Subject</td>
						<td><input type="text" name="subject" value="<?php echo $subject ?>" class="text_input" id="subject"></td>
					</tr>
					<tr>
						<td class="label"><label for="message">Your message<span class="req_star">*</span><br /><br /><span id="message_error" class="error_label"></span></td>
						<td><textarea name="message" id="message" rows="8" cols="40" class="text_area" style="width:300px !important"><?php echo $message ?></textarea></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit_button" value="Send" id="submit_button"></td>
					</tr>
					</form>
				</table>
			</div>
			<?php } else { ?>
			<p style="color:#368c07">Your message was sent... Yea!</p>
			<?php } ?>
		</div>
	</div><!-- /primary_content -->
</div><!-- /content -->

<?php include("template/footer.php"); ?>