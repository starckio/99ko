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
     	eval($core->callHook('startShowMsg'));
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
     	eval($core->callHook('startShowMsg'));
     	if($msg != '') $data = '<div data-alert class="alert-box '.$class[$type].' radius">
     	                                <p>'.nl2br(htmlentities($msg)).'</p><a href="#" class="close">&times;</a>
     	                        </div>';
      }
     	eval($core->callHook('endShowMsg'));
     	echo $data;
     }

     // affiche les balises "link" type css (admin + theme)
     public static function linkTags(){
		$core = core::getInstance();
		$mode = (ROOT == './') ? 'public' : 'admin';
		$data = '';
		foreach($core->getCss()[$mode] as $k=>$v){
			$data.= '<link href="'.$v.'" rel="stylesheet" type="text/css" />';
		}
     	eval($core->callHook('endShowLinkTags'));
     	echo $data;
     }

     // affiche les balises "script" type javascript (admin + theme)
     public static function scriptTags(){
		$core = core::getInstance();
		$mode = (ROOT == './') ? 'public' : 'admin';
		$data = '';
		foreach($core->getJs()[$mode] as $k=>$v){
			$data.= '<script type="text/javascript" src="'.$v.'"></script>';
		}
     	eval($core->callHook('endShowLinkTags'));
     	echo $data;
     }

     // affiche une balise textarea (admin)
     public static function adminEditor($name, $content, $id='editor', $class='editor') {
      $core = core::getInstance();
     	eval($core->callHook('startShowAdminEditor'));
     	$data = '<textarea name="'.$name.'" id="'.$id.'" class="'.$class.'">'.$content.'</textarea>';
     	eval($core->callHook('endShowAdminEditor'));
     	echo $data;
     }

     // affiche un input hidden contenant le token (admin)
     public static function adminTokenField() {
      $core = core::getInstance();
     	eval($core->callHook('startShowAdminTokenField'));
     	$output = '<input type="hidden" name="token" value="'.administrator::getToken().'" />';
     	eval($core->callHook('endShowAdminTokenField'));
     	echo $output;
     }
   
     // affiche le contenu de la meta title (theme)
     public static function titleTag() {
      $core = core::getInstance();
     	global $runPlugin;
     	eval($core->callHook('startShowtitleTag'));
     	$data = $runPlugin->getTitleTag();
     	eval($core->callHook('endShowtitleTag'));
     	echo $data;
     }

     // affiche le contenu de la meta description (theme)
     public static function metaDescriptionTag() {
      $core = core::getInstance();
     	global $runPlugin;
     	eval($core->callHook('startShowMetaDescriptionTag'));
     	$data = $runPlugin->getMetaDescriptionTag();
     	eval($core->callHook('endShowMetaDescriptionTag'));
     	echo $data;
     }

     // affiche le titre de page (theme)
     public static function mainTitle($format = '<h1>[mainTitle]</h1>') {
      $core = core::getInstance();
     	global $runPlugin;
     	eval($core->callHook('startShowMainTitle'));
     	if($core->getConfigVal('hideTitles') == 0 && $runPlugin->getMainTitle() != ''){
     		$data = $format;
     		$data = str_replace('[mainTitle]', $runPlugin->getMainTitle(), $data);
     	}
     	else $data = '';
     	eval($core->callHook('endShowMainTitle'));
     	echo $data;
     }

     // affiche le nom du site (theme)
     public static function siteName() {
      $core = core::getInstance();
     	eval($core->callHook('startShowSiteName'));
     	$data = $core->getConfigVal('siteName');
     	eval($core->callHook('endShowSiteName'));
     	echo $data;
     }

     // affiche la escription du site (theme)
     public static function siteDescription() {
      $core = core::getInstance();
     	eval($core->callHook('startShowSiteDescription'));
     	$data = $core->getConfigVal('siteDescription');
     	eval($core->callHook('endShowSiteDescription'));
     	echo $data;
     }

     // affiche l'url du site (theme)
     public static function siteUrl() {
      $core = core::getInstance();
     	eval($core->callHook('startShowSiteUrl'));
     	$data = $core->getConfigVal('siteUrl');
     	eval($core->callHook('endShowSiteUrl'));
     	echo $data;
     }

     // affiche la langue courante (theme)
     public static function siteLang() {
      $core = core::getInstance();
     	eval($core->callHook('startShowSiteLang'));
     	$data = $core->getConfigVal('siteLang');
     	eval($core->callHook('endShowSiteLang'));
     	echo $data;
     }

     // affiche la navigation principale (theme)
     public static function mainNavigation($format = '<li><a href="[target]" target="[targetAttribut]">[label]</a>[childrens]</li>') {
     	$pluginsManager = pluginsManager::getInstance();
	$core = core::getInstance();
     	$data = '';
     	eval($core->callHook('startShowMainNavigation'));
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
     	eval($core->callHook('endShowMainNavigation'));
     	echo $data;
     }

     // affiche le theme courant (theme)
     public static function theme($format = '<a onclick="window.open(this.href);return false;" href="[authorWebsite]">[name]</a>') {
     	//global $themes;
	$core = core::getInstance();
     	eval($core->callHook('startShowTheme'));
     	$data = $format;
     	$data = str_replace('[authorWebsite]', $core->getThemeInfo('authorWebsite'), $data);
     	$data = str_replace('[author]', $core->getThemeInfo('author'), $data);
     	$data = str_replace('[name]', $core->getThemeInfo('name'), $data);
	$data = str_replace('[id]', $core->getConfigVal('theme'), $data);
     	eval($core->callHook('endShowTheme'));
     	echo $data;
     }

     // affiche l'identifiant du plugin courant (theme)
     public static function pluginId(){
      $core = core::getInstance();
     	global $runPlugin;
     	eval($core->callHook('startShowPluginId'));
     	$data = $runPlugin->getName();
     	eval($core->callHook('endShowPluginId'));
     	echo $data;
     }
	 
	 public static function currentUrl(){
	  $core = core::getInstance();
     	eval($core->callHook('startShowCurrentUrl'));
     	$data = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     	eval($core->callHook('endShowCurrentUrl'));
     	echo $data;
	 }
    
}
?>