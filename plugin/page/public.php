<?php
defined('ROOT') OR exit('No direct script access allowed');
$page = new page();
# Création, de la page
$id = ($core->getUrlParam(1)) ? $core->getUrlParam(1) : false;
if(!$id) $pageItem = $page->createHomepage();
elseif($pageItem = $page->create($id)){}
else $core->error404();
if($pageItem->targetIs() != 'page') $core->error404();
# Gestion du titre
if($runPlugin->getConfigVal('hideTitles')) $runPlugin->setMainTitle('');
else $runPlugin->setMainTitle(($pageItem->getMainTitle() != '') ? $pageItem->getMainTitle() : $pageItem->getName());
# Gestion des metas
if($pageItem->getMetaTitleTag()) $runPlugin->setTitleTag($pageItem->getMetaTitleTag());
else $runPlugin->setTitleTag($pageItem->getName());
if($pageItem->getMetaDescriptionTag()) $runPlugin->setMetaDescriptionTag($pageItem->getMetaDescriptionTag());
// template
$pageFile = ($pageItem->getFile()) ? THEMES .$core->getConfigVal('theme').'/'.$pageItem->getFile() : false;
?>