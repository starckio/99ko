<?php
defined('ROOT') OR exit('No direct script access allowed');

## Fonction d'installation

<<<<<<< HEAD
/********************************************************************************************************************
** Code relatif au plugin
** La partie ci-dessous est réservé au code du plugin 
** Elle peut contenir des classes, des fonctions, hooks... ou encore du code à exécutter lors du chargement du plugin
********************************************************************************************************************/

function pluginsmanagerAdminNotifications(){
    $core = core::getInstance();
    $pluginsManager = pluginsManager::getInstance();
    $list = '';
    foreach($pluginsManager->getPlugins() as $plugin){
        if(!$pluginsManager->isActivePlugin($plugin->getName())) $list.= $plugin->getInfoVal('name').', ';
    }
    if($list != '') show::msg($core->lang("Plugins are inactive or require maintenance").' ('.trim($list, ', ').')', "info");
=======
function pluginsmanagerInstall(){
>>>>>>> dev
}

## Hooks
## Code relatif au plugin
?>