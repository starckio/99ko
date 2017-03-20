<?php
if(!defined('ROOT')) die();

$msg = '';
$msgType = '';
$sendError = false;
if($core->getUrlParam(0) == 'send'){
	if(contactUseCaptchaPlugin() && !checkCaptcha()){
		$msg = $core->lang("The captcha you entered is incorrect");
		$msgType = 'error';
		$sendError = true;
	}
	else{
		if(contactSend()){
			$msg = $core->lang("Your message has been sent");
			$msgType = 'success';
		}
		else{
			$msg = $core->lang("Fields are not filled or the email address is invalid");
			$msgType = 'error';
			$sendError = true;
		}
	}
}
$name = ($sendError) ? $_POST['name'] : '';
$firstname = ($sendError) ? $_POST['firstname'] : '';
$email = ($sendError) ? $_POST['email'] : '';
$message = ($sendError) ? $_POST['message'] : '';
$runPlugin->setMainTitle($runPlugin->getConfigVal('label'));
$runPlugin->setTitleTag($runPlugin->getConfigVal('label'));
?>