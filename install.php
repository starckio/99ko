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

session_start();
define('ROOT', './');
include_once(ROOT.'common/config.php');
include_once(COMMON.'util.class.php');
include_once(COMMON.'core.class.php');
include_once(COMMON.'pluginsManager.class.php');
include_once(COMMON.'plugin.class.php');
include_once(COMMON.'show.class.php');
include_once(COMMON.'administrator.class.php');
if(file_exists(DATA. 'config.json')) die('Un fichier de configuration existe déjà !');
$core = core::getInstance();
$administrator = new administrator();
$pluginsManager = pluginsManager::getInstance();
$msg = "Après installation, vous serez redirigé vers la page d'identification afin de paramétrer votre site web.";
if($core->install()){
	$plugins = $pluginsManager->getPlugins();
	if($plugins != false){
		foreach($plugins as $plugin){
		  if($plugin->getLibFile()){
			include_once($plugin->getLibFile());
			if(!$plugin->isInstalled()) $pluginsManager->installPlugin($plugin->getName(), true);
			$plugin->setConfigVal('activate', '1');
			$pluginsManager->savePluginConfig($plugin);
		  }
		}
	}
}
if(count($_POST) > 0 && $administrator->isAuthorized()){
	$adminPwd = $administrator->encrypt($_POST['adminPwd']); 
    $adminEmail = $_POST['adminEmail'];
	$config = array(
		'siteName' => "Nom du site",
		'adminPwd' => $administrator->encrypt($_POST['adminPwd']),
		'adminEmail' => $_POST['adminEmail'],
		'siteUrl' => $core->makeSiteUrl(),      
		'urlRewriting' => '0',
		'htaccessOptimization' => '0',
		'theme' => 'default',
		'hideTitles' => '0',
		'defaultPlugin' => 'page',
		'debug' => '0',
		'defaultAdminPlugin' => 'page',
		'urlSeparator' => ',',
	);
	if(!@file_put_contents(DATA. 'config.json', json_encode($config)) ||	!@chmod(DATA. 'config.json', 0666)){
		$msg = 'Une erreur est survenue';
	}
	else{
		$_SESSION['installOk'] = true;
		header('location:admin/');
		die();
	}
}
?>

<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<title>99ko - Installation</title>

	<link rel="stylesheet" href="admin/main.css">
	<link rel="stylesheet" href="admin/login.css">

</head>
<body>

<main class="main" role="main">

	<?php show::msg($msg); ?>

	<h1>Installation</h1>

	<form method="post" action="">
		<?php show::adminTokenField(); ?>
		<div class="field">
			<label for="adminEmail">Email</label>
			<input type="email" name="adminEmail" id="adminEmail" required />
		</div>
		<div class="field">
			<label for="adminPwd">Mot de passe</label>
			<input type="password" name="adminPwd" id="adminPwd" required />
			<small><a id="showPassword" href="javascript:showPassword()">Montrer le mot de passe</a></small>
		</div>
		<button class="btn" type="submit" name="submit">Valider</button>
	</form>

	<footer class="footer cf" role="contentinfo">
		<div class="copyright">
			Designed by <a href="http://www.starck.io"><b>Starckio</b></a>
		</div>
		<div class="colophon">
			<a href="http://99ko.org">Just using 99ko <b><?php echo VERSION; ?></b></a>
		</div>
	</footer>
</main>

<script type="text/javascript">
	function showPassword(){
		document.getElementById("adminPwd").setAttribute("type", "text");
		document.getElementById("showPassword").style.display = 'none';
	}
</script>
</body>
</html>