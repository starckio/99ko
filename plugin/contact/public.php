<?php
if(!defined('ROOT')) die();

$msg = '';
$sendError = false;
if($core->getUrlParam(0) == 'send'){
	if(contactSend()) $msg = "Message envoyé.";
	else{
		$msg = "Champ(s) incomplet(s) ou email invalide";
		$sendError = true;
	}
}
$name = ($sendError) ? $_POST['name'] : '';
$firstname = ($sendError) ? $_POST['firstname'] : '';
$email = ($sendError) ? $_POST['email'] : '';
$message = ($sendError) ? $_POST['message'] : '';
$runPlugin->setMainTitle($runPlugin->getConfigVal('label'));
$runPlugin->setTitleTag($runPlugin->getConfigVal('label'));
?>