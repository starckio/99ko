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
session_start();
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'common/config.php');
include_once(COMMON.'util.class.php');
include_once(COMMON.'core.class.php');
include_once(COMMON.'pluginsManager.class.php');
include_once(COMMON.'plugin.class.php');
include_once(COMMON.'show.class.php');
## Création de l'instance core
$core = core::getInstance();
## Plugin par défaut du mode public
define('DEFAULT_PLUGIN', $core->getConfigVal('defaultPlugin'));
## Plugin par défaut du mode admin
define('DEFAULT_ADMIN_PLUGIN', $core->getConfigVal('defaultAdminPlugin'));
## Si le core n'est pas installé on redirige vers le script d'installation
if(!$core->isInstalled()){
	header('location:' .ROOT. 'install.php');
	die();
}
## Création de l'istance pluginsManager
$pluginsManager = pluginsManager::getInstance();
## On boucle sur les plugins
foreach($pluginsManager->getPlugins() as $plugin){
	// On inclut le fichier PHP principal
	include_once($plugin->getLibFile());
	// Le core charge le fichier langue du plugin
	$core->loadPluginLang($plugin->getName());
	// Le core alimente le tableau des hooks
	if($plugin->getConfigVal('activate')){
		foreach($plugin->getHooks() as $name=>$function){
			$core->addHook($name, $function);
		}
	}
}
## Hook
eval($core->callHook('startCreatePlugin'));
## Création de l'instance runPlugin, objet qui représente le plugin en cours d'execution
$runPlugin = $pluginsManager->getPlugin($core->getPluginToCall());
## Hook
eval($core->callHook('endCreatePlugin'));
?>