<?php
/*
 * 99ko CMS (since 2010)
 * http://99ko.org
 *
 * Creator / Developper :
 * helloJo (contact@99ko.org / j.coulet@gmail.com)
 * 
 * Contributors :
 * Frédéric Kaplon (frederic.kaplon@me.com)
 * Florent Fortat (florent.fortat@maxgun.fr)
 *
 */

## Préchauffage...
define('ROOT', '../');
include_once(ROOT.'common/common.php');
include_once(COMMON.'administrator.class.php');
$administrator = new administrator($core->getConfigVal('adminEmail'), $core->getConfigVal('adminPwd'));
## Variables
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
$msgType = (isset($_GET['msgType'])) ? $_GET['msgType'] : '';
$pageTitle = $runPlugin->getInfoVal('name');
## Mode login
if($administrator->isAuthorized() && $core->detectAdminMode() == 'login'){
	// on bloque l'authentification si le fichier install est présent
	/*$temp = $core->check();
	if($core->getConfigVal('debug') == 0 && isset($temp[2])){
		$msg = $core->lang('Please delete the install.php file before logging');
		include_once('login.php');
	}*/
	// authentification
	/*else*/if($administrator->login($_POST['adminEmail'], $_POST['adminPwd'])){
		header('location:index.php');
		die();
	}
	else{
		$msg = "Mot de passe incorrect";
		include_once('login.php');
	}
}
## Mode logout
elseif($administrator->isAuthorized() && $core->detectAdminMode() == 'logout'){
	$administrator->logout();
	header('location:index.php');
	die();
}
## Mode session KO
if(!$administrator->isLogged()){
	include_once('login.php');
}
## Mode plugin
elseif($core->detectAdminMode() == 'plugin'){
	// On inclut le fichier des traitements admin
	include($runPlugin->getAdminFile());
	// Plugin standard (un seul template)
	if(!is_array($runPlugin->getAdminTemplate())) include($runPlugin->getAdminTemplate());
}
?>