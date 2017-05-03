<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(THEMES.$core->getConfigVal('theme').'/functions.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<title><?php show::titleTag(); ?></title>
	<base href="<?php show::siteUrl(); ?>/" />
	<meta name="description" content="<?php show::metaDescriptionTag(); ?>">
	<meta name="keywords" content="99ko,etc…">

	<?php show::linkTags(); ?>
	<?php show::scriptTags(); ?>
	<?php eval($core->callHook('endFrontHead')); ?>

</head>
<body id="<?php show::pluginId(); ?>">

<header class="header cf" role="banner">
	<a class="logo" href="<?php show::siteUrl(); ?>">
		<img src="<?php show::siteUrl(); ?>/theme/<?php echo $core->getConfigVal('theme'); ?>/logo.svg" alt="<?php show::siteName(); ?>" />
	</a>
	<div class="toggle">Menu</div>
	<nav class="navigation" role="navigation">
	
		<ul class="menu cf">
			<?php show::mainNavigation(); ?>
		</ul>
	
	</nav>
</header>

<main class="main cf" role="main">

	<div class="text">
		<?php show::mainTitle(); ?>
