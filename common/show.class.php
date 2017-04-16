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

defined('ROOT') OR exit('No direct script access allowed');

class show{
    
     ## Affiche un message d'alerte (admin + theme)
     public static function msg($msg){
		$core = core::getInstance();
		if(ROOT == './'){
			if($msg != '') echo '<div class="msg"><p>'.nl2br(htmlentities($msg)).'</p></div>';
		}
		else{
			if($msg != '') echo '<div class="msg"><p>'.nl2br(htmlentities($msg)).'</p></div>';
		}
     }

     ## Affiche les balises "link" type css (admin + theme)
     public static function linkTags(){
		$core = core::getInstance();
     	$pluginsManager = pluginsManager::getInstance();
		foreach($core->getCss() as $k=>$v){
			echo '<link href="'.$v.'" rel="stylesheet" type="text/css" />';
		}
     	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
     		if(ROOT == './' && $plugin->getConfigVal('activate') && $plugin->getPublicCssFile()) echo '<link href="'.$plugin->getPublicCssFile().'" rel="stylesheet" type="text/css" />';
     		elseif(ROOT == '../' && $plugin->getConfigVal('activate') && $plugin->getAdminCssFile()) echo '<link href="'.$plugin->getAdminCssFile().'" rel="stylesheet" type="text/css" />';
     	}
     	if(ROOT == './') echo '<link href="'.$core->getConfigVal('siteUrl').'/'.'theme/'.$core->getConfigVal('theme').'/styles.css" rel="stylesheet" type="text/css" />';
     }

     ## Affiche les balises "script" type javascript (admin + theme)
     public static function scriptTags(){
		$core = core::getInstance();
     	$pluginsManager = pluginsManager::getInstance();
		foreach($core->getJs() as $k=>$v){
			echo '<script type="text/javascript" src="'.$v.'"></script>';
		}
     	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
     		if(ROOT == './' && $plugin->getConfigVal('activate') && $plugin->getPublicJsFile()) echo '<script type="text/javascript" src="'.$plugin->getPublicJsFile().'"></script>';
     		elseif(ROOT == '../' && $plugin->getConfigVal('activate') && $plugin->getAdminJsFile()) echo '<script type="text/javascript" src="'.$plugin->getAdminJsFile().'"></script>';
     	}
     	if(ROOT == './') echo '<script type="text/javascript" src="'.$core->getConfigVal('siteUrl').'/'.'theme/'.$core->getConfigVal('theme').'/scripts.js'.'"></script>';
     }

     ## Affiche un champ de formulaire contenant le jeton de session (admin)
     public static function adminTokenField(){
		$core = core::getInstance();
     	echo '<input type="hidden" name="token" value="'.administrator::getToken().'" />';
     }
   
     ## Affiche le contenu de la meta title (theme)
     public static function titleTag(){
		$core = core::getInstance();
     	global $runPlugin;
     	echo $runPlugin->getTitleTag().' - '.$core->getConfigVal('siteName');
     }

     ## Affiche le contenu de la meta description (theme)
     public static function metaDescriptionTag(){
		$core = core::getInstance();
     	global $runPlugin;
     	echo $runPlugin->getMetaDescriptionTag();
     }

     ## Affiche le titre de page (theme)
     public static function mainTitle($format = '<h1>[mainTitle]</h1>'){
		$core = core::getInstance();
     	global $runPlugin;
     	if($core->getConfigVal('hideTitles') == 0 && $runPlugin->getMainTitle() != ''){
     		$data = $format;
     		$data = str_replace('[mainTitle]', $runPlugin->getMainTitle(), $data);
     	}
     	else $data = '';
     	echo $data;
     }

     ## Affiche le nom du site (theme)
     public static function siteName(){
		$core = core::getInstance();
     	echo $core->getConfigVal('siteName');
     }

     ## Affiche l'url du site (theme)
     public static function siteUrl(){
		$core = core::getInstance();
     	echo $core->getConfigVal('siteUrl');
     }

     ## Affiche la navigation principale (theme)
     public static function mainNavigation($format = '<li><a href="[target]" target="[targetAttribut]">[label]</a>[childrens]</li>'){
     	$pluginsManager = pluginsManager::getInstance();
		$core = core::getInstance();
     	$data = '';
     	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
     		foreach($plugin->getNavigation() as $k2=>$item) if($item['label'] != ''){
				if($item['parent'] < 1){
				 $temp = $format;
				 $temp = str_replace('[target]', $item['target'], $temp);
				 $temp = str_replace('[label]', $item['label'], $temp);
				 $temp = str_replace('[targetAttribut]', $item['targetAttribut'], $temp);
				 $data2 = '<ul>';
				 $i = 0;
				 foreach($plugin->getNavigation() as $k3=>$item2) if($item2['label'] != '' && $item2['parent'] == $item['id']){
				  $temp2 = $format;
				  $temp2 = str_replace('[target]', $item2['target'], $temp2);
				  $temp2 = str_replace('[label]', $item2['label'], $temp2);
				  $temp2 = str_replace('[targetAttribut]', $item2['targetAttribut'], $temp2);
				  $temp2 = str_replace('[childrens]', '', $temp2);
				  $data2.= $temp2;
				  $i++;
				 }
				 $data2.= '</ul>';
				 if($i == 0) $data2 = '';
				 $temp = str_replace('[childrens]', $data2, $temp);
				 $data.= $temp;
				}
     		}
     	}
     	echo $data;
     }

     ## Affiche le theme courant (theme)
     public static function theme($format = '<a onclick="window.open(this.href);return false;" href="[authorWebsite]">[name]</a>'){
		$core = core::getInstance();
     	$data = $format;
     	$data = str_replace('[authorWebsite]', $core->getThemeInfo('authorWebsite'), $data);
     	$data = str_replace('[author]', $core->getThemeInfo('author'), $data);
     	$data = str_replace('[name]', $core->getThemeInfo('name'), $data);
		$data = str_replace('[id]', $core->getConfigVal('theme'), $data);
     	echo $data;
     }

     ## Affiche l'identifiant du plugin courant (theme)
     public static function pluginId(){
		$core = core::getInstance();
     	global $runPlugin;
     	echo $runPlugin->getName();
     }
	
	## Affiche l'URL courante (theme)
	public static function currentUrl(){
	    $core = core::getInstance();
	    echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
    
}
?>