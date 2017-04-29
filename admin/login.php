<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="fr">
  <head>
	<?php eval($core->callHook('adminHead')); ?>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<<<<<<< HEAD
	<title>99ko - <?php echo $core->lang('Login'); ?></title>	
=======
	<title>99ko - Connexion</title>	
>>>>>>> dev
	<?php show::linkTags(); ?>
	<link rel="stylesheet" href="styles.css" media="all">
	<?php show::scriptTags(); ?>
	<script type="text/javascript" src="scripts.js"></script>
	<?php eval($core->callHook('endAdminHead')); ?>	
  </head>
  <body class="login">
		<?php show::msg($msg); ?>
  <div id="login">
	<h1>Connexion</h1>
	<form method="post" action="index.php?action=login">   
	  <?php show::adminTokenField(); ?>          
<<<<<<< HEAD
	  <p><label for="adminEmail"><?php echo $core->lang('Email'); ?></label><br>
	  <input type="email" id="adminEmail" name="adminEmail" placeholder="your@mail.com" required></p>
	  <p><label for="adminPwd"><?php echo $core->lang('Password'); ?></label>
	  <input type="password" id="adminPwd" name="adminPwd" placeholder="*******" required></p>
	  <p>
		<input type="button" class="button alert" value="<?php echo $core->lang('Quit'); ?>" rel="<?php echo $core->getConfigVal('siteUrl'); ?>" />
		<input type="submit" class="button" value="<?php echo $core->lang('Validate'); ?>" />
		</p>
	  <p class="just_using"><a title="<?php echo $core->lang("NoDB CMS"); ?>" target="_blank" href="http://99ko.org"><?php echo $core->lang("Just using 99ko"); ?></a>
=======
	  <p><label for="adminEmail">Email</label><br>
	  <input type="email" id="adminEmail" name="adminEmail" required></p>
	  <p><label for="adminPwd">Mot de passe</label>
	  <input type="password" id="adminPwd" name="adminPwd" required></p>
	  <p>
		<input type="button" class="button alert" value="Quitter" rel="<?php echo $core->getConfigVal('siteUrl'); ?>" />
		<input type="submit" class="button" value="Valider" />
		</p>
	  <p class="just_using"><a target="_blank" href="http://99ko.org">Just using 99ko</a>
>>>>>>> dev
	  </p>
	</form>
  </div>
  <?php eval($core->callHook('endAdminBody')); ?>
  </body>
</html>