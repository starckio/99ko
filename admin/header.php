<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<?php $core->callHook('adminHead'); ?>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<title><?php show::siteName(); ?> - Administration</title>

	<?php show::linkTags(); ?>
	<link rel="stylesheet" href="main.css">
	<?php show::scriptTags(); ?>
	<script type="text/javascript" src="scripts.js"></script>

	<?php $core->callHook('endAdminHead'); ?>

</head>
<body>
<div id="alert"><?php show::msg($msg); ?></div>

<header class="header cf" role="banner">
	<a class="logo" href="./"><?php show::siteName(); ?> - Administration</a>
	<nav role="navigation">

		<ul class="menu cf">
			<li><a href="../" target="_blank">Voir le site</a></li>
			<li><a href="index.php?action=logout&token=<?php echo administrator::getToken(); ?>">Déconnexion</a></li>
		</ul>

	</nav>
</header>

<div class="cf">

<aside role="seealso" class="sidebar">
	<ul class="menu cf">
		<?php foreach($pluginsManager->getPlugins() as $k=>$v) if($v->getConfigVal('activate') && $v->getAdminFile()){ ?>
		<li<?php if($v->isRequired()){ ?> class="last"<?php } ?>>
			<a href="index.php?p=<?php echo $v->getName(); ?>"><?php echo $v->getInfoVal('name'); ?></a>
		</li>
		<?php } ?>
	</ul>
</aside>

<main class="main <?php echo $runPlugin->getName(); ?>-admin" role="main">

	<?php if($runPlugin->getParamTemplate()){ ?>

	<div class="meta cf">
		<h1><?php echo $runPlugin->getInfoVal('name'); ?></h1>
		<a id="param_link" href="javascript:">Paramètres</a>
	</div>

	<div class="text cf">
		<div id="param_panel">
			<?php include($runPlugin->getParamTemplate()); ?>
		</div>

	
	<?php } else { ?>
	<h1><?php echo $runPlugin->getInfoVal('name'); ?></h1>
	<div class="text cf">
	<?php } ?>