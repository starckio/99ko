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
    
     // affiche un message d'alerte (admin + theme)
     public static function msg($msg, $type){
      $core = core::getInstance();
      if(ROOT == './'){
     	$class = array(
     		'error'   => 'error',
     		'success' => 'success',
     		'info'    => 'info',
     		'warning' => 'warning',
     	);

          if (!isset($class[$type])) {
               $type = 'info';
          }
     	$data = '';
     	if($msg != '') $data = '<div id="msg" class="'.$class[$type].'"><p>'.nl2br(htmlentities($msg)).'</p></div>';
      }
      else{
	 $class = array(
     		'error'   => 'alert',
     		'success' => 'success',
     		'info'    => 'info',
     		'warning' => 'warning',
     	);

          if (!isset($class[$type])) {
               $type = 'info';
          }

     	$data = '';
     	if($msg != '') $data = '<div data-alert class="alert-box '.$class[$type].' radius">
     	                                <p>'.nl2br(htmlentities($msg)).'</p><a href="#" class="close">&times;</a>
     	                        </div>';
      }
     	echo $data;
     }

     // affiche les balises "link" type css (admin + theme)
     public static function linkTags($format = '<link href="[file]" rel="stylesheet" type="text/css" />'){
      $core = core::getInstance();
     	$pluginsManager = pluginsManager::getInstance();
     	$data = '';
     	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
     		if(ROOT == './' && $plugin->getConfigVal('activate') && $plugin->getPublicCssFile()) $data.= str_replace('[file]', $plugin->getPublicCssFile(), $format);
     		elseif(ROOT == '../' && $plugin->getConfigVal('activate') && $plugin->getAdminCssFile()) $data.= str_replace('[file]', $plugin->getAdminCssFile(), $format);
     	}
     	if(ROOT == './') $data.= str_replace('[file]', $core->getConfigVal('siteUrl').'/'.'theme/'.$core->getConfigVal('theme').'/styles.css', $format);
     	echo $data;
     }

     // affiche les balises "script" type javascript (admin + theme)
     public static function scriptTags($format = '<script type="text/javascript" src="[file]"></script>') {
      $core = core::getInstance();
     	$pluginsManager = pluginsManager::getInstance();
     	$data = '';
     	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
     		if(ROOT == './' && $plugin->getConfigVal('activate') && $plugin->getPublicJsFile()) $data.= str_replace('[file]', $plugin->getPublicJsFile(), $format);
     		elseif(ROOT == '../' && $plugin->getConfigVal('activate') && $plugin->getAdminJsFile()) $data.= str_replace('[file]', $plugin->getAdminJsFile(), $format);
     	}
     	if(ROOT == './') $data.= str_replace('[file]', $core->getConfigVal('siteUrl').'/'.'theme/'.$core->getConfigVal('theme').'/scripts.js', $format);
     	echo $data;
     }

     // affiche une balise textarea (admin)
     public static function adminEditor($name, $content, $id='editor', $class='editor') {
      $core = core::getInstance();
     	$data = '<textarea name="'.$name.'" id="'.$id.'" class="'.$class.'">'.$content.'</textarea>';
     	echo $data;
     }

     // affiche un input hidden contenant le token (admin)
     public static function adminTokenField() {
      $core = core::getInstance();
     	$output = '<input type="hidden" name="token" value="'.administrator::getToken().'" />';
     	echo $output;
     }
   
     // affiche le contenu de la meta title (theme)
     public static function titleTag() {
      $core = core::getInstance();
     	global $runPlugin;
     	$data = $runPlugin->getTitleTag();
     	echo $data;
     }

     // affiche le contenu de la meta description (theme)
     public static function metaDescriptionTag() {
      $core = core::getInstance();
     	global $runPlugin;
     	$data = $runPlugin->getMetaDescriptionTag();
     	echo $data;
     }

     // affiche le titre de page (theme)
     public static function mainTitle($format = '<h1>[mainTitle]</h1>') {
      $core = core::getInstance();
     	global $runPlugin;
     	if($core->getConfigVal('hideTitles') == 0 && $runPlugin->getMainTitle() != ''){
     		$data = $format;
     		$data = str_replace('[mainTitle]', $runPlugin->getMainTitle(), $data);
     	}
     	else $data = '';
     	echo $data;
     }

     // affiche le nom du site (theme)
     public static function siteName() {
      $core = core::getInstance();
     	$data = $core->getConfigVal('siteName');
     	echo $data;
     }

     // affiche la escription du site (theme)
     public static function siteDescription() {
      $core = core::getInstance();
     	$data = $core->getConfigVal('siteDescription');
     	echo $data;
     }

     // affiche l'url du site (theme)
     public static function siteUrl() {
      $core = core::getInstance();
     	$data = $core->getConfigVal('siteUrl');
     	echo $data;
     }

     // affiche la langue courante (theme)
     public static function siteLang() {
      $core = core::getInstance();
     	$data = $core->getConfigVal('siteLang');
     	echo $data;
     }

     // affiche la navigation principale (theme)
     public static function mainNavigation($format = '<li><a href="[target]" target="[targetAttribut]">[label]</a>[childrens]</li>') {
     	$pluginsManager = pluginsManager::getInstance();
	$core = core::getInstance();
     	$data = '';
     	foreach($pluginsManager->getPlugins() as $k=>$plugin) if($plugin->getConfigval('activate') == 1){
			//print_r($plugin->getNavigation());
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

     // affiche le theme courant (theme)
     public static function theme($format = '<a onclick="window.open(this.href);return false;" href="[authorWebsite]">[name]</a>') {
     	//global $themes;
	$core = core::getInstance();
     	$data = $format;
     	$data = str_replace('[authorWebsite]', $core->getThemeInfo('authorWebsite'), $data);
     	$data = str_replace('[author]', $core->getThemeInfo('author'), $data);
     	$data = str_replace('[name]', $core->getThemeInfo('name'), $data);
	$data = str_replace('[id]', $core->getConfigVal('theme'), $data);
     	echo $data;
     }

     // affiche l'identifiant du plugin courant (theme)
     public static function pluginId(){
      $core = core::getInstance();
     	global $runPlugin;
     	$data = $runPlugin->getName();
     	echo $data;
     }
	 
	 public static function currentUrl(){
	  $core = core::getInstance();
     	$data = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     	echo $data;
	 }
    
}
?>