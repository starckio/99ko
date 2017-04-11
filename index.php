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
define('ROOT', './');
include_once(ROOT.'common/common.php');
## Gestion des erreurs 404
if(!$runPlugin || $runPlugin->getConfigVal('activate') < 1) $core->error404();
## On inclut le fichier public et la template du plugin en cours d'execution
elseif($runPlugin->getPublicFile()){
	include($runPlugin->getPublicFile());
	include($runPlugin->getPublicTemplate());
}
?>